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
                'gym_id' => 1,
                'day' => 'Monday',
                'man' => '02:00 PM - 11:00 PM',
                'woman' => '07:00 AM - 01:00 PM',
            ],
            [
                'gym_id' => 1,
                'day' => 'Tuesday',
                'man' => '02:00 PM - 11:00 PM',
                'woman' => '07:00 AM - 01:00 PM',
            ],
            'Wednesday' => [
                'gym_id' => 1,

                'day' => 'Wednesday',
                'man' => '02:00 PM - 11:00 PM',
                'woman' => '07:00 AM - 01:00 PM',
            ],
            [
                'gym_id' => 1,
                'day' => 'Thursday',
                'man' => '02:00 PM - 11:00 PM',
                'woman' => '07:00 AM - 01:00 PM',
            ],
            [
                'gym_id' => 1,
                'day' => 'Friday',
                'man' => 'CLOSED',
                'woman' => 'CLOSED',
            ],
            [
                'gym_id' => 1,
                'day' => 'Saturday',
                'man' => '02:00 PM - 11:00 PM',
                'woman' => '07:00 AM - 01:00 PM',
            ],
            [
                'gym_id' => 1,
                'day' => 'Sunday',
                'man' => '02:00 PM - 11:00 PM',
                'woman' => '07:00 AM - 01:00 PM',
            ],
        ];
        Work::insert($data);
    }
}
