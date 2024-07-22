<?php

namespace Database\Seeders\Tasks;

use App\Domains\Tasks\Models\Type;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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
                'name' => 'legs',
            ],
            [
                'name' => 'chest',
            ],
            [
                'name' => 'shoulder',
            ],
        ];
        Type::insert($data);
        for ($i = 1; $i <= 4; $i++) {
            $mediaData[] = [
                'model_type' => 'type',
                'model_id' => $i,
                'uuid' => Str::uuid()->toString(),
                'collection_name' => 'types',
                'name' => 'type_'.$i,
                'file_name' => 'type_'.$i.'.jpg',
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
