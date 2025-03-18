<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = [
            [
                'id' => 1,
                'name' => 'Living/Dining',
            ],
            [
                'id' => 2,
                'name' => 'Kitchen',
            ],
            [
                'id' => 3,
                'name' => 'Bedroom',
                'have_quantity' => true,
            ],
            [
                'id' => 4,
                'name' => 'Bathroom',
                'have_quantity' => true,
            ],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}
