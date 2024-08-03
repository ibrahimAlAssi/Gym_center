<?php

namespace App\Src\Shared\Notifications;

use App\Domains\Entities\Models\Player;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PlayerAdded extends Notification
{
    use Queueable;

    public $player;

    public function __construct(Player $player)
    {
        $this->player = $player;
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
            'message' => 'You have a new player' . $this->player->name,
            'player' => $this->player,
        ];
    }
}
