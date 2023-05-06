<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MatiereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatiereRepository::class)]
#[ApiResource()]
class Matiere
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $matiereId = null;

    #[ORM\Column(length: 255)]
    private ?string $matiereNom = null;

    #[ORM\OneToMany(mappedBy: 'matiereId', targetEntity: Enseigner::class)]
    private Collection $enseigners;

    #[ORM\ManyToMany(targetEntity: Professeur::class, mappedBy: 'enseigne')]
    private Collection $professeurs;

    public function __construct()
    {
        $this->enseigners = new ArrayCollection();
        $this->professeurs = new ArrayCollection();
    }
    public function __toString()
    {
        return $this->matiereNom;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatiereId(): ?string
    {
        return $this->matiereId;
    }

    public function setMatiereId(string $matiereId): self
    {
        $this->matiereId = $matiereId;

        return $this;
    }

    public function getMatiereNom(): ?string
    {
        return $this->matiereNom;
    }

    public function setMatiereNom(string $matiereNom): self
    {
        $this->matiereNom = $matiereNom;

        return $this;
    }

    /**
     * @return Collection<int, Enseigner>
     */
    public function getEnseigners(): Collection
    {
        return $this->enseigners;
    }

    public function addEnseigner(Enseigner $enseigner): self
    {
        if (!$this->enseigners->contains($enseigner)) {
            $this->enseigners->add($enseigner);
            $enseigner->setMatiereId($this);
        }

        return $this;
    }

    public function removeEnseigner(Enseigner $enseigner): self
    {
        if ($this->enseigners->removeElement($enseigner)) {
            // set the owning side to null (unless already changed)
            if ($enseigner->getMatiereId() === $this) {
                $enseigner->setMatiereId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Professeur>
     */
    public function getProfesseurs(): Collection
    {
        return $this->professeurs;
    }

    public function addProfesseur(Professeur $professeur): self
    {
        if (!$this->professeurs->contains($professeur)) {
            $this->professeurs->add($professeur);
            $professeur->addEnseigne($this);
        }

        return $this;
    }

    public function removeProfesseur(Professeur $professeur): self
    {
        if ($this->professeurs->removeElement($professeur)) {
            $professeur->removeEnseigne($this);
        }

        return $this;
    }
}
