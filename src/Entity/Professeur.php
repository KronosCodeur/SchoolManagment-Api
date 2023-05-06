<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProfesseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfesseurRepository::class)]
#[ApiResource()]
class Professeur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $professeurId = null;

    #[ORM\Column(length: 255)]
    private ?string $professeurNom = null;

    #[ORM\Column(length: 255)]
    private ?string $professeurPrenom = null;

    #[ORM\OneToMany(mappedBy: 'professeurId', targetEntity: Enseigner::class)]
    private Collection $enseigners;

    #[ORM\ManyToMany(targetEntity: Matiere::class, inversedBy: 'professeurs')]
    private Collection $enseigne;

    public function __construct()
    {
        $this->enseigners = new ArrayCollection();
        $this->enseigne = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->professeurNom;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProfesseurId(): ?string
    {
        return $this->professeurId;
    }

    public function setProfesseurId(string $professeurId): self
    {
        $this->professeurId = $professeurId;

        return $this;
    }

    public function getProfesseurNom(): ?string
    {
        return $this->professeurNom;
    }

    public function setProfesseurNom(string $professeurNom): self
    {
        $this->professeurNom = $professeurNom;

        return $this;
    }

    public function getProfesseurPrenom(): ?string
    {
        return $this->professeurPrenom;
    }

    public function setProfesseurPrenom(string $professeurPrenom): self
    {
        $this->professeurPrenom = $professeurPrenom;

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
            $enseigner->setProfesseurId($this);
        }

        return $this;
    }

    public function removeEnseigner(Enseigner $enseigner): self
    {
        if ($this->enseigners->removeElement($enseigner)) {
            // set the owning side to null (unless already changed)
            if ($enseigner->getProfesseurId() === $this) {
                $enseigner->setProfesseurId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Matiere>
     */
    public function getEnseigne(): Collection
    {
        return $this->enseigne;
    }

    public function addEnseigne(Matiere $enseigne): self
    {
        if (!$this->enseigne->contains($enseigne)) {
            $this->enseigne->add($enseigne);
        }

        return $this;
    }

    public function removeEnseigne(Matiere $enseigne): self
    {
        $this->enseigne->removeElement($enseigne);

        return $this;
    }
}
