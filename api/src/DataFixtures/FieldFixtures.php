<?php

namespace App\DataFixtures;

use App\Entity\Field;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class FieldFixtures extends Fixture
{
    private array $fieldsData;

    public function load(ObjectManager $manager): void
    {
        $this->initializeFieldsData();

        foreach ($this->fieldsData as $fieldInfo) {
            $field = new Field();
            $field->setId(Uuid::fromString($fieldInfo['id']));
            $field->setName($fieldInfo['name']);
            $field->setDescription($fieldInfo['description']);
            $field->setImage($fieldInfo['image']);
            $manager->persist($field);
        }

        $manager->flush();
    }

    private function initializeFieldsData(): void
    {
        $this->fieldsData = [
            [
                'id' => '0edbed88-f546-4bee-b16a-035c16abc5b4',
                'name' => 'Informática y Comunicaciones',
                'description' => 'Este campo incluye el desarrollo y mantenimiento de sistemas informáticos y software, la creación y gestión de redes de comunicación, la protección de datos mediante ciberseguridad, la implementación de soluciones basadas en inteligencia artificial, y el análisis y manejo de grandes volúmenes de datos.',
                'image' => 'https://firebasestorage.googleapis.com/v0/b/edusearch-1c3c8.appspot.com/o/Inform%C3%A1tica_-_EduSearch-NO-BG.png?alt=media&token=58c4d331-1500-4df8-8d68-996be82a447e'
            ],
            [
                'id' => '94443462-8e93-46e0-8025-e00b3fbda869',
                'name' => 'Actividades Físicas y Deportivas',
                'description' => 'Este campo incluye la educación física, entrenamiento deportivo, gestión de instalaciones deportivas, nutrición y salud deportiva, rehabilitación y fisioterapia, psicología del deporte, investigación en ciencias del deporte y organización de eventos deportivos, promoviendo el bienestar, el rendimiento físico y la gestión eficiente del deporte en diversos contextos.',
                'image' => 'https://firebasestorage.googleapis.com/v0/b/edusearch-1c3c8.appspot.com/o/Actividades_F%C3%ADsicas_y_Deportivas_-_EduSearch-NO-BG.png?alt=media&token=45cccef7-2426-4054-82b5-7b6218fb55a2'
            ],
            [
                'id' => '14051bb8-3a6b-4882-a8fe-70c3c633b3ca',
                'name' => 'Servicios Socioculturales y a la Comunidad',
                'description' => 'Este campo incluye la intervención social, gestión cultural, animación sociocultural, trabajo comunitario, atención a la diversidad, educación social, servicios de bienestar, promoción de la igualdad y la inclusión, y el desarrollo de programas comunitarios, fortaleciendo la cohesión social y mejorando la calidad de vida de las comunidades.',
                'image' => 'https://firebasestorage.googleapis.com/v0/b/edusearch-1c3c8.appspot.com/o/Servicios_Socioculturales_-_EduSearch-NO-BG.png?alt=media&token=0deeadc1-cc93-4c68-b1ed-a50a0b35b05f'
            ],
            [
                'id' => '4d3ecb2d-378a-4f1a-be7f-7631e1519a32',
                'name' => 'Sanidad',
                'description' => 'Este campo incluye la atención médica, enfermería, salud pública, investigación biomédica, gestión sanitaria, farmacia, tecnología médica, rehabilitación y fisioterapia, promoción de la salud, y la prevención de enfermedades, garantizando el bienestar, el tratamiento efectivo y la mejora continua de la salud de la población.',
                'image' => 'https://firebasestorage.googleapis.com/v0/b/edusearch-1c3c8.appspot.com/o/Salud_-_EduSearch-NO-BG.png?alt=media&token=e65f3cd0-361f-41ab-806d-c887d26c92c1'
            ],
            [
                'id' => '6ec5573a-065f-4ed5-893d-8b54c5e8760a',
                'name' => 'Audiovisuales',
                'description' => 'Este campo incluye la producción y dirección de cine, televisión y video, edición y postproducción, diseño de sonido y efectos especiales, fotografía y cinematografía, desarrollo de contenidos digitales y multimedia, así como la gestión de proyectos audiovisuales, facilitando la creación y difusión de contenidos visuales y sonoros en diversas plataformas.',
                'image' => 'https://firebasestorage.googleapis.com/v0/b/edusearch-1c3c8.appspot.com/o/Imagen_y_Sonido_-_EduSearch-NO-BG.png?alt=media&token=1a8d3e8a-7e82-4c3d-88a0-7f52bd583a6a'
            ],
            [
                'id' => 'c3658e40-6845-45c7-bfc0-9c4df9ed1a9e',
                'name' => 'Comercio y Marketing',
                'description' => 'Este campo incluye la gestión de ventas y relaciones con clientes, desarrollo de estrategias de marketing, investigación de mercados, publicidad y comunicación, comercio electrónico, gestión de marca, análisis de datos de consumidores, y logística, impulsando el crecimiento empresarial y la satisfacción del cliente en un entorno competitivo.',
                'image' => 'https://firebasestorage.googleapis.com/v0/b/edusearch-1c3c8.appspot.com/o/Marketing_-_EduSearch-NO-BG.png?alt=media&token=eb2b42ce-f9ec-4e40-a1c5-36400e6579e5'
            ],
        ];
    }
}
