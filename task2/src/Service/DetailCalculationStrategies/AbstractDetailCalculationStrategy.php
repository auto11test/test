<?php

declare(strict_types=1);

namespace App\Service\DetailCalculationStrategies;

use App\Dto\CarDamageCalculationDto;
use App\Model\CarDetail;

abstract class AbstractDetailCalculationStrategy implements CarDetailDamageCalculationStrategyInterface
{
    public function __invoke(
        CarDetail $detail,
        CarDamageCalculationDto $calculationDto = null
    ): CarDamageCalculationDto {
        if (!$this->supports($detail)) {
            throw new \Exception('Wrong detail type given');
        }
        $calculationDto = $calculationDto ?? new CarDamageCalculationDto($detail->getCar());

        return $this->calculateDamage($detail, $calculationDto);
    }

    abstract protected function calculateDamage(
        CarDetail $detail,
        CarDamageCalculationDto $calculationDto
    ): CarDamageCalculationDto;
}
