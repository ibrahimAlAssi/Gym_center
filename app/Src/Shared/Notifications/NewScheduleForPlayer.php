<?php

namespace App\Src\Shared\Notifications;

use App\Domains\Entities\Models\Coach;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewScheduleForPlayer extends Notification
{
    use Queueable;

    public $message;

    public function __construct($message)
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
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->message,
        ];
    }
}
