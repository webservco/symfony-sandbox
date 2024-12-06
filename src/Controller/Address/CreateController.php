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

            $this->addFlash('success', 'Address was created.');

            return $this->redirectToRoute('app_address_browse');
        }

        return $this->render(
            'address/create.html.twig',
            [
                /**
                 * Strange:
                 * if using:
                 * 'addressForm' => $form->createView(),
                 * (from video tutorial? probably deprecated?)
                 * then form errors are not displayed.
                 */
                'addressForm' => $form,
            ],
        );
    }

    /**
     * @param \Symfony\Component\Form\FormInterface<\App\Entity\Address|null> $form
     */
    private function createAddress(FormInterface $form): Address
    {
        /**
         * When the form is bound to a class ("data_class"),
         * `getData` returns an object of that class, otherwise an array.
         */
        $address = $form->getData();

        if (!$address instanceof Address) {
            throw new UnexpectedValueException('Data is not an instance of Address.');
        }

        return $address;
    }
}
