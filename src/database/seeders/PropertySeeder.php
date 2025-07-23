<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;

class PropertySeeder extends Seeder
{
    public function run(): void
    {
        $properties = [
            [
                'name' => 'Green Lake Villa',
                'location' => 'Tangerang',
                'price' => 850000000,
                'type' => 'Rumah',
                'bedrooms' => 3,
                'bathrooms' => 2,
                'land_area' => 120,
                'description' => 'Rumah asri dekat danau, cocok untuk keluarga.',
                'image' => 'properties/greenlake.jpg',
                'status' => 'available',
            ],
            [
                'name' => 'Apartemen Sky Tower',
                'location' => 'Jakarta Selatan',
                'price' => 1250000000,
                'type' => 'Apartemen',
                'bedrooms' => 2,
                'bathrooms' => 1,
                'land_area' => 80,
                'description' => 'Apartemen mewah dengan pemandangan kota.',
                'image' => 'properties/skytower.jpg',
                'status' => 'available',
            ],
            [
                'name' => 'Tanah Kavling Sunrise Hill',
                'location' => 'Bogor',
                'price' => 500000000,
                'type' => 'Tanah',
                'bedrooms' => 0,
                'bathrooms' => 0,
                'land_area' => 200,
                'description' => 'Kavling strategis untuk investasi atau rumah impian.',
                'image' => 'properties/sunrisehill.jpg',
                'status' => 'available',
            ],
        ];

        foreach ($properties as $property) {
            Property::create($property);
        }
    }
}
