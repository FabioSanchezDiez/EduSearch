<?php

namespace App\Tests\Controller;

use App\Entity\Feedback;
use App\Entity\Field;
use App\Entity\Institution;
use App\Entity\Program;
use App\Entity\Subject;
use App\Entity\User;
use App\Repository\FeedbackRepository;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Zenstruck\Foundry\Test\ResetDatabase;

class GetFeedbackTest extends WebTestCase
{
    use ResetDatabase;
    private KernelBrowser $client;
    private FeedbackRepository $feedbackRepository;
    private EntityManagerInterface $em;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $container = static::getContainer();
        $this->feedbackRepository = $container->get(FeedbackRepository::class);
        $this->em = $container->get(EntityManagerInterface::class);

    }

    public function testGetFeedbackByProgram(): void
    {
        $program = new Program();
        $program->setId(Uuid::fromString('2c0892fe-8a29-426b-8c18-e8fb92bf5868'));
        $program->setName('Técnico Superior en Desarrollo de Aplicaciones Multiplataforma');
        $program->setDescription('La competencia general de este título consiste en desarrollar, implantar, documentar y mantener aplicaciones informáticas multiplataforma, utilizando tecnologías y entornos de desarrollo específicos, garantizando el acceso a los datos de forma segura y cumpliendo los criterios de «usabilidad» y calidad exigidas en los estándares establecidos.');
        $program->setPriorEducation('Para poder optar, es necesario cumplir con uno de los siguientes requisitos educativos: poseer el título de Bachiller, Técnico Superior de Formación Profesional o un grado universitario, Técnico de Grado Medio de Formación Profesional o el título de Técnico o Técnica de Artes Plásticas y Diseño. Alternativamente, también podrás optar si has completado una oferta formativa de Grado C incluida en el ciclo formativo, un curso específico de formación preparatorio y gratuito para el acceso a ciclos de grado superior en centros autorizados, o has aprobado una prueba de acceso designada por la Administración educativa.');
        $program->setType('Formación Reglada');
        $program->setTag('Grado Superior');
        $program->setAdditionalInformation('https://www.juntadeandalucia.es/educacion/portals/web/formacion-profesional-andaluza/fp-grado-superior/detalle-titulo?idTitulo=51');

        $this->em->persist($program);

        $user = new User();
        $user->setId(Uuid::fromString('f0325753-b06f-475c-a166-7735e58ef1cb'));
        $user->setName('Example User');
        $user->setEmail('example@gmail.com');
        $user->setPassword('$2y$13$JKAHm8CB0DjWgMpm2wXgoeEPiKvbumY6cTLKMpZcCf6uGI1Tz8or6');
        $user->setVerified(true);
        $user->setAddress('Granada');
        $user->setRoles(['ROLE_USER']);

        $this->em->persist($user);

        $feedback = new Feedback();
        $feedback->setId(Uuid::fromString('c39cf262-4b3f-4821-8f39-5a3a2fe07358'));
        $feedback->setFeedback('Curso muy completo si te quieres dedicar a la programación, completamente recomendado para todos aquellos que quieran aprender desde las bases de la programción hasta como desarrollar aplicaciones completas.');
        $feedback->setUser($user);
        $feedback->setProgram($program);

        $this->em->persist($feedback);
        $this->em->flush();

        $this->client->request("GET", "/api/feedback/program/2c0892fe-8a29-426b-8c18-e8fb92bf5868");
        $response = $this->client->getResponse();
        $content = $response->getContent();
        $feedback = json_decode($content, true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotNull($content);
        $this->assertCount(1, $feedback);

        $feedback = $this->feedbackRepository->find('c39cf262-4b3f-4821-8f39-5a3a2fe07358');
        $this->assertNotNull($feedback);
        $this->assertEquals('Curso muy completo si te quieres dedicar a la programación, completamente recomendado para todos aquellos que quieran aprender desde las bases de la programción hasta como desarrollar aplicaciones completas.', $feedback->getFeedback());
        $this->assertEquals($user, $feedback->getUser());
        $this->assertEquals($program, $feedback->getProgram());
    }

    public function testGetFeedbackBySubject(): void
    {
        $subject = new Subject();
        $subject->setId(Uuid::fromString('1b2a7bf8-e997-4df5-8ec1-9408e00c9504'));
        $subject->setName('Lenguajes de marcas y sistemas de gestión de información');
        $subject->setDescription('El módulo profesional \"Lenguajes de marcas y sistemas de gestión de información\" enseña a reconocer y utilizar lenguajes de marcas para la transmisión y presentación de información web, así como a gestionar información en sistemas empresariales. Los estudiantes aprenden a identificar características y ventajas de lenguajes de marcas, utilizar HTML y CSS para crear y validar documentos web, manipular documentos mediante scripts de cliente, establecer mecanismos de validación y conversión de documentos para el intercambio de información, y gestionar información en bases de datos relacionales y nativas. Además, se abordan la instalación, administración y configuración de sistemas de gestión empresarial, integrando módulos y asegurando el acceso seguro a la información.');

        $this->em->persist($subject);

        $user = new User();
        $user->setId(Uuid::fromString('f0325753-b06f-475c-a166-7735e58ef1cb'));
        $user->setName('Example User');
        $user->setEmail('example@gmail.com');
        $user->setPassword('$2y$13$JKAHm8CB0DjWgMpm2wXgoeEPiKvbumY6cTLKMpZcCf6uGI1Tz8or6');
        $user->setVerified(true);
        $user->setAddress('Granada');
        $user->setRoles(['ROLE_USER']);

        $this->em->persist($user);

        $feedback = new Feedback();
        $feedback->setId(Uuid::fromString('c39cf262-4b3f-4821-8f39-5a3a2fe07358'));
        $feedback->setFeedback('Feedback de prueba');
        $feedback->setUser($user);
        $feedback->setSubject($subject);

        $this->em->persist($feedback);
        $this->em->flush();

        $this->client->request("GET", "/api/feedback/subject/1b2a7bf8-e997-4df5-8ec1-9408e00c9504");
        $response = $this->client->getResponse();
        $content = $response->getContent();
        $feedback = json_decode($content, true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotNull($content);
        $this->assertCount(1, $feedback);

        $feedback = $this->feedbackRepository->find('c39cf262-4b3f-4821-8f39-5a3a2fe07358');
        $this->assertNotNull($feedback);
        $this->assertEquals('Feedback de prueba', $feedback->getFeedback());
        $this->assertEquals($user, $feedback->getUser());
        $this->assertEquals($subject, $feedback->getSubject());
    }

    public function testGetFeedbackByInstitution(): void
    {
        $institution = new Institution();
        $institution->setId(Uuid::fromString('5f78bcf8-ddba-4717-bb44-6d71420d1608'));
        $institution->setName('IES Hermenegildo Lanz');
        $institution->setDescription('Centro público');
        $institution->setProvince('Granada');
        $institution->setType('Educación');
        $institution->setLastUpdate(new \DateTime('2024-07-17'));

        $this->em->persist($institution);

        $user = new User();
        $user->setId(Uuid::fromString('f0325753-b06f-475c-a166-7735e58ef1cb'));
        $user->setName('Example User');
        $user->setEmail('example@gmail.com');
        $user->setPassword('$2y$13$JKAHm8CB0DjWgMpm2wXgoeEPiKvbumY6cTLKMpZcCf6uGI1Tz8or6');
        $user->setVerified(true);
        $user->setAddress('Granada');
        $user->setRoles(['ROLE_USER']);

        $this->em->persist($user);

        $feedback = new Feedback();
        $feedback->setId(Uuid::fromString('c39cf262-4b3f-4821-8f39-5a3a2fe07358'));
        $feedback->setFeedback('Feedback de prueba');
        $feedback->setUser($user);
        $feedback->setInstitution($institution);

        $this->em->persist($feedback);
        $this->em->flush();

        $this->client->request("GET", "/api/feedback/institution/5f78bcf8-ddba-4717-bb44-6d71420d1608");
        $response = $this->client->getResponse();
        $content = $response->getContent();
        $feedback = json_decode($content, true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotNull($content);
        $this->assertCount(1, $feedback);

        $feedback = $this->feedbackRepository->find('c39cf262-4b3f-4821-8f39-5a3a2fe07358');
        $this->assertNotNull($feedback);
        $this->assertEquals('Feedback de prueba', $feedback->getFeedback());
        $this->assertEquals($user, $feedback->getUser());
        $this->assertEquals($institution, $feedback->getInstitution());
    }
}