<?php

namespace Database\Factories\Domains\Club\Models;

use App\Domains\Club\Models\Food;
use App\Domains\Club\Models\Nutritional_value;
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
    public $model = Nutritional_value::class;
    public function definition(): array
    {
        return [
            'food_id' => Food::inRandomOrder()->first()->id,
            'name'    => $this->faker->name,
            'value'   => $this->faker->numberBetween(10, 25), // Generates a random number between 10 and 25
        ];
    }
}
