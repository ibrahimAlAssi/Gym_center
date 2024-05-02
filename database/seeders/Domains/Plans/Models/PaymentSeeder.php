<?php

namespace Database\Seeders\Domains\Plans\Models;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Domains\Entities\Models\Player;
use App\Domains\Plans\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Payment::factory()->create();
        Payment::factory()->create(
            [
                'subscribe_id' => null,
                'player_id' => Player::inRandomOrder()->first()->id,
            ]
        );
    }
}
