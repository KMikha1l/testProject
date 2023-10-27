<?php

namespace App\Resources;

use JsonSerializable;

class AgeCalculatorResource implements JsonSerializable
{

    public function __construct(
        private readonly string $birthDate,
        private readonly string $calculationDate,
        private readonly int $age
    )
    {
    }

    public function jsonSerialize(): array
    {
        return [
            'calculationDate' => $this->calculationDate,
            'birthDate' => $this->birthDate,
            'age' => $this->age,
        ];
    }
}
