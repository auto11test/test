<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\CarDamageCalculationDto;
use App\Model\Car;
use App\Service\DetailCalculationStrategies\CarDetailDamageCalculationStrategyInterface;

class CarDamageCalculator
{
    /**
     * @var array|CarDetailDamageCalculationStrategyInterface[]
     */
    private array $calculationStrategies = [];
    public function __construct(array $calculationStrategies)
    {
        $this->calculationStrategies = $calculationStrategies;
    }
    public function __invoke(Car $car): CarDamageCalculationDto
    {
        $calculationDto = new CarDamageCalculationDto($car);
        foreach ($car->getDetails() as $detail) {
            foreach ($this->calculationStrategies as $calculationStrategy) {
                if ($calculationStrategy->supports($detail)) {
                    ($calculationStrategy)($detail, $calculationDto);
                }
            }
        }

        return $calculationDto;
    }
}
