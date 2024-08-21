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
                'id' => 'e3d473e7-1517-4777-9161-9f27342f1fbf',
                'name' => 'Técnico en Sistemas Microinformáticos y Redes',
                'description' => 'La competencia general de este título consiste en instalar, configurar y mantener sistemas microinformáticos, aislados o en red, así como redes locales en pequeños entornos, asegurando su funcionalidad y aplicando los protocolos de calidad, seguridad y respeto al medio ambiente establecidos.',
                'prior_education' => 'Para poder optar a la Formación Profesional, debes cumplir alguno de los siguientes requisitos: poseer un título de Graduado/a en Educación Secundaria Obligatoria o un nivel académico superior, un Título Profesional Básico (Formación Profesional de Grado Básico), o un Título de Técnico/a o Técnico/a Auxiliar o equivalente a efectos académicos. También puedes haber superado el segundo curso del Bachillerato Unificado y Polivalente (BUP), la prueba de acceso a ciclos formativos de grado medio, para la cual se requiere tener al menos diecisiete años cumplidos en el año de la prueba, o la prueba de acceso a la Universidad para mayores de 25 años (teniendo en cuenta que la superación de las pruebas de acceso a la Universidad para mayores de 40 y 45 años no es un requisito válido para acceder a FP).',
                'type' => 'Formación Reglada',
                'tag' => 'Grado Medio',
                'additional_information' => 'https://www.juntadeandalucia.es/educacion/portals/web/formacion-profesional-andaluza/fp-grado-medio/detalle-titulo?idTitulo=17',
                'field_id' => '0edbed88-f546-4bee-b16a-035c16abc5b4'
            ],
            [
                'id' => '43c504a0-c759-4e85-9835-af4bffbbf462',
                'name' => 'Grado en Ingeniería Informática',
                'description' => 'La ingeniería informática es una disciplina que combina principios de la ingeniería y la informática para diseñar, desarrollar y mantener sistemas de hardware y software. Los ingenieros informáticos se encargan de la creación y optimización de tecnologías de procesamiento de datos, redes y sistemas de información, aplicando conocimientos de algoritmos, arquitectura de computadores y programación.',
                'prior_education' => 'Para poder optar, es necesario estar en posesión del título de Bachiller y haber superado la EvAU (Evaluación para el Acceso a la Universidad) o contar con un título de Técnico Superior o Técnica Superior de FP, de Artes Plásticas y Diseño o Deportivo. Haber superado la prueba de acceso a la Universidad para mayores de 25 años.',
                'type' => 'Formación Reglada',
                'tag' => 'Carrera Universitaria',
                'additional_information' => 'https://www.ugr.es/estudiantes/grados/grado-ingenieria-informatica',
                'field_id' => '0edbed88-f546-4bee-b16a-035c16abc5b4'
            ],
            [
                'id' => '74d8b517-4d63-4640-ba61-475f316d2e0d',
                'name' => 'Técnico Superior en Acondicionamiento Físico',
                'description' => 'La competencia general de este título consiste en elaborar, coordinar, desarrollar y evaluar programas de acondicionamiento físico para todo tipo de personas usuarias y en diferentes espacios de práctica, dinamizando las actividades y orientándolas hacia la mejora de la calidad de vida y la salud, garantizando la seguridad y aplicando criterios de calidad, tanto en el proceso como en los resultados del servicio.',
                'prior_education' => 'Para poder optar, es necesario cumplir con uno de los siguientes requisitos educativos: poseer el título de Bachiller, Técnico Superior de Formación Profesional o un grado universitario, Técnico de Grado Medio de Formación Profesional o el título de Técnico o Técnica de Artes Plásticas y Diseño. Alternativamente, también podrás optar si has completado una oferta formativa de Grado C incluida en el ciclo formativo, un curso específico de formación preparatorio y gratuito para el acceso a ciclos de grado superior en centros autorizados, o has aprobado una prueba de acceso designada por la Administración educativa.',
                'type' => 'Formación Reglada',
                'tag' => 'Grado Superior',
                'additional_information' => 'https://www.juntadeandalucia.es/educacion/portals/web/formacion-profesional-andaluza/fp-grado-superior/detalle-titulo?idTitulo=561',
                'field_id' => '94443462-8e93-46e0-8025-e00b3fbda869'
            ],
            [
                'id' => 'aaa01ed4-d828-48b8-893a-b048c74c5ec8',
                'name' => 'Curso de Desarrollo Web Moderno Completo',
                'description' => 'Este curso te enseña a dominar HTML y CSS para diseñar sitios web modernos siguiendo buenas prácticas y metodologías como Módulos y BEM. Aprenderás a desarrollar páginas web con HTML, CSS, y JavaScript (ES6), crear sitios dinámicos y aplicaciones CRUD con PHP y MySQL, integrar pagos con PayPal, y asegurar tus aplicaciones. Al finalizar, estarás preparado para postularte a empleos de Desarrollador Web Junior.',
                'prior_education' => '',
                'type' => 'Autodidacta',
                'tag' => 'Curso Online',
                'additional_information' => 'https://www.udemy.com/course/desarrollo-web-completo-con-html5-css3-js-php-y-mysql/',
                'field_id' => '0edbed88-f546-4bee-b16a-035c16abc5b4'
            ],
            [
                'id' => '72e80146-431a-438a-94e2-99a45748f641',
                'name' => 'Máster Completo en Java de cero a experto 2024',
                'description' => 'Este curso te enseña Java desde lo básico hasta nivel avanzado usando IntelliJ IDEA, con más de 50 tareas y desafíos. Aprenderás programación funcional con Java 8, orientación a objetos, pruebas unitarias, manejo de hilos y excepciones, y desarrollo web completo con Jakarta EE 9 y Spring Framework 5. También incluye el desarrollo de aplicaciones Full Stack y preparación para la certificación de Java Oracle.',
                'prior_education' => '',
                'type' => 'Autodidacta',
                'tag' => 'Curso Online',
                'additional_information' => 'https://www.udemy.com/course/master-completo-java-de-cero-a-experto/',
                'field_id' => '0edbed88-f546-4bee-b16a-035c16abc5b4'
            ],
            [
                'id' => '6129511a-8cfc-454d-a9fb-79faa51e63cf',
                'name' => 'Bootcamp FullStack Gratuito',
                'description' => 'Este curso impartido por Midudev es una introducción al desarrollo web moderno con JavaScript. El enfoque principal está en las aplicaciones de una sola página implementadas con React y que las soportan con servicios web RESTful y GraphQL implementados con Node.js también veremos TypeScript y React Native.',
                'prior_education' => '',
                'type' => 'Autodidacta',
                'tag' => 'Curso Online',
                'additional_information' => 'https://www.youtube.com/playlist?list=PLV8x_i1fqBw0Kn_fBIZTa3wS_VZAqddX7',
                'field_id' => '0edbed88-f546-4bee-b16a-035c16abc5b4'
            ],
            [
                'id' => 'b875b4d9-ebd1-4f0b-87f9-a0e6df6a3f76',
                'name' => 'Curso de Android Studio con Kotlin desde cero',
                'description' => 'Curso definitivo para aprender a programar aplicaciones Android con Kotlin desde cero sin conocimientos previos. En el curso aprenderás poco a poco todos los conceptos necesarios para dominar la sintaxis de Kotlin y luego iremos haciendo apps reales con Recyclerviews, data class, cardview, distintos tipos de layouts, consumo de APIs con Retrofit y mucho más.',
                'prior_education' => '',
                'type' => 'Autodidacta',
                'tag' => 'Curso Online',
                'additional_information' => 'https://www.youtube.com/playlist?list=PL8ie04dqq7_OcBYDpvHrcSFVoggLi3cm_',
                'field_id' => '0edbed88-f546-4bee-b16a-035c16abc5b4'
            ],
            [
                'id' => '10f1a432-77b2-40f1-a589-d9f9005493e7',
                'name' => 'Técnico Superior en Educación Infantil',
                'description' => 'La competencia general de este título consiste en diseñar, implementar y evaluar proyectos y programas educativos de atención a la infancia en el primer ciclo de educación infantil en el ámbito formal, de acuerdo con la propuesta pedagógica elaborada por un Maestro con la especialización en educación infantil o título de grado equivalente, y en toda la etapa en el ámbito no formal, generando entornos seguros y en colaboración con otros profesionales y con las familias.',
                'prior_education' => 'Para poder optar, es necesario cumplir con uno de los siguientes requisitos educativos: poseer el título de Bachiller, Técnico Superior de Formación Profesional o un grado universitario, Técnico de Grado Medio de Formación Profesional o el título de Técnico o Técnica de Artes Plásticas y Diseño. Alternativamente, también podrás optar si has completado una oferta formativa de Grado C incluida en el ciclo formativo, un curso específico de formación preparatorio y gratuito para el acceso a ciclos de grado superior en centros autorizados, o has aprobado una prueba de acceso designada por la Administración educativa.',
                'type' => 'Formación Reglada',
                'tag' => 'Grado Superior',
                'additional_information' => 'https://www.juntadeandalucia.es/educacion/portals/web/formacion-profesional-andaluza/fp-grado-superior/detalle-titulo?idTitulo=3',
                'field_id' => '14051bb8-3a6b-4882-a8fe-70c3c633b3ca'
            ],
            [
                'id' => '131a9366-6ee9-4d01-aaa9-2aca299bbcf6',
                'name' => 'Técnico Superior en Integración Social',
                'description' => 'La competencia general de este título consiste en programar, organizar, implementar y evaluar las intervenciones de integración social aplicando estrategias y técnicas específicas, promoviendo la igualdad de oportunidades, actuando en todo momento con una actitud de respeto hacia las personas destinatarias y garantizando la creación de entornos seguros tanto para las personas destinatarias como para el profesional.',
                'prior_education' => 'Para poder optar, es necesario cumplir con uno de los siguientes requisitos educativos: poseer el título de Bachiller, Técnico Superior de Formación Profesional o un grado universitario, Técnico de Grado Medio de Formación Profesional o el título de Técnico o Técnica de Artes Plásticas y Diseño. Alternativamente, también podrás optar si has completado una oferta formativa de Grado C incluida en el ciclo formativo, un curso específico de formación preparatorio y gratuito para el acceso a ciclos de grado superior en centros autorizados, o has aprobado una prueba de acceso designada por la Administración educativa.',
                'type' => 'Formación Reglada',
                'tag' => 'Grado Superior',
                'additional_information' => 'https://www.juntadeandalucia.es/educacion/portals/web/formacion-profesional-andaluza/fp-grado-superior/detalle-titulo?idTitulo=132',
                'field_id' => '14051bb8-3a6b-4882-a8fe-70c3c633b3ca'
            ],
            [
                'id' => '1c05e66b-374d-4db7-818d-f90f920492e0',
                'name' => 'Técnico en Atención a Personas en Situación de Dependencia',
                'description' => 'La competencia general de este título consiste en atender a las personas en situación de dependencia, en el ámbito domiciliario e institucional, a fin de mantener y mejorar su calidad de vida, realizando actividades asistenciales, no sanitarias, psicosociales y de apoyo a la gestión doméstica, aplicando medidas y normas de prevención y seguridad y derivándolas a otros servicios cuando sea necesario.',
                'prior_education' => 'Para poder optar a la Formación Profesional, debes cumplir alguno de los siguientes requisitos: poseer un título de Graduado/a en Educación Secundaria Obligatoria o un nivel académico superior, un Título Profesional Básico (Formación Profesional de Grado Básico), o un Título de Técnico/a o Técnico/a Auxiliar o equivalente a efectos académicos. También puedes haber superado el segundo curso del Bachillerato Unificado y Polivalente (BUP), la prueba de acceso a ciclos formativos de grado medio, para la cual se requiere tener al menos diecisiete años cumplidos en el año de la prueba, o la prueba de acceso a la Universidad para mayores de 25 años (teniendo en cuenta que la superación de las pruebas de acceso a la Universidad para mayores de 40 y 45 años no es un requisito válido para acceder a FP).',
                'type' => 'Formación Reglada',
                'tag' => 'Grado Medio',
                'additional_information' => 'https://www.juntadeandalucia.es/educacion/portals/web/formacion-profesional-andaluza/fp-grado-medio/detalle-titulo?idTitulo=112',
                'field_id' => '14051bb8-3a6b-4882-a8fe-70c3c633b3ca'
            ],
            [
                'id' => '1f24304f-321c-4487-99be-6ced9cc6f0d0',
                'name' => 'Grado en Educación Infantil',
                'description' => 'La carrera de Educación Infantil prepara a profesionales para enseñar y apoyar el desarrollo integral de niños en sus primeras etapas. Los estudiantes aprenden sobre psicología, desarrollo infantil y técnicas pedagógicas, capacitándose para trabajar en guarderías y preescolares, fomentando el aprendizaje y la socialización de los niños.',
                'prior_education' => 'Para poder optar, es necesario estar en posesión del título de Bachiller y haber superado la EvAU (Evaluación para el Acceso a la Universidad) o contar con un título de Técnico Superior o Técnica Superior de FP, de Artes Plásticas y Diseño o Deportivo. Haber superado la prueba de acceso a la Universidad para mayores de 25 años.',
                'type' => 'Formación Reglada',
                'tag' => 'Carrera Universitaria',
                'additional_information' => 'https://www.ugr.es/estudiantes/grados/grado-educacion-infantil',
                'field_id' => '14051bb8-3a6b-4882-a8fe-70c3c633b3ca'
            ],
            [
                'id' => '23284d8a-832a-4cff-aea0-87a7766f30dd',
                'name' => 'Grado en Educación Primaria',
                'description' => 'La carrera de Educación Primaria prepara a profesionales para enseñar a niños de 6 a 12 años. Los estudiantes adquieren conocimientos en pedagogía y estrategias educativas, capacitándolos para fomentar el desarrollo integral de los niños en escuelas primarias.',
                'prior_education' => 'Para poder optar, es necesario estar en posesión del título de Bachiller y haber superado la EvAU (Evaluación para el Acceso a la Universidad) o contar con un título de Técnico Superior o Técnica Superior de FP, de Artes Plásticas y Diseño o Deportivo. Haber superado la prueba de acceso a la Universidad para mayores de 25 años.',
                'type' => 'Formación Reglada',
                'tag' => 'Carrera Universitaria',
                'additional_information' => 'https://www.ugr.es/estudiantes/grados/grado-educacion-primaria',
                'field_id' => '14051bb8-3a6b-4882-a8fe-70c3c633b3ca'
            ],
            [
                'id' => '387df9f1-e6ba-446b-983e-24db83d57b58',
                'name' => 'Técnico Superior en Higiene Bucodental',
                'description' => 'La competencia general de este título consiste en promover la salud bucodental de las personas y de la comunidad, mediante el desarrollo de actividades preventivas y técnico-asistenciales que incluyen, la exploración, la evaluación, la promoción y la realización de técnicas odontológicas en colaboración con el odontólgo o médico estomatólogo. Como miembro de un equipo de salud bucodental realizará su actividad profesional con criterios de calidad, seguridad y optimización de recursos.',
                'prior_education' => 'Para poder optar, es necesario cumplir con uno de los siguientes requisitos educativos: poseer el título de Bachiller, Técnico Superior de Formación Profesional o un grado universitario, Técnico de Grado Medio de Formación Profesional o el título de Técnico o Técnica de Artes Plásticas y Diseño. Alternativamente, también podrás optar si has completado una oferta formativa de Grado C incluida en el ciclo formativo, un curso específico de formación preparatorio y gratuito para el acceso a ciclos de grado superior en centros autorizados, o has aprobado una prueba de acceso designada por la Administración educativa.',
                'type' => 'Formación Reglada',
                'tag' => 'Grado Superior',
                'additional_information' => 'https://www.juntadeandalucia.es/educacion/portals/web/formacion-profesional-andaluza/fp-grado-superior/detalle-titulo?idTitulo=167',
                'field_id' => '4d3ecb2d-378a-4f1a-be7f-7631e1519a32'
            ],
            [
                'id' => '3f7ab96a-6d0a-43df-87b1-b1abc0792e73',
                'name' => 'Técnico Superior en Laboratorio Clínico y Biomédico',
                'description' => 'La competencia general de este título consiste en realizar estudios analíticos de muestras biológicas, siguiendo los protocolos normalizados de trabajo, aplicando las normas de calidad, seguridad y medioambientales establecidas, y valorando los resultados técnicos, para que sirvan como soporte a la prevención, al diagnóstico, al control de la evolución y al tratamiento de la enfermedad, así como a la investigación, siguiendo los protocolos establecidos en la unidad asistencial.',
                'prior_education' => 'Para poder optar, es necesario cumplir con uno de los siguientes requisitos educativos: poseer el título de Bachiller, Técnico Superior de Formación Profesional o un grado universitario, Técnico de Grado Medio de Formación Profesional o el título de Técnico o Técnica de Artes Plásticas y Diseño. Alternativamente, también podrás optar si has completado una oferta formativa de Grado C incluida en el ciclo formativo, un curso específico de formación preparatorio y gratuito para el acceso a ciclos de grado superior en centros autorizados, o has aprobado una prueba de acceso designada por la Administración educativa.',
                'type' => 'Formación Reglada',
                'tag' => 'Grado Superior',
                'additional_information' => 'https://www.juntadeandalucia.es/educacion/portals/web/formacion-profesional-andaluza/fp-grado-superior/detalle-titulo?idTitulo=169',
                'field_id' => '4d3ecb2d-378a-4f1a-be7f-7631e1519a32'
            ],
            [
                'id' => '57d79580-c422-4c7f-8b82-7597a26a9d2e',
                'name' => 'Técnico Superior en Radioterapia y Dosimetría',
                'description' => 'La competencia general de este título consiste en aplicar tratamientos con radiaciones ionizantes bajo prescripción médica, utilizar equipos provistos de fuentes encapsuladas o productores de radiaciones, aplicando las normas de radioprotección generales y específicas, y asistiendo al paciente durante su estancia en la unidad, así como realizar procedimientos de protección radiológica hospitalaria, siguiendo normas de garantía de calidad y los protocolos establecidos en la unidad asistencial.',
                'prior_education' => 'Para poder optar, es necesario cumplir con uno de los siguientes requisitos educativos: poseer el título de Bachiller, Técnico Superior de Formación Profesional o un grado universitario, Técnico de Grado Medio de Formación Profesional o el título de Técnico o Técnica de Artes Plásticas y Diseño. Alternativamente, también podrás optar si has completado una oferta formativa de Grado C incluida en el ciclo formativo, un curso específico de formación preparatorio y gratuito para el acceso a ciclos de grado superior en centros autorizados, o has aprobado una prueba de acceso designada por la Administración educativa.',
                'type' => 'Formación Reglada',
                'tag' => 'Grado Superior',
                'additional_information' => 'https://www.juntadeandalucia.es/educacion/portals/web/formacion-profesional-andaluza/fp-grado-superior/detalle-titulo?idTitulo=170',
                'field_id' => '4d3ecb2d-378a-4f1a-be7f-7631e1519a32'
            ],
            [
                'id' => '5d4738df-f549-4158-bb44-404a7cd4087f',
                'name' => 'Técnico en Farmacia y Parafarmacia',
                'description' => 'La competencia general de este título consiste en asistir en la dispensación y elaboración de productos farmacéuticos y afines, y realizar la venta de productos parafarmacéuticos, fomentando la promoción de la salud y ejecutando tareas administrativas y de control de almacén, cumpliendo con las especificaciones de calidad, seguridad y protección ambiental.',
                'prior_education' => 'Para poder optar a la Formación Profesional, debes cumplir alguno de los siguientes requisitos: poseer un título de Graduado/a en Educación Secundaria Obligatoria o un nivel académico superior, un Título Profesional Básico (Formación Profesional de Grado Básico), o un Título de Técnico/a o Técnico/a Auxiliar o equivalente a efectos académicos. También puedes haber superado el segundo curso del Bachillerato Unificado y Polivalente (BUP), la prueba de acceso a ciclos formativos de grado medio, para la cual se requiere tener al menos diecisiete años cumplidos en el año de la prueba, o la prueba de acceso a la Universidad para mayores de 25 años (teniendo en cuenta que la superación de las pruebas de acceso a la Universidad para mayores de 40 y 45 años no es un requisito válido para acceder a FP).',
                'type' => 'Formación Reglada',
                'tag' => 'Grado Medio',
                'additional_information' => 'https://www.juntadeandalucia.es/educacion/portals/web/formacion-profesional-andaluza/fp-grado-medio/detalle-titulo?idTitulo=8',
                'field_id' => '4d3ecb2d-378a-4f1a-be7f-7631e1519a32'
            ],
            [
                'id' => '621fcd8b-503b-4c6f-a335-032e6d1c5f97',
                'name' => 'Técnico Superior en Imagen para el Diagnóstico y Medicina Nuclear',
                'description' => 'La competencia general de este título consiste en obtener registros gráficos, morfológicos o funcionales del cuerpo humano, con fines diagnósticos o terapéuticos, a partir de la prescripción facultativa utilizando equipos de diagnóstico por imagen y de medicina nuclear, y asistiendo al paciente durante su estancia en la unidad, aplicando protocolos de radioprotección y de garantía de calidad, así como los establecidos en la unidad asistencial.',
                'prior_education' => 'Para poder optar, es necesario cumplir con uno de los siguientes requisitos educativos: poseer el título de Bachiller, Técnico Superior de Formación Profesional o un grado universitario, Técnico de Grado Medio de Formación Profesional o el título de Técnico o Técnica de Artes Plásticas y Diseño. Alternativamente, también podrás optar si has completado una oferta formativa de Grado C incluida en el ciclo formativo, un curso específico de formación preparatorio y gratuito para el acceso a ciclos de grado superior en centros autorizados, o has aprobado una prueba de acceso designada por la Administración educativa.',
                'type' => 'Formación Reglada',
                'tag' => 'Grado Superior',
                'additional_information' => 'https://www.juntadeandalucia.es/educacion/portals/web/formacion-profesional-andaluza/fp-grado-superior/detalle-titulo?idTitulo=168',
                'field_id' => '4d3ecb2d-378a-4f1a-be7f-7631e1519a32'
            ],
            [
                'id' => '84c0d3b3-0751-43ad-9352-f514a8fc671c',
                'name' => 'Técnico Superior en Anatomía Patológica y Citodiagnóstico',
                'description' => 'La competencia general de este título consiste en procesar muestras histológicas y citológicas, seleccionar y hacer la aproximación diagnóstica de citologías ginecológicas y generales, y colaborar en la realización de necropsias clínicas y forenses, de manera que sirvan como soporte al diagnóstico clínico o médico-legal, organizando y programando el trabajo, y cumpliendo criterios de calidad del servicio y de optimización de recursos, bajo la supervisión facultativa correspondiente.',
                'prior_education' => 'Para poder optar, es necesario cumplir con uno de los siguientes requisitos educativos: poseer el título de Bachiller, Técnico Superior de Formación Profesional o un grado universitario, Técnico de Grado Medio de Formación Profesional o el título de Técnico o Técnica de Artes Plásticas y Diseño. Alternativamente, también podrás optar si has completado una oferta formativa de Grado C incluida en el ciclo formativo, un curso específico de formación preparatorio y gratuito para el acceso a ciclos de grado superior en centros autorizados, o has aprobado una prueba de acceso designada por la Administración educativa.',
                'type' => 'Formación Reglada',
                'tag' => 'Grado Superior',
                'additional_information' => 'https://www.juntadeandalucia.es/educacion/portals/web/formacion-profesional-andaluza/fp-grado-superior/detalle-titulo?idTitulo=165',
                'field_id' => '4d3ecb2d-378a-4f1a-be7f-7631e1519a32'
            ],
            [
                'id' => '84fd37d4-d199-41c4-b697-ba2037f047f1',
                'name' => 'Grado en Medicina',
                'description' => 'La carrera de Medicina prepara a profesionales para diagnosticar, tratar y prevenir enfermedades. Los estudiantes adquieren conocimientos en ciencias básicas y habilidades clínicas mediante prácticas en hospitales. Se forman en diversas especialidades médicas, con énfasis en ética, investigación y la relación médico-paciente, quedando listos para ejercer como médicos o especializarse.',
                'prior_education' => 'Para poder optar, es necesario estar en posesión del título de Bachiller y haber superado la EvAU (Evaluación para el Acceso a la Universidad) o contar con un título de Técnico Superior o Técnica Superior de FP, de Artes Plásticas y Diseño o Deportivo. Haber superado la prueba de acceso a la Universidad para mayores de 25 años.',
                'type' => 'Formación Reglada',
                'tag' => 'Carrera Universitaria',
                'additional_information' => 'https://www.ugr.es/estudiantes/grados/grado-medicina',
                'field_id' => '4d3ecb2d-378a-4f1a-be7f-7631e1519a32'
            ],
            [
                'id' => '8d51a934-19cd-4a44-b9b9-5c1e87d103fd',
                'name' => 'Grado en Comunicación Audiovisual',
                'description' => 'La carrera de Comunicación Audiovisual forma profesionales en la creación y producción de contenidos para cine, televisión, radio y medios digitales. Los estudiantes aprenden sobre narrativa visual, edición, producción, y manejo de cámaras, combinando habilidades técnicas y creativas. Además, se estudia la teoría de la comunicación y el impacto de los medios en la sociedad, preparando a los graduados para trabajar en diversas áreas de la industria audiovisual.',
                'prior_education' => 'Para poder optar, es necesario estar en posesión del título de Bachiller y haber superado la EvAU (Evaluación para el Acceso a la Universidad) o contar con un título de Técnico Superior o Técnica Superior de FP, de Artes Plásticas y Diseño o Deportivo. Haber superado la prueba de acceso a la Universidad para mayores de 25 años.',
                'type' => 'Formación Reglada',
                'tag' => 'Carrera Universitaria',
                'additional_information' => 'https://www.ugr.es/estudiantes/grados/grado-comunicacion-audiovisual',
                'field_id' => '6ec5573a-065f-4ed5-893d-8b54c5e8760a'
            ],
            [
                'id' => '8dbd69df-fe2c-446d-828c-d01467f8d54d',
                'name' => 'Técnico Superior en Animaciones 3D Juegos y Entornos Interactivos',
                'description' => 'La competencia general de este título consiste en generar animaciones 2D y 3D para producciones audiovisuales y desarrollar productos audiovisuales multimedia interactivos, integrando los elementos y fuentes que intervienen en su creación y teniendo en cuenta sus relaciones, dependencias y criterios de interactividad, a partir de parámetros previamente definidos.',
                'prior_education' => 'Para poder optar, es necesario cumplir con uno de los siguientes requisitos educativos: poseer el título de Bachiller, Técnico Superior de Formación Profesional o un grado universitario, Técnico de Grado Medio de Formación Profesional o el título de Técnico o Técnica de Artes Plásticas y Diseño. Alternativamente, también podrás optar si has completado una oferta formativa de Grado C incluida en el ciclo formativo, un curso específico de formación preparatorio y gratuito para el acceso a ciclos de grado superior en centros autorizados, o has aprobado una prueba de acceso designada por la Administración educativa.',
                'type' => 'Formación Reglada',
                'tag' => 'Grado Superior',
                'additional_information' => 'https://www.juntadeandalucia.es/educacion/portals/web/formacion-profesional-andaluza/fp-grado-superior/detalle-titulo?idTitulo=115',
                'field_id' => '6ec5573a-065f-4ed5-893d-8b54c5e8760a'
            ],
            [
                'id' => 'a2974b24-25e3-448b-8ae2-f6ff9e69578e',
                'name' => 'Técnico Superior en Realización de Proyectos Audiovisuales y Espectáculos',
                'description' => 'La competencia general de este título consiste en organizar y supervisar la preparación, realización y montaje de proyectos audiovisuales filmados, grabados o en directo, así como regir los procesos técnicos y artísticos de representaciones de espectáculos en vivo y eventos, coordinando los medios técnicos y humanos y controlando el contenido, la forma, el proyecto artístico y la calidad establecida.',
                'prior_education' => 'Para poder optar, es necesario cumplir con uno de los siguientes requisitos educativos: poseer el título de Bachiller, Técnico Superior de Formación Profesional o un grado universitario, Técnico de Grado Medio de Formación Profesional o el título de Técnico o Técnica de Artes Plásticas y Diseño. Alternativamente, también podrás optar si has completado una oferta formativa de Grado C incluida en el ciclo formativo, un curso específico de formación preparatorio y gratuito para el acceso a ciclos de grado superior en centros autorizados, o has aprobado una prueba de acceso designada por la Administración educativa.',
                'type' => 'Formación Reglada',
                'tag' => 'Grado Superior',
                'additional_information' => 'https://www.juntadeandalucia.es/educacion/portals/web/formacion-profesional-andaluza/fp-grado-superior/detalle-titulo?idTitulo=101',
                'field_id' => '6ec5573a-065f-4ed5-893d-8b54c5e8760a'
            ],
            [
                'id' => 'c9b0b06e-a8c0-44ba-9def-1b3b17e95852',
                'name' => 'Grado en Ciencias de la Actividad Física y del Deporte',
                'description' => 'El Grado en Ciencias de la Actividad Física y del Deporte forma a profesionales en entrenamiento, salud y gestión deportiva. Los estudiantes aprenden a diseñar programas de ejercicio y promover estilos de vida saludables, preparándose para trabajar en educación, entrenamiento y gestión deportiva.',
                'prior_education' => 'Para poder optar, es necesario estar en posesión del título de Bachiller y haber superado la EvAU (Evaluación para el Acceso a la Universidad) o contar con un título de Técnico Superior o Técnica Superior de FP, de Artes Plásticas y Diseño o Deportivo. Haber superado la prueba de acceso a la Universidad para mayores de 25 años.',
                'type' => 'Formación Reglada',
                'tag' => 'Carrera Universitaria',
                'additional_information' => 'https://www.ugr.es/estudiantes/grados/grado-ciencias-actividad-fisica-deporte',
                'field_id' => '94443462-8e93-46e0-8025-e00b3fbda869'
            ],
            [
                'id' => 'd2f68ec9-0c2e-4352-85ef-821b14e3ea59',
                'name' => 'Técnico Superior en Enseñanza y Animación Sociodeportiva',
                'description' => 'La competencia general de este título consiste en elaborar, gestionar y evaluar proyectos de animación físico-deportivos recreativos para todo tipo de usuarios, programando y dirigiendo las actividades de enseñanza, de inclusión sociodeportiva y de tiempo libre, coordinando las actuaciones de los profesionales implicados, garantizando la seguridad, respetando el medio ambiente y consiguiendo la satisfacción de los usuarios, en los límites de coste previstos.',
                'prior_education' => 'Para poder optar, es necesario cumplir con uno de los siguientes requisitos educativos: poseer el título de Bachiller, Técnico Superior de Formación Profesional o un grado universitario, Técnico de Grado Medio de Formación Profesional o el título de Técnico o Técnica de Artes Plásticas y Diseño. Alternativamente, también podrás optar si has completado una oferta formativa de Grado C incluida en el ciclo formativo, un curso específico de formación preparatorio y gratuito para el acceso a ciclos de grado superior en centros autorizados, o has aprobado una prueba de acceso designada por la Administración educativa.',
                'type' => 'Formación Reglada',
                'tag' => 'Grado Superior',
                'additional_information' => 'https://www.juntadeandalucia.es/educacion/portals/web/formacion-profesional-andaluza/fp-grado-superior/detalle-titulo?idTitulo=601',
                'field_id' => '94443462-8e93-46e0-8025-e00b3fbda869'
            ],
            [
                'id' => 'd3136fcb-6d49-4ae9-bb8f-1f2d0584ef51',
                'name' => 'Grado en Marketing e Investigación de Mercados',
                'description' => 'El Grado en Marketing e Investigación de Mercados prepara a profesionales en la creación de estrategias de marketing y el análisis de datos de mercado. Los estudiantes aprenden sobre comportamiento del consumidor, comunicación comercial, y técnicas de investigación para identificar oportunidades de negocio. Al finalizar, están capacitados para trabajar en áreas como publicidad, ventas, análisis de mercados y desarrollo de productos.',
                'prior_education' => 'Para poder optar, es necesario estar en posesión del título de Bachiller y haber superado la EvAU (Evaluación para el Acceso a la Universidad) o contar con un título de Técnico Superior o Técnica Superior de FP, de Artes Plásticas y Diseño o Deportivo. Haber superado la prueba de acceso a la Universidad para mayores de 25 años.',
                'type' => 'Formación Reglada',
                'tag' => 'Carrera Universitaria',
                'additional_information' => 'https://grados.ugr.es/marketing/docencia/plan-estudios',
                'field_id' => 'c3658e40-6845-45c7-bfc0-9c4df9ed1a9e'
            ],
            [
                'id' => 'df3cee9c-8e17-424e-9bc0-4e93c2ba67fc',
                'name' => 'Técnico Superior en Marketing y Publicidad',
                'description' => 'La competencia general de este título consiste en definir y efectuar el seguimiento de las políticas de marketing basadas en estudios comerciales y en promocionar y publicitar los productos y/o servicios en los medios y soportes de comunicación adecuados, elaborando los materiales publipromocionales necesarios.',
                'prior_education' => 'Para poder optar, es necesario cumplir con uno de los siguientes requisitos educativos: poseer el título de Bachiller, Técnico Superior de Formación Profesional o un grado universitario, Técnico de Grado Medio de Formación Profesional o el título de Técnico o Técnica de Artes Plásticas y Diseño. Alternativamente, también podrás optar si has completado una oferta formativa de Grado C incluida en el ciclo formativo, un curso específico de formación preparatorio y gratuito para el acceso a ciclos de grado superior en centros autorizados, o has aprobado una prueba de acceso designada por la Administración educativa.',
                'type' => 'Formación Reglada',
                'tag' => 'Grado Superior',
                'additional_information' => 'https://www.juntadeandalucia.es/educacion/portals/web/formacion-profesional-andaluza/fp-grado-superior/detalle-titulo?idTitulo=91',
                'field_id' => 'c3658e40-6845-45c7-bfc0-9c4df9ed1a9e'
            ],
            [
                'id' => 'f6506d28-0be0-41a2-9946-ab1a7b491484',
                'name' => 'Técnico Superior en Comercio Internacional',
                'description' => 'La competencia general de este título consiste en planificar y gestionar los procesos de importación/exportación e introducción/expedición de mercancías, aplicando la legislación vigente, en el marco de los objetivos y procedimientos establecidos.',
                'prior_education' => 'Para poder optar, es necesario cumplir con uno de los siguientes requisitos educativos: poseer el título de Bachiller, Técnico Superior de Formación Profesional o un grado universitario, Técnico de Grado Medio de Formación Profesional o el título de Técnico o Técnica de Artes Plásticas y Diseño. Alternativamente, también podrás optar si has completado una oferta formativa de Grado C incluida en el ciclo formativo, un curso específico de formación preparatorio y gratuito para el acceso a ciclos de grado superior en centros autorizados, o has aprobado una prueba de acceso designada por la Administración educativa.',
                'type' => 'Formación Reglada',
                'tag' => 'Grado Superior',
                'additional_information' => 'https://www.juntadeandalucia.es/educacion/portals/web/formacion-profesional-andaluza/fp-grado-superior/detalle-titulo?idTitulo=94',
                'field_id' => 'c3658e40-6845-45c7-bfc0-9c4df9ed1a9e'
            ],
        ];
    }

    public function getDependencies(): array
    {
        return [FieldFixtures::class];
    }
}
