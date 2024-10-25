<?php

namespace App\Entity;

use App\Repository\DashboardRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DashboardRepository::class)]
class Dashboard
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private ?array $ProjetsEnCours = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private ?array $paiementsAttendus = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private ?array $evaluationsRecues = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProjetsEnCours(): ?array
    {
        return $this->ProjetsEnCours;
    }

    public function setProjetsEnCours(?array $ProjetsEnCours): static
    {
        $this->ProjetsEnCours = $ProjetsEnCours;

        return $this;
    }

    public function getPaiementsAttendus(): ?array
    {
        return $this->paiementsAttendus;
    }

    public function setPaiementsAttendus(?array $paiementsAttendus): static
    {
        $this->paiementsAttendus = $paiementsAttendus;

        return $this;
    }

    public function getEvaluationsRecues(): ?array
    {
        return $this->evaluationsRecues;
    }

    public function setEvaluationsRecues(?array $evaluationsRecues): static
    {
        $this->evaluationsRecues = $evaluationsRecues;

        return $this;
    }
}
