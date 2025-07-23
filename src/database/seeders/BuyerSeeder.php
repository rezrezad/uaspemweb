<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Buyer;
use App\Models\Property;

class BuyerSeeder extends Seeder
{
    public function run(): void
    {
        $buyers = [
            [
                'name' => 'Reza Aditya',
                'email' => 'reza@example.com',
                'phone' => '081234567890',
                'property_id' => 1,
                'status' => 'pending',
            ],
            [
                'name' => 'Lestari Anindya',
                'email' => 'lestari@example.com',
                'phone' => '089998887766',
                'property_id' => 2,
                'status' => 'approved',
            ],
            [
                'name' => 'Joko Santoso',
                'email' => 'joko@example.com',
                'phone' => '082233445566',
                'property_id' => 3,
                'status' => 'rejected',
            ],
        ];

        foreach ($buyers as $buyer) {
            Buyer::create($buyer);
        }
    }
}
