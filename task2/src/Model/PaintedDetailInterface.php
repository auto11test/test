<?php

declare(strict_types=1);

namespace App\Model;

interface PaintedDetailInterface
{
    public function isPaintingDamaged(): bool;
}
