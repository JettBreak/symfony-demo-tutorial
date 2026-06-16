<?php

namespace App\DTO;

class ContactData
{
    private ?int $id;
    private ?string $name;

    public function setID(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getID(): ?int
    {
        return $this->id;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
}
