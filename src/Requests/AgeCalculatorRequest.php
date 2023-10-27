<?php

namespace App\Requests;

use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\NotBlank;

class AgeCalculatorRequest
{
    public function __construct(
        #[DateTime(format: "d.m.Y")]
        #[NotBlank()]
        public readonly string $birthDate,

        #[DateTime(format: "d.m.Y")]
        public string $calculationDate
    )
    {
        $this->calculationDate = $calculationDate ?: (new \DateTime())->format('d.m.Y');
    }
}
