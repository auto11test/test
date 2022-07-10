<?php

declare(strict_types=1);

namespace App\Model;

class Tyre extends CarDetail
{
    private int $radius;

    public function __construct(
        Car $car,
        bool $isDamaged,
        int $radius
    ) {
        parent::__construct($car, $isDamaged);
        $this->radius = $radius;
    }

    public  function getRadius(): int
    {
        return $this->radius;
    }
}
