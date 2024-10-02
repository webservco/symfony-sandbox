<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use UnexpectedValueException;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends \Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory<\App\Entity\User>
 */
final class UserFactory extends PersistentProxyObjectFactory
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
        parent::__construct();

        // inject services if required (https://github.com/zenstruck/foundry#factories-as-services)
    }

    public static function class(): string
    {
        return User::class;
    }

    /**
     * @return array<string,array<string>|string>
     */
    protected function defaults(): array
    {
        return [
            // add your default values here (https://github.com/zenstruck/foundry#model-factories)
            'email' => self::faker()->email(),
            'plainPassword' => 'qwerty',
            'roles' => [
                'ROLE_USER',
            ],
        ];
    }

    protected function initialize(): static
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
             ->afterInstantiate(function (User $user): void {
                 $plainPassword = $user->getPlainPassword();
                if ($plainPassword === null) {
                    throw new UnexpectedValueException('Plain password is null.');
                }
                 $hashedPassword = $this->passwordHasher
                     ->hashPassword($user, $plainPassword);

                 $user->setPassword($hashedPassword);
             });
    }
}
