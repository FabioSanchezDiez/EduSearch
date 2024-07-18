<?php

namespace App\Controller;

use App\Repository\SubjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api', name: 'api_')]
class SubjectController extends AbstractController
{
    public function __construct(private SubjectRepository $subjectRepository, private SerializerInterface $serializer){}

    #[Route('/subjects/program/{programId}', name: 'subjects_by_program', methods: ['GET'])]
    public function subjectsByProgram(string $programId): Response
    {
        $subjects = $this->subjectRepository->findByProgramId($programId);
        $data = $this->serializer->serialize($subjects, 'json');
        return new Response($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }
}
