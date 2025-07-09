<?php

namespace App\Tests\Service;

use App\Entity\Beneficiary;
use App\Service\BeneficiaryGeneratorService;
use App\Service\NameGeneratorService;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

class BeneficiaryGeneratorServiceTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testGetRandomBeneficiariesReturnsExpectedCount(): void
    {
        $mockNameGen = $this->createMock(NameGeneratorService::class);
        $mockNameGen->method('getFirstName')->willReturn('Martin');

        $limit = 5;
        $service = new BeneficiaryGeneratorService($mockNameGen);
        $beneficiaries = $service->getRandomBeneficiaries($limit);

        $this->assertCount($limit, $beneficiaries);
    }

    /**
     * @throws Exception
     */
    public function testGetRandomBeneficiariesReturnsExpectedNames(): void
    {
        $stub = $this->createMock(NameGeneratorService::class);

        $stub->method('getFirstName')
            ->willReturnOnConsecutiveCalls('Alice', 'Bob', 'Charlie');

        $service = new BeneficiaryGeneratorService($stub);
        $beneficiaries = $service->getRandomBeneficiaries(3);

        $names = array_map(fn($b) => $b->getName(), $beneficiaries);

        $this->assertEquals(['Alice', 'Bob', 'Charlie'], $names);
    }
}