<?php

namespace App\Src\Shared\Notifications;

use App\Domains\Entities\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class ChatMessageWasReceived extends Notification
{
    use Queueable;

    public $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['broadcast'];
    }

    public function toBroadcast($notifiable)
    {
        // Use the private channel for the chat
        $channelName = 'chat.' . $this->message->chat_id;

        return new BroadcastMessage([
            'message' => $this->message,
        ], $channelName);
    }
}
