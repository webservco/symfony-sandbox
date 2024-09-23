<?php

declare(strict_types=1);

namespace App\Controller\Address;

use App\Repository\AddressRepository;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BrowseController extends AbstractController
{
    #[Route('address/browse', name: 'app_address_browse')]
    public function browse(AddressRepository $repository, Request $request): Response
    {
        $queryBuilder = $repository->findAllCustom(null);
        $queryAdapter = new QueryAdapter($queryBuilder);
        $pagerfanta = new Pagerfanta($queryAdapter);
        $pagerfanta->setMaxPerPage(9);
        $pagerfanta->setCurrentPage($request->query->getInt('page', 1));

        return $this->render('address/browse.html.twig', ['pager' => $pagerfanta]);
    }
}
