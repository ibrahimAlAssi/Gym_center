<?php

namespace Database\Seeders\Domains\Plans;

use App\Domains\Plans\Models\Plan;
use App\Domains\Plans\Models\Service;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $planData = [
            [
                'name' => 'Normal',
                'type' => 'all',
                'cost' => 100000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Vip',
                'type' => 'all',
                'cost' => 200000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Premium',
                'type' => 'all',
                'cost' => 250000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        Plan::insert($planData);
        $serviceData = [
            //Normal
            ['name' => 'Fast WIFI Inside The Gym', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Best Equipments & Kits', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Air Conditioned Rooms', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Access to subset of Diets', 'created_at' => now(), 'updated_at' => now()],
            //Vip
            ['name' => 'Special Cabnet', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Access to Special Services', 'created_at' => now(), 'updated_at' => now()],
            //Premium
            ['name' => 'Special rooms only for Premium', 'created_at' => now(), 'updated_at' => now()],
        ];
        Service::insert($serviceData);
        // Associating plans with services
        $associations = [
            1 => [1, 2, 3], // Normal plan services
            2 => [1, 2, 3, 4, 5], // Vip plan services
            3 => [1, 2, 3, 4, 5, 6], // Premium plan services
        ];

        foreach ($associations as $planId => $serviceIds) {
            $plan = Plan::find($planId);
            $plan->services()->attach($serviceIds);
        }
    }
}
