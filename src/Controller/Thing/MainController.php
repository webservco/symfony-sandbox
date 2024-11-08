<?php

declare(strict_types=1);

namespace App\Controller\Thing;

use App\Repository\ThingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use function array_rand;

final class MainController extends AbstractController
{
    #[Route('/things', 'things')]
    public function index(ThingRepository $repository): Response
    {
        $all = $repository->findAll();

        return $this->render(
            'thing/index.html.twig',
            [
                'key' => 'value',
                'thing' => $all[array_rand($all, 1)],
                'things' => $all,
                'totalStuff' => $repository->getTotal(),
            ],
        );
    }
}
