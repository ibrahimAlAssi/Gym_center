<?php

namespace Database\Factories\Domains\Entities\Models;

use App\Domains\Entities\Models\Chat;
use App\Domains\Entities\Models\Message;
use App\Domains\Entities\Models\Player;
use App\Domains\Shared\Enums\AppTypesEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public $model = Message::class;

    public function definition(): array
    {
        return [
            'chat_id' => Chat::factory(),
            'senderable_id' => Player::first()->id,
            'senderable_type' => AppTypesEnum::PLAYER,
            'message' => fake()->title(),
            'read_at' => $this->faker->dateTime(),
        ];
    }
}
