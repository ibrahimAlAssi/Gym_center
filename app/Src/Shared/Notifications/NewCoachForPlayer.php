<?php

namespace App\Src\Shared\Notifications;

use App\Domains\Entities\Models\Coach;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewCoachForPlayer extends Notification
{
    use Queueable;

    public $coach;

    public function __construct(Coach $coach)
    {
        $this->coach = $coach;
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
            'message' => 'You have a coach ' . $this->coach->name,
            'coach' => $this->coach,
        ];
    }
}
