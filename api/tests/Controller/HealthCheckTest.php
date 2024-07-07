<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HealthCheckTest extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function testHealthCheck(): void
    {
        $this->client->request("GET", "/health-check");
        $response = $this->client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }
}
