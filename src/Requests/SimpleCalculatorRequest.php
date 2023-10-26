<?php

namespace App\Requests;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Type;

class SimpleCalculatorRequest extends BaseRequest
{
    #[Type('integer')]
    #[NotBlank()]
    protected int $operand1;

    #[Type('integer')]
    #[NotBlank()]
    protected int $operand2;

    #[Type('string')]
    #[Regex('/^[+\\-\\*\\/]{1}$/s')]
    #[NotBlank()]
    protected string $operation;

    public function getOperand1(): int
    {
        return $this->operand1;
    }

    public function getOperand2(): int
    {
        return $this->operand2;
    }

    public function getOperation(): string
    {
        return $this->operation;
    }
}
