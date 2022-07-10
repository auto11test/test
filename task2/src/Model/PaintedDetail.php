<?php

declare(strict_types=1);

namespace App\Model;

abstract class PaintedDetail extends CarDetail implements PaintedDetailInterface
{
    protected bool $isPaintingDamaged;

    public function __construct(
        Car $car,
        bool $isBroken,
        bool $isPaintingDamaged = false
    ) {
        parent::__construct($car, $isBroken);
        $this->isPaintingDamaged=$isPaintingDamaged;
    }

    public function setIsPaintingDamaged(bool $isPaintingDamaged): self
    {
        $this->isPaintingDamaged = $isPaintingDamaged;

        return $this;
    }

    public  function isPaintingDamaged(): bool
    {
        return $this->isPaintingDamaged;
    }
}
