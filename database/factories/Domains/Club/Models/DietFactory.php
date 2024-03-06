<?php

namespace Database\Factories\Domains\Club\Models;

use App\Domains\Club\Models\Diet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DietFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public $model = Diet::class;
    public function definition(): array
    {
        return [
            'name'    => $this->faker->name,
            'is_free' => $this->faker->randomElement([true, false]),
        ];
    }
}
