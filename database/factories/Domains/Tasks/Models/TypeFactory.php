<?php

namespace Database\Factories\Domains\Tasks\Models;

use App\Domains\Tasks\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Type::class;

    public function definition(): array
    {
        return [
            'name'       => $this->faker->name,
            'description'  => $this->faker->title,
        ];
    }
}
