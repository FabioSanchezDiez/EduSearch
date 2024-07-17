<?php

namespace App\Controller;

use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api', name: 'api_')]
class UserController extends AbstractController
{
    #[Route('/users/register', name: 'users_create', methods: ['POST'])]
    public function registerUser(Request $request, UserService $userService): JsonResponse
    {
        $userData = json_decode($request->getContent(), true);
        $userService->registerUser($userData);

        return new JsonResponse(["success" => "Usuario creado correctamente"], Response::HTTP_CREATED);
    }
}