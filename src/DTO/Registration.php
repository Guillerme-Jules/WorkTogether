<?php

namespace App\DTO;

class Registration{
    private ?string $firstName = null;

    private ?string $lastName = null;

    private ?\DateTimeInterface $birthday = null;

    private ?string $email = null;

    private ?string $password = null;

    private ?bool $agreeTerms = null;

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): static
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getAgreeTerms(): string
    {
        return $this->agreeTerms;
    }

    public function setAgreeTerms(string $agreeTerms): static
    {
        $this->agreeTerms = $agreeTerms;

        return $this;
    }

}