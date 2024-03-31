<?php

namespace Database\Factories\Domains\Entities\Models;

use App\Domains\Entities\Models\Feedback;
use App\Domains\Entities\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domains\Entities\Models\Feedback>
 */
class FeedbackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public $model = Feedback::class;

    public function definition(): array
    {
        return [
            'player_id' => Player::factory(),
            'message' => fake()->name(),
            'is_complaint' => fake()->boolean(),
        ];
    }
}
