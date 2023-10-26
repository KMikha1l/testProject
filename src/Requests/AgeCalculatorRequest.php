<?php

namespace App\Requests;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Type;

class AgeCalculatorRequest extends BaseRequest
{
    #[Type('string')]
    #[Regex('/^\d{2}\.\d{2}\.\d{4}$/s')]
    #[NotBlank()]
    protected string $birthDate;

    #[Type('string')]
    #[Regex('/^\d{2}\.\d{2}\.\d{4}$/s')]
    #[NotBlank()]
    protected string $calculationDate;

    public function getBirthDate(): string
    {
        return $this->birthDate;
    }

    public function getCalculationDate(): string
    {
        return $this->calculationDate;
    }
}
