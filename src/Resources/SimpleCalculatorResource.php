<?php

namespace App\Resources;
use JsonSerializable;

class SimpleCalculatorResource implements JsonSerializable
{
    public function __construct(
        private string $operation,
        private int $operand1,
        private int $operand2,
        private float $result
    )
    {
    }

    public function jsonSerialize(): array
    {
        return [
            'operation' => $this->operation,
            'operand1' => $this->operand1,
            'operand2' => $this->operand2,
            'result' => $this->result
        ];
    }
}
