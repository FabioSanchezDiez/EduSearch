<?php

namespace App\Tests\Controller;

use App\Entity\Program;
use App\Repository\ProgramRepository;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Zenstruck\Foundry\Test\ResetDatabase;

class GetProgramsTest extends WebTestCase
{
    use ResetDatabase;
    private KernelBrowser $client;
    private ProgramRepository $programRepository;
    private EntityManagerInterface $em;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $container = static::getContainer();
        $this->programRepository = $container->get(ProgramRepository::class);
        $this->em = $container->get(EntityManagerInterface::class);

    }

    public function testGetAllPrograms(): void
    {
        $program = new Program();
        $program->setId(Uuid::fromString('08743d2a-d22c-4272-b804-5c91d44dd079'));
        $program->setName('Técnico Superior en Administracion de Sistemas Informáticos en Red');
        $program->setDescription('La competencia general de este título consiste en configurar, administrar y mantener sistemas informáticos, garantizando la funcionalidad, la integridad de los recursos y servicios del sistema, con la calidad exigida y cumpliendo la reglamentación vigente.');
        $program->setPriorEducation('Para poder optar, es necesario contar con alguno de los siguientes títulos educativos: Bachillerato, certificado de haber superado todas las materias del Bachillerato, Formación Profesional de Grado Medio, Técnico/a Superior, Técnico Especialista o equivalente académico, Técnico/a de Artes Plásticas y Diseño según lo establecido en la Ley Orgánica de Educación, o una titulación universitaria o equivalente.');
        $program->setType('Formación Reglada');
        $program->setAdditionalInformation('https://www.juntadeandalucia.es/educacion/portals/web/formacion-profesional-andaluza/fp-grado-superior/detalle-titulo?idTitulo=50');

        $this->em->persist($program);

        $program2 = new Program();
        $program2->setId(Uuid::fromString('2c0892fe-8a29-426b-8c18-e8fb92bf5868'));
        $program2->setName('Técnico Superior en Desarrollo de Aplicaciones Multiplataforma');
        $program2->setDescription('La competencia general de este título consiste en desarrollar, implantar, documentar y mantener aplicaciones informáticas multiplataforma, utilizando tecnologías y entornos de desarrollo específicos, garantizando el acceso a los datos de forma segura y cumpliendo los criterios de «usabilidad» y calidad exigidas en los estándares establecidos.');
        $program2->setPriorEducation('Para poder optar, es necesario cumplir con uno de los siguientes requisitos educativos: poseer el título de Bachiller, Técnico Superior de Formación Profesional o un grado universitario, Técnico de Grado Medio de Formación Profesional o el título de Técnico o Técnica de Artes Plásticas y Diseño. Alternativamente, también podrás optar si has completado una oferta formativa de Grado C incluida en el ciclo formativo, un curso específico de formación preparatorio y gratuito para el acceso a ciclos de grado superior en centros autorizados, o has aprobado una prueba de acceso designada por la Administración educativa.');
        $program2->setType('Formación Reglada');
        $program2->setAdditionalInformation('https://www.juntadeandalucia.es/educacion/portals/web/formacion-profesional-andaluza/fp-grado-superior/detalle-titulo?idTitulo=51');

        $this->em->persist($program2);
        $this->em->flush();

        $this->client->request("GET", "/api/programs");
        $response = $this->client->getResponse();
        $content = $response->getContent();
        $programs = json_decode($content, true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotNull($content);
        $this->assertCount(2, $programs);

        $program = $this->programRepository->find('08743d2a-d22c-4272-b804-5c91d44dd079');
        $this->assertNotNull($program);
        $this->assertEquals('Técnico Superior en Administracion de Sistemas Informáticos en Red', $program->getName());
        $this->assertEquals('La competencia general de este título consiste en configurar, administrar y mantener sistemas informáticos, garantizando la funcionalidad, la integridad de los recursos y servicios del sistema, con la calidad exigida y cumpliendo la reglamentación vigente.', $program->getDescription());
        $this->assertEquals('Para poder optar, es necesario contar con alguno de los siguientes títulos educativos: Bachillerato, certificado de haber superado todas las materias del Bachillerato, Formación Profesional de Grado Medio, Técnico/a Superior, Técnico Especialista o equivalente académico, Técnico/a de Artes Plásticas y Diseño según lo establecido en la Ley Orgánica de Educación, o una titulación universitaria o equivalente.', $program->getPriorEducation());
        $this->assertEquals('Formación Reglada', $program->getType());
        $this->assertEquals('https://www.juntadeandalucia.es/educacion/portals/web/formacion-profesional-andaluza/fp-grado-superior/detalle-titulo?idTitulo=50', $program->getAdditionalInformation());

        $program2 = $this->programRepository->find('2c0892fe-8a29-426b-8c18-e8fb92bf5868');
        $this->assertNotNull($program2);
        $this->assertEquals('Técnico Superior en Desarrollo de Aplicaciones Multiplataforma', $program2->getName());
        $this->assertEquals('La competencia general de este título consiste en desarrollar, implantar, documentar y mantener aplicaciones informáticas multiplataforma, utilizando tecnologías y entornos de desarrollo específicos, garantizando el acceso a los datos de forma segura y cumpliendo los criterios de «usabilidad» y calidad exigidas en los estándares establecidos.', $program2->getDescription());
        $this->assertEquals('Para poder optar, es necesario cumplir con uno de los siguientes requisitos educativos: poseer el título de Bachiller, Técnico Superior de Formación Profesional o un grado universitario, Técnico de Grado Medio de Formación Profesional o el título de Técnico o Técnica de Artes Plásticas y Diseño. Alternativamente, también podrás optar si has completado una oferta formativa de Grado C incluida en el ciclo formativo, un curso específico de formación preparatorio y gratuito para el acceso a ciclos de grado superior en centros autorizados, o has aprobado una prueba de acceso designada por la Administración educativa.', $program2->getPriorEducation());
        $this->assertEquals('Formación Reglada', $program2->getType());
        $this->assertEquals('https://www.juntadeandalucia.es/educacion/portals/web/formacion-profesional-andaluza/fp-grado-superior/detalle-titulo?idTitulo=51', $program2->getAdditionalInformation());
    }

}