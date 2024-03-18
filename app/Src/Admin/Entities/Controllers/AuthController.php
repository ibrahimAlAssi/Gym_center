<?php

namespace App\Src\Admin\Entities\Controllers;

use App\Domains\Entities\Mail\SendCodeResetPassword;
use App\Domains\Entities\Models\Admin;
use App\Domains\Entities\Models\ResetCodePassword;
use App\Http\Controllers\Controller;
use App\Src\Admin\Entities\Requests\LoginRequest;
use App\Src\Admin\Entities\Resources\AdminResource;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function __construct(protected Admin $admin)
    {
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $admin = $this->admin->findByEmail($request->get('email'));
        if (empty($admin) || Hash::check($request->get('password'), $admin->password) === false) {
            return $this->failedResponse(__('admin.response_messages.invalid_credentials'));
        }

        return $this->successResponse(
            [
                'admin' => AdminResource::make($admin),
                'token' => $admin->createToken('admin')->plainTextToken,
            ],
            message: __('shared.response_messages.login_success')
        );
    }

    public function logout(): JsonResponse
    {
        /**
         * @var App\Domains\Entities\Models\Admin $admin
         */
        $admin = Auth::guard('admin')->user();
        $admin->currentAccessToken()->delete();

        return $this->successResponse(message: __('shared.response_messages.success'));
    }

    public function user(Request $request)
    {
        return $this->successResponse(
            AdminResource::make($request->user()),
            __('shared.response_messages.success')
        );
    }

    public function forgetPassword(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|exists:admins',
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
            'email' => 'required|email|exists:admins',
            'code' => 'required|numeric',
            'password' => 'required|string|min:6',
        ]);

        $resetCode = ResetCodePassword::where('email', $request->email)
            ->where('created_at', '>=', Carbon::now()->subMinutes(5)->toDateTimeString())->first();
        if (! $resetCode || $resetCode->code != $request->code) {
            return $this->failedResponse(message: __('passwords.invalid_code'));
        }

        $admin = $this->admin->where('email', $request->email)->first();
        $admin->password = Hash::make($request->password);
        $admin->save();

        return $this->successResponse(message: __('passwords.reset'));
    }
}
