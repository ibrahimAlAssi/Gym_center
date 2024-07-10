<?php

namespace Database\Seeders\Domains\Club;

use App\Domains\Club\Models\Diet;
use App\Domains\Club\Models\DietFood;
use App\Domains\Club\Models\Food;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class DietSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mediterranean Diet
        $Mediterranean_dietData = [
            'name' => 'Mediterranean Diet', 'is_free' => 1,
        ];

        $Mediterranean_allowedFoods = [
            'Egg', 'Tomato', 'Tuna', 'Salmon',
            'peppers',
            'cucumbers',
            'Apples',
            'bananas',
            'oranges',
            'strawberries',
            'Almonds',
            'Lentils',
            'chickpeas',
            'sardines',
            'Chicken breast',
        ];
        $Mediterranean_notAllowedFoods = [
            'Sausages',
            'White bread',
            'pasta',
            'white rice',
            'Oil',
            'Fast food',
            'snack foods',
        ];

        // Insert diet
        $Mediterranean_diet = Diet::Create($Mediterranean_dietData);

        // Prepare data for bulk insert
        $allowedData = [];
        $notAllowedData = [];

        foreach ($Mediterranean_allowedFoods as $foodName) {
            $foodId = Food::where('name', $foodName)->value('id');
            if ($foodId) {
                $allowedData[] = ['diet_id' => $Mediterranean_diet->id, 'food_id' => $foodId, 'allowed' => true];
            }
        }

        foreach ($Mediterranean_notAllowedFoods as $foodName) {
            $foodId = Food::where('name', $foodName)->value('id');
            if ($foodId) {
                $notAllowedData[] = ['diet_id' => $Mediterranean_diet->id, 'food_id' => $foodId, 'allowed' => false];
            }
        }

        // Paleo Diet
        $Paleo_dietData = [
            'name' => 'Paleo Diet', 'is_free' => 1,
        ];

        $Paleo_allowedFoods = [
            'Meats',
            'salmon',
            'Berries',
            'Apples',
            'bananas',
            'Almonds',
            'Egg',
        ];
        $Paleo_notAllowedFoods = [
            'Rice',
            'Lentils',
            'Peanuts',
            'Milk',
            'Cheese',
            'Oil'
        ];

        // Insert diet
        $Paleo_diet = Diet::firstOrCreate($Paleo_dietData);

        foreach ($Paleo_allowedFoods as $foodName) {
            $foodId = Food::where('name', $foodName)->value('id');
            if ($foodId) {
                $allowedData[] = ['diet_id' => $Paleo_diet->id, 'food_id' => $foodId, 'allowed' => true];
            }
        }

        foreach ($Paleo_notAllowedFoods as $foodName) {
            $foodId = Food::where('name', $foodName)->value('id');
            if ($foodId) {
                $notAllowedData[] = ['diet_id' => $Paleo_diet->id, 'food_id' => $foodId, 'allowed' => false];
            }
        }

        // Keto Diet
        $dietData = [
            'name' => 'Keto Diet', 'is_free' => 1,
        ];

        $keto_allowedFoods = [
            'Egg', 'Chicken breast', 'Milk', 'Yogurt', 'Fish', 'Almond', 'Tomato', 'Tuna', 'Salmon'
        ];
        $keto_notAllowedFoods = [
            'Cake', 'Rice', 'pasta', 'Peas', 'Carrot', 'Crabs', 'Sugar',
        ];

        // Insert diet
        $keto_diet = Diet::firstOrCreate($dietData);

        foreach ($keto_allowedFoods as $foodName) {
            $foodId = Food::where('name', $foodName)->value('id');
            if ($foodId) {
                $allowedData[] = ['diet_id' => $keto_diet->id, 'food_id' => $foodId, 'allowed' => true];
            }
        }

        foreach ($keto_notAllowedFoods as $foodName) {
            $foodId = Food::where('name', $foodName)->value('id');
            if ($foodId) {
                $notAllowedData[] = ['diet_id' => $keto_diet->id, 'food_id' => $foodId, 'allowed' => false];
            }
        }

        // Insert allowed foods
        if (!empty($allowedData)) {
            DietFood::insert($allowedData);
        }

        // Insert not allowed foods
        if (!empty($notAllowedData)) {
            DietFood::insert($notAllowedData);
        }

        Media::insert([
            [
                'model_type' => 'diet',
                'model_id' => $Mediterranean_diet->id,
                'uuid' => Str::uuid()->toString(),
                'collection_name' => 'diet',
                'name' => 'diet_1',
                'file_name' => 'diet_1.jpg',
                'mime_type' => 'jpg',
                'disk' => 'public_dir',
                'size' => 1200,
                'manipulations' => json_encode([]),
                'custom_properties' => json_encode([]),
                'generated_conversions' => json_encode([]),
                'responsive_images' => json_encode([]),
            ],
            [
                'model_type' => 'diet',
                'model_id' => $Paleo_diet->id,
                'uuid' => Str::uuid()->toString(),
                'collection_name' => 'diet',
                'name' => 'diet_2',
                'file_name' => 'diet_2.jpg',
                'mime_type' => 'jpg',
                'disk' => 'public_dir',
                'size' => 1200,
                'manipulations' => json_encode([]),
                'custom_properties' => json_encode([]),
                'generated_conversions' => json_encode([]),
                'responsive_images' => json_encode([]),
            ],
            [
                'model_type' => 'diet',
                'model_id' => $keto_diet->id,
                'uuid' => Str::uuid()->toString(),
                'collection_name' => 'diet',
                'name' => 'diet_3',
                'file_name' => 'diet_3.jpg',
                'mime_type' => 'jpg',
                'disk' => 'public_dir',
                'size' => 1200,
                'manipulations' => json_encode([]),
                'custom_properties' => json_encode([]),
                'generated_conversions' => json_encode([]),
                'responsive_images' => json_encode([]),
            ],
        ]);
    }
}
