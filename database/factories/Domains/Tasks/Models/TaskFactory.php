<?php

namespace Database\Factories\Domains\Tasks\Models;

use App\Domains\Tasks\Models\Task;
use App\Domains\Tasks\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'type_id' => Type::factory(),
            'number' => $this->faker->numberBetween(10, 20),
            'description' => $this->faker->sentence(),
        ];
    }
}
