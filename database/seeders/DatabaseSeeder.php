<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use App\Domains\Club\Models\Gym;
use App\Domains\Club\Models\Tax;
use App\Domains\Club\Models\Cart;
use Database\Seeders\ProductSeeder;
use App\Domains\Club\Models\Contact;
use App\Domains\Entities\Models\Chat;
use App\Domains\Entities\Models\Coach;
use App\Domains\Plans\Models\Discount;
use App\Domains\Tasks\Models\Schedule;
use Database\Seeders\Tasks\TaskSeeder;
use Database\Seeders\Tasks\TypeSeeder;
use App\Domains\Entities\Models\Player;
use App\Domains\Entities\Models\Message;
use App\Domains\Entities\Models\Feedback;
use App\Domains\Plans\Models\Subscription;
use App\Domains\Tasks\Models\ScheduleTask;
use App\Domains\Club\Models\NutritionalValue;
use Database\Seeders\Domains\Club\DietSeeder;
use Database\Seeders\Domains\Club\FoodSeeder;
use Database\Seeders\Domains\Plans\PlanSeeder;

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
        $this->call(TypeSeeder::class);
        $this->call(TaskSeeder::class);
        $this->call(ProductSeeder::class);

        $player = Player::factory()
            ->create(['email' => 'player@gmail.com']);
        Coach::factory()->count(10)->create();
        Player::factory()->count(6)->create(['coach_id' => 1, 'diet_id' => null]);
        Player::factory()->count(4)->create(['coach_id' => 2, 'diet_id' => null]);
        $playerCart = Cart::factory()->create(['player_id' => 1, 'coach_id' => null, 'product_id' => 1]);
        $coachCart = Cart::factory()->create(['coach_id' => 1, 'player_id' => null, 'product_id' => 2]);
        Contact::factory()->for($gym)->create();
        // NutritionalValue::factory()->create();
        Tax::factory()->create();
        $chats = Chat::factory()->count(3)->create();
        Message::factory()->for($chats[0])->count(5)->create();
        Feedback::factory()->for($player)->count(5)->create(['coach_id' => null]);
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
