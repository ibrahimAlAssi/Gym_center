<?php

namespace App\Src\Shared\Notifications;

use Illuminate\Bus\Queueable;
use App\Domains\Entities\Models\Player;
use Illuminate\Notifications\Notification;

class NewReview extends Notification
{
    use Queueable;

    private $player;
    public function __construct(Player $player)
    {
        $this->player = $player;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'A new review , by ' . $this->player->name,
            'player' => $this->player,
        ];
    }
}
