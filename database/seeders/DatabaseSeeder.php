<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Domains\Club\Models\Cart;
use App\Domains\Club\Models\Contact;
use App\Domains\Club\Models\Diet;
use App\Domains\Club\Models\DietFood;
use App\Domains\Club\Models\Gym;
use App\Domains\Club\Models\NutritionalValue;
use App\Domains\Club\Models\Product;
use App\Domains\Club\Models\Tax;
use App\Domains\Entities\Models\Chat;
use App\Domains\Entities\Models\Coach;
use App\Domains\Entities\Models\Feedback;
use App\Domains\Entities\Models\Message;
use App\Domains\Entities\Models\Player;
use App\Domains\Plans\Models\Discount;
use App\Domains\Plans\Models\Subscription;
use App\Domains\Tasks\Models\Schedule;
use App\Domains\Tasks\Models\ScheduleTask;
use App\Domains\Tasks\Models\Task;
use Database\Seeders\Domains\Club\DietSeeder;
use Database\Seeders\Domains\Club\FoodSeeder;
use Database\Seeders\Domains\Plans\PlanSeeder;
use Database\Seeders\Tasks\TypeSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //club
        $gym = Gym::factory()->create([
            'name' => 'default gym',
        ]);
        $this->call(PermissionsSeeder::class);
        $this->call(WorkSeeder::class);

        $this->call(FoodSeeder::class);
        $this->call(DietSeeder::class);
        // $diet = Diet::factory()->create();
        // DietFood::factory()->for($diet)->count(5)->create();
        // $customDiet = Diet::factory()->create(['is_free' => 0]);
        // DietFood::factory()->for($customDiet)->count(4)->create();
        $player = Player::factory()
            ->create(['email' => 'player@gmail.com']);
        Coach::factory()->count(10)->create();
        Player::factory()->count(6)->create(['coach_id' => 1, 'diet_id' => null]);
        Player::factory()->count(4)->create(['coach_id' => 2, 'diet_id' => null]);
        $products = Product::factory()->count(5)->create();
        $playerCart = Cart::factory()->for($products[0])->create(['player_id' => 1, 'coach_id' => null]);
        $coachCart = Cart::factory()->for($products[1])->create(['coach_id' => 1, 'player_id' => null]);
        Contact::factory()->for($gym)->create();
        // NutritionalValue::factory()->create();
        Tax::factory()->create();
        $chats = Chat::factory()->count(3)->create();
        Message::factory()->for($chats[0])->count(5)->create();
        Feedback::factory()->for($player)->count(5)->create(['coach_id' => null]);
        //Tasks
        Task::factory()->count(5)->create();
        $this->call(TypeSeeder::class);
        //plans
        $this->call(PlanSeeder::class);
        $Subscriptions = Subscription::factory()
            ->count(5)
            ->create();
        $normalDiscount = Discount::factory()
            ->create(['plan_id' => 1]);
        $vipDiscount = Discount::factory()
            ->create(['plan_id' => 2]);

        $schedule = Schedule::factory()->create();
        ScheduleTask::factory()->for($schedule)->count(5)->create();
    }
}
