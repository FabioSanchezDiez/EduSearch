<?php

namespace App\Tests\Controller;

use App\Entity\Field;
use App\Entity\Institution;
use App\Entity\Program;
use App\Repository\InstitutionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Zenstruck\Foundry\Test\ResetDatabase;

class GetInstitutionsTest extends WebTestCase
{
    use ResetDatabase;
    private KernelBrowser $client;
    private InstitutionRepository $institutionRepository;
    private EntityManagerInterface $em;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $container = static::getContainer();
        $this->institutionRepository = $container->get(InstitutionRepository::class);
        $this->em = $container->get(EntityManagerInterface::class);

    }

    public function testGetEducationalInstitutionsByProgram(): void
    {
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

        $institution = new Institution();
        $institution->setId(Uuid::fromString('77f8f054-dba7-4f49-8c9b-74960a59915a'));
        $institution->setName('IES Zaidín Vergeles');
        $institution->setDescription('Centro público');
        $institution->setProvince('Granada');
        $institution->setType('Educación');
        $institution->setLastUpdate(new \DateTime('2024-07-17'));
        $institution->addProgram($program);

        $this->em->persist($institution);

        $institution2 = new Institution();
        $institution2->setId(Uuid::fromString('5f78bcf8-ddba-4717-bb44-6d71420d1608'));
        $institution2->setName('IES Hermenegildo Lanz');
        $institution2->setDescription('Centro público');
        $institution2->setProvince('Granada');
        $institution2->setType('Educación');
        $institution2->setLastUpdate(new \DateTime('2024-07-17'));
        $institution2->addProgram($program);

        $this->em->persist($institution2);

        $this->em->flush();

        $this->client->request("GET", "/api/institutions/educational/2c0892fe-8a29-426b-8c18-e8fb92bf5868");
        $response = $this->client->getResponse();
        $content = $response->getContent();
        $institutions = json_decode($content, true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotNull($content);
        $this->assertCount(2, $institutions);
    }
}