<?php

namespace App\Controller;

use App\Repository\InstitutionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api', name: 'api_')]
class InstitutionController extends AbstractController
{
    private const DATETIME_FORMAT = ['datetime_format' => 'Y-m-d'];

    public function __construct(private InstitutionRepository $institutionRepository, private SerializerInterface $serializer){}

    #[Route('/institutions/educational/{programId}', name: 'institutions_educational_by_program', methods: ['GET'])]
    public function institutionsEducationalByProgram(string $programId): Response
    {
        $institutions = $this->institutionRepository->findEducationalInstitutionsByProgram($programId);
        $data = $this->serializer->serialize($institutions, 'json', self::DATETIME_FORMAT);
        return new Response($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }
}
