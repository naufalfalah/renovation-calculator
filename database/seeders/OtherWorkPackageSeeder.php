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
                'min_property_size' => 1,
                'max_property_size' => 100,
                'other_work_id' => 1,
                'name' => WorkPackageNameEnum::LIGHT,
                'lower_bound_budget' => 100,
                'upper_bound_budget' => 200,
            ],
            [
                'min_property_size' => 1,
                'max_property_size' => 100,
                'other_work_id' => 1,
                'name' => WorkPackageNameEnum::MODERATE,
                'lower_bound_budget' => 200,
                'upper_bound_budget' => 1600,
            ],
            [
                'min_property_size' => 1,
                'max_property_size' => 100,
                'other_work_id' => 1,
                'name' => WorkPackageNameEnum::EXTENSIVE,
                'lower_bound_budget' => 1600,
                'upper_bound_budget' => 15900,
            ],
            [
                'min_property_size' => 1,
                'max_property_size' => 100,
                'other_work_id' => 2,
                'name' => WorkPackageNameEnum::LIGHT,
                'lower_bound_budget' => 100,
                'upper_bound_budget' => 200,
            ],
            [
                'min_property_size' => 1,
                'max_property_size' => 100,
                'other_work_id' => 2,
                'name' => WorkPackageNameEnum::MODERATE,
                'lower_bound_budget' => 200,
                'upper_bound_budget' => 600,
            ],
            [
                'min_property_size' => 1,
                'max_property_size' => 100,
                'other_work_id' => 2,
                'name' => WorkPackageNameEnum::EXTENSIVE,
                'lower_bound_budget' => 600,
                'upper_bound_budget' => 7700,
            ],
            [
                'min_property_size' => 1,
                'max_property_size' => 100,
                'other_work_id' => 3,
                'name' => WorkPackageNameEnum::LIGHT,
                'lower_bound_budget' => 100,
                'upper_bound_budget' => 500,
            ],
            [
                'min_property_size' => 1,
                'max_property_size' => 100,
                'other_work_id' => 3,
                'name' => WorkPackageNameEnum::MODERATE,
                'lower_bound_budget' => 500,
                'upper_bound_budget' => 2800,
            ],
            [
                'min_property_size' => 1,
                'max_property_size' => 100,
                'other_work_id' => 3,
                'name' => WorkPackageNameEnum::EXTENSIVE,
                'lower_bound_budget' => 2800,
                'upper_bound_budget' => 30000,
            ],
            [
                'min_property_size' => 1,
                'max_property_size' => 100,
                'other_work_id' => 4,
                'name' => WorkPackageNameEnum::LIGHT,
                'lower_bound_budget' => 100,
                'upper_bound_budget' => 200,
            ],
            [
                'min_property_size' => 1,
                'max_property_size' => 100,
                'other_work_id' => 4,
                'name' => WorkPackageNameEnum::MODERATE,
                'lower_bound_budget' => 200,
                'upper_bound_budget' => 300,
            ],
            [
                'min_property_size' => 1,
                'max_property_size' => 100,
                'other_work_id' => 4,
                'name' => WorkPackageNameEnum::EXTENSIVE,
                'lower_bound_budget' => 300,
                'upper_bound_budget' => 12300,
            ],
        ];

        foreach ($otherWorkPackages as $owp) {
            OtherWorkPackage::create($owp);
        }
    }
}
