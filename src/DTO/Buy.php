<?php

namespace App\DTO;

use App\Entity\TypeReservation;

class Buy {
    private ?TypeReservation $typeReservation = null;

    private ?int $quantity = 1;

    public function getTypeReservation(): ?TypeReservation
    {
        return $this->typeReservation;
    }

    public function setTypeReservation(?TypeReservation $typeReservation): Buy
    {
        $this->typeReservation = $typeReservation;

        return $this;
    }
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }
    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }
}