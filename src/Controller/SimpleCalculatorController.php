<?php

namespace App\Controller;

use App\Requests\SimpleCalculatorRequest;
use App\Resources\SimpleCalculatorResource;
use App\Services\SimpleCalculatorService;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class SimpleCalculatorController extends AbstractController
{
    #[Route('/api/calculator/simple', methods: ['POST'])]
    public function calculate(#[MapRequestPayload] SimpleCalculatorRequest $request): Response
    {
        try {
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
        } catch (Exception $e) {
            return $this->json([
                'error' => $e->getMessage()
            ]);
        }

        return $this->json($resource);
    }
}
