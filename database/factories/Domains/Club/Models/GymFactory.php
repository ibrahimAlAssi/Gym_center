<?php

namespace Database\Factories\Domains\Club\Models;

use App\Domains\Club\Models\Gym;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class GymFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public $model = Gym::class;

    public function definition(): array
    {
        // Generate random latitude and longitude values for a point
        $latitude = $this->faker->latitude;
        $longitude = $this->faker->longitude;

        return [
            'name' => fake()->name(),
            'latitude' => '56465456', // Using raw SQL to define a point
            'longitude' =>'64654564', // Using raw SQL to define a point
        ];
    }
}
