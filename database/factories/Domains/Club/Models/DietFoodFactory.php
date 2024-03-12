<?php

namespace Database\Factories\Domains\Club\Models;

use App\Domains\Club\Models\Diet;
use App\Domains\Club\Models\DietFood;
use App\Domains\Club\Models\Food;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DietFoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public $model = DietFood::class;

    public function definition(): array
    {
        return [
            'diet_id' => Diet::inRandomOrder()->first()->id,
            'food_id' => Food::inRandomOrder()->first()->id,
            'allowed_food' => $this->faker->randomElement([true, false]),
        ];
    }
}
