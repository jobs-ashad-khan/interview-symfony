<?php

namespace App\Service;

use App\DTO\BeneficiaryDTO;
use App\Entity\Beneficiary;
use App\Utils\DiceBearAvatarGenerator;

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
            $beneficiaryDTO = new BeneficiaryDTO();
            $beneficiaryDTO->name = $this->nameGeneratorService->getFirstName();
            $beneficiaryDTO->avatarUrl = DiceBearAvatarGenerator::getAvatar($beneficiaryDTO->name);
            $beneficiaries[] = $beneficiaryDTO;
        }

        return $beneficiaries;
    }
}