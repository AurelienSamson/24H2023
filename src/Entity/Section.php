<?php

namespace App\Entity;

use App\Repository\SectionRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Slop;

#[ORM\Entity(repositoryClass: SectionRepository::class)]
class Section
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $terrain = null;

    #[ORM\Column(length: 255)]
    private ?string $slop = null;

    #[ORM\Column]
    private ?float $temps = null;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTerrain(): ?string
    {
        return $this->terrain;
    }

    public function setTerrain(string $terrain): self
    {
        $this->terrain = $terrain;

        return $this;
    }

    public function getSlop(): ?string
    {
        return $this->slop;
    }

    public function setSlop(string $slop): self
    {
        $this->slop = $slop;

        return $this;
    }

    public function getTemps(): ?float
    {
        return $this->temps;
    }

    public function setTemps(float $temps): self
    {
        $this->temps = $temps;

        return $this;
    }

    function __construct($terrain, $slop) {
        $value = 0;

        switch ($terrain) {
            case "Concrete":
                $value = 15;
                break;
            case "Dirt":
                $value = 35;
                break;
            case "Ice":
                $value = 20;
                break;
        }

        switch ($slop) {
            case "Uphill":
                $value *= 2.33;
                break;
            case "Downhill":
                $value *= 0.66;
                break;
            case "Straight":
                $value *= 1;
                break;
            case "Turn":
                $value *= 2;
                break;
            case "Sharp turn":
                $value *= 3.33;
                break;
        }

        $this->terrain = $terrain;
        $this->slop = $slop;
        $this->temps = $value;
      }


}
