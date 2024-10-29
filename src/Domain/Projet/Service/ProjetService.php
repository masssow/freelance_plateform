<?php

namespace App\Domain\Projet\Service;

use App\entity\Client;
use App\Entity\Freelance;
use App\Entity\Projet;
use Doctrine\ORM\EntityManagerInterface;

class ProjetService
{
    public function __construct(private EntityManagerInterface $entityManager)
    { }

    public function createProjet(Client $client, Projet $projet): void
    {
        $projet->setClientCreateur($client);
        $this->entityManager->persist($projet);
        $this->entityManager->flush();

    }

    public function updateProjet(Projet $projet)
    {
        $this->entityManager->flush();
    }

    public function deleteProjet(Projet $projet)
    {
        $this->entityManager->remove($projet);
        $this->entityManager->flush();
    }

    public function changeStatus(Projet $projet, string $status): void
    {
        $projet->setStatus($status);
        $this->entityManager->flush();
    }
}