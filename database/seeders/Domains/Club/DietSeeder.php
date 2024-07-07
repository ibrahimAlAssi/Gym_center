<?php

namespace Database\Seeders\Domains\Club;

use Illuminate\Database\Seeder;
use App\Domains\Club\Models\Diet;
use App\Domains\Club\Models\DietFood;
use App\Domains\Club\Models\Food;

class DietSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dietData = [
            ["name" => 'Keto Diet', "is_free" => 1]
        ];
        Diet::insert($dietData);
        $allowed_ids = Food::whereIn('name', [
            'Egg',
            'Chicken breast',
            'Milk',
            'Yogurt',
            'Fish',
            'Almond',
            'Tomatoes',
            'Tuna',
            'Salmon',
        ])->pluck('id')->toArray();
        $not_allowed_ids = Food::whereIn('name', [
            'Cake',
            'Rice',
            'Pasta',
            'Peas',
            'Carrots',
            'Crabs',
            'Sugar',
        ])->pluck('id')->toArray();
        foreach ($allowed_ids as $id) {
            DietFood::insert(
                [
                    'diet_id' => 1,
                    'food_id' => $id,
                    'allowed' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
        foreach ($not_allowed_ids as $id) {
            DietFood::insert(
                [
                    'diet_id' => 1,
                    'food_id' => $id,
                    'allowed' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
