<?php

namespace App\Tests\Controller;

use App\Entity\Field;
use App\Entity\Program;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Zenstruck\Foundry\Test\ResetDatabase;

class GetUsersTest extends WebTestCase
{
    use ResetDatabase;
    private KernelBrowser $client;
    private UserRepository $userRepository;
    private EntityManagerInterface $em;
    private JWTTokenManagerInterface $jwtTokenManager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $container = static::getContainer();
        $this->userRepository = $container->get(UserRepository::class);
        $this->em = $container->get(EntityManagerInterface::class);
        $this->jwtTokenManager = $container->get(JWTTokenManagerInterface::class);
    }

    public function testGetUserWithProgram(): void
    {
        $field = new Field();
        $field->setId(Uuid::fromString('0edbed88-f546-4bee-b16a-035c16abc5b4'));
        $field->setName('Informática y Comunicaciones');
        $field->setDescription('Este campo incluye el desarrollo de hardware y software, redes de comunicación, ciberseguridad, inteligencia artificial y análisis de datos, facilitando la conectividad global y la innovación tecnológica en diversos sectores.');
        $field->setImage('https://firebasestorage.googleapis.com/v0/b/edusearch-1c3c8.appspot.com/o/Inform%C3%A1tica_-_EduSearch-NO-BG.png?alt=media&token=58c4d331-1500-4df8-8d68-996be82a447e');

        $this->em->persist($field);

        $program = new Program();
        $program->setId(Uuid::fromString('08743d2a-d22c-4272-b804-5c91d44dd079'));
        $program->setName('Técnico Superior en Administracion de Sistemas Informáticos en Red');
        $program->setDescription('La competencia general de este título consiste en configurar, administrar y mantener sistemas informáticos, garantizando la funcionalidad, la integridad de los recursos y servicios del sistema, con la calidad exigida y cumpliendo la reglamentación vigente.');
        $program->setPriorEducation('Para poder optar, es necesario contar con alguno de los siguientes títulos educativos: Bachillerato, certificado de haber superado todas las materias del Bachillerato, Formación Profesional de Grado Medio, Técnico/a Superior, Técnico Especialista o equivalente académico, Técnico/a de Artes Plásticas y Diseño según lo establecido en la Ley Orgánica de Educación, o una titulación universitaria o equivalente.');
        $program->setType('Formación Reglada');
        $program->setTag('Grado Superior');
        $program->setAdditionalInformation('https://www.juntadeandalucia.es/educacion/portals/web/formacion-profesional-andaluza/fp-grado-superior/detalle-titulo?idTitulo=50');

        $this->em->persist($program);

        $user = new User();
        $user->setId(Uuid::fromString('f0325753-b06f-475c-a166-7735e58ef1cb'));
        $user->setName('Fabio');
        $user->setEmail('fabio@gmail.com');
        $user->setPassword('$2y$13$JKAHm8CB0DjWgMpm2wXgoeEPiKvbumY6cTLKMpZcCf6uGI1Tz8or6');
        $user->setVerified(true);
        $user->setAddress('Granada');
        $user->setRoles(['ROLE_USER']);

        $this->em->persist($user);
        $this->em->flush();

        $jwtToken = $this->jwtTokenManager->create($user);

        $this->client->request(
            'POST',
            '/api/users/programs/enroll',
            [],
            [],
            ['HTTP_AUTHORIZATION' => 'Bearer ' . $jwtToken],
            json_encode(
                [
                    "email" => "fabio@gmail.com",
                    "programId" => "08743d2a-d22c-4272-b804-5c91d44dd079",
                ],
                JSON_THROW_ON_ERROR,
            ),
        );
        $response = $this->client->getResponse();

        $user = $this->userRepository->findOneByEmail('fabio@gmail.com');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotNull($user);
        $this->assertEquals($program, $user->getProgram());
    }
}