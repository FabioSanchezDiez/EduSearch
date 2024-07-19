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
        $programs = $this->feedbackRepository->findBy(['program' => $programId]);
        $data = $this->serializer->serialize($programs, 'json');
        return new Response($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }
}
