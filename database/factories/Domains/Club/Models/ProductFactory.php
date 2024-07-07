<?php

namespace Database\Factories\Domains\Club\Models;

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
            'name' => fake()->name(),
            'quantity' => fake()->randomNumber(2),
            'price' => fake()->randomNumber(5),
        ];
    }
}
