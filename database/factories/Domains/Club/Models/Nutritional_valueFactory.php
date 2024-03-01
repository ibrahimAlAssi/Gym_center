<?php

namespace Database\Factories\Domains\Club\Models;

use App\Domains\Club\Models\Food;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class Nutritional_valueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'food_id' => Food::inRandomOrder()->first()->id,
            'name'    => $this->faker->name,
            'value'   => $this->faker->numberBetween(10, 25), // Generates a random number between 10 and 25
        ];
    }
}
