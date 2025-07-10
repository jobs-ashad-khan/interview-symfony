<?php

namespace App\Tests\Service;

use App\DTO\BeneficiaryDTO;
use App\Entity\Beneficiary;
use App\Repository\BeneficiaryRepository;
use App\Service\BeneficiaryProviderService;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

class BeneficiaryProviderServiceTest extends TestCase
{
    private BeneficiaryRepository $beneficiaryRepository;
    private BeneficiaryProviderService $service;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        $this->beneficiaryRepository = $this->createMock(BeneficiaryRepository::class);
        $this->service = new BeneficiaryProviderService($this->beneficiaryRepository);
    }

    /**
     * @throws Exception
     */
    public function testGetAllReturnsArrayOfBeneficiaries(): void
    {
        $beneficiary1 = $this->createMock(Beneficiary::class);
        $beneficiary2 = $this->createMock(Beneficiary::class);

        $this->beneficiaryRepository
            ->expects($this->once())
            ->method('findAll')
            ->willReturn([$beneficiary1, $beneficiary2]);

        $result = $this->service->getAll();

        $this->assertIsArray($result);
        $this->assertCount(2, $result);
        $this->assertSame($beneficiary1, $result[0]);
        $this->assertSame($beneficiary2, $result[1]);
    }

    /**
     * @throws Exception
     */
    public function testCreateBeneficiary(): void
    {
        $dto = $this->createMock(BeneficiaryDTO::class);
        $entity = $this->createMock(Beneficiary::class);

        $dto->expects($this->once())
            ->method('toEntity')
            ->willReturn($entity);

        $this->beneficiaryRepository
            ->expects($this->once())
            ->method('save')
            ->with($entity)
            ->willReturn($entity);

        $result = $this->service->createBeneficiary($dto);

        $this->assertInstanceOf(Beneficiary::class, $result);
        $this->assertSame($entity, $result);
    }
}
