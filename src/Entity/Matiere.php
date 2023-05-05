<?php

namespace App\Entity;

use App\Repository\MatiereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatiereRepository::class)]
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

    public function __construct()
    {
        $this->enseigners = new ArrayCollection();
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
}
