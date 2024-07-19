<?php

namespace App\Controller;

use App\Repository\FeedbackRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api', name: 'api_')]
class FeedbackController extends AbstractController
{
    public function __construct(private FeedbackRepository $feedbackRepository, private SerializerInterface $serializer){}

    #[Route('/feedback/program/{programId}', name: 'feedback_by_program', methods: ['GET'])]
    public function feedbackByProgram(string $programId): Response
    {
        $feedback = $this->feedbackRepository->findBy(['program' => $programId]);
        $data = $this->serializer->serialize($feedback, 'json');
        return new Response($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }
    
    #[Route('/feedback/subject/{subjectId}', name: 'feedback_by_subject', methods: ['GET'])]
    public function feedbackBySubject(string $subjectId): Response
    {
        $feedback = $this->feedbackRepository->findBy(['subject' => $subjectId]);
        $data = $this->serializer->serialize($feedback, 'json');
        return new Response($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    #[Route('/feedback/institution/{institutionId}', name: 'feedback_by_institution', methods: ['GET'])]
    public function feedbackByInstitution(string $institutionId): Response
    {
        $feedback = $this->feedbackRepository->findBy(['institution' => $institutionId]);
        $data = $this->serializer->serialize($feedback, 'json');
        return new Response($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }
}
