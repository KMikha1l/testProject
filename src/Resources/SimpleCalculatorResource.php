<?php

namespace App\Resources;

class SimpleCalculatorResource extends BaseResource
{
    public function __construct(
        private string $operation,
        private int $operand1,
        private int $operand2,
        private float $result
    )
    {
    }

    public function toArray(): array
    {
        return [
            'operation' => $this->operation,
            'operand1' => $this->operand1,
            'operand2' => $this->operand2,
            'result' => $this->result
        ];
    }
}
