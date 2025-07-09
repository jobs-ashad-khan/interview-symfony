<?php

namespace App\Controller;

use App\DTO\BeneficiaryDTO;
use App\Service\BeneficiaryGeneratorService;
use App\Service\BeneficiaryProviderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BeneficiaryController extends AbstractController
{
    public function __construct(
        private readonly BeneficiaryGeneratorService $beneficiaryGeneratorService,
        private readonly BeneficiaryProviderService  $beneficiaryProviderService
    )
    {
    }

    #[Route('/beneficiary/generate', name: 'app_beneficiary_generate')]
    public function generate(Request $request): JsonResponse
    {
        if (!$request->isXmlHttpRequest()) {
            return $this->json([
                'error' => 'Cette route doit être appelée via AJAX.'
            ], Response::HTTP_BAD_REQUEST);
        }

        try {
            $beneficiary = $this->beneficiaryGeneratorService->getRandomBeneficiaries(1)[0];
            $beneficiary = $this->beneficiaryProviderService->createBeneficiary($beneficiary);

            return $this->json(BeneficiaryDTO::fromEntity($beneficiary), Response::HTTP_CREATED);
        } catch (\Throwable $e) {
            return $this->json([
                'error' => 'Erreur lors de la génération du bénéficiaire.',
                'details' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
