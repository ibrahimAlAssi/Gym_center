<?php

namespace Database\Factories\Domains\Entities\Models;

use App\Domains\Entities\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public $model = Admin::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => 'admin@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //passport
            'phone' => fake()->phoneNumber(),
        ];
    }
}
