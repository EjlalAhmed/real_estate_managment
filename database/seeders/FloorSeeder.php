<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Floor;
use App\Models\Apartment;

class FloorSeeder extends Seeder
{
    public function run(): void
    {
        $apartments = Apartment::all();

        foreach ($apartments as $apartment) {
            for ($i = 1; $i <= 3; $i++) {
                Floor::create([
                    'apartment_id' => $apartment->id,
                    'floor_number' => $i,
                ]);
            }
        }
    }
}
