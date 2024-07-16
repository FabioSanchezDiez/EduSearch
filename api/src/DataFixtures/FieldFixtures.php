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
                'description' => 'Este campo incluye el desarrollo de hardware y software, redes de comunicación, ciberseguridad, inteligencia artificial y análisis de datos, facilitando la conectividad global y la innovación tecnológica en diversos sectores.',
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


        ];
    }
}
