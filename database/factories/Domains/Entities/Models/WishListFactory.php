<?php

namespace Database\Factories\Domains\Entities\Models;

use App\Domains\Entities\Models\Player;
use App\Domains\Entities\Models\WishList;
use App\Domains\Tasks\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class WishListFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public $model = WishList::class;

    public function definition(): array
    {
        return [
            'player_id' => Player::inRandomOrder()->first()->id,
            'task_id' => Task::inRandomOrder()->first()->id,
        ];
    }
}
