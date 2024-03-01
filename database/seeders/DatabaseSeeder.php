<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Domains\Club\Models\Contact;
use App\Domains\Club\Models\Food;
use App\Domains\Club\Models\Gym;
use App\Domains\Entities\Models\Admin;
use Database\Factories\Domains\Club\Models\Nutritional_valueFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Gym::factory()->create([
            'name' => 'default gym',
        ]);
        $this->call(PermissionsSeeder::class);
        Contact::factory()->create();
        Food::factory(5)->create();
        Nutritional_valueFactory::factory(5)->create();
    }
}
