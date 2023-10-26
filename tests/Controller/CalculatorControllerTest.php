<?php

namespace App\Tests\Controller;

use App\Requests\AgeCalculatorRequest;
use App\Requests\SimpleCalculatorRequest;
use App\Resources\AgeCalculatorResource;
use App\Resources\SimpleCalculatorResource;
use App\Services\CalculateAgeService;
use App\Services\SimpleCalculatorService;
use PHPUnit\Framework\TestCase;

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

    public function testCalculateAge()
    {
        $request = $this->createMock(AgeCalculatorRequest::class);

        $request->expects(self::any())
            ->method('getBirthDate')
            ->willReturn('15.05.1998');

        $request->expects(self::any())
            ->method('getCalculationDate')
            ->willReturn('15.05.2015');

        $service = new CalculateAgeService(
            birthDate: $request->getBirthDate(),
            calculationDate: $request->getCalculationDate()
        );

        $result = $service->execute();
        self::assertEquals($result, 17);

        $resource = new AgeCalculatorResource(
            birthDate: $request->getBirthDate(),
            calculationDate: $request->getCalculationDate(),
            age: $result
        );

        self::assertEquals(
            $resource->toArray(),
            [
                'calculationDate' => "15.05.2015",
                'birthDate' => "15.05.1998",
                'age' => 17,
            ]
        );
    }
}
