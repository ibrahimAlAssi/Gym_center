<?php

namespace Database\Factories\Domains\Entities\Models;

use App\Domains\Club\Models\Diet;
use App\Domains\Entities\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public $model = Player::class;

    public function definition(): array
    {
        return [
            'diet_id' => Diet::inRandomOrder()->first()->id,
            'name' => fake()->name(),
            'email' => fake()->email(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //passport
            'phone' => fake()->phoneNumber(),
            'active' => true,
            'gender' => fake()->randomElement(['male', 'female']),
            'attendance_days' => fake()->numberBetween(3, 30),
        ];
    }
}
