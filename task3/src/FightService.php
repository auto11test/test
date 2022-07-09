<?php

declare(strict_types=1);

namespace App;

class FightService
{
    private DamageCalculatorInterace $damageCalculator;

    public function __construct(DamageCalculatorInterace $damageCalculator)
    {
        $this->damageCalculator = $damageCalculator;
    }

    public function fight(HeroInterface $attacker, HeroInterface $defender)
    {
        $damage = $this->damageCalculator->calculateDamage($attacker, $defender);

        $defender->setHealthPoints($defender->getHealthPoints() - $damage);
    }
}
