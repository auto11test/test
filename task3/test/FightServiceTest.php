<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class FightServiceTest extends TestCase {

    public function testFight()
    {
        $hero1 = $this->createMock(\App\HeroInterface::class);

        $hero2 = $this->createMock(\App\HeroInterface::class);
        $hero2
            ->expects($this->once())
            ->method('getHealthPoints')->willReturn(8);
        $hero2
            ->expects($this->once())
            ->method('setHealthPoints')
            ->with(5);

        $damageCalculator = $this->createMock(\App\DamageCalculatorInterace::class);
        $damageCalculator
            ->expects($this->once())
            ->method('calculateDamage')->willReturn(3);

        $fightService = new \App\FightService($damageCalculator);
        $fightService->fight($hero1, $hero2);
    }
}
