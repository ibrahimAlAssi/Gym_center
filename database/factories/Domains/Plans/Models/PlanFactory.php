<?php

namespace Database\Factories\Domains\Plans\Models;

use App\Domains\Club\Models\Gym;
use App\Domains\Plans\Models\Plan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Plan::class;
    public function definition(): array
    {
        return [
            'gym_id' => Gym::factory(),
            'type'   => $this->faker->randomElement(['V', 'N']),
            'cost'  => $this->faker->randomNumber(4, 4),
        ];
    }
}
