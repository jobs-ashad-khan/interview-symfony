<?php

namespace App\Controller;

use App\Service\BeneficiaryGeneratorService;
use App\Service\BeneficiaryProviderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BeneficiaryController extends AbstractController
{
    public function __construct(
        private readonly BeneficiaryGeneratorService $beneficiaryGeneratorService,
        private readonly BeneficiaryProviderService $beneficiaryProviderService
    ) {
    }

    #[Route('/beneficiary/generate', name: 'app_beneficiary_generate')]
    public function generate(): Response
    {
        $beneficiary = $this->beneficiaryGeneratorService->getRandomBeneficiaries(1)[0];
        $beneficiary = $this->beneficiaryProviderService->createBeneficiary($beneficiary);

        return $this->redirectToRoute('app_dashboard');
    }
}
