<?php

namespace App\DataFixtures;

use App\Entity\Program;
use App\Entity\Subject;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class SubjectFixtures extends Fixture implements DependentFixtureInterface
{
    private array $subjectsData;

    public function load(ObjectManager $manager): void
    {
        $this->initializeSubjectData();

        foreach ($this->subjectsData as $subjectInfo) {
            $subject = new Subject();
            $subject->setId(Uuid::fromString($subjectInfo['id']));
            $subject->setName($subjectInfo['name']);
            $subject->setDescription($subjectInfo['description']);
            foreach ($subjectInfo['programs'] as $programId) {
                $program = $manager->getReference(Program::class, Uuid::fromString($programId));
                $subject->addProgram($program);
            }
            $manager->persist($subject);
        }

        $manager->flush();
    }
    public function initializeSubjectData(): void
    {
        $this->subjectsData = [
            [
                'id' => '07abc29e-07db-483e-aece-236910c79117',
                'name' => 'Bases de Datos',
                'description' => 'La asignatura "Bases de datos" se centra en el reconocimiento y la utilidad de los sistemas gestores de bases de datos, así como en la creación y gestión de bases de datos relacionales y no relacionales. Aborda la programación de procedimientos almacenados, el diseño lógico y físico de bases de datos, la normalización de esquemas, y la ejecución de consultas y modificaciones de datos. También incluye la interpretación de diagramas entidad/relación y el uso de herramientas para la gestión y optimización de la información. Esta formación es esencial para desempeñar funciones clave en la gestión y desarrollo de aplicaciones que acceden a bases de datos.',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868', '3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0'],
            ],
            [
                'id' => '1665217d-4864-4e0d-bfa3-ac3b29fd7e2c',
                'name' => 'Programación',
                'description' => 'La asignatura "Programación" se enfoca en el desarrollo de programas organizados en clases aplicando principios de programación orientada a objetos. Se abordan aspectos como la identificación y uso de elementos del lenguaje de programación, la escritura y prueba de programas simples, el uso de estructuras de control, y el desarrollo de clases y objetos. Además, se enseña a realizar operaciones de entrada y salida de información, a manipular datos avanzados, y a aplicar características avanzadas de los lenguajes orientados a objetos. También incluye el uso de bases de datos orientadas a objetos y la gestión de información almacenada en bases de datos, garantizando la integridad y consistencia de los datos.',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868', '3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0'],
            ],
            [
                'id' => '1b2a7bf8-e997-4df5-8ec1-9408e00c9504',
                'name' => 'Lenguajes de marcas y sistemas de gestión de información',
                'description' => 'El módulo profesional "Lenguajes de marcas y sistemas de gestión de información" enseña a reconocer y utilizar lenguajes de marcas para la transmisión y presentación de información web, así como a gestionar información en sistemas empresariales. Los estudiantes aprenden a identificar características y ventajas de lenguajes de marcas, utilizar HTML y CSS para crear y validar documentos web, manipular documentos mediante scripts de cliente, establecer mecanismos de validación y conversión de documentos para el intercambio de información, y gestionar información en bases de datos relacionales y nativas. Además, se abordan la instalación, administración y configuración de sistemas de gestión empresarial, integrando módulos y asegurando el acceso seguro a la información.',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868', '3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0', '08743d2a-d22c-4272-b804-5c91d44dd079'],
            ],
            [
                'id' => '3a05bffa-3b16-4795-8cc7-d068d143e32d',
                'name' => 'Entornos de desarrollo',
                'description' => 'El módulo profesional "Entornos de desarrollo" capacita a los estudiantes en el reconocimiento de los elementos y herramientas esenciales para desarrollar programas informáticos, abordando desde la relación de los programas con los componentes del sistema informático hasta las fases del desarrollo de una aplicación. Se estudian los conceptos de código fuente, objeto y ejecutable, así como la generación de código intermedio y los distintos lenguajes de programación. Se evalúan entornos integrados de desarrollo para editar código y generar ejecutables, personalizando y automatizando su configuración. Además, se realiza verificación y optimización del software mediante pruebas, refactorización de código y generación de diagramas de clases y comportamiento, empleando herramientas específicas para cada tarea. Este módulo prepara a los estudiantes para funciones como desarrolladores de aplicaciones, proporcionando las habilidades necesarias en el uso efectivo de herramientas de desarrollo, documentación técnica, diseño y ejecución de pruebas, optimización de código y trabajo colaborativo con sistemas de control de versiones.',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868', '3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0'],
            ],
            [
                'id' => '3b9af95f-3ab0-45a5-a9f3-4cce420730ad',
                'name' => 'Acceso a datos',
                'description' => 'El módulo profesional "Acceso a datos" se centra en capacitar a los estudiantes en el desarrollo de aplicaciones capaces de gestionar información almacenada en diversas fuentes de datos. Desde la manipulación de ficheros y directorios utilizando clases específicas, hasta el manejo de bases de datos relacionales, orientadas a objetos y documentales mediante conectores y herramientas ORM, se abordan todos los aspectos clave del acceso y persistencia de datos. Los criterios de evaluación incluyen el uso eficaz de clases para operaciones de lectura y escritura en ficheros, la implementación de consultas y transacciones en bases de datos, así como la creación y gestión de componentes de acceso a datos para integrar en aplicaciones multiplataforma. Este enfoque integral prepara a los estudiantes para enfrentar desafíos reales en el desarrollo de software, cumpliendo con estándares profesionales y adoptando las mejores prácticas en cada etapa del proceso.',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868'],
            ],
            [
                'id' => '3de83477-2166-489d-bccb-bea1a4ed3d18',
                'name' => 'Desarrollo de interfaces',
                'description' => 'El módulo profesional "Desarrollo de interfaces" se enfoca en capacitar a los estudiantes en la creación efectiva de interfaces gráficas de usuario y naturales, empleando herramientas visuales avanzadas. Los criterios de evaluación abarcan desde la utilización de editores visuales para diseñar interfaces gráficas y modificar el código generado, hasta la integración de reconocimiento de voz, detección de movimientos y realidad aumentada en interfaces naturales. Se enfatiza también la creación de componentes visuales personalizados, el diseño conforme a estándares de usabilidad y accesibilidad, la generación de informes detallados, la documentación exhaustiva de aplicaciones y la preparación adecuada para la distribución de software. Este enfoque integral prepara a los estudiantes para enfrentar desafíos prácticos en el desarrollo de aplicaciones multiplataforma, cumpliendo con estándares profesionales y mejorando la experiencia del usuario final.',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868'],
            ],
            [
                'id' => '57a99450-bbf1-46fe-a1a9-5ab2197898c0',
                'name' => 'Programación multimedia y dispositivos móviles',
                'description' => 'El módulo profesional "Programación multimedia y dispositivos móviles" se centra en el desarrollo avanzado de aplicaciones y juegos para dispositivos móviles. Los estudiantes exploran tecnologías específicas para optimizar el rendimiento y la funcionalidad de las aplicaciones móviles, desde la configuración de entornos de desarrollo hasta la implementación en dispositivos reales mediante emuladores y pruebas exhaustivas. Además, se enfatiza en la integración de contenido multimedia y la utilización de motores de juegos para crear experiencias interactivas en 2D y 3D. Este enfoque prepara a los alumnos para resolver desafíos técnicos y desarrollar soluciones innovadoras en el campo de la programación móvil y multimedia.',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868'],
            ],
            [
                'id' => '5ce6e386-5106-436f-9f10-32345be3a952',
                'name' => 'Programación de servicios y procesos',
                'description' => 'El módulo profesional "Programación de servicios y procesos" se enfoca en capacitar a los estudiantes en el desarrollo avanzado de aplicaciones que aprovechan las capacidades de procesamiento paralelo y distribuido. Se exploran principios fundamentales de la programación concurrente y paralela, así como el uso de hilos y procesos para ejecutar tareas simultáneas. Los estudiantes aprenden a programar aplicaciones que gestionan múltiples hilos de ejecución, utilizando mecanismos para la sincronización y el intercambio seguro de información entre ellos. Además, se aborda la programación de comunicaciones en red mediante el uso de sockets, implementando tanto aplicaciones cliente como servidor. Se hace hincapié en la seguridad, integrando prácticas de programación segura y técnicas criptográficas para proteger el acceso, almacenamiento y transmisión de datos sensibles. Este enfoque prepara a los alumnos para resolver desafíos técnicos en el desarrollo de sistemas distribuidos y servicios en red, cumpliendo con estándares de eficiencia y seguridad en el ámbito profesional.',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868'],
            ],
            [
                'id' => '65056d32-db90-4379-86f4-ab5cdf3ddf71',
                'name' => 'Sistemas de gestión empresarial',
                'description' => 'El módulo profesional "Sistemas de gestión empresarial" se centra en la implementación y adaptación de sistemas ERP y CRM. Los estudiantes aprenden a identificar, comparar, instalar y configurar estos sistemas, reconociendo sus características y tipos de licencia. Además, se capacitan en la gestión de módulos, actualización de sistemas y verificación de su funcionamiento. También se aborda la realización de operaciones de gestión, consulta y análisis de información utilizando las herramientas proporcionadas por los ERP-CRM, así como la adaptación de estos sistemas a las necesidades empresariales y el desarrollo de nuevos componentes.',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868'],
            ],
            [
                'id' => '696fcb03-b1dc-43fe-a091-10474ee0b6cb',
                'name' => 'Sistemas informáticos',
                'description' => 'El módulo profesional "Sistemas informáticos" aborda la evaluación, instalación, gestión y configuración de sistemas operativos y redes. Los estudiantes aprenden a identificar y clasificar componentes de hardware y tipos de memorias, así como a instalar y configurar sistemas operativos libres y propietarios, y a gestionar la información del sistema mediante comandos y herramientas gráficas. Además, se enfocan en la interconexión de sistemas en red, configurando dispositivos y protocolos, y en la gestión de recursos de red, garantizando la seguridad y optimización del sistema. El módulo también cubre la elaboración de documentación técnica y la explotación de aplicaciones informáticas de propósito general, utilizando herramientas ofimáticas y de trabajo colaborativo.',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868', '3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0'],
            ],
            [
                'id' => '69cd768b-b3d5-4697-b5ef-c8e983a48d77',
                'name' => 'Desarrollo web en entorno cliente',
                'description' => 'El módulo profesional "Desarrollo web en entorno cliente" se centra en la formación para crear aplicaciones web que se ejecutan en navegadores, abarcando una amplia gama de habilidades y conocimientos. Los estudiantes aprenden a seleccionar tecnologías de programación, escribir y depurar código, manejar objetos predefinidos y crear estructuras de datos complejas. Además, se desarrollan aplicaciones interactivas utilizando eventos y formularios, y se integran mecanismos de comunicación asíncrona entre cliente y servidor. El módulo enfatiza la independencia de capas de implementación y la utilización de librerías y frameworks para la actualización dinámica del contenido web. Esta formación contribuye a alcanzar objetivos generales y competencias profesionales, personales y sociales del ciclo formativo, preparando a los alumnos para desarrollar y adaptar aplicaciones web para clientes en diversos entornos.',
                'programs' => ['3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0'],
            ],
            [
                'id' => '816fdfd2-1847-4136-b47a-1bf23c6c5172',
                'name' => 'Desarrollo web en entorno servidor',
                'description' => 'El módulo "Desarrollo web en entorno servidor" enseña a crear y gestionar aplicaciones y servicios web en servidores. Los estudiantes aprenden a diferenciar entre ejecución en cliente y servidor, utilizar lenguajes y tecnologías para programación web en servidor, integrar lenguajes de marcas con código embebido, y aplicar mecanismos de generación dinámica de páginas web. También se enfocan en el manejo de datos, la autenticación de usuarios, la separación de lógica de negocio y presentación, y el uso de frameworks. El módulo cubre la creación y consumo de servicios web, acceso a bases de datos, y el desarrollo de aplicaciones híbridas que incorporan Big Data e inteligencia de negocios, garantizando la seguridad y la integridad de la información.',
                'programs' => ['3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0'],
            ],
            [
                'id' => '9dc21d04-d36d-41f5-b38d-48ce8403e2f8',
                'name' => 'Despliegue de aplicaciones web',
                'description' => 'El módulo "Despliegue de aplicaciones web" enseña a implementar, administrar y asegurar aplicaciones web en servidores. Los estudiantes aprenden sobre arquitecturas web, instalación y configuración de servidores web y de aplicaciones, así como tecnologías de virtualización en la nube y contenedores. El curso cubre la configuración avanzada de servidores, la administración de la transferencia de archivos, la configuración de servicios de red para aplicaciones web y el uso de herramientas de control de versiones y de integración continua. Además, se enfoca en la documentación de aplicaciones y el uso de herramientas de gestión de logs para la toma de decisiones. La formación del módulo abarca aspectos de instalación, configuración y despliegue seguro de aplicaciones web, contribuyendo al desarrollo de competencias profesionales en mantenimiento y actualización de estas aplicaciones.',
                'programs' => ['3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0'],
            ],
            [
                'id' => 'c26f0131-080d-4f8c-9f74-2b0d58e7950d',
                'name' => 'Diseño de interfaces web',
                'description' => 'El módulo "Diseño de interfaces web" aborda la planificación y creación de interfaces web aplicando principios de diseño y usabilidad. Se estudian elementos como color, tipografía, y guías de estilo, y se aprende a usar tecnologías y frameworks para diseñar interfaces responsivas. También se cubre la preparación e integración de archivos multimedia (imágenes, audio, vídeo) y la creación de contenido interactivo. Se enfatiza la accesibilidad y usabilidad de las webs, aplicando pautas del W3C y realizando verificaciones con herramientas específicas. Este módulo de 80 horas contribuye al desarrollo de aplicaciones web que cumplen con criterios de accesibilidad y optimización para motores de búsqueda, asegurando interfaces amigables y funcionales en diversos dispositivos y navegadores.',
                'programs' => ['3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0'],
            ],
            [
                'id' => 'c3a120a3-0aa8-499d-8cf3-23b615de2e94',
                'name' => 'Implantación de Sistemas Operativos',
                'description' => 'El módulo profesional de Implantación de Sistemas Operativos se centra en desarrollar habilidades para instalar, configurar y administrar sistemas operativos en entornos informáticos. Los estudiantes aprenderán a analizar las características de diferentes sistemas operativos, comparar versiones y licencias, realizar instalaciones y aplicar técnicas de actualización y recuperación del sistema. Además, se enfocarán en resolver incidencias del sistema y del proceso de inicio, utilizar herramientas para gestionar el software instalado y documentar adecuadamente las actividades realizadas.',
                'programs' => ['08743d2a-d22c-4272-b804-5c91d44dd079'],
            ],
            [
                'id' => 'cdf06edc-8891-4f83-8250-c4ac20fa0992',
                'name' => 'Planificación y Administración de Redes',
                'description' => 'El módulo profesional de Planificación y Administración de Redes se centra en desarrollar competencias clave para configurar y administrar redes de datos. Los objetivos principales incluyen el reconocimiento de la estructura y componentes de las redes, la integración de equipos en redes cableadas e inalámbricas, la configuración de conmutadores y routers, la implementación de VLANs, y el análisis de protocolos dinámicos de encaminamiento. Este curso proporciona las habilidades necesarias para gestionar infraestructuras de red, desde conceptos básicos hasta tareas avanzadas de administración y configuración.',
                'programs' => ['08743d2a-d22c-4272-b804-5c91d44dd079'],
            ],
            [
                'id' => 'd2d2ac47-fc54-42ec-885a-1da45f674b88',
                'name' => 'Gestión de Base de Datos',
                'description' => 'El módulo de Gestión de Base de Datos se centra en capacitar a los estudiantes en el diseño y administración eficiente de sistemas de bases de datos. A lo largo del curso, los participantes aprenderán a reconocer y analizar diversos sistemas de almacenamiento de información, identificarán modelos de datos y diseñarán esquemas lógicos utilizando diagramas entidad-relación. Además, adquirirán habilidades prácticas en la implementación física de bases de datos, realización de consultas complejas, manipulación de datos, gestión de seguridad e integridad de la información, así como técnicas avanzadas de copias de seguridad y transferencia de datos entre sistemas gestores.',
                'programs' => ['08743d2a-d22c-4272-b804-5c91d44dd079'],
            ],
            [
                'id' => 'e54b90a6-3b25-4310-aa50-ac042a723c91',
                'name' => 'Servicios de Red e Internet',
                'description' => 'El módulo profesional de Servicios de Red e Internet capacita a los estudiantes en la instalación y administración de infraestructuras clave para redes y servicios en línea. Durante el curso, los participantes aprenderán a configurar y gestionar servicios fundamentales como la resolución de nombres de dominio, la configuración automática de redes, servidores web, transferencia de archivos, correo electrónico, mensajería instantánea, noticias, listas de distribución, así como servicios de audio y vídeo. Se enfatiza en la seguridad, la eficiencia operativa y la documentación detallada de todas las configuraciones y procedimientos implementados.',
                'programs' => ['08743d2a-d22c-4272-b804-5c91d44dd079'],
            ],
            [
                'id' => 'ef7f7c77-b835-4ab8-b5b2-18c446f55387',
                'name' => 'Implantación de Aplicaciones Web',
                'description' => 'El módulo profesional de Implantación de Aplicaciones Web proporciona una formación integral en la preparación y administración de entornos de desarrollo y servidores de aplicaciones web, así como en la instalación y configuración de gestores de contenidos y aplicaciones de ofimática web. Los estudiantes adquieren habilidades para integrar tecnologías esenciales, asegurar la accesibilidad y seguridad de los sistemas, y realizar tareas avanzadas como la generación de documentos web dinámicos y la gestión de bases de datos. Este curso prepara a los participantes para enfrentar los desafíos actuales en el ámbito de las aplicaciones web, enfocándose en la eficiencia operativa y la adaptación a las necesidades específicas de cada proyecto.',
                'programs' => ['08743d2a-d22c-4272-b804-5c91d44dd079'],
            ],
            [
                'id' => 'f544abe9-3f89-47f5-b202-8b564939f793',
                'name' => 'Administración de Sistemas Gestores de Bases de Datos',
                'description' => 'El módulo profesional de Administración de Sistemas Gestores de Bases de Datos proporciona una formación completa en la instalación, configuración, y administración de sistemas gestores de bases de datos (SGBD). Los estudiantes adquieren habilidades para seleccionar y desplegar SGBD según requisitos específicos del sistema, configurar parámetros técnicos y de red, y gestionar la seguridad mediante la asignación de permisos y roles. Además, aprenden a automatizar tareas administrativas mediante la creación de guiones, optimizar el rendimiento a través de técnicas de monitorización y ajustes de índices, y aplicar criterios de disponibilidad en entornos distribuidos y replicados. Este curso prepara a los participantes para enfrentar los desafíos de la administración eficiente y segura de bases de datos, integrándose con las necesidades operativas de cualquier organización.',
                'programs' => ['08743d2a-d22c-4272-b804-5c91d44dd079'],
            ],
            [
                'id' => 'fdbdc7ad-c8c4-433e-8c9e-0c760efd740b',
                'name' => 'Seguridad y Alta Disponibilidad',
                'description' => 'El módulo profesional de Seguridad y Alta Disponibilidad proporciona una formación integral en prácticas y técnicas avanzadas de seguridad informática, así como en la implementación de soluciones que garantizan la continuidad operativa de sistemas críticos. Los estudiantes adquieren habilidades para evaluar vulnerabilidades y aplicar medidas de protección física y lógica, asegurar el acceso remoto de manera segura, configurar cortafuegos y servidores proxy, y desplegar soluciones de alta disponibilidad mediante virtualización y sistemas redundantes. Además, se enfatiza el cumplimiento de la legislación vigente sobre protección de datos y servicios de la sociedad de la información. Este curso prepara a los participantes para enfrentar los desafíos actuales de seguridad informática y mantener la disponibilidad de servicios esenciales en entornos empresariales críticos.',
                'programs' => ['08743d2a-d22c-4272-b804-5c91d44dd079'],
            ],
            [
                'id' => '397333f2-b670-491b-b64a-3dea943522e6',
                'name' => 'Empresa e Iniciativa Emprendedora',
                'description' => 'El módulo profesional de Empresa e Iniciativa Emprendedora proporciona a los estudiantes los conocimientos esenciales para entender y aplicar conceptos fundamentales del emprendimiento. A través de resultados de aprendizaje como el reconocimiento de la innovación y la cultura emprendedora, se busca fortalecer la capacidad de los estudiantes para identificar oportunidades empresariales. Además, se enfoca en desarrollar habilidades prácticas para la creación y gestión de pequeñas empresas, considerando aspectos legales, fiscales y financieros relevantes. Este enfoque integral prepara a los estudiantes para asumir roles tanto como emprendedores como profesionales con iniciativa y visión estratégica en entornos laborales existentes.',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868', '3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0', '08743d2a-d22c-4272-b804-5c91d44dd079', '74d8b517-4d63-4640-ba61-475f316d2e0d', 'e3d473e7-1517-4777-9161-9f27342f1fbf'],
            ],
            [
                'id' => '3358d26d-542c-4d99-a88e-88de00b882af',
                'name' => 'Formación y Orientación Laboral',
                'description' => 'El módulo profesional de Formación y Orientación Laboral (FOL) ofrece a los estudiantes una base sólida para entender las dinámicas del mercado laboral y las competencias necesarias para una inserción efectiva. A través de resultados de aprendizaje como la valoración de la formación continua y la identificación de itinerarios formativos específicos, los estudiantes adquieren habilidades para la búsqueda activa de empleo y la toma de decisiones informadas sobre su carrera profesional. Además, se enfoca en el desarrollo de competencias en gestión de equipos, resolución de conflictos y conocimientos en derecho laboral y seguridad social, preparándolos para enfrentar los retos del entorno laboral moderno con eficacia y responsabilidad. Este enfoque integral no solo promueve la empleabilidad, sino que también fortalece la capacidad de los estudiantes para contribuir positivamente en las organizaciones.',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868', '3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0', '08743d2a-d22c-4272-b804-5c91d44dd079', '74d8b517-4d63-4640-ba61-475f316d2e0d', 'e3d473e7-1517-4777-9161-9f27342f1fbf'],
            ],
            [
                'id' => '38450441-f152-4e41-b954-206e05c8fa4d',
                'name' => 'Montaje y mantenimiento de equipos',
                'description' => 'El módulo profesional de Montaje y Mantenimiento de Equipos se enfoca en el conocimiento y la práctica relacionados con la configuración, ensamblaje y mantenimiento de sistemas microinformáticos. Abarca la selección y análisis de componentes esenciales, como placas base, microprocesadores, memorias y dispositivos de almacenamiento, así como la comprensión de sus funciones y características. Incluye la realización de procedimientos de montaje de equipos, técnicas de diagnóstico y mantenimiento preventivo y correctivo. Además, cubre la instalación de software, manejo de periféricos y cumplimiento de normativas de seguridad laboral y protección ambiental. También se considera la integración de nuevas tendencias tecnológicas y el uso de herramientas para garantizar un rendimiento óptimo y la longevidad de los equipos microinformáticos.',
                'programs' => ['e3d473e7-1517-4777-9161-9f27342f1fbf'],
            ],
            [
                'id' => 'b089a86f-19ef-4ba1-b765-e0bb7cf16ffe',
                'name' => 'Sistemas operativos monopuesto',
                'description' => 'El módulo profesional de Sistemas Operativos Monopuesto se centra en el manejo y administración de sistemas operativos en entornos de un solo usuario. Explora la caracterización de sistemas operativos, abordando tanto libres como propietarios, y sus funciones esenciales como gestión de recursos y procesos. Los contenidos incluyen operaciones fundamentales con sistemas de archivos, instalación y configuración de sistemas operativos, y realización de tareas básicas como el arranque, la actualización y la administración del software. También cubre la administración de perfiles de usuario, la gestión del rendimiento del sistema y la compartición de recursos. Además, se incluye la configuración de máquinas virtuales, abordando la virtualización y el uso de software tanto propietario como libre para crear y gestionar entornos virtuales.',
                'programs' => ['e3d473e7-1517-4777-9161-9f27342f1fbf'],
            ],
            [
                'id' => '93301f02-e766-4f50-a4f4-801998d24645',
                'name' => 'Aplicaciones ofimáticas',
                'description' => 'El módulo profesional de Aplicaciones Ofimáticas se centra en el uso y gestión de software de oficina para realizar tareas administrativas y de documentación. Aborda la instalación y configuración de diversas aplicaciones ofimáticas, como procesadores de texto, hojas de cálculo, bases de datos y paquetes ofimáticos completos. Los contenidos incluyen la creación y gestión de documentos utilizando estilos, plantillas y macros en procesadores de texto y hojas de cálculo, así como la elaboración de documentos con tablas y gráficos dinámicos. También cubre la manipulación de imágenes y videos, el diseño de presentaciones, y la gestión de correo electrónico y agendas electrónicas. Además, se enfoca en la elaboración de guías y manuales de usuario, y en la formación de usuarios para un manejo eficaz de las aplicaciones ofimáticas.',
                'programs' => ['e3d473e7-1517-4777-9161-9f27342f1fbf'],
            ],
            [
                'id' => '7cc81385-ee12-4f89-98f4-276fd060d71f',
                'name' => 'Sistemas operativos en red',
                'description' => 'El módulo de Sistemas Operativos en Red aborda la gestión y administración de sistemas operativos diseñados para funcionar en un entorno de red, facilitando la comunicación, el intercambio de recursos y la administración centralizada. Incluye el estudio de sistemas operativos que permiten la conexión y operación de múltiples dispositivos en una red, ya sea en redes locales (LAN) o en redes más amplias (WAN). Los contenidos abarcan la instalación y configuración de sistemas operativos en red, la gestión de recursos compartidos, la administración de usuarios y grupos, y el control de permisos y seguridad. Se examina la configuración de servicios de red como DNS, DHCP y servicios de archivos e impresión, así como la implementación de políticas de seguridad y la resolución de problemas de conectividad y rendimiento en entornos de red. Además, se trata la integración de sistemas operativos en red con otros servicios y aplicaciones, optimizando el uso de recursos y garantizando la estabilidad y seguridad de la red.',
                'programs' => ['e3d473e7-1517-4777-9161-9f27342f1fbf'],
            ],
            [
                'id' => 'b423b24b-5dd7-4b2e-9322-35289cb7af89',
                'name' => 'Redes locales',
                'description' => 'En el módulo de Redes Locales, se aborda el despliegue y gestión de redes de área local (LAN), comenzando con la caracterización de redes locales, incluyendo sus características, ventajas e inconvenientes, tipos y topologías comunes. Se detalla la identificación de elementos y espacios físicos cruciales como cuartos de comunicaciones, armarios de comunicaciones y paneles de parcheo, así como la instalación de cableado estructurado utilizando medios de transmisión como par trenzado y fibra óptica. El módulo cubre la interconexión de equipos mediante adaptadores para redes cableadas e inalámbricas y la instalación/configuración de equipos de red, abordando el modelo OSI, protocolos como TCP/IP, y la configuración de direcciones IP. Se enfatiza la seguridad básica en redes, la resolución de incidencias físicas y lógicas, y la monitorización de redes utilizando herramientas de diagnóstico. Finalmente, se abordan las normas de prevención de riesgos laborales y protección ambiental relacionadas con el montaje y mantenimiento de redes, asegurando un cumplimiento adecuado de las normativas de seguridad y ambientales.',
                'programs' => ['e3d473e7-1517-4777-9161-9f27342f1fbf'],
            ],
            [
                'id' => '7b251a2e-162e-4e43-8370-917f33fd6d6f',
                'name' => 'Seguridad informática',
                'description' => 'En el módulo de Seguridad Informática, se estudia la implementación de medidas para proteger los sistemas informáticos a través de enfoques tanto pasivos como activos. Se exploran los tipos de seguridad, diferenciando entre activa y pasiva, y se enfatiza la necesidad de seguridad en entornos de red. La protección física de equipos y servidores, junto con la gestión de la alimentación eléctrica mediante sistemas de alimentación ininterrumpida, es crucial para mantener la integridad del sistema. El módulo abarca la gestión de dispositivos de almacenamiento, incluyendo almacenamiento redundante, distribuido, y remoto, y el uso de sistemas RAID para copias de seguridad e imágenes de respaldo. Se profundiza en la seguridad activa, con la implementación de identificación digital, firma electrónica, certificados digitales, y el uso de cortafuegos (hardware y software), así como listas de control de acceso y políticas de contraseñas. Además, se trata la protección contra software malicioso y el aseguramiento de la privacidad de la información, incluyendo la prevención de fraudes informáticos y robos de información. Se revisan los métodos para asegurar la privacidad en la transmisión de datos y el cumplimiento de la legislación vigente sobre protección de datos y servicios de la sociedad de la información.',
                'programs' => ['e3d473e7-1517-4777-9161-9f27342f1fbf'],
            ],
            [
                'id' => 'b18f6ac7-2962-436a-9609-20893b570a97',
                'name' => 'Servicios en red',
                'description' => 'En el módulo de Servicios en Red, se cubren diversos aspectos esenciales para la instalación, gestión y seguridad de servicios de red. El módulo comienza con la instalación de servicios de configuración dinámica, abordando la asignación de direcciones IP, máscaras de red, y puertas de enlace, y profundiza en el protocolo DHCP, incluyendo la configuración de rangos, exclusiones, concesiones y reservas. Luego, se exploran los servicios de resolución de nombres, destacando la importancia de estos servicios, sus componentes, y la diferencia entre sistemas de nombres planos y jerárquicos, así como la gestión de zonas y registros. En cuanto a los servicios de transferencia de ficheros, se analizan los objetivos, modos activo y pasivo, y la configuración de permisos y cuotas. Se revisa la gestión de servicios de correo electrónico, abarcando desde la configuración de cuentas y buzones hasta la identificación de vulnerabilidades. La gestión de servidores web se enfoca en la instalación y configuración de servidores, el uso de servidores virtuales, y los métodos de autentificación. El módulo también aborda el acceso remoto, la seguridad asociada y la instalación de terminales tanto en modo texto como gráfico. En la sección de redes inalámbricas, se examinan sus características, la selección de componentes, y los procesos de instalación y seguridad. Finalmente, se trata la interconexión de redes privadas con públicas, explorando tecnologías como pasarelas, almacenamiento en caché y enrutamiento de tráfico entre interfaces de red.',
                'programs' => ['e3d473e7-1517-4777-9161-9f27342f1fbf'],
            ],
            [
                'id' => '7eb6bfe5-6fe1-4d72-a854-1ab416e6c3ef',
                'name' => 'Aplicaciones web',
                'description' => 'En el módulo de Aplicaciones Web, se aborda la instalación y gestión de diversas herramientas y servicios web esenciales para la administración y funcionalidad de sitios y plataformas en línea. El módulo comienza con la instalación de gestores de contenidos, destacando su utilidad para la gestión de sitios web, tanto comerciales como de código abierto, y su configuración en sistemas operativos libres y propietarios. Se exploran las funcionalidades proporcionadas por estos gestores, incluyendo la creación de usuarios y grupos, la personalización del entorno, y la gestión de módulos y menús. Se profundiza en la instalación de sistemas de gestión de aprendizaje a distancia, cubriendo características como la comunicación, los materiales y actividades, así como la personalización del entorno y la creación de cursos. Además, se revisa la instalación de servicios de gestión de archivos web, que incluye la administración de recursos compartidos y la configuración de usuarios y permisos. El módulo también aborda la instalación de aplicaciones de ofimática web, enfocándose en su utilización, gestión de usuarios y comprobación de seguridad. Finalmente, se trata la instalación de aplicaciones web de escritorio, como aplicaciones de correo web, abarcando su instalación y gestión de usuarios.',
                'programs' => ['e3d473e7-1517-4777-9161-9f27342f1fbf'],
            ],
            [
                'id' => '1d5bda43-be9f-4a0b-92ff-ab6a7958eb49',
                'name' => 'Habilidades sociales',
                'description' => 'Este módulo de Habilidades Sociales está diseñado para dotar a los estudiantes de competencias esenciales en comunicación y dinamización grupal, fundamentales para su desempeño en el sector del acondicionamiento físico. Los resultados de aprendizaje abarcan desde la implementación de estrategias de comunicación basadas en inteligencia emocional, hasta la gestión de conflictos y la conducción de reuniones. El módulo se enfoca en el desarrollo de competencias como la empatía, la autocrítica, y el trabajo en equipo, así como en la capacidad para dinamizar grupos y resolver problemas de manera efectiva. Además, se subraya la importancia de la autoevaluación y la mejora continua en las habilidades sociales y la competencia profesional.',
                'programs' => ['74d8b517-4d63-4640-ba61-475f316d2e0d'],
            ],
            [
                'id' => '33b35e25-d033-42d4-9a53-194378a34131',
                'name' => 'Valoración de la condición física e intervención en accidentes',
                'description' => 'El módulo "Valoración de la condición física e intervención en accidentes" capacita al alumnado en la evaluación de la condición física y la motivación de los participantes en actividades físicas y deportivas, así como en la aplicación de primeros auxilios en caso de accidentes. A través del análisis fisiológico, biomecánico y la práctica de pruebas de valoración, los estudiantes aprenderán a elaborar programas de acondicionamiento físico, aplicar técnicas de recuperación, y manejar situaciones de emergencia mediante técnicas de soporte vital y movilización segura de personas accidentadas.',
                'programs' => ['74d8b517-4d63-4640-ba61-475f316d2e0d'],
            ],
            [
                'id' => '389facc9-a910-45dc-8451-b6e5278d289a',
                'name' => 'Fitness en sala de entrenamiento polivalente',
                'description' => 'El módulo "Fitness en sala de entrenamiento polivalente" capacita al alumnado en la organización y dirección de actividades de acondicionamiento físico en salas de entrenamiento. A través de este módulo, se adquieren habilidades para planificar programas de fitness, gestionar el espacio y los recursos de la sala, y dirigir sesiones de entrenamiento adaptadas a diversos perfiles de usuarios. Se enfatiza la seguridad, la prevención de lesiones, y la organización de eventos, con el objetivo de mejorar la condición física de los participantes mediante un enfoque integral que incluye la evaluación continua y la motivación activa.',
                'programs' => ['74d8b517-4d63-4640-ba61-475f316d2e0d'],
            ],
            [
                'id' => '4c4553fc-771b-42eb-948f-6d89a4306c13',
                'name' => 'Actividades especializadas de acondicionamiento físico con soporte musical',
                'description' => 'El módulo se enfoca en la programación, diseño y dirección de actividades especializadas de acondicionamiento físico en grupo con soporte musical. Los estudiantes deben analizar los aspectos técnicos y efectos de estas actividades, evaluando la dificultad de ejecución y las adaptaciones fisiológicas que provocan en el organismo. También se les exige identificar síntomas de fatiga y sobrecarga, así como reconocer las contraindicaciones para cada modalidad. Además, deben programar actividades teniendo en cuenta las necesidades de los usuarios, diseñar coreografías adecuadas para diferentes niveles y estilos, y dirigir sesiones, asegurando la correcta ejecución y adaptación de los ejercicios a las características del grupo.',
                'programs' => ['74d8b517-4d63-4640-ba61-475f316d2e0d'],
            ],
            [
                'id' => '7e4ad9c1-1784-4c02-b0e5-2a5e7a0dcd40',
                'name' => 'Acondicionamiento físico en el agua',
                'description' => 'El módulo de Acondicionamiento Físico en el Agua está diseñado para capacitar a los estudiantes en la programación, organización, diseño, dirección y evaluación de actividades de fitness acuático. Se enfoca en analizar las características de las actividades acuáticas y sus efectos sobre el organismo, considerando adaptaciones fisiológicas y riesgos asociados. Los estudiantes deben organizar recursos, programar y diseñar actividades de acuerdo con las necesidades de los usuarios y las condiciones del medio acuático, y aplicar técnicas de rescate en situaciones de emergencia. Además, el módulo abarca la aplicación de técnicas específicas para la dirección efectiva de sesiones y la creación de ambientes seguros y accesibles. Incluye 100 horas de formación práctica y teórica, y cubre temas como la organización de eventos acuáticos, el diseño de sesiones adaptadas a diferentes niveles, y el uso de tecnología y software específicos para la mejora de la condición física en el agua.',
                'programs' => ['74d8b517-4d63-4640-ba61-475f316d2e0d'],
            ],
            [
                'id' => 'b9598b1c-e009-4cc0-8ff3-3dd2b0def60e',
                'name' => 'Técnicas de hidrocinesia',
                'description' => 'El módulo de Técnicas de Hidrocinesia está diseñado para capacitar a los estudiantes en la planificación, dirección y evaluación de actividades acuáticas terapéuticas. Abarca el análisis de movimientos específicos en hidrocinesia, incluyendo la evaluación de su impacto funcional, la identificación de puntos críticos para prevenir lesiones y la gestión de fatiga y sobrecarga. También cubre la supervisión y preparación del espacio acuático y los recursos materiales necesarios, asegurando su buen estado y seguridad. Los estudiantes aprenderán a elaborar protocolos personalizados para diferentes perfiles de usuarios y a dirigir sesiones de hidrocinesia, adaptando las técnicas y los ejercicios a las necesidades individuales. Además, se enfoca en la evaluación de los resultados y la calidad del servicio, utilizando herramientas y métodos adecuados para la mejora continua de los programas.',
                'programs' => ['74d8b517-4d63-4640-ba61-475f316d2e0d'],
            ],
            [
                'id' => 'aacc162c-5836-406c-907e-b65c8da60f16',
                'name' => 'Control postural, bienestar y mantenimiento funcional',
                'description' => 'El módulo de Control Postural, Bienestar y Mantenimiento Funcional, se enfoca en capacitar a los estudiantes en la planificación, supervisión, dirección y evaluación de actividades orientadas a mejorar la postura, el bienestar y la funcionalidad. Los resultados de aprendizaje incluyen la programación de actividades específicas según perfiles de usuarios y recursos disponibles, supervisión del espacio y equipos, diseño y dirección de sesiones, y evaluación de la calidad y efectividad del servicio. Los contenidos abarcan desde técnicas y biomecánica hasta métodos como la gimnasia correctiva, el taichí y el método Pilates, considerando adaptaciones para personas con discapacidad. El módulo también aborda la seguridad, la adaptación de espacios y materiales, y la elaboración de propuestas de mejora basadas en la evaluación de los programas y sesiones. La formación incluye simulaciones prácticas, visitas institucionales y trabajo colaborativo, fomentando un entorno de confianza y comunicación efectiva.',
                'programs' => ['74d8b517-4d63-4640-ba61-475f316d2e0d'],
            ],
        ];
    }

    public function getDependencies(): array
    {
        return [ProgramFixtures::class];
    }
}
