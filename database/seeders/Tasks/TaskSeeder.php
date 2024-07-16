<?php

namespace Database\Seeders\Tasks;

use App\Domains\Tasks\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            //Back
            [
                'name' => 'Lat Pull downs',
                'number' => '15',
                'type_id' => '1',
                'description' => 'These exercises help strengthen the back muscles,improve posture, and support overall spine health.',
            ],
            [
                'name' => 'Pull Up',
                'number' => '10',
                'type_id' => '1',
                'description' => 'These exercises help strengthen the back muscles,improve posture, and support overall spine health.',
            ],
            [
                'name' => 'Pull Up On Rope',
                'number' => '10',
                'type_id' => '1',
                'description' => 'These exercises help strengthen the back muscles,improve posture, and support overall spine health.',
            ],
            [
                'name' => 'Single Arm Dumbbell Rows',
                'number' => '10',
                'type_id' => '1',
                'description' => 'These exercises help strengthen the back muscles,improve posture, and support overall spine health.',
            ],
            // Chest
            [
                'name' => 'Cabel Crossovers',
                'number' => '10',
                'type_id' => '3',
                'description' => 'These exercises help build strength and definition in the chest area.',
            ],
            [
                'name' => 'Chest Flyes',
                'number' => '10',
                'type_id' => '3',
                'description' => 'These exercises help build strength and definition in the chest area.',
            ],
            [
                'name' => 'dumbal press',
                'number' => '10',
                'type_id' => '3',
                'description' => 'These exercises help build strength and definition in the chest area.',
            ],
            [
                'name' => 'Incline Bench Press',
                'number' => '10',
                'type_id' => '3',
                'description' => 'These exercises help build strength and definition in the chest area.',
            ],
            [
                'name' => 'Push Up',
                'number' => '10',
                'type_id' => '3',
                'description' => 'These exercises help build strength and definition in the chest area.',
            ],
            //legs
            [
                'name' => 'Jump Rope',
                'number' => '10',
                'type_id' => '2',
                'description' => 'Leg exercises are essential for overall lower body strength and stability',
            ],
            [
                'name' => 'Lunges',
                'number' => '10',
                'type_id' => '2',
                'description' => 'Leg exercises are essential for overall lower body strength and stability',

            ],
            [
                'name' => 'Squat',
                'number' => '10',
                'type_id' => '2',
                'description' => 'Leg exercises are essential for overall lower body strength and stability',

            ],
            //Shoulder
            [
                'name' => 'Arnold Press',
                'number' => '10',
                'type_id' => '4',
                'description' => ' Shoulder exercises target the deltoid muscles and help improve shoulder strength and stability.Some popular shoulder exercises include',
            ],
            [
                'name' => 'Overhead Press',
                'number' => '10',
                'type_id' => '4',
                'description' => ' Shoulder exercises target the deltoid muscles and help improve shoulder strength and stability.Some popular shoulder exercises include',
            ],

        ];
        Task::insert($data);
        for ($i = 1; $i <= 14; $i++) {
            $mediaData[] = [
                'model_type' => 'task',
                'model_id' => $i,
                'uuid' => Str::uuid()->toString(),
                'collection_name' => 'tasks',
                'name' => 'task_'.$i,
                'file_name' => 'task_'.$i.'.jpg',
                'mime_type' => 'jpg',
                'disk' => 'public_dir',
                'size' => 1200,
                'manipulations' => json_encode([]),
                'custom_properties' => json_encode([]),
                'generated_conversions' => json_encode([]),
                'responsive_images' => json_encode([]),
            ];
        }
        Media::insert($mediaData);

    }
}
