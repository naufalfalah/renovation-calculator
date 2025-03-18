<?php

namespace Database\Seeders;

use App\Enums\WorkPackageNameEnum;
use App\Models\OtherWorkPackage;
use Illuminate\Database\Seeder;

class OtherWorkPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $otherWorkPackages = [
            [
                'other_work_id' => 1,
                'name' => WorkPackageNameEnum::LIGHT,
                'lower_bound_budget' => 100,
                'upper_bound_budget' => 1000,
            ],
            [
                'other_work_id' => 1,
                'name' => WorkPackageNameEnum::MODERATE,
                'lower_bound_budget' => 200,
                'upper_bound_budget' => 1700,
            ],
            [
                'other_work_id' => 1,
                'name' => WorkPackageNameEnum::EXTENSIVE,
                'lower_bound_budget' => 1700,
                'upper_bound_budget' => 16000,
            ],
            [
                'other_work_id' => 2,
                'name' => WorkPackageNameEnum::LIGHT,
                'lower_bound_budget' => 100,
                'upper_bound_budget' => 1100,
            ],
            [
                'other_work_id' => 2,
                'name' => WorkPackageNameEnum::MODERATE,
                'lower_bound_budget' => 200,
                'upper_bound_budget' => 700,
            ],
            [
                'other_work_id' => 2,
                'name' => WorkPackageNameEnum::EXTENSIVE,
                'lower_bound_budget' => 700,
                'upper_bound_budget' => 7800,
            ],
            [
                'other_work_id' => 3,
                'name' => WorkPackageNameEnum::LIGHT,
                'lower_bound_budget' => 100,
                'upper_bound_budget' => 1500,
            ],
            [
                'other_work_id' => 3,
                'name' => WorkPackageNameEnum::MODERATE,
                'lower_bound_budget' => 700,
                'upper_bound_budget' => 2900,
            ],
            [
                'other_work_id' => 3,
                'name' => WorkPackageNameEnum::EXTENSIVE,
                'lower_bound_budget' => 2900,
                'upper_bound_budget' => 30200,
            ],
            [
                'other_work_id' => 4,
                'name' => WorkPackageNameEnum::LIGHT,
                'lower_bound_budget' => 100,
                'upper_bound_budget' => 1100,
            ],
            [
                'other_work_id' => 4,
                'name' => WorkPackageNameEnum::MODERATE,
                'lower_bound_budget' => 200,
                'upper_bound_budget' => 300,
            ],
            [
                'other_work_id' => 4,
                'name' => WorkPackageNameEnum::EXTENSIVE,
                'lower_bound_budget' => 300,
                'upper_bound_budget' => 12400,
            ],
        ];

        foreach ($otherWorkPackages as $owp) {
            OtherWorkPackage::create($owp);
        }
    }
}
