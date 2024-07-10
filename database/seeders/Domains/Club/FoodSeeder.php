<?php

namespace Database\Seeders\Domains\Club;

use App\Domains\Club\Models\Food;
use App\Domains\Club\Models\NutritionalValue;
use Illuminate\Database\Seeder;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $foodData = [
            ['name' => 'Tomato',],
            ['name' => 'Egg',],
            ['name' => 'Carrot',],
            ['name' => 'Spinach',],
            ['name' => 'Broccoli',],
            ['name' => 'Salmon',],
            ['name' => 'Quinoa',],
            ['name' => 'Greek Yogurt',],
            ['name' => 'Chicken Breast',],
            ['name' => 'Almonds',],
            ['name' => 'Avocado',],
            ['name' => 'Oats',],
            ['name' => 'Blueberries',],
            ['name' => 'Sweet Potato',],
            ['name' => 'Tuna',],
            ['name' => 'Lentils',],
            ['name' => 'Kale',],
            ['name' => 'Chia Seeds',],
            ['name' => 'Bell Pepper (Red)',],
            ['name' => 'Cottage Cheese',],
        ];
        Food::insert($foodData);
        $nutritionalValuesData = [
            ['food_id' => 1, 'name' => 'Protein', 'value' => 1],
            ['food_id' => 1, 'name' => 'Fat', 'value' => 0],
            ['food_id' => 1, 'name' => 'Calories', 'value' => 22],
            ['food_id' => 1, 'name' => 'Carbohydrates', 'value' => 5],

            ['food_id' => 2, 'name' => 'Protein', 'value' => 6],
            ['food_id' => 2, 'name' => 'Fat', 'value' => 5],
            ['food_id' => 2, 'name' => 'Calories', 'value' => 70],
            ['food_id' => 2, 'name' => 'Carbohydrates', 'value' => 1],

            ['food_id' => 3, 'name' => 'Protein', 'value' => 1],
            ['food_id' => 3, 'name' => 'Fat', 'value' => 0],
            ['food_id' => 3, 'name' => 'Calories', 'value' => 25],
            ['food_id' => 3, 'name' => 'Carbohydrates', 'value' => 6],

            ['food_id' => 4, 'name' => 'Protein', 'value' => 1],
            ['food_id' => 4, 'name' => 'Fat', 'value' => 0],
            ['food_id' => 4, 'name' => 'Calories', 'value' => 7],
            ['food_id' => 4, 'name' => 'Carbohydrates', 'value' => 1],

            ['food_id' => 5, 'name' => 'Protein', 'value' => 3],
            ['food_id' => 5, 'name' => 'Fat', 'value' => 0],
            ['food_id' => 5, 'name' => 'Calories', 'value' => 55],
            ['food_id' => 5, 'name' => 'Carbohydrates', 'value' => 11],

            ['food_id' => 6, 'name' => 'Protein', 'value' => 22],
            ['food_id' => 6, 'name' => 'Fat', 'value' => 13],
            ['food_id' => 6, 'name' => 'Calories', 'value' => 206],
            ['food_id' => 6, 'name' => 'Carbohydrates', 'value' => 0],

            ['food_id' => 7, 'name' => 'Protein', 'value' => 4],
            ['food_id' => 7, 'name' => 'Fat', 'value' => 2],
            ['food_id' => 7, 'name' => 'Calories', 'value' => 222],
            ['food_id' => 7, 'name' => 'Carbohydrates', 'value' => 39],

            ['food_id' => 8, 'name' => 'Protein', 'value' => 10],
            ['food_id' => 8, 'name' => 'Fat', 'value' => 0],
            ['food_id' => 8, 'name' => 'Calories', 'value' => 59],
            ['food_id' => 8, 'name' => 'Carbohydrates', 'value' => 3],

            ['food_id' => 9, 'name' => 'Protein', 'value' => 24],
            ['food_id' => 9, 'name' => 'Fat', 'value' => 1],
            ['food_id' => 9, 'name' => 'Calories', 'value' => 165],
            ['food_id' => 9, 'name' => 'Carbohydrates', 'value' => 0],

            ['food_id' => 10, 'name' => 'Protein', 'value' => 6],
            ['food_id' => 10, 'name' => 'Protein', 'value' => 14],
            ['food_id' => 10, 'name' => 'Fat', 'value' => 163],
            ['food_id' => 10, 'name' => 'Fat', 'value' => 6],

            ['food_id' => 11, 'name' => 'Calories', 'value' => 2],
            ['food_id' => 11, 'name' => 'Calories', 'value' => 15],
            ['food_id' => 11, 'name' => 'Carbohydrates', 'value' => 160],
            ['food_id' => 11, 'name' => 'Carbohydrates', 'value' => 9],

            ['food_id' => 12, 'name' => 'Calories', 'value' => 5],
            ['food_id' => 12, 'name' => 'Calories', 'value' => 3],
            ['food_id' => 12, 'name' => 'Carbohydrates', 'value' => 147],
            ['food_id' => 12, 'name' => 'Carbohydrates', 'value' => 27],

            ['food_id' => 13, 'name' => 'Calories', 'value' => 1],
            ['food_id' => 13, 'name' => 'Calories', 'value' => 0],
            ['food_id' => 13, 'name' => 'Carbohydrates', 'value' => 42],
            ['food_id' => 13, 'name' => 'Carbohydrates', 'value' => 11],

            ['food_id' => 14, 'name' => 'Calories', 'value' => 2],
            ['food_id' => 14, 'name' => 'Calories', 'value' => 0],
            ['food_id' => 14, 'name' => 'Carbohydrates', 'value' => 86],
            ['food_id' => 14, 'name' => 'Carbohydrates', 'value' => 20],

            ['food_id' => 15, 'name' => 'Calories', 'value' => 29],
            ['food_id' => 15, 'name' => 'Calories', 'value' => 1],
            ['food_id' => 15, 'name' => 'Carbohydrates', 'value' => 128],
            ['food_id' => 15, 'name' => 'Carbohydrates', 'value' => 0],

            ['food_id' => 16, 'name' => 'Calories', 'value' => 9],
            ['food_id' => 16, 'name' => 'Calories', 'value' => 0],
            ['food_id' => 16, 'name' => 'Carbohydrates', 'value' => 230],
            ['food_id' => 16, 'name' => 'Carbohydrates', 'value' => 40],

            ['food_id' => 17, 'name' => 'Calories', 'value' => 3],
            ['food_id' => 17, 'name' => 'Calories', 'value' => 0],
            ['food_id' => 17, 'name' => 'Carbohydrates', 'value' => 33],
            ['food_id' => 17, 'name' => 'Carbohydrates', 'value' => 6],

            ['food_id' => 18, 'name' => 'Calories', 'value' => 4],
            ['food_id' => 18, 'name' => 'Calories', 'value' => 9],
            ['food_id' => 18, 'name' => 'Carbohydrates', 'value' => 137],
            ['food_id' => 18, 'name' => 'Carbohydrates', 'value' => 12],

            ['food_id' => 19, 'name' => 'Calories', 'value' => 1],
            ['food_id' => 19, 'name' => 'Calories', 'value' => 0],
            ['food_id' => 19, 'name' => 'Carbohydrates', 'value' => 31],
            ['food_id' => 19, 'name' => 'Carbohydrates', 'value' => 7],

            ['food_id' => 20, 'name' => 'Calories', 'value' => 12],
            ['food_id' => 20, 'name' => 'Calories', 'value' => 5],
            ['food_id' => 20, 'name' => 'Carbohydrates', 'value' => 98],
            ['food_id' => 20, 'name' => 'Carbohydrates', 'value' => 3],
        ];
        NutritionalValue::insert($nutritionalValuesData);

        // if ($request->hasFile('image')) {
        //     $food->addMediaFromRequest('image')->toMediaCollection('foods');
        // }
    }
}
