<?php

namespace Database\Factories\Domains\Club\Models;

use App\Domains\Club\Models\Contact;
use App\Domains\Club\Models\Gym;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public $model = Contact::class;

    public function definition(): array
    {
        return [
            'platform' => fake()->randomElement(["WhatsApp", "Telegram", "Facebook"]),
            'contact'  => 'link',
        ];
    }
}
