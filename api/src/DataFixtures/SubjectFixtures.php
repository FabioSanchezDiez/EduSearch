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
                'name' => 'Bases de Datos',
                'description' => 'La asignatura "Bases de datos" se centra en el reconocimiento y la utilidad de los sistemas gestores de bases de datos, así como en la creación y gestión de bases de datos relacionales y no relacionales. Aborda la programación de procedimientos almacenados, el diseño lógico y físico de bases de datos, la normalización de esquemas, y la ejecución de consultas y modificaciones de datos. También incluye la interpretación de diagramas entidad/relación y el uso de herramientas para la gestión y optimización de la información. Esta formación es esencial para desempeñar funciones clave en la gestión y desarrollo de aplicaciones que acceden a bases de datos.',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868', '3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0'],
            ],
            [
                'name' => 'Programación',
                'description' => 'La asignatura "Programación" se enfoca en el desarrollo de programas organizados en clases aplicando principios de programación orientada a objetos. Se abordan aspectos como la identificación y uso de elementos del lenguaje de programación, la escritura y prueba de programas simples, el uso de estructuras de control, y el desarrollo de clases y objetos. Además, se enseña a realizar operaciones de entrada y salida de información, a manipular datos avanzados, y a aplicar características avanzadas de los lenguajes orientados a objetos. También incluye el uso de bases de datos orientadas a objetos y la gestión de información almacenada en bases de datos, garantizando la integridad y consistencia de los datos.',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868', '3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0'],
            ],
            [
                'name' => 'Lenguajes de marcas y sistemas de gestión de información',
                'description' => 'El módulo profesional "Lenguajes de marcas y sistemas de gestión de información" enseña a reconocer y utilizar lenguajes de marcas para la transmisión y presentación de información web, así como a gestionar información en sistemas empresariales. Los estudiantes aprenden a identificar características y ventajas de lenguajes de marcas, utilizar HTML y CSS para crear y validar documentos web, manipular documentos mediante scripts de cliente, establecer mecanismos de validación y conversión de documentos para el intercambio de información, y gestionar información en bases de datos relacionales y nativas. Además, se abordan la instalación, administración y configuración de sistemas de gestión empresarial, integrando módulos y asegurando el acceso seguro a la información.',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868', '3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0', '08743d2a-d22c-4272-b804-5c91d44dd079'],
            ],
            [
                'name' => 'Entornos de desarrollo',
                'description' => 'El módulo profesional "Entornos de desarrollo" capacita a los estudiantes en el reconocimiento de los elementos y herramientas esenciales para desarrollar programas informáticos, abordando desde la relación de los programas con los componentes del sistema informático hasta las fases del desarrollo de una aplicación. Se estudian los conceptos de código fuente, objeto y ejecutable, así como la generación de código intermedio y los distintos lenguajes de programación. Se evalúan entornos integrados de desarrollo para editar código y generar ejecutables, personalizando y automatizando su configuración. Además, se realiza verificación y optimización del software mediante pruebas, refactorización de código y generación de diagramas de clases y comportamiento, empleando herramientas específicas para cada tarea. Este módulo prepara a los estudiantes para funciones como desarrolladores de aplicaciones, proporcionando las habilidades necesarias en el uso efectivo de herramientas de desarrollo, documentación técnica, diseño y ejecución de pruebas, optimización de código y trabajo colaborativo con sistemas de control de versiones.',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868', '3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0'],
            ],
            [
                'name' => 'Acceso a datos',
                'description' => 'El módulo profesional "Acceso a datos" se centra en capacitar a los estudiantes en el desarrollo de aplicaciones capaces de gestionar información almacenada en diversas fuentes de datos. Desde la manipulación de ficheros y directorios utilizando clases específicas, hasta el manejo de bases de datos relacionales, orientadas a objetos y documentales mediante conectores y herramientas ORM, se abordan todos los aspectos clave del acceso y persistencia de datos. Los criterios de evaluación incluyen el uso eficaz de clases para operaciones de lectura y escritura en ficheros, la implementación de consultas y transacciones en bases de datos, así como la creación y gestión de componentes de acceso a datos para integrar en aplicaciones multiplataforma. Este enfoque integral prepara a los estudiantes para enfrentar desafíos reales en el desarrollo de software, cumpliendo con estándares profesionales y adoptando las mejores prácticas en cada etapa del proceso.',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868'],
            ],
            [
                'name' => 'Desarrollo de interfaces',
                'description' => 'El módulo profesional "Desarrollo de interfaces" se enfoca en capacitar a los estudiantes en la creación efectiva de interfaces gráficas de usuario y naturales, empleando herramientas visuales avanzadas. Los criterios de evaluación abarcan desde la utilización de editores visuales para diseñar interfaces gráficas y modificar el código generado, hasta la integración de reconocimiento de voz, detección de movimientos y realidad aumentada en interfaces naturales. Se enfatiza también la creación de componentes visuales personalizados, el diseño conforme a estándares de usabilidad y accesibilidad, la generación de informes detallados, la documentación exhaustiva de aplicaciones y la preparación adecuada para la distribución de software. Este enfoque integral prepara a los estudiantes para enfrentar desafíos prácticos en el desarrollo de aplicaciones multiplataforma, cumpliendo con estándares profesionales y mejorando la experiencia del usuario final.',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868'],
            ],
            [
                'name' => 'Programación multimedia y dispositivos móviles',
                'description' => 'El módulo profesional "Programación multimedia y dispositivos móviles" se centra en el desarrollo avanzado de aplicaciones y juegos para dispositivos móviles. Los estudiantes exploran tecnologías específicas para optimizar el rendimiento y la funcionalidad de las aplicaciones móviles, desde la configuración de entornos de desarrollo hasta la implementación en dispositivos reales mediante emuladores y pruebas exhaustivas. Además, se enfatiza en la integración de contenido multimedia y la utilización de motores de juegos para crear experiencias interactivas en 2D y 3D. Este enfoque prepara a los alumnos para resolver desafíos técnicos y desarrollar soluciones innovadoras en el campo de la programación móvil y multimedia.',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868'],
            ],
            [
                'name' => 'Programación de servicios y procesos',
                'description' => 'El módulo profesional "Programación de servicios y procesos" se enfoca en capacitar a los estudiantes en el desarrollo avanzado de aplicaciones que aprovechan las capacidades de procesamiento paralelo y distribuido. Se exploran principios fundamentales de la programación concurrente y paralela, así como el uso de hilos y procesos para ejecutar tareas simultáneas. Los estudiantes aprenden a programar aplicaciones que gestionan múltiples hilos de ejecución, utilizando mecanismos para la sincronización y el intercambio seguro de información entre ellos. Además, se aborda la programación de comunicaciones en red mediante el uso de sockets, implementando tanto aplicaciones cliente como servidor. Se hace hincapié en la seguridad, integrando prácticas de programación segura y técnicas criptográficas para proteger el acceso, almacenamiento y transmisión de datos sensibles. Este enfoque prepara a los alumnos para resolver desafíos técnicos en el desarrollo de sistemas distribuidos y servicios en red, cumpliendo con estándares de eficiencia y seguridad en el ámbito profesional.',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868'],
            ],
            [
                'name' => 'Sistemas de gestión empresarial',
                'description' => 'El módulo profesional "Sistemas de gestión empresarial" se centra en la implementación y adaptación de sistemas ERP y CRM. Los estudiantes aprenden a identificar, comparar, instalar y configurar estos sistemas, reconociendo sus características y tipos de licencia. Además, se capacitan en la gestión de módulos, actualización de sistemas y verificación de su funcionamiento. También se aborda la realización de operaciones de gestión, consulta y análisis de información utilizando las herramientas proporcionadas por los ERP-CRM, así como la adaptación de estos sistemas a las necesidades empresariales y el desarrollo de nuevos componentes.',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868'],
            ],
            [
                'name' => 'Sistemas informáticos',
                'description' => 'El módulo profesional "Sistemas informáticos" aborda la evaluación, instalación, gestión y configuración de sistemas operativos y redes. Los estudiantes aprenden a identificar y clasificar componentes de hardware y tipos de memorias, así como a instalar y configurar sistemas operativos libres y propietarios, y a gestionar la información del sistema mediante comandos y herramientas gráficas. Además, se enfocan en la interconexión de sistemas en red, configurando dispositivos y protocolos, y en la gestión de recursos de red, garantizando la seguridad y optimización del sistema. El módulo también cubre la elaboración de documentación técnica y la explotación de aplicaciones informáticas de propósito general, utilizando herramientas ofimáticas y de trabajo colaborativo.',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868', '3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0'],
            ],
            [
                'name' => 'Desarrollo web en entorno cliente',
                'description' => 'El módulo profesional "Desarrollo web en entorno cliente" se centra en la formación para crear aplicaciones web que se ejecutan en navegadores, abarcando una amplia gama de habilidades y conocimientos. Los estudiantes aprenden a seleccionar tecnologías de programación, escribir y depurar código, manejar objetos predefinidos y crear estructuras de datos complejas. Además, se desarrollan aplicaciones interactivas utilizando eventos y formularios, y se integran mecanismos de comunicación asíncrona entre cliente y servidor. El módulo enfatiza la independencia de capas de implementación y la utilización de librerías y frameworks para la actualización dinámica del contenido web. Esta formación contribuye a alcanzar objetivos generales y competencias profesionales, personales y sociales del ciclo formativo, preparando a los alumnos para desarrollar y adaptar aplicaciones web para clientes en diversos entornos.',
                'programs' => ['3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0'],
            ],
            [
                'name' => 'Desarrollo web en entorno servidor',
                'description' => 'El módulo "Desarrollo web en entorno servidor" enseña a crear y gestionar aplicaciones y servicios web en servidores. Los estudiantes aprenden a diferenciar entre ejecución en cliente y servidor, utilizar lenguajes y tecnologías para programación web en servidor, integrar lenguajes de marcas con código embebido, y aplicar mecanismos de generación dinámica de páginas web. También se enfocan en el manejo de datos, la autenticación de usuarios, la separación de lógica de negocio y presentación, y el uso de frameworks. El módulo cubre la creación y consumo de servicios web, acceso a bases de datos, y el desarrollo de aplicaciones híbridas que incorporan Big Data e inteligencia de negocios, garantizando la seguridad y la integridad de la información.',
                'programs' => ['3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0'],
            ],
            [
                'name' => 'Despliegue de aplicaciones web',
                'description' => 'El módulo "Despliegue de aplicaciones web" enseña a implementar, administrar y asegurar aplicaciones web en servidores. Los estudiantes aprenden sobre arquitecturas web, instalación y configuración de servidores web y de aplicaciones, así como tecnologías de virtualización en la nube y contenedores. El curso cubre la configuración avanzada de servidores, la administración de la transferencia de archivos, la configuración de servicios de red para aplicaciones web y el uso de herramientas de control de versiones y de integración continua. Además, se enfoca en la documentación de aplicaciones y el uso de herramientas de gestión de logs para la toma de decisiones. La formación del módulo abarca aspectos de instalación, configuración y despliegue seguro de aplicaciones web, contribuyendo al desarrollo de competencias profesionales en mantenimiento y actualización de estas aplicaciones.',
                'programs' => ['3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0'],
            ],
            [
                'name' => 'Diseño de interfaces web',
                'description' => 'El módulo "Diseño de interfaces web" aborda la planificación y creación de interfaces web aplicando principios de diseño y usabilidad. Se estudian elementos como color, tipografía, y guías de estilo, y se aprende a usar tecnologías y frameworks para diseñar interfaces responsivas. También se cubre la preparación e integración de archivos multimedia (imágenes, audio, vídeo) y la creación de contenido interactivo. Se enfatiza la accesibilidad y usabilidad de las webs, aplicando pautas del W3C y realizando verificaciones con herramientas específicas. Este módulo de 80 horas contribuye al desarrollo de aplicaciones web que cumplen con criterios de accesibilidad y optimización para motores de búsqueda, asegurando interfaces amigables y funcionales en diversos dispositivos y navegadores.',
                'programs' => ['3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0'],
            ],
            [
                'name' => 'Implantación de Sistemas Operativos',
                'description' => 'El módulo profesional de Implantación de Sistemas Operativos se centra en desarrollar habilidades para instalar, configurar y administrar sistemas operativos en entornos informáticos. Los estudiantes aprenderán a analizar las características de diferentes sistemas operativos, comparar versiones y licencias, realizar instalaciones y aplicar técnicas de actualización y recuperación del sistema. Además, se enfocarán en resolver incidencias del sistema y del proceso de inicio, utilizar herramientas para gestionar el software instalado y documentar adecuadamente las actividades realizadas.',
                'programs' => ['08743d2a-d22c-4272-b804-5c91d44dd079'],
            ],
            [
                'name' => 'Planificación y Administración de Redes',
                'description' => 'El módulo profesional de Planificación y Administración de Redes se centra en desarrollar competencias clave para configurar y administrar redes de datos. Los objetivos principales incluyen el reconocimiento de la estructura y componentes de las redes, la integración de equipos en redes cableadas e inalámbricas, la configuración de conmutadores y routers, la implementación de VLANs, y el análisis de protocolos dinámicos de encaminamiento. Este curso proporciona las habilidades necesarias para gestionar infraestructuras de red, desde conceptos básicos hasta tareas avanzadas de administración y configuración.',
                'programs' => ['08743d2a-d22c-4272-b804-5c91d44dd079'],
            ],
            [
                'name' => 'Gestión de Base de Datos',
                'description' => 'El módulo de Gestión de Base de Datos se centra en capacitar a los estudiantes en el diseño y administración eficiente de sistemas de bases de datos. A lo largo del curso, los participantes aprenderán a reconocer y analizar diversos sistemas de almacenamiento de información, identificarán modelos de datos y diseñarán esquemas lógicos utilizando diagramas entidad-relación. Además, adquirirán habilidades prácticas en la implementación física de bases de datos, realización de consultas complejas, manipulación de datos, gestión de seguridad e integridad de la información, así como técnicas avanzadas de copias de seguridad y transferencia de datos entre sistemas gestores.',
                'programs' => ['08743d2a-d22c-4272-b804-5c91d44dd079'],
            ],
            [
                'name' => 'Servicios de Red e Internet',
                'description' => 'El módulo profesional de Servicios de Red e Internet capacita a los estudiantes en la instalación y administración de infraestructuras clave para redes y servicios en línea. Durante el curso, los participantes aprenderán a configurar y gestionar servicios fundamentales como la resolución de nombres de dominio, la configuración automática de redes, servidores web, transferencia de archivos, correo electrónico, mensajería instantánea, noticias, listas de distribución, así como servicios de audio y vídeo. Se enfatiza en la seguridad, la eficiencia operativa y la documentación detallada de todas las configuraciones y procedimientos implementados.',
                'programs' => ['08743d2a-d22c-4272-b804-5c91d44dd079'],
            ],
            [
                'name' => 'Implantación de Aplicaciones Web',
                'description' => 'El módulo profesional de Implantación de Aplicaciones Web proporciona una formación integral en la preparación y administración de entornos de desarrollo y servidores de aplicaciones web, así como en la instalación y configuración de gestores de contenidos y aplicaciones de ofimática web. Los estudiantes adquieren habilidades para integrar tecnologías esenciales, asegurar la accesibilidad y seguridad de los sistemas, y realizar tareas avanzadas como la generación de documentos web dinámicos y la gestión de bases de datos. Este curso prepara a los participantes para enfrentar los desafíos actuales en el ámbito de las aplicaciones web, enfocándose en la eficiencia operativa y la adaptación a las necesidades específicas de cada proyecto.',
                'programs' => ['08743d2a-d22c-4272-b804-5c91d44dd079'],
            ],
            [
                'name' => 'Administración de Sistemas Gestores de Bases de Datos',
                'description' => 'El módulo profesional de Administración de Sistemas Gestores de Bases de Datos proporciona una formación completa en la instalación, configuración, y administración de sistemas gestores de bases de datos (SGBD). Los estudiantes adquieren habilidades para seleccionar y desplegar SGBD según requisitos específicos del sistema, configurar parámetros técnicos y de red, y gestionar la seguridad mediante la asignación de permisos y roles. Además, aprenden a automatizar tareas administrativas mediante la creación de guiones, optimizar el rendimiento a través de técnicas de monitorización y ajustes de índices, y aplicar criterios de disponibilidad en entornos distribuidos y replicados. Este curso prepara a los participantes para enfrentar los desafíos de la administración eficiente y segura de bases de datos, integrándose con las necesidades operativas de cualquier organización.',
                'programs' => ['08743d2a-d22c-4272-b804-5c91d44dd079'],
            ],
            [
                'name' => 'Seguridad y Alta Disponibilidad',
                'description' => 'El módulo profesional de Seguridad y Alta Disponibilidad proporciona una formación integral en prácticas y técnicas avanzadas de seguridad informática, así como en la implementación de soluciones que garantizan la continuidad operativa de sistemas críticos. Los estudiantes adquieren habilidades para evaluar vulnerabilidades y aplicar medidas de protección física y lógica, asegurar el acceso remoto de manera segura, configurar cortafuegos y servidores proxy, y desplegar soluciones de alta disponibilidad mediante virtualización y sistemas redundantes. Además, se enfatiza el cumplimiento de la legislación vigente sobre protección de datos y servicios de la sociedad de la información. Este curso prepara a los participantes para enfrentar los desafíos actuales de seguridad informática y mantener la disponibilidad de servicios esenciales en entornos empresariales críticos.',
                'programs' => ['08743d2a-d22c-4272-b804-5c91d44dd079'],
            ],
            [
                'name' => 'Empresa e Iniciativa Emprendedora',
                'description' => 'El módulo profesional de Empresa e Iniciativa Emprendedora proporciona a los estudiantes los conocimientos esenciales para entender y aplicar conceptos fundamentales del emprendimiento. A través de resultados de aprendizaje como el reconocimiento de la innovación y la cultura emprendedora, se busca fortalecer la capacidad de los estudiantes para identificar oportunidades empresariales. Además, se enfoca en desarrollar habilidades prácticas para la creación y gestión de pequeñas empresas, considerando aspectos legales, fiscales y financieros relevantes. Este enfoque integral prepara a los estudiantes para asumir roles tanto como emprendedores como profesionales con iniciativa y visión estratégica en entornos laborales existentes.',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868', '3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0', '08743d2a-d22c-4272-b804-5c91d44dd079', '74d8b517-4d63-4640-ba61-475f316d2e0d'],
            ],
            [
                'name' => 'Formación y Orientación Laboral',
                'description' => 'El módulo profesional de Formación y Orientación Laboral (FOL) ofrece a los estudiantes una base sólida para entender las dinámicas del mercado laboral y las competencias necesarias para una inserción efectiva. A través de resultados de aprendizaje como la valoración de la formación continua y la identificación de itinerarios formativos específicos, los estudiantes adquieren habilidades para la búsqueda activa de empleo y la toma de decisiones informadas sobre su carrera profesional. Además, se enfoca en el desarrollo de competencias en gestión de equipos, resolución de conflictos y conocimientos en derecho laboral y seguridad social, preparándolos para enfrentar los retos del entorno laboral moderno con eficacia y responsabilidad. Este enfoque integral no solo promueve la empleabilidad, sino que también fortalece la capacidad de los estudiantes para contribuir positivamente en las organizaciones.',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868', '3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0', '08743d2a-d22c-4272-b804-5c91d44dd079', '74d8b517-4d63-4640-ba61-475f316d2e0d'],
            ],
        ];
    }

    public function getDependencies(): array
    {
        return [ProgramFixtures::class];
    }
}
