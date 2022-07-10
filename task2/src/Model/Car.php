<?php

declare(strict_types=1);

namespace App\Model;

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
