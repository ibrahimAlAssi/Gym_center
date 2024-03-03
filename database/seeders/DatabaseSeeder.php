<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Domains\Club\Models\Contact;
use App\Domains\Club\Models\Food;
use App\Domains\Club\Models\Gym;
use Database\Factories\Domains\Club\Models\NutritionalValueFactory;
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
        Contact::factory()->for($gym)->create();
        //Food::factory()->for($gym)->create();
        NutritionalValueFactory::factory()->create();
    }
}
