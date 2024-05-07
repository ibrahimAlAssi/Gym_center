<?php

namespace App\Src\Coach\Entities\Controllers;

use App\Domains\Entities\Models\Chat;
use App\Domains\Entities\Models\Message;
use App\Http\Controllers\Controller;
use App\Src\Coach\Entities\Resources\ChatGridResource;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function __construct(protected Chat $chat, protected Message $message)
    {
    }

    public function index(Request $request)
    {

        return $this->successResponse(
            ChatGridResource::collection(
                $this->chat->getForGrid(
                    null,
                    $request->user()->id
                )
            ),
            __('shared.response_messages.success')
        );
    }

    public function destroy(Request $request, Chat $chat)
    {
        throw_if($request->user()->id != $chat->coach_id, new AuthorizationException());
        try {
            DB::beginTransaction();
            $this->message->where('chat_id', $chat->id)->delete();
            $chat->delete();
            DB::commit();

            return $this->deletedResponse();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("error on delete message, exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }
}
