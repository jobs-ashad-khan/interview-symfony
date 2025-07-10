<?php

namespace App\EventListener;

use App\Entity\Beneficiary;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

readonly class BeneficiaryListener
{
    public function __construct(
        private TokenStorageInterface $tokenStorage
    ) {}

    /**
     * @param Beneficiary $beneficiary
     * @param LifecycleEventArgs $args
     * @return void
     */
    public function prePersist(Beneficiary $beneficiary, LifecycleEventArgs $args): void
    {
        if (!$beneficiary->getCreatedAt()) {
            $beneficiary->setCreatedAt(new \DateTimeImmutable());
        }

        $user = $this->tokenStorage->getToken()?->getUser();
        if ($user && !$beneficiary->getCreator()) {
            $beneficiary->setCreator($user);
        }
    }
}
