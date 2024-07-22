<?php

namespace Database\Seeders\Domains\Club;

use App\Domains\Club\Models\Food;
use App\Domains\Club\Models\NutritionalValue;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $foodData = [
            ['name' => 'Tomato'],
            ['name' => 'Egg'],
            ['name' => 'Carrot'],
            ['name' => 'Spinach'],
            ['name' => 'Broccoli'],
            ['name' => 'Salmon'],
            ['name' => 'Quinoa'],
            ['name' => 'Yogurt'],
            ['name' => 'Chicken breast'],
            ['name' => 'Almonds'],
            ['name' => 'Avocado'],
            ['name' => 'Oats'],
            ['name' => 'Berries'],
            ['name' => 'Sweet Potato'],
            ['name' => 'Tuna'],
            ['name' => 'Lentils'],
            ['name' => 'Kale'],
            ['name' => 'Chia Seeds'],
            ['name' => 'Bell Pepper (Red)'],
            ['name' => 'Cottage Cheese'],
            ['name' => 'Rice'],
            ['name' => 'Peanuts'],
            ['name' => 'Milk'],
            ['name' => 'Cheese'],
            ['name' => 'Oil'],
            ['name' => 'Fish'],
            ['name' => 'Fast food'],
            ['name' => 'peppers'],
            ['name' => 'cucumbers'],
            ['name' => 'Apples'],
            ['name' => 'bananas'],
            ['name' => 'oranges'],
            ['name' => 'strawberries'],
            ['name' => 'chickpeas'],
            ['name' => 'Peas'],
            ['name' => 'sardines'],
            ['name' => 'White bread'],
            ['name' => 'pasta'],
            ['name' => 'Sausages'],
            ['name' => 'white rice'],
            ['name' => 'snack foods'],
            ['name' => 'Meats'],
            ['name' => 'Cake'],
            ['name' => 'Crabs'],
            ['name' => 'Sugar'],
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
            ['food_id' => 10, 'name' => 'Fat', 'value' => 14],
            ['food_id' => 10, 'name' => 'Calories', 'value' => 163],
            ['food_id' => 10, 'name' => 'Carbohydrates', 'value' => 6],

            ['food_id' => 11, 'name' => 'Protein', 'value' => 2],
            ['food_id' => 11, 'name' => 'Fat', 'value' => 15],
            ['food_id' => 11, 'name' => 'Calories', 'value' => 160],
            ['food_id' => 11, 'name' => 'Carbohydrates', 'value' => 9],

            ['food_id' => 12, 'name' => 'Protein', 'value' => 5],
            ['food_id' => 12, 'name' => 'Fat', 'value' => 3],
            ['food_id' => 12, 'name' => 'Calories', 'value' => 147],
            ['food_id' => 12, 'name' => 'Carbohydrates', 'value' => 27],

            ['food_id' => 13, 'name' => 'Protein', 'value' => 1],
            ['food_id' => 13, 'name' => 'Fat', 'value' => 0],
            ['food_id' => 13, 'name' => 'Calories', 'value' => 42],
            ['food_id' => 13, 'name' => 'Carbohydrates', 'value' => 11],

            ['food_id' => 14, 'name' => 'Protein', 'value' => 2],
            ['food_id' => 14, 'name' => 'Fat', 'value' => 0],
            ['food_id' => 14, 'name' => 'Calories', 'value' => 86],
            ['food_id' => 14, 'name' => 'Carbohydrates', 'value' => 20],

            ['food_id' => 15, 'name' => 'Protein', 'value' => 29],
            ['food_id' => 15, 'name' => 'Fat', 'value' => 1],
            ['food_id' => 15, 'name' => 'Calories', 'value' => 128],
            ['food_id' => 15, 'name' => 'Carbohydrates', 'value' => 0],

            ['food_id' => 16, 'name' => 'Protein', 'value' => 17.9],
            ['food_id' => 16, 'name' => 'Fat', 'value' => 0.8],
            ['food_id' => 16, 'name' => 'Calories', 'value' => 230],
            ['food_id' => 16, 'name' => 'Carbohydrates', 'value' => 40],

            ['food_id' => 17, 'name' => 'Protein', 'value' => 3],
            ['food_id' => 17, 'name' => 'Fat', 'value' => 0],
            ['food_id' => 17, 'name' => 'Calories', 'value' => 33],
            ['food_id' => 17, 'name' => 'Carbohydrates', 'value' => 6],

            ['food_id' => 18, 'name' => 'Protein', 'value' => 4],
            ['food_id' => 18, 'name' => 'Fat', 'value' => 9],
            ['food_id' => 18, 'name' => 'Calories', 'value' => 137],
            ['food_id' => 18, 'name' => 'Carbohydrates', 'value' => 12],

            ['food_id' => 19, 'name' => 'Protein', 'value' => 1],
            ['food_id' => 19, 'name' => 'Fat', 'value' => 0],
            ['food_id' => 19, 'name' => 'Calories', 'value' => 31],
            ['food_id' => 19, 'name' => 'Carbohydrates', 'value' => 7],

            ['food_id' => 20, 'name' => 'Protein', 'value' => 12],
            ['food_id' => 20, 'name' => 'Fat', 'value' => 5],
            ['food_id' => 20, 'name' => 'Calories', 'value' => 98],
            ['food_id' => 20, 'name' => 'Carbohydrates', 'value' => 3],

            ['food_id' => 21, 'name' => 'Protein', 'value' => 4.3],
            ['food_id' => 21, 'name' => 'Fat', 'value' => 0.4],
            ['food_id' => 21, 'name' => 'Calories', 'value' => 205],
            ['food_id' => 21, 'name' => 'Carbohydrates', 'value' => 44.5],

            ['food_id' => 22, 'name' => 'Calories', 'value' => 166],
            ['food_id' => 22, 'name' => 'Fat', 'value' => 14],
            ['food_id' => 22, 'name' => 'Protein', 'value' => 7.3],
            ['food_id' => 22, 'name' => 'Carbohydrates', 'value' => 6.1],

            ['food_id' => 23, 'name' => 'Calories', 'value' => 149],
            ['food_id' => 23, 'name' => 'Fat', 'value' => 8],
            ['food_id' => 23, 'name' => 'Protein', 'value' => 7.7],
            ['food_id' => 23, 'name' => 'Carbohydrates', 'value' => 11.7],

            ['food_id' => 24, 'name' => 'Calories', 'value' => 113],
            ['food_id' => 24, 'name' => 'Fat', 'value' => 9.3],
            ['food_id' => 24, 'name' => 'Protein', 'value' => 7],
            ['food_id' => 24, 'name' => 'Carbohydrates', 'value' => 0.4],

            ['food_id' => 25, 'name' => 'Calories', 'value' => 119],
            ['food_id' => 25, 'name' => 'Fat', 'value' => 119],
            ['food_id' => 25, 'name' => 'Protein', 'value' => 0],
            ['food_id' => 25, 'name' => 'Carbohydrates', 'value' => 0],
        ];
        NutritionalValue::insert($nutritionalValuesData);

        for ($i = 1; $i <= 23; $i++) {
            if ($i == 8 || $i == 17 || $i == 21 || $i == 22) {
                continue;
            }
            $dataMedia[] = [
                'model_type' => 'food',
                'model_id' => $i,
                'uuid' => Str::uuid()->toString(),
                'collection_name' => 'food',
                'name' => 'food_'.$i,
                'file_name' => $i.'.jpg',
                'mime_type' => 'jpg',
                'disk' => 'public_dir',
                'size' => 1200,
                'manipulations' => json_encode([]),
                'custom_properties' => json_encode([]),
                'generated_conversions' => json_encode([]),
                'responsive_images' => json_encode([]),
            ];
        }
        Media::insert($dataMedia);
    }
}
