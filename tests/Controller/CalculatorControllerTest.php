<?php

namespace App\Tests\Controller;

use App\Controller\CalculatorController;
use App\Requests\SimpleCalculatorRequest;
use App\Resources\SimpleCalculatorResource;
use App\Services\SimpleCalculatorService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

class CalculatorControllerTest extends TestCase
{
    public function testCalculate()
    {
        $request = $this->createMock(SimpleCalculatorRequest::class);
        $request->expects(self::any())
            ->method('getOperation')
            ->willReturn('+');

        $request->expects(self::any())
            ->method('getOperand1')
            ->willReturn(25);

        $request->expects(self::any())
            ->method('getOperand2')
            ->willReturn(11);

        $service = new SimpleCalculatorService(
            operation: $request->getOperation(),
            operand1: $request->getOperand1(),
            operand2: $request->getOperand2()
        );

        $calcResult = $service->execute();
        self::assertEquals($calcResult, 36);

        $resource = new SimpleCalculatorResource(
            operation: $request->getOperation(),
            operand1: $request->getOperand1(),
            operand2: $request->getOperand2(),
            result: $calcResult
        );

        self::assertEquals(
            $resource->toArray(),
            [
                'operand1' => 25,
                'operand2' => 11,
                'operation' => '+',
                'result' => 36
            ]
        );
    }
}
