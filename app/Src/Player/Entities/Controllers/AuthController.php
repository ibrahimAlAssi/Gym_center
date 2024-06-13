<?php

namespace App\Src\Player\Entities\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Domains\Entities\Models\Player;
use App\Src\Admin\Entities\Requests\LoginRequest;
use App\Domains\Entities\Models\ResetCodePassword;
use App\Domains\Entities\Mail\SendCodeResetPassword;
use App\Src\Player\Entities\Resources\PlayerResource;

class AuthController extends Controller
{
    public function __construct(protected Player $player)
    {
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $player = $this->player->findByEmail($request->get('email'));
        if (empty($player) || Hash::check($request->get('password'), $player->password) === false) {
            return $this->failedResponse(__('shared.response_messages.invalid_credentials'));
        }

        return $this->successResponse(
            [
                'player' => PlayerResource::make($player),
                'token' => $player->createToken('player')->plainTextToken,
            ],
            message: __('shared.response_messages.login_success')
        );
    }

    public function logout(): JsonResponse
    {
        /**
         * @var App\Domains\Entities\Models\Player $player
         */
        $player = Auth::guard('player')->user();
        $player->currentAccessToken()->delete();

        return $this->successResponse(message: __('shared.response_messages.logout_success'));
    }

    public function user(Request $request)
    {
        return $this->successResponse(
            PlayerResource::make($request->user()),
            __('shared.response_messages.success')
        );
    }

    public function forgetPassword(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|exists:players',
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
            'email' => 'required|email|exists:players',
            'code' => 'required|numeric',
            'password' => 'nullable|string|min:8',
        ]);

        try {
            $resetCode = ResetCodePassword::where('email', $request->email)
            ->where('created_at', '>=', Carbon::now()->subMinutes(5)->toDateTimeString())->first();
            if (! $resetCode || $resetCode->code != $request->code) {
                  return $this->failedResponse(message: __('passwords.invalid_code'));
            }

            if ($request->has('password')) {
                 $this->player->where('email', $request->email)
                ->update(['password' => $request->password]);

                 return $this->successResponse(message: __('passwords.reset'));
            }
        } catch (\Throwable $th) {
            Log::info($th);
        }

        return $this->successResponse(message: __('passwords.code_is_verified'));
    }
}
