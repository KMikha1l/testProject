<?php

namespace App\Controller;

use App\Requests\AgeCalculatorRequest;
use App\Resources\AgeCalculatorResource;
use App\Services\CalculateAgeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;
use Exception;

class AgeCalculatorController extends AbstractController
{
    #[Route('/api/calculator/age', methods: ['POST'])]
    public function calculateAge(#[MapRequestPayload] AgeCalculatorRequest $request): Response
    {
        try {
            $service = new CalculateAgeService(
                birthDate: $request->birthDate,
                calculationDate: $request->calculationDate
            );
            $result = $service->execute();

            $resource = new AgeCalculatorResource(
                birthDate: $request->birthDate,
                calculationDate: $request->calculationDate,
                age: $result
            );
        } catch (Exception $e) {
            return $this->json([
                'error' => $e->getMessage()
            ]);
        }

        return $this->json($resource);
    }
}
