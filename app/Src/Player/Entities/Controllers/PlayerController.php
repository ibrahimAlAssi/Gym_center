<?php

namespace App\Src\Player\Entities\Controllers;

use App\Http\Controllers\Controller;
use App\Src\Player\Entities\Requests\UpdatePlayerRequest;
use App\Src\Player\Entities\Resources\PlayerResource;
use Illuminate\Support\Facades\Log;

class PlayerController extends Controller
{
    public function update(UpdatePlayerRequest $request)
    {
        try {
            $player = $request->user();
            $player->update($request->validated());
            if ($request->has('avatar')) {
                $player->clearMediaCollection('avatar');
                $player->addMediaFromRequest('avatar')->toMediaCollection('avatar');
            }

            return $this->successResponse(
                PlayerResource::make($player->load('media')),
                __('shared.response_messages.success')
            );
        } catch (\Throwable $th) {
            Log::error("error on update  player , exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function markAsReadAll()
    {
        auth()->user('player')->unReadNotifications->markAsRead();
        return $this->successResponse(message: "all notifications marked as read");
    }

    // Mark the notification as read
    public function markAsReadNotification($notificationId)
    {
        $notification = auth()->user('player')->unReadNotifications->find($notificationId);
        if (!$notification) {
            return $this->notFoundResponse();
        }
        $notification->markAsRead();
        return $this->successResponse(message: "success");
    }
}
