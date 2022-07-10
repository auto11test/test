<?php

require_once './vendor/autoload.php';

use App\Model\Car;
use App\Model\Door;
use App\Model\Tyre;
use App\Service\CarDamageCalculator;
use App\Service\DetailCalculationStrategies\GeneralDetailCalculationStrategy;
use App\Service\DetailCalculationStrategies\PaintedDetailCalculationStrategy;

$car = new Car();

$door = new Door($car, false, true, Door::DOOR_TYPE_REAR_RIGHT);
$tyre = new Tyre($car, false, 16);

$car
    ->addDetails($door)
    ->addDetails($tyre);

$damageCalculator = new CarDamageCalculator([
    new GeneralDetailCalculationStrategy(),
    new PaintedDetailCalculationStrategy(),
]);

$calculationResult = ($damageCalculator)($car);
echo 'Painting is' . ($calculationResult->isPaintingRequired() ? '' : ' not') . ' required';
echo "\n";
echo 'Is ' . ($calculationResult->isBroken() ? '' : 'not') .  ' broken';
