<?php

namespace App\Entity;

use App\Repository\SousCategorieMetierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SousCategorieMetierRepository::class)]
class SousCategorieMetier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $active = null;

    #[ORM\ManyToOne(inversedBy: 'Souscategories')]
    private ?CategorieMetier $categorieMetier = null;

    /**
     * @var Collection<int, Metier>
     */
    #[ORM\OneToMany(targetEntity: Metier::class, mappedBy: 'sousCategorieMetier')]
    private Collection $Metier;

    public function __construct()
    {
        $this->Metier = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): static
    {
        $this->active = $active;

        return $this;
    }

    public function getCategorieMetier(): ?CategorieMetier
    {
        return $this->categorieMetier;
    }

    public function setCategorieMetier(?CategorieMetier $categorieMetier): static
    {
        $this->categorieMetier = $categorieMetier;

        return $this;
    }

    /**
     * @return Collection<int, Metier>
     */
    public function getMetier(): Collection
    {
        return $this->Metier;
    }

    public function addMetier(Metier $metier): static
    {
        if (!$this->Metier->contains($metier)) {
            $this->Metier->add($metier);
            $metier->setSousCategorieMetier($this);
        }

        return $this;
    }

    public function removeMetier(Metier $metier): static
    {
        if ($this->Metier->removeElement($metier)) {
            // set the owning side to null (unless already changed)
            if ($metier->getSousCategorieMetier() === $this) {
                $metier->setSousCategorieMetier(null);
            }
        }

        return $this;
    }
}
