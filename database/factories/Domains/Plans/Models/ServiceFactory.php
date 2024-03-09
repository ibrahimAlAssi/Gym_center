<?php

namespace Database\Factories\Domains\Plans\Models;

use App\Domains\Club\Models\Gym;
use App\Domains\Plans\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Service::class;
    public function definition(): array
    {
        return [
            'gym_id'       => Gym::factory(),
            'name'         => $this->faker->name,
            'description'  => $this->faker->title,
        ];
    }
}