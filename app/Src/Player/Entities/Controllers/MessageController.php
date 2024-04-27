<?php

namespace App\Src\Player\Entities\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Domains\Entities\Models\Chat;
use App\Domains\Entities\Models\Coach;
use App\Domains\Entities\Models\Message;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ChatMessageWasReceived;
use Illuminate\Auth\Access\AuthorizationException;
use App\Src\Player\Entities\Requests\StoreChatRequest;
use App\Src\Player\Entities\Resources\MessageResource;
use App\Src\Player\Entities\Requests\UpdateChatRequest;
use App\Src\Player\Entities\Resources\MessageGridResource;

class MessageController extends Controller
{
    public function __construct(protected Message $message)
    {
    }

    public function index(Request $request)
    {
        return $this->successResponse(
            MessageGridResource::collection(
                $this->message->getForGrid(
                    $request->chat_id
                )
            ),
            __('shared.response_messages.success')
        );
    }

    public function store(StoreChatRequest $request)
    {
        try {
            DB::beginTransaction();
            $user1Id =  $request->user('player')->id;
            $user2Id = $request->coach_id;

            // Check if a chat already exists between these two users
            $existingChat = Chat::where('player_id', $user1Id)
                ->where('coach_id', $user2Id)
                ->first();
            if (!$existingChat) {
                $existingChat = Chat::create([
                    'player_id' => $user1Id,
                    'coach_id'  => $user2Id,
                ]);
            }
            $message = $this->message->create([
                'chat_id' => $existingChat->id,
                'senderable_id' => $user1Id,
                'senderable_type' => 'App\Domains\Entities\Models\Player',
                'message' => $request->message,
            ]);
            DB::commit();
            Notification::send(Coach::find($user2Id), new ChatMessageWasReceived($message));
            return $this->createdResponse(MessageResource::make($message), 'created');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function update(UpdateChatRequest $request, Message $message)
    {
        throw_if($request->user()->id != $message->owner_id, new AuthorizationException());
        try {
            $message->update($request->validated());

            return $this->successResponse('updated');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function destroy(Request $request, Message $message)
    {
        throw_if($request->user()->id != $message->owner_id, new AuthorizationException());

        try {
            $message->delete();

            return $this->deletedResponse();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }
}
