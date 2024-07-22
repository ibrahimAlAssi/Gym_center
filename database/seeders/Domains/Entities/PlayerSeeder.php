<?php

namespace Database\Seeders\Domains\Entities;

use App\Domains\Entities\Models\Player;
use Illuminate\Database\Seeder;

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

        $players = Player::get();
        foreach ($players as $key => $player) {
            $path = public_path('images/players/'.$pictures[$key]);
            $player->addMedia($path)->preservingOriginal()
                ->toMediaCollection('avatar');
        }
    }
}
