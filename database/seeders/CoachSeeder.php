<?php

namespace Database\Seeders;

use App\Domains\Club\Models\Product;
use App\Domains\Entities\Models\Coach;
use Illuminate\Database\Seeder;

class CoachSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pictures = [
            'pexels-alesiakozik-7289248.jpg',
            'pexels-bemistermister-3490348.jpg',
            'pexels-justin-shaifer-501272-1222271.jpg',
            'pexels-olly-774095.jpg',
            'pexels-olly-846741.jpg',
            'pexels-pixabay-262391.jpg',
            'pexels-tima-miroshnichenko-5327485.jpg',
            'pexels-tima-miroshnichenko-5327539.jpg',
        ];

        $coaches = Coach::get();
        foreach ($coaches as $key => $coach) {
            $path = public_path('images/coaches/' . $pictures[$key]);
            $coach->addMedia($path)->preservingOriginal()
                ->toMediaCollection('coaches');
        }
    }
}
