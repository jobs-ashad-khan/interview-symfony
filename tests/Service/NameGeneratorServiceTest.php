<?php

namespace App\Tests\Service;

use App\Service\NameGeneratorService;
use PHPUnit\Framework\TestCase;

class NameGeneratorServiceTest extends TestCase
{
    private NameGeneratorService $nameGeneratorService;

    protected function setUp(): void
    {
        $this->nameGeneratorService = new NameGeneratorService('fr_FR');
    }

    public function testGetFirstNameReturnsString(): void
    {
        $firstName = $this->nameGeneratorService->getFirstName();
        $this->assertIsString($firstName);
        $this->assertNotEmpty($firstName);
    }

    public function testGetLastNameReturnsString(): void
    {
        $lastName = $this->nameGeneratorService->getLastName();
        $this->assertIsString($lastName);
        $this->assertNotEmpty($lastName);
    }

    public function testGetFullNameReturnsString(): void
    {
        $name = $this->nameGeneratorService->getName();
        $this->assertIsString($name);
        $this->assertNotEmpty($name);
        $this->assertStringContainsString(' ', $name);
    }
}