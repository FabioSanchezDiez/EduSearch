<?php

namespace App\Tests\Controller;

use App\Entity\Field;
use App\Entity\Program;
use App\Entity\Subject;
use App\Repository\SubjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Zenstruck\Foundry\Test\ResetDatabase;

class GetSubjectsTest extends WebTestCase
{
    use ResetDatabase;
    private KernelBrowser $client;
    private SubjectRepository $subjectRepository;
    private EntityManagerInterface $em;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $container = static::getContainer();
        $this->subjectRepository = $container->get(SubjectRepository::class);
        $this->em = $container->get(EntityManagerInterface::class);

    }

    public function testGetSubjectsByProgram(): void
    {
        $program = new Program();
        $program->setId(Uuid::fromString('08743d2a-d22c-4272-b804-5c91d44dd079'));
        $program->setName('Técnico Superior en Administracion de Sistemas Informáticos en Red');
        $program->setDescription('La competencia general de este título consiste en configurar, administrar y mantener sistemas informáticos, garantizando la funcionalidad, la integridad de los recursos y servicios del sistema, con la calidad exigida y cumpliendo la reglamentación vigente.');
        $program->setPriorEducation('Para poder optar, es necesario contar con alguno de los siguientes títulos educativos: Bachillerato, certificado de haber superado todas las materias del Bachillerato, Formación Profesional de Grado Medio, Técnico/a Superior, Técnico Especialista o equivalente académico, Técnico/a de Artes Plásticas y Diseño según lo establecido en la Ley Orgánica de Educación, o una titulación universitaria o equivalente.');
        $program->setType('Formación Reglada');
        $program->setAdditionalInformation('https://www.juntadeandalucia.es/educacion/portals/web/formacion-profesional-andaluza/fp-grado-superior/detalle-titulo?idTitulo=50');

        $this->em->persist($program);

        $subjectsData = [
            [
                "id" => "1b2a7bf8-e997-4df5-8ec1-9408e00c9504",
                "name" => "Lenguajes de marcas y sistemas de gestión de información",
                "description" => "El módulo profesional \"Lenguajes de marcas y sistemas de gestión de información\" enseña a reconocer y utilizar lenguajes de marcas para la transmisión y presentación de información web, así como a gestionar información en sistemas empresariales. Los estudiantes aprenden a identificar características y ventajas de lenguajes de marcas, utilizar HTML y CSS para crear y validar documentos web, manipular documentos mediante scripts de cliente, establecer mecanismos de validación y conversión de documentos para el intercambio de información, y gestionar información en bases de datos relacionales y nativas. Además, se abordan la instalación, administración y configuración de sistemas de gestión empresarial, integrando módulos y asegurando el acceso seguro a la información."
            ],
            [
                "id" => "3358d26d-542c-4d99-a88e-88de00b882af",
                "name" => "Formación y Orientación Laboral",
                "description" => "El módulo profesional de Formación y Orientación Laboral (FOL) ofrece a los estudiantes una base sólida para entender las dinámicas del mercado laboral y las competencias necesarias para una inserción efectiva. A través de resultados de aprendizaje como la valoración de la formación continua y la identificación de itinerarios formativos específicos, los estudiantes adquieren habilidades para la búsqueda activa de empleo y la toma de decisiones informadas sobre su carrera profesional. Además, se enfoca en el desarrollo de competencias en gestión de equipos, resolución de conflictos y conocimientos en derecho laboral y seguridad social, preparándolos para enfrentar los retos del entorno laboral moderno con eficacia y responsabilidad. Este enfoque integral no solo promueve la empleabilidad, sino que también fortalece la capacidad de los estudiantes para contribuir positivamente en las organizaciones."
            ],
            [
                "id" => "397333f2-b670-491b-b64a-3dea943522e6",
                "name" => "Empresa e Iniciativa Emprendedora",
                "description" => "El módulo profesional de Empresa e Iniciativa Emprendedora proporciona a los estudiantes los conocimientos esenciales para entender y aplicar conceptos fundamentales del emprendimiento. A través de resultados de aprendizaje como el reconocimiento de la innovación y la cultura emprendedora, se busca fortalecer la capacidad de los estudiantes para identificar oportunidades empresariales. Además, se enfoca en desarrollar habilidades prácticas para la creación y gestión de pequeñas empresas, considerando aspectos legales, fiscales y financieros relevantes. Este enfoque integral prepara a los estudiantes para asumir roles tanto como emprendedores como profesionales con iniciativa y visión estratégica en entornos laborales existentes."
            ]
        ];

        foreach ($subjectsData as $subjectData) {
            $subject = new Subject();
            $subject->setId(Uuid::fromString($subjectData['id']));
            $subject->setName($subjectData['name']);
            $subject->setDescription($subjectData['description']);
            $subject->addProgram($program);

            $this->em->persist($subject);
        }

        $this->em->flush();

        $this->client->request("GET", "/api/subjects/program/08743d2a-d22c-4272-b804-5c91d44dd079");
        $response = $this->client->getResponse();
        $content = $response->getContent();
        $subjects = json_decode($content, true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotNull($content);
        $this->assertCount(3, $subjects);

        $subject1 = $this->subjectRepository->find('1b2a7bf8-e997-4df5-8ec1-9408e00c9504');
        $this->assertNotNull($subject1);
        $this->assertEquals('Lenguajes de marcas y sistemas de gestión de información', $subject1->getName());
        $this->assertEquals('El módulo profesional "Lenguajes de marcas y sistemas de gestión de información" enseña a reconocer y utilizar lenguajes de marcas para la transmisión y presentación de información web, así como a gestionar información en sistemas empresariales. Los estudiantes aprenden a identificar características y ventajas de lenguajes de marcas, utilizar HTML y CSS para crear y validar documentos web, manipular documentos mediante scripts de cliente, establecer mecanismos de validación y conversión de documentos para el intercambio de información, y gestionar información en bases de datos relacionales y nativas. Además, se abordan la instalación, administración y configuración de sistemas de gestión empresarial, integrando módulos y asegurando el acceso seguro a la información.', $subject1->getDescription());

        $subject2 = $this->subjectRepository->find('3358d26d-542c-4d99-a88e-88de00b882af');
        $this->assertNotNull($subject2);
        $this->assertEquals('Formación y Orientación Laboral', $subject2->getName());
        $this->assertEquals('El módulo profesional de Formación y Orientación Laboral (FOL) ofrece a los estudiantes una base sólida para entender las dinámicas del mercado laboral y las competencias necesarias para una inserción efectiva. A través de resultados de aprendizaje como la valoración de la formación continua y la identificación de itinerarios formativos específicos, los estudiantes adquieren habilidades para la búsqueda activa de empleo y la toma de decisiones informadas sobre su carrera profesional. Además, se enfoca en el desarrollo de competencias en gestión de equipos, resolución de conflictos y conocimientos en derecho laboral y seguridad social, preparándolos para enfrentar los retos del entorno laboral moderno con eficacia y responsabilidad. Este enfoque integral no solo promueve la empleabilidad, sino que también fortalece la capacidad de los estudiantes para contribuir positivamente en las organizaciones.', $subject2->getDescription());

        $subject3 = $this->subjectRepository->find('397333f2-b670-491b-b64a-3dea943522e6');
        $this->assertNotNull($subject3);
        $this->assertEquals('Empresa e Iniciativa Emprendedora', $subject3->getName());
        $this->assertEquals('El módulo profesional de Empresa e Iniciativa Emprendedora proporciona a los estudiantes los conocimientos esenciales para entender y aplicar conceptos fundamentales del emprendimiento. A través de resultados de aprendizaje como el reconocimiento de la innovación y la cultura emprendedora, se busca fortalecer la capacidad de los estudiantes para identificar oportunidades empresariales. Además, se enfoca en desarrollar habilidades prácticas para la creación y gestión de pequeñas empresas, considerando aspectos legales, fiscales y financieros relevantes. Este enfoque integral prepara a los estudiantes para asumir roles tanto como emprendedores como profesionales con iniciativa y visión estratégica en entornos laborales existentes.', $subject3->getDescription());
    }
}