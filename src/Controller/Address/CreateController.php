<?php

declare(strict_types=1);

namespace App\Controller\Address;

use App\Entity\Address;
use App\Form\AddressFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use UnexpectedValueException;

use function is_array;

final class CreateController extends AbstractController
{
    #[Route('address/create', name: 'app_address_create')]
    public function create(EntityManagerInterface $entityManager, Request $request): Response
    {
        $form = $this->createForm(AddressFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $address = $this->createAddress($form);

            $entityManager->persist($address);
            $entityManager->flush();

            $id = $address->getId();
            if ($id === null) {
                throw new UnexpectedValueException('Id cannot be null.');
            }

            return $this->redirectToRoute('app_address_browse');
        }

        return $this->render(
            'address/create.html.twig',
            [
                'addressForm' => $form->createView(),
            ],
        );
    }

    private function createAddress(FormInterface $form): Address
    {
        $data = $form->getData();

        if (!is_array($data)) {
            throw new UnexpectedValueException('Form data is not an array.');
        }

        return new Address(
            null,
            (int) $data['clientId'],
            $data['name'],
            $data['address1'],
            null,
            null,
            $data['city'],
            $data['postalCode'],
            $data['state'],
            $data['country'],
            null,
        );
    }
}
