<?php

namespace Database\Factories\Domains\Plans\Models;

use App\Domains\Entities\Models\Coach;
use App\Domains\Entities\Models\Player;
use App\Domains\Plans\Models\Plan;
use App\Domains\Plans\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Subscription::class;

    public function definition(): array
    {
        return [
            'player_id' => Player::inRandomOrder()->first()->id,
            'plan_id' => Plan::inRandomOrder()->first()->id,
            'coach_id' => Coach::inRandomOrder()->first()->id,
            'cost' => $this->faker->randomNumber(4, 4),
            'description' => $this->faker->paragraph(),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
        ];
    }
}
