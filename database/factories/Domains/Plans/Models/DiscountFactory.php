<?php

namespace Database\Factories\Domains\Plans\Models;

use App\Domains\Club\Models\Gym;
use App\Domains\Plans\Models\Discount;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DiscountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Discount::class;

    public function definition(): array
    {
        return [
            'gym_id'     => Gym::factory(),
            'start_date' => $this->faker->date(),
            'end_date'   => $this->faker->date(),
            'type'       => $this->faker->numberBetween(0, 1),
            'value'      => $this->faker->numberBetween(100, 1000)
        ];
    }
}
