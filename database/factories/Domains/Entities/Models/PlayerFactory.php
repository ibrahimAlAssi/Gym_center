<?php

namespace Database\Factories\Domains\Entities\Models;

use App\Domains\Club\Models\Diet;
use App\Domains\Entities\Enums\PlayerGenderEnum;
use App\Domains\Entities\Models\Coach;
use App\Domains\Entities\Models\Player;
use App\Domains\Operations\Models\Wallet;
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
            'diet_id' => Diet::inRandomOrder()->first(),
            'wallet_id' => Wallet::factory(),
            'coach_id' => Coach::factory(),
            'name' => fake()->name(),
            'email' => fake()->email(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //passport
            'phone' => fake()->numerify('09#########'),
            'active' => true,
            'gender' => PlayerGenderEnum::getRandomValue(),
            'attendance_days' => fake()->numberBetween(3, 30),
            'birthday' => fake()->date(),
        ];
    }
}
