<?php

declare(strict_types=1);

namespace App\Controller\Address;

use App\Entity\Address;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use UnexpectedValueException;

use function dd;
use function is_string;

final class EditController extends AbstractController
{
    /**
     * Complete edit using symfony forms
     */
    #[Route('/address/edit/{id<\d+>}', name: 'app_address_edit')]
    public function edit(Address $address): Response
    {
        dd($address);
        /** @todo */
    }

    /**
     * Minimal edit without using symfony forms.
     * Form is displayed in the show page.
     */
    #[Route('/address/edit_name/{id<\d+>}', name: 'app_address_edit_name', methods: ['POST'])]
    public function editName(Address $address, EntityManagerInterface $entityManager, Request $request): Response
    {
        $name = $request->request->get('name');
        if (!is_string($name)) {
            throw new UnexpectedValueException('Name must be a string');
        }
        $address->name = $name;

        $entityManager->flush();

        $this->addFlash('success', 'The address has been edited.');

        return $this->redirectToRoute('app_address_show', ['id' => $address->getId()]);
    }
}
