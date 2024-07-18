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
        $programs = $this->programRepository->findAll();
        $data = $this->serializer->serialize($programs, 'json');
        return new Response($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    #[Route('/programs/field/{fieldId}', name: 'programs_by_field', methods: ['GET'])]
    public function programsByField(string $fieldId): Response
    {
        $programs = $this->programRepository->findBy(['field' => $fieldId]);
        $data = $this->serializer->serialize($programs, 'json');
        return new Response($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }
}
