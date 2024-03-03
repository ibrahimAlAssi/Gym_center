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
                'type' => $this->faker->numberBetween(0, 1),
                'day' => $this->faker->dayOfWeek(),
                'working' => $this->faker->numberBetween(0, 1),
                'from' => $this->faker->time(),
                'to' => $this->faker->time(),
            ];
        } catch (\Throwable $th) {
            //throw $th;
            Log::error("message: the row in work is duplicated");
        }
    }
}
