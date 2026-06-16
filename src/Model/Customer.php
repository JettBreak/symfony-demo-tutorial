<?php

namespace App\Model;

class Customer
{
    public function __construct(
        private int $id,
        private string $name,
        private string $dtcreated,
        private string $dtupdated,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDtcreated(): string
    {
        return $this->dtcreated;
    }

    public function setDtcreated(string $dtcreated): static
    {
        $this->dtcreated = $dtcreated;

        return $this;
    }

    public function getDtupdated(): string
    {
        return $this->dtupdated;
    }

    public function setDtupdated(string $dtupdated): static
    {
        $this->dtupdated = $dtupdated;

        return $this;
    }
}
