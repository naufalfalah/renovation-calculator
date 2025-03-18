<?php

namespace Database\Seeders;

use App\Enums\WorkTypeEnum;
use App\Models\Work;
use Illuminate\Database\Seeder;

class WorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $works = [
            [
                'id' => 1,
                'room_id' => 1,
                'type' => WorkTypeEnum::HACKING,
            ],
            [
                'id' => 2,
                'room_id' => 1,
                'type' => WorkTypeEnum::MASONRY,
            ],
            [
                'id' => 3,
                'room_id' => 1,
                'type' => WorkTypeEnum::CARPENTRY,
            ],
            [
                'id' => 4,
                'room_id' => 1,
                'type' => WorkTypeEnum::CEILING_PARTITION,
            ],
            [
                'id' => 5,
                'room_id' => 2,
                'type' => WorkTypeEnum::HACKING,
            ],
            [
                'id' => 6,
                'room_id' => 2,
                'type' => WorkTypeEnum::MASONRY,
            ],
            [
                'id' => 7,
                'room_id' => 2,
                'type' => WorkTypeEnum::CARPENTRY,
            ],
            [
                'id' => 8,
                'room_id' => 2,
                'type' => WorkTypeEnum::PLUMBING,
            ],
            [
                'id' => 9,
                'room_id' => 3,
                'type' => WorkTypeEnum::HACKING,
            ],
            [
                'id' => 10,
                'room_id' => 3,
                'type' => WorkTypeEnum::MASONRY,
            ],
            [
                'id' => 11,
                'room_id' => 3,
                'type' => WorkTypeEnum::CARPENTRY,
            ],
            [
                'id' => 12,
                'room_id' => 3,
                'type' => WorkTypeEnum::CEILING_PARTITION,
            ],
            [
                'id' => 13,
                'room_id' => 4,
                'type' => WorkTypeEnum::HACKING,
            ],
            [
                'id' => 14,
                'room_id' => 4,
                'type' => WorkTypeEnum::MASONRY,
            ],
            [
                'id' => 15,
                'room_id' => 4,
                'type' => WorkTypeEnum::CARPENTRY,
            ],
            [
                'id' => 16,
                'room_id' => 4,
                'type' => WorkTypeEnum::PLUMBING,
            ],
        ];

        foreach ($works as $work) {
            Work::create($work);
        }
    }
}
