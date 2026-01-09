<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\Floor;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        $floors = Floor::all();

        foreach ($floors as $floor) {
            for ($i = 1; $i <= 4; $i++) {
                Room::create([
                    'floor_id' => $floor->id,
                    'room_number' => $floor->floor_number . '0' . $i,
                    'type' => '1 Bed',
                    'price' => rand(900, 2500),
                ]);
            }
        }
    }
}
