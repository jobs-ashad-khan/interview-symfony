<?php

namespace App\Service;

use App\DTO\BeneficiaryDTO;
use App\Entity\Beneficiary;
use App\Repository\BeneficiaryRepository;
use Doctrine\ORM\EntityManagerInterface;

readonly class BeneficiaryProviderService
{
    public function __construct(
        private BeneficiaryRepository $beneficiaryRepository,
    ){
    }

    public function getAll(): array
    {
        return $this->beneficiaryRepository->findAll();
    }

    public function createBeneficiary(BeneficiaryDTO $beneficiaryDTO): Beneficiary
    {
        $beneficiary = $beneficiaryDTO->toEntity();

        return $this->beneficiaryRepository->save($beneficiary);
    }
}