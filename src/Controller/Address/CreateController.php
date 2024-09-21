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
        $name = $address->getName();
        if ($name === null) {
            throw new UnexpectedValueException('Name cannot be null.');
        }

        return new Response(
            sprintf(
                'Created address "%s" with id "%d"',
                $name,
                $id,
            ),
        );
    }

    private function createAddress(): Address
    {
        $address = new Address();
        $address->setClientId(117032);
        $address->setName(sprintf('Test Name %d', time()));
        $address->setAddress1('Test street 123');
        $address->setAddress2('Line 2');
        $address->setAddress3('Line 3');
        $address->setCity('Milano');
        $address->setPostalCode('20129');
        $address->setState('MI');
        $address->setCountry('IT');
        $address->setTaxIdentification('TX123456');

        return $address;
    }
}
