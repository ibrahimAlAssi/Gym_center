<?php

namespace App\Src\Coach\Entities\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Domains\Entities\Models\Chat;
use App\Domains\Entities\Models\Coach;
use App\Domains\Entities\Models\Message;
use App\Domains\Shared\Enums\AppTypesEnum;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Access\AuthorizationException;
use App\Src\Coach\Entities\Requests\StoreChatRequest;
use App\Src\Coach\Entities\Resources\MessageResource;
use App\Src\Coach\Entities\Requests\UpdateChatRequest;
use App\Src\Shared\Notifications\ChatMessageWasReceived;
use App\Src\Coach\Entities\Resources\MessageGridResource;

class MessageController extends Controller
{
    public function __construct(protected Chat $chat, protected Message $message)
    {
    }

    public function index(Request $request, Chat $chat)
    {
        throw_if($request->user()->id != $chat->coach_id, new AuthorizationException());

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
            DB::beginTransaction();
            $coachId = $request->user('coach')->id;
            $playerId = $request->player_id;

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
                'senderable_type' => AppTypesEnum::COACH,
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
                $message->senderable_type != AppTypesEnum::COACH,
            new AuthorizationException()
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
                $message->senderable_type != AppTypesEnum::COACH,
            new AuthorizationException()
        );

        try {
            $message->delete();

            return $this->deletedResponse();
        } catch (\Throwable $th) {
            Log::error("error on delete  message , exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }
}
