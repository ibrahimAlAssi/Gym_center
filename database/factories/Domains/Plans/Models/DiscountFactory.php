<?php

namespace Database\Factories\Domains\Plans\Models;

use App\Domains\Plans\Models\Discount;
use App\Domains\Plans\Models\Plan;
use Carbon\Carbon;
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
            'plan_id' => Plan::factory(),
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addWeek(),
            'value' => $this->faker->numberBetween(1, 90),
        ];
    }
}
