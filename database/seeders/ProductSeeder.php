<?php

namespace Database\Seeders;

use App\Domains\Club\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Adidas Sneakers',
                'price' => 100000,
                'brand' => 'Adidas',
            ],
            [
                'name' => 'Adidas Sneakers V2',
                'price' => 200000,
                'brand' => 'Adidas',
            ],
            [
                'name' => 'Adidas TK8',
                'price' => 250000,
                'brand' => 'Adidas',
            ],
            [
                'name' => 'Black Dumbbell',
                'price' => 250000,
                'brand' => 'Zox',
            ],
            [
                'name' => 'Boxer Cloves',
                'price' => 250000,
                'brand' => 'Zox',
            ],
            [
                'name' => 'Home Weight',
                'price' => 300000,
                'brand' => 'Zox',
            ],
            [
                'name' => 'Nike High VS2',
                'price' => 300000,
                'brand' => 'Nike',
            ],
            [
                'name' => 'Nike Light Prime',
                'price' => 280000,
                'brand' => 'Nike',
            ],
            [
                'name' => 'Nike Shoes',
                'price' => 280000,
                'brand' => 'Nike',
            ],
            [
                'name' => 'Puma Shoes',
                'price' => 350000,
                'brand' => 'Puma',
            ],
            [
                'name' => 'Sport Headphone',
                'price' => 150000,
                'brand' => 'Sony',
            ],
            [
                'name' => 'Sport Robe',
                'price' => 50000,
                'brand' => 'Zox',
            ],
        ];
        $pictures = [
            'adidas_sneakers.jpg',
            'adidas_sneakers_v2.jpg',
            'Adidas_TK8.jpg',
            'black_dumbbell.jpg',
            'boxer_cloves.jpg',
            'home_weight.jpg',
            'nike_high_vs2.jpg',
            'nike_light.prime.jpg',
            'nike_shoes.jpg',
            'puma_shoes.jpg',
            'sport_headphone.jpg',
            'sport_robe.jpg',
        ];
        Product::insert($data);
        $products = Product::get();
        foreach ($products as $key => $product) {
            $path = public_path('images/products/'.$pictures[$key]);
            $product->addMedia($path)->preservingOriginal()
                ->toMediaCollection('products');
        }
    }
}
