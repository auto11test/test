<?php

declare(strict_types=1);

namespace App\Service\DetailCalculationStrategies;

use App\Dto\CarDamageCalculationDto;
use App\Model\CarDetail;

interface CarDetailDamageCalculationStrategyInterface
{
    public function supports(CarDetail $detail): bool;

    public function __invoke(
        CarDetail $detail,
        CarDamageCalculationDto $calculationDto = null
    ): CarDamageCalculationDto;
}
