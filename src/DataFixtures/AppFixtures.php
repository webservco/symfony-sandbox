<?php

namespace App\DataFixtures;

use App\Entity\Address;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use function sprintf;
use function time;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $address = $this->createAddress();

        $manager->persist($address);

        $manager->flush();
    }

    private function createAddress(): Address
    {
        return new Address(
            null,
            117032,
            sprintf('Test Name %d', time()),
            'Test street 123',
            'Line 2',
            'Line 3',
            'Milano',
            '20129',
            'MI',
            'IT',
            'TX123456',
        );
    }
}
