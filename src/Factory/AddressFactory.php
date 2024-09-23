<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\Address;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

use function substr;

/**
 * @extends \Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory<\App\Entity\Address>
 */
final class AddressFactory extends PersistentProxyObjectFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     * @todo inject services if required
     */
    public function __construct()
    {
        // Empty function body must have at least a comment to explain why is empty.
        parent::__construct();
    }

    public static function class(): string
    {
        return Address::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'address1' => substr(self::faker()->streetAddress(), 0, 30),
            'address2' => self::faker()->text(30),
            'address3' => null,
            'city' => self::faker()->city(),
            'clientId' => self::faker()->randomNumber(),
            'country' => self::faker()->countryCode(),
            'id' => null,
            'name' => self::faker()->text(35),
            'postalCode' => self::faker()->postcode(),
            'state' => null,
            'taxIdentification' => null,
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Address $address): void {})
        ;
    }
}
