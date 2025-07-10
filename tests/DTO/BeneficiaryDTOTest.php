<?php

namespace App\Tests\DTO;

use App\DTO\BeneficiaryDTO;
use App\Entity\Beneficiary;
use App\Utils\DiceBearAvatarGenerator;
use PHPUnit\Framework\TestCase;

class BeneficiaryDTOTest extends TestCase
{
    private function setId(Beneficiary $beneficiary, int $id): void
    {
        $ref = new \ReflectionObject($beneficiary);
        $prop = $ref->getProperty('id');
        $prop->setValue($beneficiary, $id);
    }

    public function testFromEntity(): void
    {
        $entity = new Beneficiary();
        $entity->setName('Alice');
        $this->setId($entity, 1);

        $dto = BeneficiaryDTO::fromEntity($entity);

        $this->assertSame('Alice', $dto->name);
        $this->assertSame(
            DiceBearAvatarGenerator::getAvatar($dto->name),
            $dto->avatarUrl
        );
    }

    public function testFromEntityCollection(): void
    {
        $entity1 = new Beneficiary();
        $entity1->setName('Alice');

        $entity2 = new Beneficiary();
        $entity2->setName('Bob');

        $this->setId($entity1, 1);
        $this->setId($entity2, 2);

        $collection = BeneficiaryDTO::fromEntityCollection([$entity1, $entity2]);

        $this->assertCount(2, $collection);
        $this->assertSame('Alice', $collection[0]->name);
        $this->assertSame('Bob', $collection[1]->name);
    }

    public function testToEntity(): void
    {
        $dto = new BeneficiaryDTO();
        $dto->name = 'Charlie';
        $dto->avatarUrl = DiceBearAvatarGenerator::getAvatar($dto->name);

        $entity = $dto->toEntity();

        $this->assertInstanceOf(Beneficiary::class, $entity);
        $this->assertSame('Charlie', $entity->getName());
        $this->assertSame($dto->avatarUrl, $entity->getAvatarUrl());
    }
}
