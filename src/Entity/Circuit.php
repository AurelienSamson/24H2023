<?php

namespace App\Entity;

use App\Repository\CircuitRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Section;
use App\Entity\Voiture;

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

    private Voiture $voiture;

    

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

    public function setVoiture(Voiture $voiture): self
    {
        $this->voiture = $voiture;

        return $this;
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
            $sectionTime = $section->getTemps();
            switch ($section->getTerrain()) {
                case "Concrete":
                    $sectionTime = $sectionTime * (1 + ($this->voiture->getPoids() / 100));
                    break;
                case "Dirt":
                    $sectionTime = $sectionTime * (1 + ($this->voiture->getPoids() / 100 * 1.2));
                    break;
                case "Ice":
                    break;
            }
            $oneTurnTime += $sectionTime;
        }

        $allLapsTime = $oneTurnTime * $this->tours;
        $allLapsTime = $allLapsTime * ($this->voiture->getAcceleration() / 60) * ($this->voiture->getPuissance() / 60);
        $allLapsTime = $allLapsTime + (intval(1/50 * $this->voiture->getUsure() * $this->tours) * 25);
        $allLapsTime = $allLapsTime + (intval(1/100 * $this->voiture->getConso() * $this->tours) * 25);
        $allLapsTime = round($allLapsTime, 2);



        $this->tempsCircuit = $allLapsTime;
        return $this;
    }


}
