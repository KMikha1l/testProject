<?php

namespace App\Services;

use DateTime;

class CalculateAgeService implements ServiceInterface
{

    public function __construct(private string $birthDate, private string $calculationDate)
    {
    }

    public function execute(): int
    {
        $birthDate = DateTime::createFromFormat('d.m.Y', $this->birthDate);
        $calculationDate = DateTime::createFromFormat('d.m.Y', $this->calculationDate);

        return $calculationDate
            ->diff($birthDate)->y;
    }
}
