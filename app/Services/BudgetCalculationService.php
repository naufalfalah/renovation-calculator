<?php

namespace App\Services;

class BudgetCalculationService
{
    // Step 1: Initializes Budget Ranges
    protected int $lowerBoundTotal = 0;

    protected int $upperBoundTotal = 0;

    protected array $workTypeTotalMap = [];

    protected array $roomTotalMap = [];

    public function calculate(string $propertyType, array $userSelections): array
    {
        // Step 2 & 3: Process Room-Specific Selections & Additional Works
        foreach ($userSelections as $selection) {
            $this->lowerBoundTotal += $selection['work_package']['lower_bound_budget'];
            $this->upperBoundTotal += $selection['work_package']['upper_bound_budget'];

            // Insert into work pie chart
            $workType = $selection['work']['type'];
            $this->workTypeTotalMap[$workType] = $this->getAverageBudget($selection['work_package']);

            // Insert into room pie chart
            if (isset($selection['room'])) {
                $roomName = $selection['room']['name'];
                $this->roomTotalMap[$roomName] = $this->getAverageBudget($selection['work_package']);
            }
        }
        // dump($this->lowerBoundTotal);
        // dump($this->upperBoundTotal);

        // Step 4: Calculate Percentages
        $workPercentages = $this->calculatePercentage($this->workTypeTotalMap);
        $workBudgets = $this->calculateBudget($this->workTypeTotalMap);
        $roomPercentages = $this->calculatePercentage($this->roomTotalMap);
        $roomBudgets = $this->calculateBudget($this->roomTotalMap);

        // Step 5: Market Position Calculation
        $marketData = $this->getMarketDataForPropertyType($propertyType);
        $position = $this->calculateMarketPosition($marketData);

        // Step 6: Get Budget Range
        $minimumBudgetRounded = round($this->lowerBoundTotal + ($this->upperBoundTotal * 0.4));
        $maximumBudgetRounded = round($this->lowerBoundTotal + ($this->upperBoundTotal * 0.6));

        return [
            'budgetRange' => sprintf(
                '$%s - $%s',
                number_format($minimumBudgetRounded),
                number_format($maximumBudgetRounded)
            ),
            'workPercentages' => $workPercentages,
            'workBudgets' => $workBudgets,
            'roomPercentages' => $roomPercentages,
            'roomBudgets' => $roomBudgets,
            'marketPosition' => $position,
        ];
    }

    public function getAverageBudget($package): int|float
    {
        return ($package['lower_bound_budget'] + $package['upper_bound_budget']) / 2;
    }

    public function calculatePercentage(array $data): array
    {
        $total = array_sum($data);

        if ($total === 0) {
            return array_map(fn () => 0, $data);
        }

        return array_map(function ($value) use ($total) {
            return ($value / $total) * 100;
        }, $data);
    }

    public function calculateBudget(array $data): array
    {
        $total = array_sum($data);

        if ($total === 0) {
            return array_map(fn () => 0, $data);
        }

        return array_map(function ($value) use ($total) {
            return $value;
        }, $data);
    }

    protected function getMarketDataForPropertyType(string $propertyType = ''): array
    {
        // TODO: Replace with actual database call
        return [
            'lowerEnd' => 27000,
            'average' => 45000,
            'higherEnd' => 72000,
        ];
    }

    protected function calculateMarketPosition(array $marketData): string
    {
        $userBudgetAvg = ($this->lowerBoundTotal + $this->upperBoundTotal) / 2;

        if ($userBudgetAvg <= $marketData['lowerEnd']) {
            return 'lower-end range';
        } elseif ($userBudgetAvg <= $marketData['average']) {
            return 'lower-to-average range';
        } elseif ($userBudgetAvg <= $marketData['higherEnd']) {
            return 'average-to-higher range';
        } else {
            return 'higher-end range';
        }
    }
}
