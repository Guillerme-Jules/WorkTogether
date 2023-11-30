<?php

namespace App\Entity;

use App\Repository\CustomerTicketRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomerTicketRepository::class)]
class CustomerTicket
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column(length: 500)]
    private ?string $Description = null;

    #[ORM\ManyToOne(inversedBy: 'customerTickets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customer $Customer = null;

    #[ORM\Column]
    private ?bool $Done = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): static
    {
        $this->Name = $Name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->Customer;
    }

    public function setCustomer(?Customer $Customer): static
    {
        $this->Customer = $Customer;

        return $this;
    }

    public function isDone(): ?bool
    {
        return $this->Done;
    }

    public function setDone(bool $Done): static
    {
        $this->Done = $Done;

        return $this;
    }
}
