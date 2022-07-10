<?php

declare(strict_types=1);

namespace App\Service\DetailCalculationStrategies;

use App\Dto\CarDamageCalculationDto;
use App\Model\CarDetail;

class GeneralDetailCalculationStrategy extends AbstractDetailCalculationStrategy
{
    public function supports(CarDetail $detail): bool
    {
        return $detail instanceof CarDetail;
    }

    protected function calculateDamage(
        CarDetail $detail,
        CarDamageCalculationDto $calculationDto
    ): CarDamageCalculationDto {
        return $calculationDto->isRepairmentRequired()
            ? $calculationDto
            : $calculationDto->setIsRepairmentRequired($detail->isBroken());
    }
}
