<?php

declare(strict_types=1);

namespace App\Controller\Development;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TablerController extends AbstractController
{
    #[Route('development/tabler/combo')]
    public function combo(): Response
    {
        return $this->render('development/tabler/combo.html.twig', []);
    }
}
