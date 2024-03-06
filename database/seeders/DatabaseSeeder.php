<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use App\Domains\Club\Models\Gym;
use App\Domains\Club\Models\Tax;
use App\Domains\Club\Models\Diet;
use App\Domains\Club\Models\Food;
use App\Domains\Club\Models\Work;
use App\Domains\Club\Models\Contact;
use App\Domains\Club\Models\Product;
use App\Domains\Club\Models\DietFood;
use App\Domains\Entities\Models\Chat;
use App\Domains\Entities\Models\Player;
use Database\Seeders\PermissionsSeeder;
use App\Domains\Entities\Models\Message;
use App\Domains\Club\Models\NutritionalValue;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $gym = Gym::factory()->create([
            'name' => 'default gym',
        ]);
        $this->call(PermissionsSeeder::class);
        Player::factory()->for($gym)->create();
        Product::factory()->for($gym)->create();
        Contact::factory()->for($gym)->create();
        Food::factory()->for($gym)->create();
        Diet::factory()->create();
        DietFood::factory()->create();
        NutritionalValue::factory()->create();
        Tax::factory()->create();
        Work::factory()->for($gym)->create();


        $chat = Chat::factory()->create();
        Message::factory()->for($chat)->create();
    }
}
