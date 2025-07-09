<?php

namespace App\DTO;

use App\Entity\Beneficiary;

class BeneficiaryDTO
{
    private int $id;

    public string $name;

    public string $avatarUrl;

    public static function fromEntity(Beneficiary $beneficiary): self
    {
        $dto = new self();
        $dto->id = $beneficiary->getId();
        $dto->name = $beneficiary->getName();
        $dto->avatarUrl = $beneficiary->getAvatarUrl();

        return $dto;
    }

    public static function fromEntityCollection(array $beneficiaries): array
    {
        return array_map(
            fn($beneficiary) => self::fromEntity($beneficiary),
            $beneficiaries
        );
    }

    public function toEntity(): Beneficiary
    {
        $beneficiary = new Beneficiary();
        $beneficiary->setName($this->name);

        return $beneficiary;
    }
}