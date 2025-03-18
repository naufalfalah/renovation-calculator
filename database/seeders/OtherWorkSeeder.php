<?php

namespace Database\Seeders;

use App\Enums\WorkTypeEnum;
use App\Models\OtherWork;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OtherWorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $otherWorks = [
            [
                'id' => 1,
                'type' => WorkTypeEnum::ELECTRICAL,
            ],
            [
                'id' => 2,
                'type' => WorkTypeEnum::PAINTING,
            ],
            [
                'id' => 3,
                'type' => WorkTypeEnum::GLASS_ALUMINIUM,
            ],
            [
                'id' => 4,
                'type' => WorkTypeEnum::CLEANING_POLISHING,
            ],
        ];

        foreach ($otherWorks as $otherWork) {
            OtherWork::create($otherWork);
        }
    }
}
