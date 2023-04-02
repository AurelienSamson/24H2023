<?php

namespace App\Entity;

use App\Repository\VoitureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoitureRepository::class)]
class Voiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $puissance = null;

    #[ORM\Column]
    private ?int $acceleration = null;

    #[ORM\Column]
    private ?int $adherance = null;

    #[ORM\Column]
    private ?int $maniabilite = null;

    #[ORM\Column]
    private ?int $poids = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPuissance(): ?int
    {
        return $this->puissance;
    }

    public function setPuissance(int $puissance): self
    {
        $this->puissance = $puissance;

        return $this;
    }

    public function getAcceleration(): ?int
    {
        return $this->acceleration;
    }

    public function setAcceleration(int $acceleration): self
    {
        $this->acceleration = $acceleration;

        return $this;
    }

    public function getAdherance(): ?int
    {
        return $this->adherance;
    }

    public function setAdherance(int $adherance): self
    {
        $this->adherance = $adherance;

        return $this;
    }

    public function getManiabilite(): ?int
    {
        return $this->maniabilite;
    }

    public function setManiabilite(int $maniabilite): self
    {
        $this->maniabilite = $maniabilite;

        return $this;
    }

    public function getPoids(): ?int
    {
        return $this->poids;
    }

    public function setPoids(int $poids): self
    {
        $this->poids = $poids;

        return $this;
    }

    public function __construct($puissance, $acceleration, $adherence, $maniabilite, $poids) {
        $this->puissance = $puissance;
        $this->acceleration = $acceleration;
        $this->adherance = $adherence;
        $this->maniabilite = $maniabilite;
        $this->poids = $poids;
    }
}
