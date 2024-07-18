<?php

namespace App\Controller;

use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api', name: 'api_')]
class ProgramController extends AbstractController
{
    public function __construct(private ProgramRepository $programRepository, private SerializerInterface $serializer){}

    #[Route('/programs', name: 'programs', methods: ['GET'])]
    public function programs(): Response
    {
        $fields = $this->programRepository->findAll();
        $data = $this->serializer->serialize($fields, 'json');
        return new Response($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }
}
