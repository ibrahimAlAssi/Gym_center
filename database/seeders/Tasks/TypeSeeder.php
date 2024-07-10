<?php

namespace Database\Seeders\Tasks;

use App\Domains\Tasks\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'back',
            ],
            [
                'name' => 'feed',
            ],
            [
                'name' => 'chest',
            ],
            [
                'name' => 'armpit',
            ],
            [
                'name' => 'shoulder',
            ],
        ];
        Type::insert($data);
    }
}
