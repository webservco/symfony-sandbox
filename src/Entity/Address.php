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
 * - properties can not be readonly is Entity is update-able.
 * - id private and uses getter/setter.
 *
 * For Doctrine ORM classes can not be final
 * @phpcs:disable SlevomatCodingStandard.Classes.RequireAbstractOrFinal.ClassNeitherAbstractNorFinal
 */
#[ORM\Entity(repositoryClass: AddressRepository::class)]
class Address
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
        public int $clientId,
        #[ORM\Column(length: 35)]
        public string $name,
        #[ORM\Column(length: 30)]
        public string $address1,
        #[ORM\Column(length: 30, nullable: true)]
        public ?string $address2,
        #[ORM\Column(length: 30, nullable: true)]
        public ?string $address3,
        #[ORM\Column(length: 30)]
        public string $city,
        #[ORM\Column(length: 10, nullable: true)]
        public ?string $postalCode,
        #[ORM\Column(length: 2, nullable: true)]
        public ?string $state,
        #[ORM\Column(length: 2)]
        public string $country,
        #[ORM\Column(length: 45, nullable: true)]
        public ?string $taxIdentification,
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
