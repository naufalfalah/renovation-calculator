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
                'rooom_id' => 1,
                'type' => WorkTypeEnum::HACKING,
            ],
            [
                'id' => 2,
                'rooom_id' => 1,
                'type' => WorkTypeEnum::MASONRY,
            ],
            [
                'id' => 3,
                'rooom_id' => 1,
                'type' => WorkTypeEnum::CARPENTRY,
            ],
            [
                'id' => 4,
                'rooom_id' => 1,
                'type' => WorkTypeEnum::CEILING_PARTITION,
            ],
            [
                'id' => 5,
                'rooom_id' => 2,
                'type' => WorkTypeEnum::HACKING,
            ],
            [
                'id' => 6,
                'rooom_id' => 2,
                'type' => WorkTypeEnum::MASONRY,
            ],
            [
                'id' => 7,
                'rooom_id' => 2,
                'type' => WorkTypeEnum::CARPENTRY,
            ],
            [
                'id' => 8,
                'rooom_id' => 2,
                'type' => WorkTypeEnum::PLUMBING,
            ],
            [
                'id' => 9,
                'rooom_id' => 3,
                'type' => WorkTypeEnum::HACKING,
            ],
            [
                'id' => 10,
                'rooom_id' => 3,
                'type' => WorkTypeEnum::MASONRY,
            ],
            [
                'id' => 11,
                'rooom_id' => 3,
                'type' => WorkTypeEnum::CARPENTRY,
            ],
            [
                'id' => 12,
                'rooom_id' => 3,
                'type' => WorkTypeEnum::CEILING_PARTITION,
            ],
            [
                'id' => 13,
                'rooom_id' => 4,
                'type' => WorkTypeEnum::HACKING,
            ],
            [
                'id' => 14,
                'rooom_id' => 4,
                'type' => WorkTypeEnum::MASONRY,
            ],
            [
                'id' => 15,
                'rooom_id' => 4,
                'type' => WorkTypeEnum::CARPENTRY,
            ],
            [
                'id' => 16,
                'rooom_id' => 4,
                'type' => WorkTypeEnum::PLUMBING,
            ],
        ];

        foreach ($works as $work) {
            Work::create($work);
        }
    }
}
