<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CoursRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoursRepository::class)]
#[ApiResource()]
class Cours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'cours')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Enseigner $professeurId = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateCours = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $heureCours = null;

    #[ORM\ManyToOne(inversedBy: 'cours')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Classe $classeId = null;

    #[ORM\ManyToOne(inversedBy: 'cours')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Enseigner $matiereId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProfesseurId(): ?Enseigner
    {
        return $this->professeurId;
    }

    public function setProfesseurId(?Enseigner $professeurId): self
    {
        $this->professeurId = $professeurId;

        return $this;
    }

    public function getDateCours(): ?\DateTimeInterface
    {
        return $this->dateCours;
    }

    public function setDateCours(\DateTimeInterface $dateCours): self
    {
        $this->dateCours = $dateCours;

        return $this;
    }

    public function getHeureCours(): ?\DateTimeInterface
    {
        return $this->heureCours;
    }

    public function setHeureCours(\DateTimeInterface $heureCours): self
    {
        $this->heureCours = $heureCours;

        return $this;
    }

    public function getClasseId(): ?Classe
    {
        return $this->classeId;
    }

    public function setClasseId(?Classe $classeId): self
    {
        $this->classeId = $classeId;

        return $this;
    }

    public function getMatiereId(): ?Enseigner
    {
        return $this->matiereId;
    }

    public function setMatiereId(?Enseigner $matiereId): self
    {
        $this->matiereId = $matiereId;

        return $this;
    }
}
