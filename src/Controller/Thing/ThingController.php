<?php

declare(strict_types=1);

namespace App\Controller\Thing;

use App\Repository\ThingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/things')]
final class ThingController extends AbstractController
{
    public function __construct(private ThingRepository $repository)
    {
    }

    #[Route('/{id<\d+>}', name: 'app_thing_show')]
    public function show(int $id): Response
    {
        $thing = $this->repository->find($id);

        if ($thing === null) {
            throw $this->createNotFoundException('Thing not found.');
        }

        return $this->render('thing/show.html.twig', ['thing' => $thing]);
    }
}
