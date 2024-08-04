<?php

namespace Database\Seeders\Domains\Entities;

use Illuminate\Database\Seeder;
use App\Domains\Entities\Models\Player;
use Illuminate\Support\Facades\Notification;
use App\Src\Shared\Notifications\PlayerAdded;
use App\Src\Shared\Notifications\NewCoachForPlayer;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pictures = [
            '1.png',
            '2.png',
            '3.png',
            '4.png',
        ];

        $players = Player::get()->take(4);
        foreach ($players as $key => $player) {
            $path = public_path('images/players/' . $pictures[$key]);
            $player->addMedia($path)->preservingOriginal()
                ->toMediaCollection('avatar');
            Notification::send($player->coach, new PlayerAdded($player));
            Notification::send($player, new NewCoachForPlayer($player->coach));
        }
    }
}
