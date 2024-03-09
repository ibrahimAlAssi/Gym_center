<?php

namespace Database\Factories\Domains\Club\Models;

use App\Domains\Club\Models\Cart;
use App\Domains\Club\Models\Product;
use App\Domains\Entities\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public $model = Cart::class;

    public function definition(): array
    {
        return [
            'product_id' => Product::inRandomOrder()->first()->id,
            'player_id' => Player::inRandomOrder()->first()->id,
            'quantity' => fake()->numberBetween(1, 3),
            'is_favorite' => fake()->numberBetween([true, false]),
        ];
    }
}
