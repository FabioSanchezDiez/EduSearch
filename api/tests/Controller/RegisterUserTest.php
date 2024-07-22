<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Zenstruck\Foundry\Test\ResetDatabase;

class RegisterUserTest extends WebTestCase
{
    use ResetDatabase;
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
        $this->assertEquals("Granada", $user->getAddress());
        $this->assertFalse($user->isVerified());
        $this->assertContains("ROLE_USER", $user->getRoles());
    }

    public function testRegisterUserAndVerify(): void
    {
        $this->client->request(
            'POST',
            '/api/users/register',
            [],
            [],
            [],
            json_encode(
                [
                    "name" => "Verified User",
                    "email" => "verifieduser@test.com",
                    "password" => "password",
                    "address" => "Granada"
                ],
                JSON_THROW_ON_ERROR,
            ),
        );

        $response = $this->client->getResponse();

        $this->assertEquals(201, $response->getStatusCode());

        $user = $this->userRepository->findOneBy(["email" => "verifieduser@test.com"]);

        $this->client->request("PUT", "/api/users/confirm/" . $user->getToken());

        $response = $this->client->getResponse();

        $this->assertEquals(200, $response->getStatusCode());

        $userUpdated = $this->userRepository->findOneBy(["email" => "verifieduser@test.com"]);

        $this->assertNull($userUpdated->getToken());
        $this->assertTrue($userUpdated->isVerified());
    }
}
