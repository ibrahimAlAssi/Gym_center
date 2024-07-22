<?php

namespace App\Src\Player\Entities\Controllers;

use App\Domains\Entities\Mail\SendCodeResetPassword;
use App\Domains\Entities\Models\Player;
use App\Domains\Entities\Models\ResetCodePassword;
use App\Http\Controllers\Controller;
use App\Src\Admin\Entities\Requests\LoginRequest;
use App\Src\Player\Entities\Resources\PlayerResource;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
                'player' => PlayerResource::make($player->load('wallet', 'coach')),
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
            PlayerResource::make($request->user()->load('wallet', 'coach', 'media')),
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

            if (! empty($request->password)) {
                DB::beginTransaction();
                $this->player->where('email', $request->email)->first()
                    ->update(['password' => $request->password]);
                $resetCode->delete();
                DB::commit();

                return $this->successResponse(message: __('passwords.reset'));
            }

            return $this->successResponse(message: __('passwords.code_is_verified'));
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("error on store  reset password  in player, exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }
}
