<?php

namespace App\Tests\Controller;

use App\Entity\Field;
use App\Entity\Program;
use App\Entity\User;
use App\Repository\FeedbackRepository;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Zenstruck\Foundry\Test\ResetDatabase;

class CreateFeedbackTest extends WebTestCase
{
    use ResetDatabase;
    private KernelBrowser $client;
    private FeedbackRepository $feedbackRepository;
    private EntityManagerInterface $em;
    private JWTTokenManagerInterface $jwtTokenManager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $container = static::getContainer();
        $this->feedbackRepository = $container->get(FeedbackRepository::class);
        $this->em = $container->get(EntityManagerInterface::class);
        $this->jwtTokenManager = $container->get(JWTTokenManagerInterface::class);
    }

    public function testSubmitProgramFeedback(): void
    {
        $user = new User();
        $user->setId(Uuid::fromString('f0325753-b06f-475c-a166-7735e58ef1cb'));
        $user->setName('Fabio');
        $user->setEmail('fabio@gmail.com');
        $user->setPassword('$2y$13$JKAHm8CB0DjWgMpm2wXgoeEPiKvbumY6cTLKMpZcCf6uGI1Tz8or6');
        $user->setVerified(true);
        $user->setAddress('Granada');
        $user->setRoles(['ROLE_USER']);

        $this->em->persist($user);

        $field = new Field();
        $field->setId(Uuid::fromString('0edbed88-f546-4bee-b16a-035c16abc5b4'));
        $field->setName('Informática y Comunicaciones');
        $field->setDescription('Este campo incluye el desarrollo de hardware y software, redes de comunicación, ciberseguridad, inteligencia artificial y análisis de datos, facilitando la conectividad global y la innovación tecnológica en diversos sectores.');
        $field->setImage('https://firebasestorage.googleapis.com/v0/b/edusearch-1c3c8.appspot.com/o/Inform%C3%A1tica_-_EduSearch-NO-BG.png?alt=media&token=58c4d331-1500-4df8-8d68-996be82a447e');

        $this->em->persist($field);

        $program = new Program();
        $program->setId(Uuid::fromString('2c0892fe-8a29-426b-8c18-e8fb92bf5868'));
        $program->setName('Técnico Superior en Desarrollo de Aplicaciones Multiplataforma');
        $program->setDescription('La competencia general de este título consiste en desarrollar, implantar, documentar y mantener aplicaciones informáticas multiplataforma, utilizando tecnologías y entornos de desarrollo específicos, garantizando el acceso a los datos de forma segura y cumpliendo los criterios de «usabilidad» y calidad exigidas en los estándares establecidos.');
        $program->setPriorEducation('Para poder optar, es necesario cumplir con uno de los siguientes requisitos educativos: poseer el título de Bachiller, Técnico Superior de Formación Profesional o un grado universitario, Técnico de Grado Medio de Formación Profesional o el título de Técnico o Técnica de Artes Plásticas y Diseño. Alternativamente, también podrás optar si has completado una oferta formativa de Grado C incluida en el ciclo formativo, un curso específico de formación preparatorio y gratuito para el acceso a ciclos de grado superior en centros autorizados, o has aprobado una prueba de acceso designada por la Administración educativa.');
        $program->setType('Formación Reglada');
        $program->setTag('Grado Superior');
        $program->setAdditionalInformation('https://www.juntadeandalucia.es/educacion/portals/web/formacion-profesional-andaluza/fp-grado-superior/detalle-titulo?idTitulo=51');
        $program->setField($field);

        $this->em->persist($program);
        $this->em->flush();

        $jwtToken = $this->jwtTokenManager->create($user);

        $this->client->request(
            'POST',
            '/api/feedback/create',
            [],
            [],
            ['HTTP_AUTHORIZATION' => 'Bearer ' . $jwtToken],
            json_encode(
                [
                    "feedback" => "Curso muy completo si te quieres dedicar a la programación, completamente recomendado para todos aquellos que quieran aprender desde las bases de la programación hasta como desarrollar aplicaciones completas",
                    "user" => "fabio@gmail.com",
                    "program" => "2c0892fe-8a29-426b-8c18-e8fb92bf5868"
                ],
                JSON_THROW_ON_ERROR,
            ),
        );
        $response = $this->client->getResponse();

        $feedback = $this->feedbackRepository->findOneBy(['feedback' => 'Curso muy completo si te quieres dedicar a la programación, completamente recomendado para todos aquellos que quieran aprender desde las bases de la programación hasta como desarrollar aplicaciones completas']);

        $this->assertNotNull($feedback);
        $this->assertEquals(201, $response->getStatusCode());
        $this->assertEquals($user, $feedback->getUser());
        $this->assertEquals($program, $feedback->getProgram());
        $this->assertNull($feedback->getSubject());
        $this->assertNull($feedback->getInstitution());
    }
}