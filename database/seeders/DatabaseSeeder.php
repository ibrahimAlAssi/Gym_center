<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Domains\Club\Models\Contact;
use App\Domains\Club\Models\Diet;
use App\Domains\Club\Models\DietFood;
use App\Domains\Club\Models\Food;
use App\Domains\Club\Models\Gym;
use App\Domains\Club\Models\NutritionalValue;
use App\Domains\Club\Models\Product;
use App\Domains\Club\Models\Tax;
use App\Domains\Club\Models\Work;
use App\Domains\Entities\Models\Chat;
use App\Domains\Entities\Models\Feedback;
use App\Domains\Entities\Models\Message;
use App\Domains\Entities\Models\Player;
use App\Domains\Plans\Models\Discount;
use App\Domains\Plans\Models\Subscription;
use App\Domains\Tasks\Models\Task;
use Illuminate\Database\Seeder;

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

        Food::factory()->count(5)->create();
        Diet::factory()->create();
        DietFood::factory()->create();

        $player = Player::factory()->create(['email' => 'player@gmail.com']);
        Product::factory()->for($gym)->create();
        Contact::factory()->for($gym)->create();
        NutritionalValue::factory()->create();
        Tax::factory()->create();
        Work::factory()->for($gym)->create();

        $chats = Chat::factory()->count(3)->create();
        Message::factory()->for($chats[0])->count(5)->create();
        Feedback::factory()->for($player)->count(5)->create();

        Task::factory()->count(5)->create();
        //plans
        $this->call(PlanSeeder::class);
        $Subscriptions = Subscription::factory()
            ->for($player)
            ->count(5)
            ->create();
        $normalDiscount = Discount::factory()
            ->create(['plan_id' => 1]);
        $vipDiscount = Discount::factory()
            ->create(['plan_id' => 2]);
    }
}
