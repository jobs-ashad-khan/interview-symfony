<?php

namespace App\Controller;

use App\Service\BeneficiaryGeneratorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DashboardController extends AbstractController
{
    public function __construct(
        private readonly BeneficiaryGeneratorService $beneficiaryGeneratorService
    ) {
    }

    #[Route('/', name: 'app_dashboard')]
    public function dashboard(): Response
    {
        $beneficiaries = $this->beneficiaryGeneratorService->getRandomBeneficiaries(12);

        return $this->render('dashboard/dashboard.html.twig', [
            'controller_name' => 'DashboardController',
            'beneficiaries' => $beneficiaries,
        ]);
    }
}
