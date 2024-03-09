<?php

namespace Database\Seeders\Domains\Plans;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Domains\Entities\Models\Player;
use Illuminate\Database\Seeder;
use App\Domains\Plans\Models\Payment;

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
                'player_id'    => Player::inRandomOrder()->first()->id,
            ]
        );
    }
}
