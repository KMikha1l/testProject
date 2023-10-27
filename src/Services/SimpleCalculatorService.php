<?php

namespace App\Services;

use App\Services\Exception\ServiceException;

class SimpleCalculatorService implements ServiceInterface
{
    public function __construct(private string $operation, private int $operand1, private int $operand2)
    {
    }

    public function execute(): float
    {
        $division = function () {
            if ($this->operand2 === 0) {
                throw new ServiceException('Attempt to divide by zero.');
            }
            return $this->operand1 / $this->operand2;
        };

        match ($this->operation) {
            '+' => $result = $this->operand1 + $this->operand2,
            '-' => $result = $this->operand1 - $this->operand2,
            '*' => $result = $this->operand1 * $this->operand2,
            '/' => $result = $division()
        };

        return $result;
    }
}
