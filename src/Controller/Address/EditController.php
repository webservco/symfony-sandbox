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

use function is_string;

final class EditController extends AbstractController
{
    #[Route('/address/edit/{id<\d+>}', name: 'app_address_edit', methods: ['POST'])]
    public function edit(Address $address, EntityManagerInterface $entityManager, Request $request): Response
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
