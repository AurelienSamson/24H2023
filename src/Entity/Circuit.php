<?php

namespace App\Entity;

use App\Repository\CircuitRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Section;

#[ORM\Entity(repositoryClass: CircuitRepository::class)]
class Circuit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    private array $listeSection = [];

    #[ORM\Column]
    private ?float $tempsCircuit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getTempsCircuit(): ?float
    {
        return $this->tempsCircuit;
    }

    public function setTempsCircuit(float $tempsCircuit): self
    {
        $this->tempsCircuit = $tempsCircuit;

        return $this;
    }

    public function getListeSection(): ?array
    {
        return $this->listeSection;
    }

    public function setListeSection(array $listeSection): self
    {
        $this->listeSection = $listeSection;

        return $this;
    }

    public function addSections($nomTerrain, $nomSlop, $nbrSection): self
    {
        for ($i = 1; $i <= $nbrSection; $i++) {
            $this->listeSection[] = new Section($nomTerrain, $nomSlop);
        }
    }


    


    public function generateNameFromImage(string $image): self
    {
        $replaced = str_replace('_', ' ', $image);
        $this->name = ucwords($replaced);

        return $this;
    }


}
