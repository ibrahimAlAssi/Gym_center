<?php

namespace Database\Factories\Domains\Plans\Models;

use App\Domains\Club\Models\Gym;
use App\Domains\Plans\Models\Payment;
use App\Domains\Plans\Models\Subscribe;
use App\Domains\Plans\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Payment::class;

    public function definition(): array
    {
        return [
            'gym_id' => Gym::factory(),
            'subscribe_id' => Subscription::inRandomOrder()->first()->id,
            'player_id' => null,
            'payment_method' => $this->faker->name(),
            'transaction_data' => json_encode('test'),
            'transaction_id' => $this->faker->numberBetween(100, 1000),
        ];
    }
}
