<?php

declare(strict_types=1);

namespace App\Controller\Address;

use App\Entity\Address;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use UnexpectedValueException;

use function sprintf;
use function time;

final class CreateController extends AbstractController
{
    #[Route('address/create', name: 'app_address_create')]
    public function create(EntityManagerInterface $entityManager): Response
    {
        $address = $this->createAddress();

        $entityManager->persist($address);
        $entityManager->flush();

        $id = $address->getId();
        if ($id === null) {
            throw new UnexpectedValueException('Id cannot be null.');
        }

        return new Response(
            sprintf(
                'Created address "%s" with id "%d"',
                $address->name,
                $id,
            ),
        );
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
