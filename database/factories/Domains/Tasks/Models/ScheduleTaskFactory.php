<?php

namespace Database\Factories\Domains\Tasks\Models;

use App\Domains\Tasks\Models\Schedule;
use App\Domains\Tasks\Models\Task;
use App\Domains\Tasks\Models\ScheduleTask;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ScheduleTaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ScheduleTask::class;

    public function definition(): array
    {
        return [
            'task_id'     => Task::inRandomOrder()->first()->id,
            'schedule_id' => Schedule::inRandomOrder()->first()->id,
            'repeat'      => $this->faker->numberBetween(2, 3),
            'weight'      => $this->faker->numberBetween(10, 15),
            'is_complete' => $this->faker->numberBetween(0, 1),
        ];
    }
}
