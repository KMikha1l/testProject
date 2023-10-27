<?php

namespace App\Tests\Controller;

use App\Requests\AgeCalculatorRequest;
use App\Requests\SimpleCalculatorRequest;
use App\Resources\AgeCalculatorResource;
use App\Resources\SimpleCalculatorResource;
use App\Services\CalculateAgeService;
use App\Services\Exception\ServiceException;
use App\Services\SimpleCalculatorService;
use PHPUnit\Framework\TestCase;

class SimpleCalculatorControllerTest extends TestCase
{
    public function testSimpleCalculatorSumWithPositiveResult(): void
    {
        $operand1 = 25;
        $operand2 = 11;
        $operation = '+';

        $request = new SimpleCalculatorRequest(operand1: $operand1, operand2: $operand2, operation: $operation);

        $service = new SimpleCalculatorService(
            operation: $request->operation,
            operand1: $request->operand1,
            operand2: $request->operand2
        );
        $calcResult = $service->execute();

        $resource = new SimpleCalculatorResource(
            operation: $request->operation,
            operand1: $request->operand1,
            operand2: $request->operand2,
            result: $calcResult
        );

        self::assertEquals(
            $resource->jsonSerialize(),
            [
                'operand1' => $operand1,
                'operand2' => $operand2,
                'operation' => '+',
                'result' => $calcResult
            ]
        );
    }

    public function testSimpleCalculatorDiffWithPositiveResult(): void
    {
        $operand1 = 17;
        $operand2 = 6;
        $operation = '-';
        $expectedResult = 11;

        $service = new SimpleCalculatorService(
            operation: $operation,
            operand1: $operand1,
            operand2: $operand2
        );

        $calcResult = $service->execute();
        self::assertEquals($calcResult, $expectedResult);
    }

    public function testSimpleCalculatorMultiplication(): void
    {
        $operand1 = 17;
        $operand2 = 8;
        $operation = '*';
        $expectedResult = 136;

        $service = new SimpleCalculatorService(
            operation: $operation,
            operand1: $operand1,
            operand2: $operand2
        );

        $calcResult = $service->execute();
        self::assertEquals($calcResult, $expectedResult);
    }

    public function testDivisionWithPositiveResult()
    {
        $operand1 = 12;
        $operand2 = 6;
        $operation = '/';
        $expectedResult = 2;

        $service = new SimpleCalculatorService(
            operation: $operation,
            operand1: $operand1,
            operand2: $operand2
        );

        $result = $service->execute();
        self::assertEquals($result, $expectedResult);
    }

    public function testDivisionWithNegativeDigitsAndPositiveResult()
    {
        $operand1 = -12;
        $operand2 = -6;
        $operation = '/';
        $expectedResult = 2;

        $service = new SimpleCalculatorService(
            operation: $operation,
            operand1: $operand1,
            operand2: $operand2
        );

        $result = $service->execute();
        self::assertEquals($result, $expectedResult);
    }

    public function testDivisionByZero(): void
    {
        self::expectException(ServiceException::class);
        $operand1 = 17;
        $operand2 = 0;
        $operation = '/';

        $service = new SimpleCalculatorService(
            operation: $operation,
            operand1: $operand1,
            operand2: $operand2
        );

        $service->execute();
    }
}
