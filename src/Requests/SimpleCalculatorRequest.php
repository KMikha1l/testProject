<?php

namespace App\Requests;

use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class SimpleCalculatorRequest
{
    public function __construct(
        #[Type('integer')]
        #[NotBlank()]
        public readonly int $operand1,

        #[Type('integer')]
        #[NotBlank()]
        public readonly int $operand2,

        #[Type('string')]
        #[Choice(['+', '-', '*', '/'])]
        #[NotBlank()]
        public readonly string $operation
    )
    {
    }
}
