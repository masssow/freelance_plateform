<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client extends User
{

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nomEntreprise = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adresse = null;

    #[ORM\Column(nullable: true)]
    private ?float $budgetTotal = null;

    /**
     * @var Collection<int, Projet>
     */
    #[ORM\OneToMany(targetEntity: Projet::class, mappedBy: 'clientCreateur')]
    private Collection $projetsPublies;

    /**
     * @var Collection<int, Evaluation>
     */
    #[ORM\OneToMany(targetEntity: Evaluation::class, mappedBy: 'client')]
    private Collection $evaluationsFreelances;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $VilleEntreprise = null;

    public function __construct()
    {
        parent::__construct();
        $this->projetsPublies = new ArrayCollection();
        $this->evaluationsFreelances = new ArrayCollection();
    }

    public function getNomEntreprise(): ?string
    {
        return $this->nomEntreprise;
    }

    public function setNomEntreprise(?string $nomEntreprise): static
    {
        $this->nomEntreprise = $nomEntreprise;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getBudgetTotal(): ?float
    {
        return $this->budgetTotal;
    }

    public function setBudgetTotal(?float $budgetTotal): static
    {
        $this->budgetTotal = $budgetTotal;

        return $this;
    }

    /**
     * @return Collection<int, Projet>
     */
    public function getProjetsPublies(): Collection
    {
        return $this->projetsPublies;
    }

    public function addProjetsPubly(Projet $projetsPubly): static
    {
        if (!$this->projetsPublies->contains($projetsPubly)) {
            $this->projetsPublies->add($projetsPubly);
            $projetsPubly->setClientCreateur($this);
        }

        return $this;
    }

    public function removeProjetsPubly(Projet $projetsPubly): static
    {
        if ($this->projetsPublies->removeElement($projetsPubly)) {
            // set the owning side to null (unless already changed)
            if ($projetsPubly->getClientCreateur() === $this) {
                $projetsPubly->setClientCreateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Evaluation>
     */
    public function getEvaluationsFreelances(): Collection
    {
        return $this->evaluationsFreelances;
    }

    public function addEvaluationsFreelance(Evaluation $evaluationsFreelance): static
    {
        if (!$this->evaluationsFreelances->contains($evaluationsFreelance)) {
            $this->evaluationsFreelances->add($evaluationsFreelance);
            $evaluationsFreelance->setClient($this);
        }

        return $this;
    }

    public function removeEvaluationsFreelance(Evaluation $evaluationsFreelance): static
    {
        if ($this->evaluationsFreelances->removeElement($evaluationsFreelance)) {
            // set the owning side to null (unless already changed)
            if ($evaluationsFreelance->getClient() === $this) {
                $evaluationsFreelance->setClient(null);
            }
        }

        return $this;
    }

    public function getVilleEntreprise(): ?string
    {
        return $this->VilleEntreprise;
    }

    public function setVilleEntreprise(?string $VilleEntreprise): static
    {
        $this->VilleEntreprise = $VilleEntreprise;

        return $this;
    }

}
