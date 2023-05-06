<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\EnseignerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnseignerRepository::class)]
#[ApiResource()]
class Enseigner
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'enseigners')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Professeur $professeurId = null;

    #[ORM\ManyToOne(inversedBy: 'enseigners')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Matiere $matiereId = null;

    #[ORM\OneToMany(mappedBy: 'professeurId', targetEntity: Cours::class)]
    private Collection $cours;

    public function __construct()
    {
        $this->cours = new ArrayCollection();
    }
    public function __toString(): string
    {
        return $this->matiereId.'-'.$this->professeurId;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProfesseurId(): ?Professeur
    {
        return $this->professeurId;
    }

    public function setProfesseurId(?Professeur $professeurId): self
    {
        $this->professeurId = $professeurId;

        return $this;
    }

    public function getMatiereId(): ?Matiere
    {
        return $this->matiereId;
    }

    public function setMatiereId(?Matiere $matiereId): self
    {
        $this->matiereId = $matiereId;

        return $this;
    }

    /**
     * @return Collection<int, Cours>
     */
    public function getCours(): Collection
    {
        return $this->cours;
    }

    public function addCour(Cours $cour): self
    {
        if (!$this->cours->contains($cour)) {
            $this->cours->add($cour);
            $cour->setProfesseurId($this);
        }

        return $this;
    }

    public function removeCour(Cours $cour): self
    {
        if ($this->cours->removeElement($cour)) {
            // set the owning side to null (unless already changed)
            if ($cour->getProfesseurId() === $this) {
                $cour->setProfesseurId(null);
            }
        }

        return $this;
    }
}
