<?php

namespace App\DataFixtures;

use App\Entity\Field;
use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    private array $programsData;

    public function load(ObjectManager $manager): void
    {
        $this->initializeProgramsData();

        foreach ($this->programsData as $programData) {
            $field = $manager->getReference(Field::class, Uuid::fromString($programData['field_id']));
            $program = new Program();
            $program->setId(Uuid::fromString($programData['id']));
            $program->setName($programData['name']);
            $program->setDescription($programData['description']);
            $program->setPriorEducation($programData['prior_education']);
            $program->setType($programData['type']);
            $program->setAdditionalInformation($programData['additional_information']);
            $program->setTag($programData['tag']);
            $program->setField($field);
            $manager->persist($program);
        }

        $manager->flush();
    }

    public function initializeProgramsData(): void
    {
        $this->programsData = [
            [
                'id' => '08743d2a-d22c-4272-b804-5c91d44dd079',
                'name' => 'Técnico Superior en Administracion de Sistemas Informáticos en Red',
                'description' => 'La competencia general de este título consiste en configurar, administrar y mantener sistemas informáticos, garantizando la funcionalidad, la integridad de los recursos y servicios del sistema, con la calidad exigida y cumpliendo la reglamentación vigente.',
                'prior_education' => 'Para poder optar, es necesario contar con alguno de los siguientes títulos educativos: Bachillerato, certificado de haber superado todas las materias del Bachillerato, Formación Profesional de Grado Medio, Técnico/a Superior, Técnico Especialista o equivalente académico, Técnico/a de Artes Plásticas y Diseño según lo establecido en la Ley Orgánica de Educación, o una titulación universitaria o equivalente.',
                'type' => 'Formación Reglada',
                'tag' => 'Grado Superior',
                'additional_information' => 'https://www.juntadeandalucia.es/educacion/portals/web/formacion-profesional-andaluza/fp-grado-superior/detalle-titulo?idTitulo=50',
                'field_id' => '0edbed88-f546-4bee-b16a-035c16abc5b4'
            ],
            [
                'id' => '2c0892fe-8a29-426b-8c18-e8fb92bf5868',
                'name' => 'Técnico Superior en Desarrollo de Aplicaciones Multiplataforma',
                'description' => 'La competencia general de este título consiste en desarrollar, implantar, documentar y mantener aplicaciones informáticas multiplataforma, utilizando tecnologías y entornos de desarrollo específicos, garantizando el acceso a los datos de forma segura y cumpliendo los criterios de «usabilidad» y calidad exigidas en los estándares establecidos.',
                'prior_education' => 'Para poder optar, es necesario cumplir con uno de los siguientes requisitos educativos: poseer el título de Bachiller, Técnico Superior de Formación Profesional o un grado universitario, Técnico de Grado Medio de Formación Profesional o el título de Técnico o Técnica de Artes Plásticas y Diseño. Alternativamente, también podrás optar si has completado una oferta formativa de Grado C incluida en el ciclo formativo, un curso específico de formación preparatorio y gratuito para el acceso a ciclos de grado superior en centros autorizados, o has aprobado una prueba de acceso designada por la Administración educativa.',
                'type' => 'Formación Reglada',
                'tag' => 'Grado Superior',
                'additional_information' => 'https://www.juntadeandalucia.es/educacion/portals/web/formacion-profesional-andaluza/fp-grado-superior/detalle-titulo?idTitulo=51',
                'field_id' => '0edbed88-f546-4bee-b16a-035c16abc5b4'
            ],
            [
                'id' => '3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0',
                'name' => 'Técnico Superior en Desarrollo de Aplicaciones Web',
                'description' => 'La competencia general de este título consiste en desarrollar, implantar, y mantener aplicaciones web, con independencia del modelo empleado y utilizando tecnologías específicas, garantizando el acceso a los datos de forma segura y cumpliendo los criterios de accesibilidad, usabilidad y calidad exigidas en los estándares establecidos.',
                'prior_education' => 'Para poder optar, es necesario cumplir con uno de los siguientes requisitos educativos: poseer el título de Bachiller, Técnico Superior de Formación Profesional o un grado universitario, Técnico de Grado Medio de Formación Profesional o el título de Técnico o Técnica de Artes Plásticas y Diseño. Alternativamente, también podrás optar si has completado una oferta formativa de Grado C incluida en el ciclo formativo, un curso específico de formación preparatorio y gratuito para el acceso a ciclos de grado superior en centros autorizados, o has aprobado una prueba de acceso designada por la Administración educativa.',
                'type' => 'Formación Reglada',
                'tag' => 'Grado Superior',
                'additional_information' => 'https://www.juntadeandalucia.es/educacion/portals/web/formacion-profesional-andaluza/fp-grado-superior/detalle-titulo?idTitulo=56',
                'field_id' => '0edbed88-f546-4bee-b16a-035c16abc5b4'
            ],
            [
                'id' => '74d8b517-4d63-4640-ba61-475f316d2e0d',
                'name' => 'Técnico superior en Acondicionamiento Físico',
                'description' => 'La competencia general de este título consiste en elaborar, coordinar, desarrollar y evaluar programas de acondicionamiento físico para todo tipo de personas usuarias y en diferentes espacios de práctica, dinamizando las actividades y orientándolas hacia la mejora de la calidad de vida y la salud, garantizando la seguridad y aplicando criterios de calidad, tanto en el proceso como en los resultados del servicio.',
                'prior_education' => 'Para poder optar, es necesario cumplir con uno de los siguientes requisitos educativos: poseer el título de Bachiller, Técnico Superior de Formación Profesional o un grado universitario, Técnico de Grado Medio de Formación Profesional o el título de Técnico o Técnica de Artes Plásticas y Diseño. Alternativamente, también podrás optar si has completado una oferta formativa de Grado C incluida en el ciclo formativo, un curso específico de formación preparatorio y gratuito para el acceso a ciclos de grado superior en centros autorizados, o has aprobado una prueba de acceso designada por la Administración educativa.',
                'type' => 'Formación Reglada',
                'tag' => 'Grado Superior',
                'additional_information' => 'https://www.juntadeandalucia.es/educacion/portals/web/formacion-profesional-andaluza/fp-grado-superior/detalle-titulo?idTitulo=561',
                'field_id' => '94443462-8e93-46e0-8025-e00b3fbda869'
            ],
            [
                'id' => 'aaa01ed4-d828-48b8-893a-b048c74c5ec8',
                'name' => 'Desarrollo Web Completo con HTML5, CSS3, JS AJAX PHP y MySQL',
                'description' => 'Aprende Desarrollo Web con este curso 100% práctico, paso a paso y sin conocimientos previo INCLUYE 4 PROYECTOS FINALES',
                'prior_education' => '',
                'type' => 'Autodidacta',
                'tag' => 'Curso Online',
                'additional_information' => 'https://www.udemy.com/course/desarrollo-web-completo-con-html5-css3-js-php-y-mysql/',
                'field_id' => '0edbed88-f546-4bee-b16a-035c16abc5b4'
            ],
        ];
    }

    public function getDependencies(): array
    {
        return [FieldFixtures::class];
    }
}
