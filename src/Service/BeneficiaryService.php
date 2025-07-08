<?php

namespace App\Service;

use App\Entity\Beneficiary;
use App\Utils\RandomNameGenerator;

class BeneficiaryService
{
    public function getRandomBeneficiaries(int $limit = 10): array
    {
        $nameGenerator = new RandomNameGenerator();

        $beneficiaries = [];
        for ($i = 0; $i < $limit; $i++) {
            $beneficiary = new Beneficiary();
            $beneficiary->setName($nameGenerator->getRandomName());
            $beneficiaries[] = $beneficiary;
        }

        return $beneficiaries;
    }
}