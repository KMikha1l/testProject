<?php

namespace App\Resources;

class AgeCalculatorResource extends BaseResource
{

    public function __construct(private string $birthDate, private string $calculationDate, private int $age)
    {
    }

    public function toArray(): array
    {
        return [
            'calculationDate' => $this->calculationDate,
            'birthDate' => $this->birthDate,
            'age' => $this->age,
        ];
    }
}