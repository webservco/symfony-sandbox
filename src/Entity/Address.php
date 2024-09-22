<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\ORM\Mapping as ORM;

use function sprintf;

#[ORM\Entity(repositoryClass: AddressRepository::class)]
final class Address
{
    #[ORM\Column]
    #[ORM\GeneratedValue]
    #[ORM\Id]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $clientId = null;

    #[ORM\Column(length: 35)]
    private ?string $name = null;

    #[ORM\Column(length: 30)]
    private ?string $address1 = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $address2 = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $address3 = null;

    #[ORM\Column(length: 30)]
    private ?string $city = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $postalCode = null;

    #[ORM\Column(length: 2, nullable: true)]
    private ?string $state = null;

    #[ORM\Column(length: 2)]
    private ?string $country = null;

    #[ORM\Column(length: 45, nullable: true)]
    private ?string $taxIdentification = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress1(): ?string
    {
        return $this->address1;
    }

    public function setAddress1(string $address1): static
    {
        $this->address1 = $address1;

        return $this;
    }

    public function getAddress2(): ?string
    {
        return $this->address2;
    }

    public function setAddress2(?string $address2): static
    {
        $this->address2 = $address2;

        return $this;
    }

    public function getAddress3(): ?string
    {
        return $this->address3;
    }

    public function setAddress3(?string $address3): static
    {
        $this->address3 = $address3;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(?string $postalCode): static
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(?string $state): static
    {
        $this->state = $state;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getTaxIdentification(): ?string
    {
        return $this->taxIdentification;
    }

    public function setTaxIdentification(?string $taxIdentification): static
    {
        $this->taxIdentification = $taxIdentification;

        return $this;
    }

    public function getClientId(): ?int
    {
        return $this->clientId;
    }

    public function setClientId(int $clientId): static
    {
        $this->clientId = $clientId;

        return $this;
    }

    public function getAllAddressLines(): string
    {
        if ($this->address1 === null) {
            return '';
        }

        return sprintf(
            '%s%s%s',
            $this->address1,
            $this->address2 !== null
            ? sprintf(', %s', $this->address2)
            : '',
            $this->address3 !== null
            ? sprintf(', %s', $this->address3)
            : '',
        );
    }
}
