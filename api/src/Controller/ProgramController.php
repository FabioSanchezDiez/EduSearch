<?php

namespace App\Controller;

use App\Repository\FieldRepository;
use App\Repository\ProgramRepository;
use App\Repository\UserRepository;
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

    #[Route('/programs/field/name/{fieldName}', name: 'programs_by_field_name', methods: ['GET'])]
    public function programsByFieldName(string $fieldName, FieldRepository $fieldRepository): Response
    {
        $fieldId = $fieldRepository->findOneBy(['name' => str_replace('-', ' ',$fieldName)])->getId();
        $programs = $this->programRepository->findBy(['field' => $fieldId]);
        $data = $this->serializer->serialize($programs, 'json');
        return new Response($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    #[Route('/programs/{id}', name: 'programs_by_id', methods: ['GET'])]
    public function programById(string $id): Response
    {
        $program = $this->programRepository->find($id);
        $data = $this->serializer->serialize($program, 'json');
        return new Response($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    #[Route('/programs/name/{name}', name: 'programs_by_name', methods: ['GET'])]
    public function programByName(string $name): Response
    {
        $program = $this->programRepository->findOneBy(['name' => str_replace('-', ' ',$name)]);
        $data = $this->serializer->serialize($program, 'json');
        return new Response($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    #[Route('/programs/user/{email}', name: 'programs_by_user', methods: ['GET'])]
    public function programByUser(string $email, UserRepository $userRepository): Response
    {
        $user = $userRepository->findOneBy(['email' => $email]);
        $program = $this->programRepository->find($user->getProgram()?->getId());
        $data = $this->serializer->serialize($program, 'json');
        return new Response($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }
}
