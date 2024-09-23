<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Factory\AddressFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class AppFixtures extends Fixture
{
    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function load(ObjectManager $manager): void
    {
        // Avoid "unused parameter" error.
        $manager->clear();

        AddressFactory::createMany(256);
    }
}
