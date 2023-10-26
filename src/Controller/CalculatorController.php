<?php

namespace App\Controller;

use App\Requests\AgeCalculatorRequest;
use App\Requests\SimpleCalculatorRequest;
use App\Resources\AgeCalculatorResource;
use App\Resources\SimpleCalculatorResource;
use App\Services\CalculateAgeService;
use App\Services\SimpleCalculatorService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class CalculatorController extends AbstractController
{
    #[Route('/api/calculator/simple', methods: ['POST'])]
    public function calculate(SimpleCalculatorRequest $request): Response
    {
        $service = new SimpleCalculatorService(
            operation: $request->getOperation(),
            operand1: $request->getOperand1(),
            operand2: $request->getOperand2()
        );
        $calcResult = $service->execute();

        $resource = new SimpleCalculatorResource(
            operation: $request->getOperation(),
            operand1: $request->getOperand1(),
            operand2: $request->getOperand2(),
            result: $calcResult
        );

        return $this->json($resource->toArray());
    }

    #[Route('/api/calculator/age', methods: ['POST'])]
    public function calculateAge(AgeCalculatorRequest $request): Response
    {
        $service = new CalculateAgeService(
            birthDate: $request->getBirthDate(),
            calculationDate: $request->getCalculationDate()
        );
        $result = $service->execute();

        $resource = new AgeCalculatorResource(
            birthDate: $request->getBirthDate(),
            calculationDate: $request->getCalculationDate(),
            age: $result
        );

        return $this->json($resource->toArray());
    }
}
