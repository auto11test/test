<?php

declare(strict_types=1);

namespace App\Model;

abstract class CarDetail {

    protected bool $isBroken;
    protected Car $car;

    public function __construct(
        Car $car,
        bool $isBroken
    ) {
        $this->car = $car;
        $this->isBroken = $isBroken;
    }

    public  function getCar(): Car
    {
        return $this->car;
    }
    public function setCar(Car $car): self
    {
        $this->car = $car;

        return $this;
    }

    public function isBroken(): bool
    {
        return $this->isBroken;
    }
}

