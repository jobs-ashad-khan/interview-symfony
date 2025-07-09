<?php

namespace App\Service;

use App\Entity\Beneficiary;

readonly class BeneficiaryGeneratorService
{
    public function __construct(
        private NameGeneratorService $nameGeneratorService,
    ) {
    }

    public function getRandomBeneficiaries(int $limit = 10): array
    {
        $beneficiaries = [];
        for ($i = 0; $i < $limit; $i++) {
            $beneficiary = new Beneficiary();
            $beneficiary->setName($this->nameGeneratorService->getName());
            $beneficiaries[] = $beneficiary;
        }

        return $beneficiaries;
    }
}