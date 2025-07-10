<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\EventListener\BeneficiaryListener;
use App\Repository\BeneficiaryRepository;
use App\Utils\DiceBearAvatarGenerator;
use Doctrine\ORM\Mapping as ORM;

#[ORM\EntityListeners([BeneficiaryListener::class])]
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

    #[ORM\ManyToOne]
    private ?User $creator = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

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

    public function getCreator(): ?User
    {
        return $this->creator;
    }

    public function setCreator(?User $creator): static
    {
        $this->creator = $creator;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
