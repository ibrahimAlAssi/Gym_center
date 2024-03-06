<?php

namespace Database\Factories\Domains\Club\Models;

use App\Domains\Club\Models\Gym;
use App\Domains\Club\Models\Work;
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
    public $model = Work::class;
    public function definition(): array
    {
        try {
            return [
                'gym_id' => Gym::factory(),
                'type'   => $this->faker->randomElement(["male", "female"]),
                'day'    => $this->faker->numberBetween(1, 7),
                'is_working' => $this->faker->numberBetween(0, 1),
                'from' => $this->faker->time(),
                'to'   => $this->faker->time(),
            ];
        } catch (\Throwable $th) {
            //throw $th;
            Log::error("message: the row in work is duplicated");
        }
    }
}
