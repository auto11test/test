<?php

declare(strict_types=1);

namespace App\Service\DetailCalculationStrategies;

use App\Dto\CarDamageCalculationDto;
use App\Model\CarDetail;
use App\Model\PaintedDetail;

class PaintedDetailCalculationStrategy extends AbstractDetailCalculationStrategy
{
    public function supports(CarDetail $detail): bool
    {
        return $detail instanceof PaintedDetail;
    }

    protected function calculateDamage(
        CarDetail $detail,
        CarDamageCalculationDto $calculationDto
    ): CarDamageCalculationDto {
        return (!$detail instanceof PaintedDetail || $calculationDto->isPaintingRequired())
            ? $calculationDto
            : $calculationDto->setIsPaintingRequired($detail->isPaintingDamaged());
    }
}
