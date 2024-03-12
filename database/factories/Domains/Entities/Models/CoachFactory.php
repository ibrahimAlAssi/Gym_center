<?php

namespace Database\Factories\Domains\Entities\Models;

use App\Domains\Club\Models\Gym;
use App\Domains\Entities\Models\Coach;
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
            'gym_id' => Gym::first()->id,
            'name' => fake()->name(),
            'email' => 'choach@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //passport
            'phone' => fake()->phoneNumber(),
        ];
    }
}