<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterUserTest extends WebTestCase
{
    private KernelBrowser $client;
    private UserRepository $userRepository;


    protected function setUp(): void
    {
        $this->client = static::createClient();
        $container = static::getContainer();
        $this->userRepository = $container->get(UserRepository::class);

    }

    public function testRegisterBasicUser(): void
    {
        $this->client->request(
            'POST',
            '/api/users/register',
            [],
            [],
            [],
            json_encode(
                [
                    "name" => "Basic User",
                    "email" => "basicuser@test.com",
                    "password" => "password",
                    "address" => "Granada"
                ],
                JSON_THROW_ON_ERROR,
            ),
        );
        $response = $this->client->getResponse();
        $user = $this->userRepository->findOneBy(["email" => "basicuser@test.com"]);

        $this->assertNotNull($user);
        $this->assertNotNull($user->getToken());
        $this->assertEquals(201, $response->getStatusCode());
        $this->assertEquals("Basic User", $user->getName());
        $this->assertEquals("basicuser@test.com", $user->getEmail());
        $this->assertFalse($user->isVerified());
        $this->assertContains("ROLE_USER", $user->getRoles());
    }
}
