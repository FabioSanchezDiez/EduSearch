<?php

namespace App\Service;

use App\Entity\Program;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher, private UserRepository $userRepository, private EmailService $emailService, private EntityManagerInterface $entityManager){}

    public function registerUser(array $userData): void
    {
        $user = new User();
        $user->setId(Uuid::uuid4());
        $user->setName($userData['name']);
        $user->setEmail($userData['email']);
        $user->setAddress($userData['address']);
        $user->setVerified(false);
        $user->setRoles(["ROLE_USER"]);
        $user->setToken($this->generateConfirmationToken());

        $hashedPassword = $this->passwordHasher->hashPassword($user, $userData['password']);
        $user->setPassword($hashedPassword);

        $this->entityManager->beginTransaction();
        try {
            $this->userRepository->createOrUpdateUser($user);
            $this->emailService->sendConfirmationEmail($user->getName(), $user->getEmail(), $user->getToken());
            $this->entityManager->commit();
        } catch (\Exception $e) {
            $this->entityManager->getConnection()->rollBack();
            throw $e;
        }
    }

    public function confirmUser(string $token): bool
    {
        $user = $this->userRepository->findOneBy(["token" => $token]);
        if(!$user) return false;
        $user->setVerified(true);
        $user->setToken(null);
        $this->entityManager->flush();
        return true;
    }

    public function enrollUser(array $userData): void
    {
        $programRepository = $this->entityManager->getRepository(Program::class);

        $user = $this->userRepository->findOneBy(["email" => $userData["email"]]);
        $program = $programRepository->find($userData["programId"]);

        if ($user && $program) {
            $user->setProgram($program);
            $this->userRepository->createOrUpdateUser($user);
        } else {
            throw new \Exception("Usuario o programa no encontrado");
        }
    }

    private function generateConfirmationToken(): string
    {
        return bin2hex(random_bytes(32));
    }
}