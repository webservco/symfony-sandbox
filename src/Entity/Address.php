<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\ORM\Mapping as ORM;

use function sprintf;

/**
 * Attempt to make Doctrine ORM Entity usable.
 * - constructor property promotion => can make nullable only what is actually needed.
 * - class can not be readonly since Doctrine needs to write the ID after object is created.
 * - id private and uses getter/setter.
 */
#[ORM\Entity(repositoryClass: AddressRepository::class)]
final class Address
{
    /**
     * PHPMD: "Consider reducing the number of parameters to less than 10"
     * OK, since DTO.
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        #[ORM\Column]
        #[ORM\GeneratedValue]
        #[ORM\Id]
        private ?int $id,
        #[ORM\Column]
        public readonly int $clientId,
        #[ORM\Column(length: 35)]
        public readonly string $name,
        #[ORM\Column(length: 30)]
        public readonly string $address1,
        #[ORM\Column(length: 30, nullable: true)]
        public readonly ?string $address2,
        #[ORM\Column(length: 30, nullable: true)]
        public readonly ?string $address3,
        #[ORM\Column(length: 30)]
        public readonly string $city,
        #[ORM\Column(length: 10, nullable: true)]
        public readonly ?string $postalCode,
        #[ORM\Column(length: 2, nullable: true)]
        public readonly ?string $state,
        #[ORM\Column(length: 2)]
        public readonly string $country,
        #[ORM\Column(length: 45, nullable: true)]
        public readonly ?string $taxIdentification,
    ) {
        $this->id = null;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

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
