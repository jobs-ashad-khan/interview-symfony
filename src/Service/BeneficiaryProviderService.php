<?php

namespace App\Service;

use App\Entity\Beneficiary;
use App\Repository\BeneficiaryRepository;
use Doctrine\ORM\EntityManagerInterface;

readonly class BeneficiaryProviderService
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private BeneficiaryRepository $beneficiaryRepository,
    ){
    }

    public function getAll(): array
    {
        return $this->beneficiaryRepository->findAll();
    }

    public function createBeneficiary(Beneficiary $beneficiary): Beneficiary
    {
        $this->entityManager->persist($beneficiary);
        $this->entityManager->flush();

        return $beneficiary;
    }
}