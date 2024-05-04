<?php

namespace App\Src\Player\Entities\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Domains\Entities\Models\Chat;
use Illuminate\Auth\Access\AuthorizationException;
use App\Src\Player\Entities\Resources\ChatGridResource;

class ChatController extends Controller
{
    public function __construct(protected Chat $chat)
    {
    }

    public function index(Request $request)
    {
        return $this->successResponse(
            ChatGridResource::collection(
                $this->chat->getForGrid(
                    $request->user('player')->id
                )
            ),
            __('shared.response_messages.success')
        );
    }

    public function destroy(Request $request, Chat $chat)
    {
        throw_if($request->user()->id != $chat->player_id, new AuthorizationException());

        try {
            $chat->delete();

            return $this->deletedResponse();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }
}
