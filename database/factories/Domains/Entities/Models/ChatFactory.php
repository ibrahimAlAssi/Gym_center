<?php

namespace Database\Factories\Domains\Entities\Models;

use App\Domains\Entities\Models\Chat;
use App\Domains\Entities\Models\Coach;
use App\Domains\Entities\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ChatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public $model = Chat::class;

    public function definition(): array
    {
        return [
            'player_id' => Player::inRandomOrder()->first()->id,
            'coach_id' => Coach::inRandomOrder()->first()->id,
        ];
    }
}
