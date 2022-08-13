<?php

namespace App\Entity;

use App\Repository\FonctionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FonctionsRepository::class)]
class Fonctions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $nomFonction = null;

    #[ORM\ManyToMany(targetEntity: Personnes::class, mappedBy: 'fonctions')]
    private Collection $personnes;

    public function __construct()
    {
        $this->personnes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomFonction(): ?string
    {
        return $this->nomFonction;
    }

    public function setNomFonction(?string $nomFonction): self
    {
        $this->nomFonction = $nomFonction;

        return $this;
    }

    /**
     * @return Collection<int, Personnes>
     */
    public function getPersonnes(): Collection
    {
        return $this->personnes;
    }

    public function addPersonne(Personnes $personne): self
    {
        if (!$this->personnes->contains($personne)) {
            $this->personnes->add($personne);
            $personne->addFonction($this);
        }

        return $this;
    }

    public function removePersonne(Personnes $personne): self
    {
        if ($this->personnes->removeElement($personne)) {
            $personne->removeFonction($this);
        }

        return $this;
    }
}
