<?php

declare(strict_types=1);

namespace App\Dto;

use App\Model\Car;

class CarDamageCalculationDto
{
    private Car $car;
    private bool $isPaintingRequired;
    private bool $isRepairmentRequired;

    public function __construct(
        Car $car,
        bool $isPaintingRequired = false,
        bool $isRepairmentRequired = false
    ) {
        $this->car = $car;
        $this->isPaintingRequired = $isPaintingRequired;
        $this->isRepairmentRequired = $isRepairmentRequired;
    }

    public  function getCar(): Car
    {
        return $this->car;
    }

    public function isPaintingRequired(): bool
    {
        return $this->isPaintingRequired;
    }

    public  function isRepairmentRequired(): bool
    {
        return $this->isRepairmentRequired;
    }

    public function setIsPaintingRequired(bool $isPaintingRequired): self
    {
        $this->isPaintingRequired = $isPaintingRequired;

        return $this;
    }
    public function setIsRepairmentRequired(bool $isRepairmentRequired): self
    {
        $this->isRepairmentRequired = $isRepairmentRequired;

        return $this;
    }

    public function isBroken(): bool
    {
        return $this->isPaintingRequired || $this->isRepairmentRequired;
    }
}

