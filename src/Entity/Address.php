<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\AddressRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

use function sprintf;

/**
 * Attempt to make Doctrine ORM Entity usable.
 * - constructor property promotion => can make nullable only what is actually needed.
 * - class can not be readonly since Doctrine needs to write the ID after object is created.
 * - properties can not be readonly if Entity is update-able.
 * - id private and uses getter/setter.
 *
 * For Doctrine ORM classes can not be final
 * @phpcs:disable SlevomatCodingStandard.Classes.RequireAbstractOrFinal.ClassNeitherAbstractNorFinal
 */
#[ApiResource]
#[ORM\Entity(repositoryClass: AddressRepository::class)]
class Address
{
    use TimestampableEntity;

    #[ORM\Column]
    #[ORM\GeneratedValue]
    #[ORM\Id]
    private ?int $id;

    #[ORM\Column]
    private int $clientId;

    #[ORM\Column(length: 35)]
    private string $name;

    #[ORM\Column(length: 30)]
    private string $address1;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $address2;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $address3;

    #[ORM\Column(length: 30)]
    private string $city;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $postalCode;

    #[ORM\Column(length: 2, nullable: true)]
    private ?string $state;

    #[ORM\Column(length: 2)]
    private string $country;

    #[ORM\Column(length: 45, nullable: true)]
    private ?string $taxIdentification;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getAddress1(): string
    {
        return $this->address1;
    }

    public function setAddress1(string $address1): void
    {
        $this->address1 = $address1;
    }

    public function getAddress2(): ?string
    {
        return $this->address2;
    }

    public function setAddress2(?string $address2): void
    {
        $this->address2 = $address2;
    }

    public function getAddress3(): ?string
    {
        return $this->address3;
    }

    public function setAddress3(?string $address3): void
    {
        $this->address3 = $address3;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(?string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(?string $state): void
    {
        $this->state = $state;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    public function getTaxIdentification(): ?string
    {
        return $this->taxIdentification;
    }

    public function setTaxIdentification(?string $taxIdentification): void
    {
        $this->taxIdentification = $taxIdentification;
    }

    public function getClientId(): int
    {
        return $this->clientId;
    }

    public function setClientId(int $clientId): void
    {
        $this->clientId = $clientId;
    }

    #[ApiProperty(readable: false)]
    public function getAllAddressLines(): string
    {
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
