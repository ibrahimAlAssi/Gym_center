<?php

namespace App\Src\Player\Entities\Controllers;

use App\Domains\Entities\Models\Chat;
use App\Domains\Entities\Models\Coach;
use App\Domains\Entities\Models\Message;
use App\Domains\Shared\Enums\AppTypesEnum;
use App\Http\Controllers\Controller;
use App\Src\Player\Entities\Requests\StoreChatRequest;
use App\Src\Player\Entities\Requests\UpdateChatRequest;
use App\Src\Player\Entities\Resources\MessageGridResource;
use App\Src\Player\Entities\Resources\MessageResource;
use App\Src\Shared\Notifications\ChatMessageWasReceived;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class MessageController extends Controller
{
    public function __construct(protected Chat $chat, protected Message $message)
    {
    }

    public function index(Request $request, Chat $chat)
    {
        throw_if($request->user()->id != $chat->player_id, new AuthorizationException);

        return $this->successResponse(
            MessageGridResource::collection(
                $this->message->getForGrid(
                    $chat->id
                )
            ),
            __('shared.response_messages.success')
        );
    }

    public function store(StoreChatRequest $request)
    {
        try {
            return $request;
            DB::beginTransaction();
            $playerId = $request->user('player')->id;
            $coachId = $request->coach_id;

            // Check if a chat already exists between these two users
            $existingChat = $this->chat->findChatByIds($playerId, $coachId);
            if (empty($existingChat)) {
                $existingChat = Chat::create([
                    'player_id' => $playerId,
                    'coach_id' => $coachId,
                ]);
            }
            $message = $this->message->create([
                'chat_id' => $existingChat->id,
                'senderable_id' => $playerId,
                'senderable_type' => AppTypesEnum::PLAYER,
                'message' => $request->message,
            ]);
            DB::commit();
            Notification::send(Coach::find($coachId), new ChatMessageWasReceived($message));

            return $this->createdResponse(
                MessageResource::make($message),
                __('shared.response_messages.created_success')
            );
        } catch (\Throwable $th) {
            Log::error("error on store  message , exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function update(UpdateChatRequest $request, Message $message)
    {
        throw_if(
            $request->user()->id != $message->senderable_id ||
                $message->senderable_type != AppTypesEnum::PLAYER,
            new AuthorizationException
        );
        try {
            $message->update($request->validated());

            return $this->successResponse(
                MessageResource::make($message),
                __('shared.response_messages.success')
            );
        } catch (\Throwable $th) {
            Log::error("error on update  message , exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function destroy(Request $request, Message $message)
    {
        throw_if(
            $request->user()->id != $message->senderable_id ||
                $message->senderable_type != AppTypesEnum::PLAYER,
            new AuthorizationException
        );
        try {
            $message->delete();

            return $this->deletedResponse();
        } catch (\Throwable $th) {
            Log::error("error on delete message player, exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }
}
