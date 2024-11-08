<?php

declare(strict_types=1);

namespace App\Controller\Thing;

use App\Repository\ThingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/things')]
final class ApiController extends AbstractController
{
    public function __construct(private ThingRepository $repository)
    {
    }

    #[Route('/{id<\d+>}', methods: ['GET'])]
    public function get(int $id): Response
    {
        $thing = $this->repository->find($id);

        if ($thing === null) {
            throw $this->createNotFoundException('Thing not found.');
        }

        return $this->json($thing);
    }

    #[Route('', methods: ['GET'])]
    public function getCollection(): Response
    {
        // dump and die
        //  dd($logger);

        $data = $this->repository->findAll();

        return $this->json($data);
    }
}
