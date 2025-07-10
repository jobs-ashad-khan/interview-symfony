<?php

namespace App\Controller;

use App\DTO\BeneficiaryDTO;
use App\Service\BeneficiaryGeneratorService;
use App\Service\BeneficiaryProviderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DashboardController extends AbstractController
{
    public function __construct(
        private readonly BeneficiaryGeneratorService $beneficiaryGeneratorService,
        private readonly BeneficiaryProviderService $beneficiaryProviderService,
    ) {
    }

    #[Route('/', name: 'app_dashboard')]
    public function dashboard(): Response
    {
        $randomBeneficiaries = $this->beneficiaryGeneratorService->getRandomBeneficiaries(12);
        $persistedBeneficiaries = BeneficiaryDTO::fromEntityCollection($this->beneficiaryProviderService->getAll());

        return $this->render('dashboard/dashboard.html.twig', [
            'randomBeneficiaries' => $randomBeneficiaries,
            'persistedBeneficiaries' => $persistedBeneficiaries,
        ]);
    }
}
