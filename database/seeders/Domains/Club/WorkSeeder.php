<?php

namespace Database\Seeders\Domains\Club;

use App\Domains\Club\Models\Work;
use Illuminate\Database\Seeder;

class WorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'day' => 'Monday',
                'man' => '02:00 PM - 11:00 PM',
                'woman' => '7:00 AM - 01:00 PM',
            ],
            [
                'day' => 'Tuesday',
                'man' => '02:00 PM - 11:00 PM',
                'woman' => '7:00 AM - 01:00 PM',
            ],
            'Wednesday' => [
                'day' => 'Wednesday',
                'man' => '02:00 PM - 11:00 PM',
                'woman' => '7:00 AM - 01:00 PM',
            ],
            [
                'day' => 'Thursday',
                'man' => '02:00 PM - 11:00 PM',
                'woman' => '7:00 AM - 01:00 PM',
            ],
            [
                'day' => 'Friday',
                'man' => 'CLOSED',
                'woman' => 'CLOSED',
            ],
            [
                'day' => 'Saturday',
                'man' => '02:00 PM - 11:00 PM',
                'woman' => '7:00 AM - 01:00 PM',
            ],
            [
                'day' => 'Sunday',
                'man' => '02:00 PM - 11:00 PM',
                'woman' => '7:00 AM - 01:00 PM',
            ],
        ];
        Work::insert($data);
    }
}
