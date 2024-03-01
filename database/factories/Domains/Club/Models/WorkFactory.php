<?php

namespace Database\Factories\Domains\Club\Models;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class WorkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        try {
            return [
                'gym_id' => $this->faker->randomNumber(), // Assuming gym_id is a foreign key
                'type' => $this->faker->randomElement(['male', 'female']),
                'day' => $this->faker->dayOfWeek(),
                'working' => $this->faker->randomElement(['on', 'off']),
                'from' => $this->faker->time(),
                'to' => $this->faker->time(),
            ];
        } catch (\Throwable $th) {
            //throw $th;
            Log::error("message: the row in work is duplicated");
        }
    }
}
