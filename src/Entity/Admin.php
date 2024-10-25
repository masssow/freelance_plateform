<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdminRepository::class)]
#[ORM\Table(name: '`admin`')]
class Admin extends User
{

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $prenom = null;

    #[ORM\Column]
    private ?int $privileges = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private ?array $historiqueModeration = null;

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(?string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getPrivileges(): ?int
    {
        return $this->privileges;
    }

    public function setPrivileges(int $privileges): static
    {
        $this->privileges = $privileges;

        return $this;
    }

    public function getHistoriqueModeration(): ?array
    {
        return $this->historiqueModeration;
    }

    public function setHistoriqueModeration(?array $historiqueModeration): static
    {
        $this->historiqueModeration = $historiqueModeration;

        return $this;
    }
}
