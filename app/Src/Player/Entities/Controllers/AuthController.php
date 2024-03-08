<?php

namespace App\Src\Player\Entities\Controllers;

use App\Domains\Entities\Models\Player;
use App\Http\Controllers\Controller;
use App\Src\Admin\Entities\Requests\LoginRequest;
use App\Src\Player\Entities\Resources\PlayerResource;
use Illuminate\Http\Client\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        $player = Auth::guard('sanctum')->user();
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
}
