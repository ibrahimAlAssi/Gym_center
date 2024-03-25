<?php

namespace Database\Factories\Domains\Plans\Models;

use App\Domains\Club\Models\Gym;
use App\Domains\Entities\Models\Coach;
use App\Domains\Entities\Models\Player;
use App\Domains\Plans\Models\Discount;
use App\Domains\Plans\Models\Plan;
use App\Domains\Plans\Models\Subscribe;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SubscribeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Subscribe::class;

    public function definition(): array
    {
        return [
            'gym_id' => Gym::factory(),
            'player_id' => Player::inRandomOrder()->first()->id,
            'plan_id' => Plan::inRandomOrder()->first()->id,
            'coach_id' => Coach::inRandomOrder()->first()->id,
            'discount_id' => Discount::inRandomOrder()->first()->id,
            'cost' => $this->faker->randomNumber(4, 4),
            'description' => $this->faker->title,
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'closet_number' => $this->faker->randomNumber(1, 2),
        ];
    }
}
