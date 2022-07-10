<?php

declare(strict_types=1);

namespace App\Model;

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
