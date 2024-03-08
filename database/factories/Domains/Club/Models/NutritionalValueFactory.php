<?php

namespace Database\Factories\Domains\Club\Models;

use App\Domains\Club\Models\Food;
use App\Domains\Club\Models\NutritionalValue;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class NutritionalValueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public $model = NutritionalValue::class;

    public function definition(): array
    {
        return [
            'food_id' => Food::factory(),
            'name' => $this->faker->name,
            'value' => $this->faker->numberBetween(10, 25), // Generates a random number between 10 and 25
        ];
    }
}
