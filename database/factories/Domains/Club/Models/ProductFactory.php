<?php

namespace Database\Factories\Domains\Club\Models;

use App\Domains\Club\Models\Gym;
use App\Domains\Club\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public $model = Product::class;
    public function definition(): array
    {
        return [
            'gym_id' => Gym::factory(),
            'name'   => fake()->name(),
            'price'  => fake()->rand(100, 2000),
        ];
    }
}
