<?php
interface PaintedDetailInterface {
    public function isPaintingDamaged(): bool;
}
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

class Door extends PaintedDetail
{
    /**
    Just an example. More and more additional, door related, properties could be added here
     */
    private ?string $doorType = null;

    public const DOOR_TYPE_FRONT_LEFT = 'front-left';
    public const DOOR_TYPE_FRONT_RIGHT = 'front-right';
    public const DOOR_TYPE_REAR_LEFT = 'rear-left';
    public const DOOR_TYPE_REAR_RIGHT = 'rear-right';

    public const DOOR_TYPES = [
        self::DOOR_TYPE_FRONT_LEFT,
        self::DOOR_TYPE_FRONT_RIGHT,
        self::DOOR_TYPE_REAR_LEFT,
        self::DOOR_TYPE_REAR_RIGHT,
    ];

    public function __construct(
        Car $car,
        bool $isBroken,
        bool $isPaintingDamaged = false,
        string $doorType = null
    ) {
        parent::__construct($car, $isBroken, $isPaintingDamaged);

        //not a good practice to throw exceptions from the constructor but don't have time to implement ValidatorsLogic and Enums :)
        if (!in_array($doorType, self::DOOR_TYPES)) {
            throw new \Exception('Wrong door type given');
        }

        $this->doorType = $doorType;
    }

    public  function getDoorType(): ?string
    {
        return $this->doorType;
    }
}

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

class Car
{
    /**
     * @var CarDetail[]
     */
    private array $details = [];

    /**
     * @param CarDetail[] $details
     */
    public function __construct(array $details = [])
    {
        foreach ($details as $detail) {
            if ($detail instanceof CarDetail && !in_array($details, $this->details)) {
                $detail->setCar($this);
                $this->details[] = $detail;
            }
        }
    }
    public  function getDetails(): array
    {
        return $this->details;
    }

    public function addDetails(CarDetail $detail): self
    {
        if (!in_array($detail, $this->details)) {
            $this->details[] = $detail;
        }

        return $this;
    }
}

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

interface CarDetailDamageCalculationStrategyInterface
{
    public function supports(CarDetail $detail): bool;

    public function __invoke(
        CarDetail $detail,
        CarDamageCalculationDto $calculationDto = null
    ): CarDamageCalculationDto;
}

abstract class AbstractDetailCalculationStrategy implements CarDetailDamageCalculationStrategyInterface
{
    public function __invoke(
        CarDetail $detail,
        CarDamageCalculationDto $calculationDto = null
    ): CarDamageCalculationDto {
        if (!$this->supports($detail)) {
            throw new \Exception('Wrong detail type given');
        }
        $calculationDto = $calculationDto ?? new CarDamageCalculationDto($detail->getCar());

        return $this->calculateDamage($detail, $calculationDto);
    }

    abstract protected function calculateDamage(
        CarDetail $detail,
        CarDamageCalculationDto $calculationDto
    ): CarDamageCalculationDto;
}

class PaintedDetailCalculationStrategy extends AbstractDetailCalculationStrategy
{
    public function supports(CarDetail $detail): bool
    {
        return $detail instanceof PaintedDetail;
    }

    protected function calculateDamage(
        CarDetail $detail,
        CarDamageCalculationDto $calculationDto
    ): CarDamageCalculationDto {
        if (!$detail instanceof PaintedDetail) {
            return $calculationDto;
        }

        $calculationDto
            ->setIsPaintingRequired($detail->isPaintingDamaged());

        return $calculationDto;
    }
}

class GeneralDetailCalculationStrategy extends AbstractDetailCalculationStrategy
{
    public function supports(CarDetail $detail): bool
    {
        return $detail instanceof CarDetail;
    }

    protected function calculateDamage(
        CarDetail $detail,
        CarDamageCalculationDto $calculationDto
    ): CarDamageCalculationDto {
        $calculationDto
            ->setIsRepairmentRequired($detail->isBroken());

        return $calculationDto;
    }
}

class CarDamageCalculator
{
    /**
     * @var array|CarDetailDamageCalculationStrategyInterface[]
     */
    private array $calculationStrategies = [];
    public function __construct(array $calculationStrategies)
    {
        $this->calculationStrategies = $calculationStrategies;
    }
    public function __invoke(Car $car): CarDamageCalculationDto
    {
        $calculationDto = new CarDamageCalculationDto($car);
        foreach ($car->getDetails() as $detail) {
            foreach ($this->calculationStrategies as $calculationStrategy) {
                if ($calculationStrategy->supports($detail)) {
                    ($calculationStrategy)($detail, $calculationDto);
                }
            }
        }

        return $calculationDto;
    }
}

$car = new Car();
$door = new Door($car, false, false, Door::DOOR_TYPE_REAR_RIGHT);
$tyre = new Tyre($car, false, 16);

$car
    ->addDetails($door)
    ->addDetails($tyre);

$damageCalculator = new CarDamageCalculator([
    new GeneralDetailCalculationStrategy(),
    new PaintedDetailCalculationStrategy(),
]);

$calculationResult = ($damageCalculator)($car);
echo 'Painting is' . ($calculationResult->isPaintingRequired() ? '' : 'not') . ' required';
echo "\n";
echo 'Is ' . ($calculationResult->isBroken() ? '' : 'not') .  ' broken';