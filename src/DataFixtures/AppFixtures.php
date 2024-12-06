<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Factory\AddressFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class AppFixtures extends Fixture
{
    /**
     * @SuppressWarnings("PHPMD.StaticAccess")
     * @suppress PhanTypeInvalidCallableArraySize (it is array OR callable, phan...)
     */
    // @phpcs:ignore SlevomatCodingStandard.Functions.FunctionLength.FunctionLength
    public function load(ObjectManager $manager): void
    {
        // Avoid "unused parameter" error.
        $manager->clear();

        AddressFactory::createMany(256);

        // Load Users

        UserFactory::new(
            [
                'email' => 'superadmin@example.com',
                'plainPassword' => 'adminpass',
                'roles' => [
                    'ROLE_USER',
                    'ROLE_SUPER_ADMIN',

                ],
                'username' => 'superadmin',
            ],
        )->create();

        UserFactory::new([
            'email' => 'admin@example.com',
            'plainPassword' => 'adminpass',
            'roles' => [
                'ROLE_USER',
                'ROLE_ADMIN',
            ],
            'username' => 'admin',
        ])->create();

        UserFactory::new([
                'email' => 'moderatoradmin@example.com',
                'plainPassword' => 'adminpass',
                'roles' => [
                    'ROLE_USER',
                    'ROLE_MODERATOR',
                ],
                'username' => 'moderatoradmin',
        ])->create();

        UserFactory::new([
            'email' => 'tisha@symfonycasts.com',
            'plainPassword' => 'tishapass',
            'roles' => [
                'ROLE_USER',
            ],
            'username' => 'tisha',
        ])->create();

        $manager->flush();
    }
}
