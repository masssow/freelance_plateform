<?php

namespace App\Entity;

use App\Repository\ProjetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjetRepository::class)]
class Projet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $competencesRequises = [];

    #[ORM\Column(nullable: true)]
    private ?float $budget = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $datePublication = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateLimiteCandidature = null;

    /**
     * @var Collection<int, Freelance>
     */
    #[ORM\ManyToMany(targetEntity: Freelance::class, mappedBy: 'projets')]
    private Collection $freelances;

    #[ORM\ManyToOne(inversedBy: 'projetsPublies')]
    private ?Client $clientCreateur = null;

    /**
     * @var Collection<int, Candidature>
     */
    #[ORM\OneToMany(targetEntity: Candidature::class, mappedBy: 'projet')]
    private Collection $candidatures;

    /**
     * @var Collection<int, Evaluation>
     */
    #[ORM\OneToMany(targetEntity: Evaluation::class, mappedBy: 'projet')]
    private Collection $evaluations;

    public function __construct()
    {
        $this->freelances = new ArrayCollection();
        $this->candidatures = new ArrayCollection();
        $this->evaluations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCompetencesRequises(): array
    {
        return $this->competencesRequises;
    }

    public function setCompetencesRequises(array $competencesRequises): static
    {
        $this->competencesRequises = $competencesRequises;

        return $this;
    }

    public function getBudget(): ?float
    {
        return $this->budget;
    }

    public function setBudget(?float $budget): static
    {
        $this->budget = $budget;

        return $this;
    }

    public function getDatePublication(): ?\DateTimeInterface
    {
        return $this->datePublication;
    }

    public function setDatePublication(\DateTimeInterface $datePublication): static
    {
        $this->datePublication = $datePublication;

        return $this;
    }

    public function getDateLimiteCandidature(): ?\DateTimeInterface
    {
        return $this->dateLimiteCandidature;
    }

    public function setDateLimiteCandidature(?\DateTimeInterface $dateLimiteCandidature): static
    {
        $this->dateLimiteCandidature = $dateLimiteCandidature;

        return $this;
    }

    /**
     * @return Collection<int, Freelance>
     */
    public function getFreelances(): Collection
    {
        return $this->freelances;
    }

    public function addFreelance(Freelance $freelance): static
    {
        if (!$this->freelances->contains($freelance)) {
            $this->freelances->add($freelance);
            $freelance->addProjet($this);
        }

        return $this;
    }

    public function removeFreelance(Freelance $freelance): static
    {
        if ($this->freelances->removeElement($freelance)) {
            $freelance->removeProjet($this);
        }

        return $this;
    }

    public function getClientCreateur(): ?Client
    {
        return $this->clientCreateur;
    }

    public function setClientCreateur(?Client $clientCreateur): static
    {
        $this->clientCreateur = $clientCreateur;

        return $this;
    }

    /**
     * @return Collection<int, Candidature>
     */
    public function getCandidatures(): Collection
    {
        return $this->candidatures;
    }

    public function addCandidature(Candidature $candidature): static
    {
        if (!$this->candidatures->contains($candidature)) {
            $this->candidatures->add($candidature);
            $candidature->setProjet($this);
        }

        return $this;
    }

    public function removeCandidature(Candidature $candidature): static
    {
        if ($this->candidatures->removeElement($candidature)) {
            // set the owning side to null (unless already changed)
            if ($candidature->getProjet() === $this) {
                $candidature->setProjet(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Evaluation>
     */
    public function getEvaluations(): Collection
    {
        return $this->evaluations;
    }

    public function addEvaluation(Evaluation $evaluation): static
    {
        if (!$this->evaluations->contains($evaluation)) {
            $this->evaluations->add($evaluation);
            $evaluation->setProjet($this);
        }

        return $this;
    }

    public function removeEvaluation(Evaluation $evaluation): static
    {
        if ($this->evaluations->removeElement($evaluation)) {
            // set the owning side to null (unless already changed)
            if ($evaluation->getProjet() === $this) {
                $evaluation->setProjet(null);
            }
        }

        return $this;
    }
}
