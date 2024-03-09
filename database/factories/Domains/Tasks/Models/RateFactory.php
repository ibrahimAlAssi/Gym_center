<?php

namespace Database\Factories\Domains\Tasks\Models;

use App\Domains\Entities\Models\Player;
use App\Domains\Tasks\Models\Rate;
use App\Domains\Tasks\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     *
     */
    protected $model = Rate::class;

    public function definition(): array
    {
        return [
            'player_id' => Player::inRandomOrder()->first()->id,
            'task_id'   => Task::inRandomOrder()->first()->id,
            'content'   => $this->faker->name,
            'rating'    => $this->faker->numberBetween(1, 5),
        ];
    }
}
