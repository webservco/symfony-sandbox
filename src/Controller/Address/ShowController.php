<?php

declare(strict_types=1);

namespace App\Controller\Address;

use App\Repository\AddressRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ShowController extends AbstractController
{
    #[Route('address/{id<\d+>}', name: 'app_address_show')]
    public function show(int $id, AddressRepository $repository): Response
    {
        return $this->render('address/show.html.twig', ['item' => $repository->find($id)]);
    }
}
