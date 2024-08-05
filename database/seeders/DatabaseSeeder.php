<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Domains\Club\Models\Cart;
use App\Domains\Club\Models\Contact;
use App\Domains\Club\Models\Gym;
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
use Database\Seeders\Domains\Club\DietSeeder;
use Database\Seeders\Domains\Club\FoodSeeder;
use Database\Seeders\Domains\Club\ProductSeeder;
use Database\Seeders\Domains\Club\WorkSeeder;
use Database\Seeders\Domains\Entities\CoachSeeder;
use Database\Seeders\Domains\Entities\PlayerSeeder;
use Database\Seeders\Domains\Plans\PlanSeeder;
use Database\Seeders\Tasks\TaskSeeder;
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
        $this->call(TypeSeeder::class);
        $this->call(TaskSeeder::class);
        $this->call(ProductSeeder::class);

        $player = Player::factory()
            ->create(['email' => 'player@gmail.com', 'coach_id' => 1]);
        Coach::factory()->count(5)->create();
        $this->call(CoachSeeder::class);
        Player::factory()->count(2)->create([
            'coach_id' => 1,
            'diet_id' => null,
        ]);
        Player::factory()->count(1)->create(['coach_id' => 2, 'diet_id' => null]);
        $this->call(PlayerSeeder::class);
        $playerCart = Cart::factory()->create(['player_id' => 1, 'coach_id' => null, 'product_id' => 1]);
        $coachCart = Cart::factory()->create(['coach_id' => 1, 'player_id' => null, 'product_id' => 2]);
        Contact::factory()->for($gym)->create();
        // NutritionalValue::factory()->create();
        Tax::factory()->create();
        $chats = Chat::factory()->count(1)->create(['player_id' => 1]);
        Message::factory()->for($chats[0])->count(5)->create();
        Feedback::factory()->for($player)->count(2)->create(['coach_id' => null]);
        Feedback::factory()->count(2)->create(['coach_id' => 1, 'player_id' => null]);
        //plans
        $this->call(PlanSeeder::class);
        $Subscriptions = Subscription::factory()
            ->count(2)
            ->create(['plan_id' => 2]);
        $Subscriptions = Subscription::factory()
            ->count(1)
            ->create(['plan_id' => 1]);
        $Subscriptions = Subscription::factory()
            ->count(1)
            ->create(['plan_id' => 3]);

        $normalDiscount = Discount::factory()
            ->create(['plan_id' => 1]);
        $vipDiscount = Discount::factory()
            ->create(['plan_id' => 2]);

        $schedule = Schedule::factory()->create();
        ScheduleTask::factory()->for($schedule)->count(5)->create();

        ///
        $Subscriptions = Subscription::factory()
            ->count(3)
            ->create(['plan_id' => 1, 'start_date' => now()->subMonths(3), 'created_at' => now()->subMonths(3),
            ]);
        $Subscriptions = Subscription::factory()
            ->count(6)
            ->create(['plan_id' => 1, 'start_date' => now()->subMonths(2), 'created_at' => now()->subMonths(2),
            ]);
    }
}
