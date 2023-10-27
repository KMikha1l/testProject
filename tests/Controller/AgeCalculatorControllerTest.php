<?php

namespace App\Tests\Controller;

use App\Requests\AgeCalculatorRequest;
use App\Resources\AgeCalculatorResource;
use App\Services\CalculateAgeService;
use App\Services\Exception\ServiceException;
use PHPUnit\Framework\TestCase;

class AgeCalculatorControllerTest extends TestCase
{
    public function testCalculateAgeWithPositiveResult(): void
    {
        $birthDate = '15.05.1998';
        $calculationDate = '15.05.2015';
        $expectedAge = 17;

        $request = new AgeCalculatorRequest(birthDate: $birthDate, calculationDate: $calculationDate);

        $service = new CalculateAgeService(
            birthDate: $request->birthDate,
            calculationDate: $request->calculationDate
        );

        $result = $service->execute();
        self::assertEquals($result, $expectedAge);

        $resource = new AgeCalculatorResource(
            birthDate: $request->birthDate,
            calculationDate: $request->calculationDate,
            age: $result
        );

        self::assertEquals(
            $resource->jsonSerialize(),
            [
                'calculationDate' => "15.05.2015",
                'birthDate' => "15.05.1998",
                'age' => 17,
            ]
        );
    }

    public function testRequestWithEmptyCalculationDate(): void
    {
        $birthDate = '15.05.1998';
        $calculationDate = '';
        $expectedAge = 25;

        $request = new AgeCalculatorRequest(birthDate: $birthDate, calculationDate: $calculationDate);

        $service = new CalculateAgeService(
            birthDate: $request->birthDate,
            calculationDate: $request->calculationDate
        );

        $result = $service->execute();
        self::assertEquals($result, $expectedAge);
    }

    public function testWithBirthdayBiggerThanCalculationDateError(): void
    {
        self::expectException(ServiceException::class);

        $birthDate = '15.05.2005';
        $calculationDate = '15.05.1998';

        $service = new CalculateAgeService(
            birthDate: $birthDate,
            calculationDate: $calculationDate
        );

        $service->execute();
    }
}
