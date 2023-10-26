<?php

namespace App\Services;

class SimpleCalculatorService implements ServiceInterface
{
    public function __construct(private string $operation, private int $operand1, private int $operand2)
    {
    }

    public function execute(): float
    {
        match ($this->operation) {
            '+' => $result = $this->operand1 + $this->operand2,
            '-' => $result = $this->operand1 - $this->operand2,
            '*' => $result = $this->operand1 * $this->operand2,
            '/' => $result = $this->operand1 / $this->operand2,
        };

        return $result;
    }
}
