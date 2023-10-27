<?php

namespace App\Services;

use App\Services\Exception\ServiceException;
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

        if ($birthDate > $calculationDate) {
            throw new ServiceException('A birth date is bigger than calculation date.');
        }

        return $calculationDate
            ->diff($birthDate)->y;
    }
}
