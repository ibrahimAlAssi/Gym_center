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
            'gym_id' => Gym::first()->id,
            'platform' => $this->getRandomSocialMedia(),
            'contact' => "link",
        ];
    }

    private function getRandomSocialMedia()
    {
        $socialMedias = ["WhatsApp", "Telegram", "Facebook"];
        return $socialMedias[array_rand($socialMedias)];
    }
}
