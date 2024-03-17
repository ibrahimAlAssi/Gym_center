<?php

namespace App\Src\Coach\Entities\Controllers;

use App\Domains\Entities\Models\Coach;
use App\Http\Controllers\Controller;
use App\Src\Admin\Entities\Requests\LoginRequest;
use App\Src\Coach\Entities\Resources\CoachResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
}
