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

    #[ORM\Column]
    private ?int $tours = null;

    private array $listeSection = [];

    #[ORM\Column]
    private ?float $tempsCircuit = null;

    private bool $medailleOr = false;

    private bool $medailleArgent = false;

    private bool $medailleBronze = false;

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
        $this->image = $image . ".svg";

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

    public function getTours(): ?int
    {
        return $this->tours;
    }

    public function setTours(int $tours): self
    {
        $this->tours = $tours;

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

    public function getMedailleOr(): ?int
    {
        return $this->medailleOr;
    }

    public function getMedailleArgent(): ?int
    {
        return $this->medailleArgent;
    }

    public function getMedailleBronze(): ?int
    {
        return $this->medailleBronze;
    }


    public function setMedals($nomMedaille): self {
        switch ($nomMedaille) {
            case "Gold":
                $this->medailleOr = true;
                $this->medailleArgent = true;
                $this->medailleBronze = true;
                break;
            case "Silver":
                $this->medailleArgent = true;
                $this->medailleBronze = true;
                break;
            case "Brass":
                $this->medailleBronze = true;
                break;
        }
        return $this;

    }

    public function addSection($nomTerrain, $nomSlop): self
    {
            $this->listeSection[] = new Section($nomTerrain, $nomSlop);
            return $this;
    }


    public function getTimeAllLaps(): self
    {
        $oneTurnTime = 0;
        foreach($this->listeSection as $section) {
            $oneTurnTime += $section->getTemps();
        }
        $this->tempsCircuit = $oneTurnTime * $this->tours;
        return $this;
    }


}
