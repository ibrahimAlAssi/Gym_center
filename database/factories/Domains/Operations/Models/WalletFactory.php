<?php

namespace Database\Factories\Domains\Operations\Models;

use App\Domains\Operations\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
 */
class WalletFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public $model = Wallet::class;

    public function definition(): array
    {
        $pending = fake()->randomNumber(2);
        $available = fake()->randomNumber(2);

        return [
            'total' => $pending + $available,
            'pending' => $pending,
            'available' => $available,
        ];
    }
}
