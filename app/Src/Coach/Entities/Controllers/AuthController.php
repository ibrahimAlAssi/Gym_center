<?php

namespace App\Src\Coach\Entities\Controllers;

use App\Domains\Entities\Mail\SendCodeResetPassword;
use App\Domains\Entities\Models\Coach;
use App\Domains\Entities\Models\ResetCodePassword;
use App\Http\Controllers\Controller;
use App\Src\Admin\Entities\Requests\LoginRequest;
use App\Src\Coach\Entities\Resources\CoachResource;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function __construct(protected Coach $coach)
    {
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $coach = $this->coach->findByEmail($request->get('email'));
        if (empty($coach) || Hash::check($request->get('password'), $coach->password) === false) {
            return $this->failedResponse(__('shared.response_messages.invalid_credentials'));
        }

        return $this->successResponse(
            [
                'coach' => CoachResource::make($coach),
                'token' => $coach->createToken('coach')->plainTextToken,
            ],
            message: __('shared.response_messages.login_success')
        );
    }

    public function logout(): JsonResponse
    {
        /**
         * @var App\Domains\Entities\Models\Coach $coach
         */
        $coach = Auth::guard('coach')->user();
        $coach->currentAccessToken()->delete();

        return $this->successResponse(message: __('shared.response_messages.logout_success'));
    }

    public function user(Request $request)
    {
        return $this->successResponse(
            CoachResource::make($request->user()),
            __('shared.response_messages.success')
        );
    }

    public function forgetPassword(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|exists:coaches',
        ]);

        ResetCodePassword::where('email', $request->email)->delete();

        $data['code'] = mt_rand(100000, 999999);
        $data['created_at'] = now();

        $codeData = ResetCodePassword::create($data);

        Mail::to($request->email)->send(new SendCodeResetPassword($codeData->code));

        return $this->successResponse(message: __('passwords.sent'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:coaches',
            'code' => 'required|numeric',
            'password' => 'required|string|min:6',
        ]);

        $resetCode = ResetCodePassword::where('email', $request->email)
            ->where('created_at', '>=', Carbon::now()->subMinutes(5)->toDateTimeString())->first();
        if (! $resetCode || $resetCode->code != $request->code) {
            return $this->failedResponse(message: __('passwords.invalid_code'));
        }
        $coach = $this->coach->where('email', $request->email)->first();
        $coach->password = Hash::make($request->password);
        $coach->save();

        return $this->successResponse(message: __('passwords.reset'));
    }
}
