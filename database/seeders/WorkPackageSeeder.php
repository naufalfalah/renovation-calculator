<?php

namespace Database\Seeders;

use App\Enums\WorkPackageNameEnum;
use App\Models\WorkPackage;
use Illuminate\Database\Seeder;

class WorkPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $workPackages = [
            [
                'room_id' => 1,
                'work_id' => 1,
                'name' => WorkPackageNameEnum::LIGHT,
                'lower_bound_budget' => 100,
                'upper_bound_budget' => 200,
            ],
            [
                'room_id' => 1,
                'work_id' => 1,
                'name' => WorkPackageNameEnum::MODERATE,
                'lower_bound_budget' => 200,
                'upper_bound_budget' => 300,
            ],
            [
                'room_id' => 1,
                'work_id' => 1,
                'name' => WorkPackageNameEnum::EXTENSIVE,
                'lower_bound_budget' => 300,
                'upper_bound_budget' => 5500,
            ],
            [
                'room_id' => 1,
                'work_id' => 2,
                'name' => WorkPackageNameEnum::LIGHT,
                'lower_bound_budget' => 100,
                'upper_bound_budget' => 200,
            ],
            [
                'room_id' => 1,
                'work_id' => 2,
                'name' => WorkPackageNameEnum::MODERATE,
                'lower_bound_budget' => 900,
                'upper_bound_budget' => 3200,
            ],
            [
                'room_id' => 1,
                'work_id' => 2,
                'name' => WorkPackageNameEnum::EXTENSIVE,
                'lower_bound_budget' => 2400,
                'upper_bound_budget' => 20500,
            ],
            [
                'room_id' => 1,
                'work_id' => 3,
                'name' => WorkPackageNameEnum::LIGHT,
                'lower_bound_budget' => 100,
                'upper_bound_budget' => 3000,
            ],
            [
                'room_id' => 1,
                'work_id' => 3,
                'name' => WorkPackageNameEnum::MODERATE,
                'lower_bound_budget' => 2200,
                'upper_bound_budget' => 5300,
            ],
            [
                'room_id' => 1,
                'work_id' => 3,
                'name' => WorkPackageNameEnum::EXTENSIVE,
                'lower_bound_budget' => 5300,
                'upper_bound_budget' => 24000,
            ],
            [
                'room_id' => 1,
                'work_id' => 4,
                'name' => WorkPackageNameEnum::LIGHT,
                'lower_bound_budget' => 100,
                'upper_bound_budget' => 200,
            ],
            [
                'room_id' => 1,
                'work_id' => 4,
                'name' => WorkPackageNameEnum::MODERATE,
                'lower_bound_budget' => 200,
                'upper_bound_budget' => 1100,
            ],
            [
                'room_id' => 1,
                'work_id' => 4,
                'name' => WorkPackageNameEnum::EXTENSIVE,
                'lower_bound_budget' => 300,
                'upper_bound_budget' => 7500,
            ],
            [
                'room_id' => 2,
                'work_id' => 5,
                'name' => WorkPackageNameEnum::LIGHT,
                'lower_bound_budget' => 100,
                'upper_bound_budget' => 200,
            ],
            [
                'room_id' => 2,
                'work_id' => 5,
                'name' => WorkPackageNameEnum::MODERATE,
                'lower_bound_budget' => 200,
                'upper_bound_budget' => 300,
            ],
            [
                'room_id' => 2,
                'work_id' => 5,
                'name' => WorkPackageNameEnum::EXTENSIVE,
                'lower_bound_budget' => 300,
                'upper_bound_budget' => 7800,
            ],
            [
                'room_id' => 2,
                'work_id' => 6,
                'name' => WorkPackageNameEnum::LIGHT,
                'lower_bound_budget' => 100,
                'upper_bound_budget' => 200,
            ],
            [
                'room_id' => 2,
                'work_id' => 6,
                'name' => WorkPackageNameEnum::MODERATE,
                'lower_bound_budget' => 700,
                'upper_bound_budget' => 3700,
            ],
            [
                'room_id' => 2,
                'work_id' => 6,
                'name' => WorkPackageNameEnum::EXTENSIVE,
                'lower_bound_budget' => 2800,
                'upper_bound_budget' => 17600,
            ],
            [
                'room_id' => 2,
                'work_id' => 7,
                'name' => WorkPackageNameEnum::LIGHT,
                'lower_bound_budget' => 100,
                'upper_bound_budget' => 4900,
            ],
            [
                'room_id' => 2,
                'work_id' => 7,
                'name' => WorkPackageNameEnum::MODERATE,
                'lower_bound_budget' => 4900,
                'upper_bound_budget' => 7900,
            ],
            [
                'room_id' => 2,
                'work_id' => 7,
                'name' => WorkPackageNameEnum::EXTENSIVE,
                'lower_bound_budget' => 8700,
                'upper_bound_budget' => 30500,
            ],
            [
                'room_id' => 2,
                'work_id' => 8,
                'name' => WorkPackageNameEnum::LIGHT,
                'lower_bound_budget' => 100,
                'upper_bound_budget' => 200,
            ],
            [
                'room_id' => 2,
                'work_id' => 8,
                'name' => WorkPackageNameEnum::MODERATE,
                'lower_bound_budget' => 200,
                'upper_bound_budget' => 300,
            ],
            [
                'room_id' => 2,
                'work_id' => 8,
                'name' => WorkPackageNameEnum::EXTENSIVE,
                'lower_bound_budget' => 300,
                'upper_bound_budget' => 3200,
            ],
            [
                'room_id' => 3,
                'work_id' => 9,
                'name' => WorkPackageNameEnum::LIGHT,
                'lower_bound_budget' => 100,
                'upper_bound_budget' => 200,
            ],
            [
                'room_id' => 3,
                'work_id' => 9,
                'name' => WorkPackageNameEnum::MODERATE,
                'lower_bound_budget' => 200,
                'upper_bound_budget' => 500,
            ],
            [
                'room_id' => 3,
                'work_id' => 9,
                'name' => WorkPackageNameEnum::EXTENSIVE,
                'lower_bound_budget' => 2100,
                'upper_bound_budget' => 7400,
            ],
            [
                'room_id' => 3,
                'work_id' => 10,
                'name' => WorkPackageNameEnum::LIGHT,
                'lower_bound_budget' => 100,
                'upper_bound_budget' => 500,
            ],
            [
                'room_id' => 3,
                'work_id' => 10,
                'name' => WorkPackageNameEnum::MODERATE,
                'lower_bound_budget' => 2300,
                'upper_bound_budget' => 4300,
            ],
            [
                'room_id' => 3,
                'work_id' => 10,
                'name' => WorkPackageNameEnum::EXTENSIVE,
                'lower_bound_budget' => 4300,
                'upper_bound_budget' => 9000,
            ],
            [
                'room_id' => 3,
                'work_id' => 11,
                'name' => WorkPackageNameEnum::LIGHT,
                'lower_bound_budget' => 100,
                'upper_bound_budget' => 2000,
            ],
            [
                'room_id' => 3,
                'work_id' => 11,
                'name' => WorkPackageNameEnum::MODERATE,
                'lower_bound_budget' => 5200,
                'upper_bound_budget' => 8600,
            ],
            [
                'room_id' => 3,
                'work_id' => 11,
                'name' => WorkPackageNameEnum::EXTENSIVE,
                'lower_bound_budget' => 8600,
                'upper_bound_budget' => 15000,
            ],
            [
                'room_id' => 3,
                'work_id' => 12,
                'name' => WorkPackageNameEnum::LIGHT,
                'lower_bound_budget' => 100,
                'upper_bound_budget' => 500,
            ],
            [
                'room_id' => 3,
                'work_id' => 12,
                'name' => WorkPackageNameEnum::MODERATE,
                'lower_bound_budget' => 1700,
                'upper_bound_budget' => 2300,
            ],
            [
                'room_id' => 3,
                'work_id' => 12,
                'name' => WorkPackageNameEnum::EXTENSIVE,
                'lower_bound_budget' => 2300,
                'upper_bound_budget' => 5000,
            ],
            [
                'room_id' => 4,
                'work_id' => 13,
                'name' => WorkPackageNameEnum::LIGHT,
                'lower_bound_budget' => 100,
                'upper_bound_budget' => 200,
            ],
            [
                'room_id' => 4,
                'work_id' => 13,
                'name' => WorkPackageNameEnum::MODERATE,
                'lower_bound_budget' => 200,
                'upper_bound_budget' => 500,
            ],
            [
                'room_id' => 4,
                'work_id' => 13,
                'name' => WorkPackageNameEnum::EXTENSIVE,
                'lower_bound_budget' => 2100,
                'upper_bound_budget' => 7400,
            ],
            [
                'room_id' => 4,
                'work_id' => 14,
                'name' => WorkPackageNameEnum::LIGHT,
                'lower_bound_budget' => 100,
                'upper_bound_budget' => 500,
            ],
            [
                'room_id' => 4,
                'work_id' => 14,
                'name' => WorkPackageNameEnum::MODERATE,
                'lower_bound_budget' => 2300,
                'upper_bound_budget' => 4300,
            ],
            [
                'room_id' => 4,
                'work_id' => 14,
                'name' => WorkPackageNameEnum::EXTENSIVE,
                'lower_bound_budget' => 4300,
                'upper_bound_budget' => 9000,
            ],
            [
                'room_id' => 4,
                'work_id' => 15,
                'name' => WorkPackageNameEnum::LIGHT,
                'lower_bound_budget' => 100,
                'upper_bound_budget' => 2000,
            ],
            [
                'room_id' => 4,
                'work_id' => 15,
                'name' => WorkPackageNameEnum::MODERATE,
                'lower_bound_budget' => 5200,
                'upper_bound_budget' => 8600,
            ],
            [
                'room_id' => 4,
                'work_id' => 15,
                'name' => WorkPackageNameEnum::EXTENSIVE,
                'lower_bound_budget' => 8600,
                'upper_bound_budget' => 15000,
            ],
            [
                'room_id' => 4,
                'work_id' => 16,
                'name' => WorkPackageNameEnum::LIGHT,
                'lower_bound_budget' => 100,
                'upper_bound_budget' => 500,
            ],
            [
                'room_id' => 4,
                'work_id' => 16,
                'name' => WorkPackageNameEnum::MODERATE,
                'lower_bound_budget' => 1700,
                'upper_bound_budget' => 2300,
            ],
            [
                'room_id' => 4,
                'work_id' => 16,
                'name' => WorkPackageNameEnum::EXTENSIVE,
                'lower_bound_budget' => 2300,
                'upper_bound_budget' => 5000,
            ],
        ];

        foreach ($workPackages as $wp) {
            WorkPackage::create($wp);
        }
    }
}
