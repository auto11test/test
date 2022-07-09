<?php

declare(strict_types=1);

namespace App;

class DamageCalculator implements DamageCalculatorInterace
{
    public function calculateDamage(HeroInterface $attacker, HeroInterface $defender): int
    {
        $damage = 0;

        if ($attacker->getAttack() > $defender->getDefence()) {
            $baseDamage = $attacker->getAttack() - $defender->getDefence();

            $factor = $baseDamage * self::DAMAGE_RAND_FACTOR;

            $minDamage = $baseDamage - $factor;
            $maxDamage = $baseDamage + $factor;

            $damage = mt_rand($minDamage, $maxDamage);
        }

        return $damage;
    }
}
