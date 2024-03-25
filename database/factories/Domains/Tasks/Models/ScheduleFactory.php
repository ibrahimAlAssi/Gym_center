<?php

namespace Database\Factories\Domains\Tasks\Models;

use App\Domains\Entities\Models\Player;
use App\Domains\Tasks\Models\Schedule;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Schedule::class;

    public function definition(): array
    {
        return [
            'player_id' => Player::inRandomOrder()->first()->id,
            'day' => $this->faker->numberBetween(1, 7),
            'is_complete' => $this->faker->numberBetween(0, 1),
        ];
    }
}
