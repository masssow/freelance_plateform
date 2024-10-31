<?php

namespace App\Entity;

use App\Repository\CategorieMetierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieMetierRepository::class)]
class CategorieMetier
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

    /**
     * @var Collection<int, SousCategorieMetier>
     */
    #[ORM\OneToMany(targetEntity: SousCategorieMetier::class, mappedBy: 'categorieMetier')]
    private Collection $Souscategories;

    public function __construct()
    {
        $this->Souscategories = new ArrayCollection();
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

    /**
     * @return Collection<int, SousCategorieMetier>
     */
    public function getSouscategories(): Collection
    {
        return $this->Souscategories;
    }

    public function addSouscategory(SousCategorieMetier $souscategory): static
    {
        if (!$this->Souscategories->contains($souscategory)) {
            $this->Souscategories->add($souscategory);
            $souscategory->setCategorieMetier($this);
        }

        return $this;
    }

    public function removeSouscategory(SousCategorieMetier $souscategory): static
    {
        if ($this->Souscategories->removeElement($souscategory)) {
            // set the owning side to null (unless already changed)
            if ($souscategory->getCategorieMetier() === $this) {
                $souscategory->setCategorieMetier(null);
            }
        }

        return $this;
    }
}
