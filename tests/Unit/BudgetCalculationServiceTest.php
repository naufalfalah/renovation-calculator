<?php

namespace Tests\Unit;

use App\Services\BudgetCalculationService;
use Tests\TestCase;
use Tests\Traits\LoadsFixtures;

class BudgetCalculationServiceTest extends TestCase
{
    use LoadsFixtures;

    protected BudgetCalculationService $service;
    protected $rooms;
    protected $works;
    protected $workPackages;
    protected $otherWorks;
    protected $otherWorkPackages;
    protected $userRenovation;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new BudgetCalculationService();

        $this->rooms = $this->loadFixtureArray('rooms');
        $this->works = $this->loadFixtureArray('works');
        $this->workPackages = $this->loadFixtureArray('work_packages');
        $this->otherWorks = $this->loadFixtureArray('other_works');
        $this->otherWorkPackages = $this->loadFixtureArray('other_work_packages');
    }

    public function test_sample_1()
    {
        $userRenovation = [
            'property_type' => 'hdb',
            'property_condition' => 'new',
            'base_unit' => 'sqft',
            'size' => 100,
            'main' => [
                [
                    'room_id' => 1,
                    'work_id' => 1,
                    'work_package_id' => 1,
                ],
                [
                    'room_id' => 1,
                    'work_id' => 2,
                    'work_package_id' => 2,
                ],
                [
                    'room_id' => 1,
                    'work_id' => 3,
                    'work_package_id' => 3,
                ],
                [
                    'room_id' => 1,
                    'work_id' => 4,
                    'work_package_id' => 4,
                ],
                [
                    'room_id' => 2,
                    'work_id' => 5,
                    'work_package_id' => 5,
                ],
                [
                    'room_id' => 2,
                    'work_id' => 6,
                    'work_package_id' => 6,
                ],
                [
                    'room_id' => 2,
                    'work_id' => 7,
                    'work_package_id' => 7,
                ],
                [
                    'room_id' => 2,
                    'work_id' => 8,
                    'work_package_id' => 8,
                ],
                [
                    'room_id' => 3,
                    'work_id' => 9,
                    'work_package_id' => 9,
                ],
                [
                    'room_id' => 3,
                    'work_id' => 10,
                    'work_package_id' => 10,
                ],
                [
                    'room_id' => 3,
                    'work_id' => 11,
                    'work_package_id' => 11,
                ],
                [
                    'room_id' => 3,
                    'work_id' => 12,
                    'work_package_id' => 12,
                ],
                [
                    'room_id' => 4,
                    'work_id' => 13,
                    'work_package_id' => 13,
                ],
                [
                    'room_id' => 4,
                    'work_id' => 14,
                    'work_package_id' => 14,
                ],
                [
                    'room_id' => 4,
                    'work_id' => 15,
                    'work_package_id' => 15,
                ],
                [
                    'room_id' => 4,
                    'work_id' => 16,
                    'work_package_id' => 16,
                ],
            ],
            'additional' => [
                [
                    'other_work_id' => 1,
                    'other_work_package_id' => 1,
                ],
                [
                    'other_work_id' => 2,
                    'other_work_package_id' => 2,
                ],
                [
                    'other_work_id' => 3,
                    'other_work_package_id' => 3,
                ],
                [
                    'other_work_id' => 4,
                    'other_work_package_id' => 4,
                ],
            ],
        ];

        $propertyType = $userRenovation['property_type'];

        // dump($this->userRenovation);

        foreach ($userRenovation['main'] as $key => $main) {
            // Populate room
            $roomId = $main['room_id'];
            $room = collect($this->rooms)->first(fn ($room) => $room['id'] === $roomId);

            // Populate work
            $workId = $main['work_id'];
            $work = collect($this->works)->first(function ($work) use ($workId, $roomId) {
                return $work['id'] === $workId && $work['room_id'] === $roomId;
            });

            // Populate work package
            $workPackageId = $main['work_package_id'];
            $workPackage = collect($this->workPackages)->first(function ($wp) use ($workPackageId, $workId, $roomId) {
                return $wp['id'] === $workPackageId
                    && $wp['work_id'] === $workId
                    && $wp['room_id'] === $roomId;
            });

            // Inject ke array utama
            $userRenovation['main'][$key]['room'] = $room;
            $userRenovation['main'][$key]['work'] = $work;
            $userRenovation['main'][$key]['work_package'] = $workPackage;
        }

        foreach ($userRenovation['additional'] as $key => $additional) {
            // Populate work
            $workId = $additional['other_work_id'];
            $work = collect($this->otherWorks)->first(fn ($work) => $work['id'] === $workId);

            // Populate work package
            $workPackageId = $additional['other_work_package_id'];
            $workPackage = collect($this->otherWorkPackages)->first(function ($wp) use ($workPackageId, $workId) {
                return $wp['id'] === $workPackageId
                    && $wp['work_id'] === $workId;
            });

            // Inject ke array utama
            $userRenovation['additional'][$key]['work'] = $work;
            $userRenovation['additional'][$key]['work_package'] = $workPackage;
        }
        // dump($this->userRenovation);

        $userSelection = array_merge($userRenovation['main'], $userRenovation['additional']);
        // dump($userSelection);

        $result = $this->service->calculate($propertyType, $userSelection);
        // dump($result);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('budgetRange', $result);
        $this->assertArrayHasKey('workPercentages', $result);
        $this->assertArrayHasKey('roomPercentages', $result);
        $this->assertArrayHasKey('marketPosition', $result);

        $this->assertIsString($result['budgetRange']);
        $this->assertIsArray($result['workPercentages']);
        $this->assertIsArray($result['roomPercentages']);
        $this->assertIsString($result['marketPosition']);
    }
}
