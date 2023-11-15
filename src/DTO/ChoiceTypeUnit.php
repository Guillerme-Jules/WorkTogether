<?php

namespace App\DTO;

use App\Entity\TypeUnit;

class ChoiceTypeUnit {
    private ?TypeUnit $typeUnit = null;

    public function getTypeUnit(): ?TypeUnit
    {
        return $this->typeUnit;
    }

    public function setTypeUnit(?TypeUnit $typeUnit): ChoiceTypeUnit
    {
        $this->typeUnit = $typeUnit;

        return $this;
    }
}