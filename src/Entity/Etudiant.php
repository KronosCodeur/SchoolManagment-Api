<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtudiantRepository::class)]
class Etudiant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $etudiantId = null;

    #[ORM\Column(length: 255)]
    private ?string $etudiantNom = null;

    #[ORM\Column(length: 255)]
    private ?string $etudiantPrenom = null;

    #[ORM\ManyToOne(inversedBy: 'etudiants')]
    private ?Classe $classeId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtudiantId(): ?string
    {
        return $this->etudiantId;
    }

    public function setEtudiantId(string $etudiantId): self
    {
        $this->etudiantId = $etudiantId;

        return $this;
    }

    public function getEtudiantNom(): ?string
    {
        return $this->etudiantNom;
    }

    public function setEtudiantNom(string $etudiantNom): self
    {
        $this->etudiantNom = $etudiantNom;

        return $this;
    }

    public function getEtudiantPrenom(): ?string
    {
        return $this->etudiantPrenom;
    }

    public function setEtudiantPrenom(string $etudiantPrenom): self
    {
        $this->etudiantPrenom = $etudiantPrenom;

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
}
