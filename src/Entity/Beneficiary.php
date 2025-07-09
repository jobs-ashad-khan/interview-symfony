<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\BeneficiaryRepository;
use App\Utils\DiceBearAvatarGenerator;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource]
#[ORM\Entity(repositoryClass: BeneficiaryRepository::class)]
class Beneficiary
{
    #[ORM\Id()]
    #[ORM\GeneratedValue()]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAvatarUrl(): string
    {
        return DiceBearAvatarGenerator::getAvatar($this->name);
    }
}
