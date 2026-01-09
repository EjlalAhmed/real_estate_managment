<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Apartment;

class ApartmentSeeder extends Seeder
{
    public function run(): void
    {
        Apartment::insert([
            [
                'name' => 'London Square Chelsea',
                'location' => 'Chelsea, London',
                'description' => 'Luxury apartments in Chelsea',
            ],
            [
                'name' => 'London Square Croydon',
                'location' => 'Croydon, London',
                'description' => 'Modern living spaces',
            ],
        ]);
    }
}
