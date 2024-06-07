<?php

namespace Database\Factories\Domains\Plans\Models;

use App\Domains\Plans\Enums\PlanTypeEnum;
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
            'name' => fake()->word(),
            'type' => PlanTypeEnum::getRandomValue(),
            'cost' => fake()->randomNumber(2),
        ];
    }
}
