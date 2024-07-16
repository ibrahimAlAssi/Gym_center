<?php

namespace Database\Factories\Domains\Entities\Models;

use App\Domains\Entities\Models\Coach;
use App\Domains\Operations\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CoachFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public $model = Coach::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'wallet_id' => Wallet::factory(),
            'specialization' => fake()->jobTitle(),
            'experienceYears' => fake()->randomNumber(1),
            'subscribePrice' => fake()->randomNumber(5),
            'description' => fake()->paragraph(),
            'email' => fake()->unique()->email(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //passport
            'phone' => fake()->phoneNumber(),
        ];
    }
}
