<?php

declare(strict_types=1);

namespace App;

interface DamageCalculatorInterace
{
    public const DAMAGE_RAND_FACTOR = 0.2;

    public function calculateDamage(HeroInterface $attacker, HeroInterface $defender): int;
}
