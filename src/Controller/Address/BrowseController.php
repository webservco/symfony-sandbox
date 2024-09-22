<?php

declare(strict_types=1);

namespace App\Controller\Address;

use App\Repository\AddressRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BrowseController extends AbstractController
{
    #[Route('address/browse', name: 'app_address_browse')]
    public function browse(AddressRepository $repository): Response
    {
        $items = $repository->findAll();

        return $this->render('address/browse.html.twig', ['items' => $items]);
    }
}
