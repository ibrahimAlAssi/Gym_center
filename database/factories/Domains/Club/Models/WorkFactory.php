<?php

namespace Database\Factories\Domains\Club\Models;

use App\Domains\Club\Enums\WorkDayEnum;
use App\Domains\Club\Models\Gym;
use App\Domains\Club\Models\Work;
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
        $day = $this->faker->unique()->dayOfWeek();

        return [
            'gym_id' => Gym::first()->id,
            'day' => $day,
            'man' => $day != WorkDayEnum::FRIDAY ? '02:00 PM - 11:00 PM' : 'CLOSED',
            'woman' => $day != WorkDayEnum::FRIDAY ? '7:00 AM - 01:00 PM' : 'CLOSED',
        ];
    }
}
