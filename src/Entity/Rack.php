<?php

namespace App\Entity;

use App\Repository\RackRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RackRepository::class)]
class Rack
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numberSlot = null;

    #[ORM\OneToMany(mappedBy: 'rack', targetEntity: Unit::class)]
    private Collection $units;

    public function __construct()
    {
        $this->units = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumberSlot(): ?int
    {
        return $this->numberSlot;
    }

    public function setNumberSlot(int $numberSlot): static
    {
        $this->numberSlot = $numberSlot;

        return $this;
    }

    /**
     * @return Collection<int, Unit>
     */
    public function getUnits(): Collection
    {
        return $this->units;
    }

    public function addUnit(Unit $unit): static
    {
        if (!$this->units->contains($unit)) {
            $this->units->add($unit);
            $unit->setRack($this);
        }

        return $this;
    }

    public function removeUnit(Unit $unit): static
    {
        if ($this->units->removeElement($unit)) {
            // set the owning side to null (unless already changed)
            if ($unit->getRack() === $this) {
                $unit->setRack(null);
            }
        }

        return $this;
    }
}
