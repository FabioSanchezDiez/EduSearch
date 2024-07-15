<?php

namespace App\Tests\Controller;

use App\Entity\Field;
use App\Repository\FieldRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Zenstruck\Foundry\Test\ResetDatabase;

class GetFieldsTest extends WebTestCase
{
    use ResetDatabase;
    private KernelBrowser $client;
    private FieldRepository $fieldRepository;
    private EntityManagerInterface $em;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $container = static::getContainer();
        $this->fieldRepository = $container->get(FieldRepository::class);
        $this->em = $container->get(EntityManagerInterface::class);

    }

    public function testGetAllFields(): void
    {
        $field = new Field();
        $field->setName('Informática y Comunicaciones');
        $field->setDescription('Este campo incluye el desarrollo de hardware y software, redes de comunicación, ciberseguridad, inteligencia artificial y análisis de datos, facilitando la conectividad global y la innovación tecnológica en diversos sectores.');
        $field->setImage('https://firebasestorage.googleapis.com/v0/b/edusearch-1c3c8.appspot.com/o/Inform%C3%A1tica_-_EduSearch-NO-BG.png?alt=media&token=58c4d331-1500-4df8-8d68-996be82a447e');

        $this->em->persist($field);

        $field2 = new Field();
        $field2->setName('Sanidad');
        $field2->setDescription('Este campo incluye la atención médica, enfermería, salud pública, investigación biomédica, gestión sanitaria, farmacia, tecnología médica, rehabilitación y fisioterapia, promoción de la salud, y la prevención de enfermedades, garantizando el bienestar, el tratamiento efectivo y la mejora continua de la salud de la población.');
        $field2->setImage('https://firebasestorage.googleapis.com/v0/b/edusearch-1c3c8.appspot.com/o/Salud_-_EduSearch-NO-BG.png?alt=media&token=e65f3cd0-361f-41ab-806d-c887d26c92c1');

        $this->em->persist($field2);

        $field3 = new Field();
        $field3->setName('Servicios Socioculturales y a la Comunidad');
        $field3->setDescription('Este campo incluye la intervención social, gestión cultural, animación sociocultural, trabajo comunitario, atención a la diversidad, educación social, servicios de bienestar, promoción de la igualdad y la inclusión, y el desarrollo de programas comunitarios, fortaleciendo la cohesión social y mejorando la calidad de vida de las comunidades.');
        $field3->setImage('https://firebasestorage.googleapis.com/v0/b/edusearch-1c3c8.appspot.com/o/Servicios_Socioculturales_-_EduSearch-NO-BG.png?alt=media&token=0deeadc1-cc93-4c68-b1ed-a50a0b35b05f');

        $this->em->persist($field3);
        $this->em->flush();

        $this->client->request("GET", "/api/fields");
        $response = $this->client->getResponse();
        $content = $response->getContent();
        $fields = json_decode($content, true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotNull($content);
        $this->assertCount(3, $fields);

        //Sort by name
        usort($fields, function($a, $b) {
            return strcmp($a['name'], $b['name']);
        });

        $this->assertEquals('Informática y Comunicaciones', $fields[0]['name']);
        $this->assertEquals('Este campo incluye el desarrollo de hardware y software, redes de comunicación, ciberseguridad, inteligencia artificial y análisis de datos, facilitando la conectividad global y la innovación tecnológica en diversos sectores.', $fields[0]['description']);
        $this->assertEquals('https://firebasestorage.googleapis.com/v0/b/edusearch-1c3c8.appspot.com/o/Inform%C3%A1tica_-_EduSearch-NO-BG.png?alt=media&token=58c4d331-1500-4df8-8d68-996be82a447e', $fields[0]['image']);

        $this->assertEquals('Sanidad', $fields[1]['name']);
        $this->assertEquals('Este campo incluye la atención médica, enfermería, salud pública, investigación biomédica, gestión sanitaria, farmacia, tecnología médica, rehabilitación y fisioterapia, promoción de la salud, y la prevención de enfermedades, garantizando el bienestar, el tratamiento efectivo y la mejora continua de la salud de la población.', $fields[1]['description']);
        $this->assertEquals('https://firebasestorage.googleapis.com/v0/b/edusearch-1c3c8.appspot.com/o/Salud_-_EduSearch-NO-BG.png?alt=media&token=e65f3cd0-361f-41ab-806d-c887d26c92c1', $fields[1]['image']);

        $this->assertEquals('Servicios Socioculturales y a la Comunidad', $fields[2]['name']);
        $this->assertEquals('Este campo incluye la intervención social, gestión cultural, animación sociocultural, trabajo comunitario, atención a la diversidad, educación social, servicios de bienestar, promoción de la igualdad y la inclusión, y el desarrollo de programas comunitarios, fortaleciendo la cohesión social y mejorando la calidad de vida de las comunidades.', $fields[2]['description']);
        $this->assertEquals('https://firebasestorage.googleapis.com/v0/b/edusearch-1c3c8.appspot.com/o/Servicios_Socioculturales_-_EduSearch-NO-BG.png?alt=media&token=0deeadc1-cc93-4c68-b1ed-a50a0b35b05f', $fields[2]['image']);
    }
}