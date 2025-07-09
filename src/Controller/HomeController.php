<?php

namespace App\Controller;

use App\Service\BeneficiaryGeneratorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    public function __construct(
        private readonly BeneficiaryGeneratorService $beneficiaryGeneratorService
    ) {
    }

    #[Route('/', name: 'app_home')]
    public function home(): Response
    {
        $beneficiaries = $this->beneficiaryGeneratorService->getRandomBeneficiaries(12);

        return $this->render('home/home.html.twig', [
            'controller_name' => 'HomeController',
            'beneficiaries' => $beneficiaries,
        ]);
    }
}
