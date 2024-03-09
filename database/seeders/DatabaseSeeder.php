<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use App\Domains\Club\Models\Gym;
use App\Domains\Club\Models\Tax;
use App\Domains\Club\Models\Diet;
use App\Domains\Club\Models\Food;
use App\Domains\Club\Models\Work;
use App\Domains\Plans\Models\Plan;
use App\Domains\Tasks\Models\Rate;
use App\Domains\Tasks\Models\Task;
use App\Domains\Tasks\Models\Type;
use App\Domains\Club\Models\Contact;
use App\Domains\Club\Models\Product;
use App\Domains\Club\Models\DietFood;
use App\Domains\Entities\Models\Chat;
use App\Domains\Plans\Models\Payment;
use App\Domains\Plans\Models\Service;
use App\Domains\Plans\Models\Discount;
use App\Domains\Tasks\Models\Schedule;
use App\Domains\Entities\Models\Player;
use App\Domains\Plans\Models\Subscribe;
use App\Domains\Entities\Models\Message;
use App\Domains\Tasks\Models\ScheduleTask;
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

        Food::factory()->for($gym)->create();
        Diet::factory()->create();
        DietFood::factory()->create();

        Player::factory()->create();
        Product::factory()->for($gym)->create();
        Contact::factory()->for($gym)->create();
        NutritionalValue::factory()->create();
        Tax::factory()->create();
        Work::factory()->for($gym)->create();

        $chat = Chat::factory()->create();
        Message::factory()->for($chat)->create();

        Discount::factory()->create();
        Plan::factory()->for($gym)->create();
        Service::factory()->for($gym)->create();
        Subscribe::factory()->for($gym)->create();
        Payment::factory()->for($gym)->create();

        Type::factory()->create();
        Task::factory()->for($gym)->create();
        Rate::factory()->create();
        Schedule::factory()->create();
        ScheduleTask::factory()->create();
    }
}
