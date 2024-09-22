<?php

declare(strict_types=1);

namespace App\Controller\Address;

use App\Entity\Address;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ShowController extends AbstractController
{
    /**
     * This uses "ParamConverter":
     * Entity is used as method parameter.
     * More verbose method:
     * param: AddressRepository $repository
     * $item = $repository->find($id);
     * if ($item === null) {
     * throw $this->createNotFoundException('Address not found.');
     * }
     */
    #[Route('address/{id<\d+>}', name: 'app_address_show')]
    public function show(Address $item): Response
    {
        return $this->render('address/show.html.twig', ['item' => $item]);
    }
}
