<?php

namespace Database\Factories\Domains\Club\Models;

use App\Domains\Club\Models\Food;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public $model = Food::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
        ];
    }
}
