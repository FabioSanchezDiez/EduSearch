<?php

namespace App\Controller;

use App\Repository\FieldRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api', name: 'api_')]
class FieldController extends AbstractController
{

    public function __construct(private FieldRepository $fieldRepository, private SerializerInterface $serializer){}

    #[Route('/fields', name: 'fields', methods: ['GET'])]
    public function index(): Response
    {
        $fields = $this->fieldRepository->findAll();
        $data = $this->serializer->serialize($fields, 'json');
        return new Response($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }
}
