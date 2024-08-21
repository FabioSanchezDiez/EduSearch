<?php

namespace App\DataFixtures;

use App\Entity\Institution;
use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class InstitutionFixtures extends Fixture implements DependentFixtureInterface
{
    private array $institutionsData;

    public function load(ObjectManager $manager): void
    {
        $this->initializeInstitutionsData();

        foreach ($this->institutionsData as $institutionInfo) {
            $institution = new Institution();
            $institution->setId(Uuid::fromString($institutionInfo['id']));
            $institution->setName($institutionInfo['name']);
            $institution->setDescription($institutionInfo['description']);
            $institution->setLastUpdate(new \DateTime($institutionInfo['last_update']));
            $institution->setProvince($institutionInfo['province']);
            $institution->setType($institutionInfo['type']);
            foreach ($institutionInfo['programs'] as $programId) {
                $program = $manager->getReference(Program::class, Uuid::fromString($programId));
                $institution->addProgram($program);
            }
            $manager->persist($institution);
        }

        $manager->flush();
    }

    private function initializeInstitutionsData(): void
    {
        $this->institutionsData = [
            [
                'id' => '5f78bcf8-ddba-4717-bb44-6d71420d1608',
                'name' => 'IES Hermenegildo Lanz',
                'description' => 'Centro público',
                'last_update' => '2024-08-21',
                'province' => 'Granada',
                'type' => 'Educación',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868', '3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0'],
            ],
            [
                'id' => '6c1faa18-ffef-42ee-8ad5-2e9f58781a24',
                'name' => 'IES Francisco Ayala',
                'description' => 'Centro público',
                'last_update' => '2024-08-21',
                'province' => 'Granada',
                'type' => 'Educación',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868', '3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0'],
            ],
            [
                'id' => '77f8f054-dba7-4f49-8c9b-74960a59915a',
                'name' => 'IES Zaidín Vergeles',
                'description' => 'Centro público',
                'last_update' => '2024-08-21',
                'province' => 'Granada',
                'type' => 'Educación',
                'programs' => ['f6506d28-0be0-41a2-9946-ab1a7b491484', '2c0892fe-8a29-426b-8c18-e8fb92bf5868', '3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0', '08743d2a-d22c-4272-b804-5c91d44dd079'],
            ],
            [
                'id' => Uuid::uuid4(),
                'name' => 'Universidad de Granada',
                'description' => 'Centro público',
                'last_update' => '2024-08-21',
                'province' => 'Granada',
                'type' => 'Educación',
                'programs' => ['d3136fcb-6d49-4ae9-bb8f-1f2d0584ef51', 'c9b0b06e-a8c0-44ba-9def-1b3b17e95852', '8d51a934-19cd-4a44-b9b9-5c1e87d103fd', '84fd37d4-d199-41c4-b697-ba2037f047f1', '23284d8a-832a-4cff-aea0-87a7766f30dd', '23284d8a-832a-4cff-aea0-87a7766f30dd', '1f24304f-321c-4487-99be-6ced9cc6f0d0', '43c504a0-c759-4e85-9835-af4bffbbf462'],
            ],
            [
                'id' => Uuid::uuid4(),
                'name' => 'Atlántida Formación Profesional',
                'description' => 'Centro privado',
                'last_update' => '2024-08-21',
                'province' => 'Granada',
                'type' => 'Educación',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868', '3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0', 'e3d473e7-1517-4777-9161-9f27342f1fbf', '10f1a432-77b2-40f1-a589-d9f9005493e7', '131a9366-6ee9-4d01-aaa9-2aca299bbcf6', '1c05e66b-374d-4db7-818d-f90f920492e0', '387df9f1-e6ba-446b-983e-24db83d57b58', '3f7ab96a-6d0a-43df-87b1-b1abc0792e73', '57d79580-c422-4c7f-8b82-7597a26a9d2e', '5d4738df-f549-4158-bb44-404a7cd4087f', '621fcd8b-503b-4c6f-a335-032e6d1c5f97', '84c0d3b3-0751-43ad-9352-f514a8fc671c', '8dbd69df-fe2c-446d-828c-d01467f8d54d', 'df3cee9c-8e17-424e-9bc0-4e93c2ba67fc', 'f6506d28-0be0-41a2-9946-ab1a7b491484'],
            ],
            [
                'id' => Uuid::uuid4(),
                'name' => 'IES Virgen de las Nieves',
                'description' => 'Centro público',
                'last_update' => '2024-08-21',
                'province' => 'Granada',
                'type' => 'Educación',
                'programs' => ['10f1a432-77b2-40f1-a589-d9f9005493e7'],
            ],
            [
                'id' => Uuid::uuid4(),
                'name' => 'CES Cristo Rey',
                'description' => 'Centro concertado',
                'last_update' => '2024-08-21',
                'province' => 'Granada',
                'type' => 'Educación',
                'programs' => ['10f1a432-77b2-40f1-a589-d9f9005493e7'],
            ],
            [
                'id' => Uuid::uuid4(),
                'name' => 'CES S. Ramón y Cajal',
                'description' => 'Centro concertado',
                'last_update' => '2024-08-21',
                'province' => 'Granada',
                'type' => 'Educación',
                'programs' => ['1c05e66b-374d-4db7-818d-f90f920492e0', '621fcd8b-503b-4c6f-a335-032e6d1c5f97', '387df9f1-e6ba-446b-983e-24db83d57b58', '5d4738df-f549-4158-bb44-404a7cd4087f', '131a9366-6ee9-4d01-aaa9-2aca299bbcf6', '10f1a432-77b2-40f1-a589-d9f9005493e7', '08743d2a-d22c-4272-b804-5c91d44dd079'],
            ],
            [
                'id' => Uuid::uuid4(),
                'name' => 'IES La Madraza',
                'description' => 'Centro público',
                'last_update' => '2024-08-21',
                'province' => 'Granada',
                'type' => 'Educación',
                'programs' => ['5d4738df-f549-4158-bb44-404a7cd4087f'],
            ],
            [
                'id' => Uuid::uuid4(),
                'name' => 'Salesianos San Juan Bosco',
                'description' => 'Centro concertado',
                'last_update' => '2024-08-21',
                'province' => 'Granada',
                'type' => 'Educación',
                'programs' => ['a2974b24-25e3-448b-8ae2-f6ff9e69578e'],
            ],
            [
                'id' => Uuid::uuid4(),
                'name' => 'IES Pedro Antonio de Alarcón',
                'description' => 'Centro público',
                'last_update' => '2024-08-21',
                'province' => 'Granada',
                'type' => 'Educación',
                'programs' => ['74d8b517-4d63-4640-ba61-475f316d2e0d', 'd2f68ec9-0c2e-4352-85ef-821b14e3ea59'],
            ],
            [
                'id' => Uuid::uuid4(),
                'name' => 'IES Ángel Ganivet',
                'description' => 'Centro público',
                'last_update' => '2024-08-21',
                'province' => 'Granada',
                'type' => 'Educación',
                'programs' => ['df3cee9c-8e17-424e-9bc0-4e93c2ba67fc'],
            ],
            [
                'id' => Uuid::uuid4(),
                'name' => 'Aircury',
                'description' => 'Aircury ofrece desarrollo de software de alta calidad para empresas de educación y sin ánimo de lucro.',
                'last_update' => '2024-08-21',
                'province' => 'Granada',
                'type' => 'Prácticas',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868', '3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0'],
            ],
            [
                'id' => Uuid::uuid4(),
                'name' => 'Nanobytes',
                'description' => 'Un servicio de consultoría e implementación de máxima calidad del ERP Odoo',
                'last_update' => '2024-08-21',
                'province' => 'Granada',
                'type' => 'Prácticas',
                'programs' => ['e3d473e7-1517-4777-9161-9f27342f1fbf', '2c0892fe-8a29-426b-8c18-e8fb92bf5868', '3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0', '08743d2a-d22c-4272-b804-5c91d44dd079'],
            ],
            [
                'id' => Uuid::uuid4(),
                'name' => 'Plexus Tech',
                'description' => 'Una compañía tecnológica e innovadora. Desarrollamos productos propios y ofrecemos servicios a empresas brindando soluciones eficientes adaptadas a sus necesidades.',
                'last_update' => '2024-08-21',
                'province' => 'Nacional',
                'type' => 'Prácticas',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868', '3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0', '08743d2a-d22c-4272-b804-5c91d44dd079'],
            ],
            [
                'id' => Uuid::uuid4(),
                'name' => 'NTT DATA',
                'description' => 'Nuestro enfoque de investigación y desarrollo aplica tecnologías avanzadas para resolver los problemas que enfrentan nuestros clientes en todo el mundo.',
                'last_update' => '2024-08-21',
                'province' => 'Nacional',
                'type' => 'Prácticas',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868', '3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0', '08743d2a-d22c-4272-b804-5c91d44dd079'],
            ],
            [
                'id' => Uuid::uuid4(),
                'name' => 'T-Systems Iberia',
                'description' => 'T-Systems ofrece soluciones integrales de TI, impulsando así la transformación digital de empresas de todas las industrias y del sector público.',
                'last_update' => '2024-08-21',
                'province' => 'Nacional',
                'type' => 'Prácticas',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868', '3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0', '08743d2a-d22c-4272-b804-5c91d44dd079'],
            ],
            [
                'id' => Uuid::uuid4(),
                'name' => 'ECOPE',
                'description' => 'Agencia de marketing digital en Granada. Diseño web, desarrollo app y marketing digital.',
                'last_update' => '2024-08-21',
                'province' => 'Granada',
                'type' => 'Prácticas',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868', '3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0'],
            ],
            [
                'id' => Uuid::uuid4(),
                'name' => 'Hiberus',
                'description' => 'Especializados en la prestación de servicios de consultoría de negocio, desarrollo tecnológico, transformación digital y outsourcing.',
                'last_update' => '2024-08-21',
                'province' => 'Nacional',
                'type' => 'Prácticas',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868', '3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0', 'e3d473e7-1517-4777-9161-9f27342f1fbf'],
            ],
            [
                'id' => Uuid::uuid4(),
                'name' => 'Kyndryl',
                'description' => 'Kyndryl es una empresa con una experiencia en el diseño, la ejecución y la gestión de sistemas tecnológicos modernos y confiables.',
                'last_update' => '2024-08-21',
                'province' => 'Nacional',
                'type' => 'Prácticas',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868', '3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0', '08743d2a-d22c-4272-b804-5c91d44dd079'],
            ],
            [
                'id' => Uuid::uuid4(),
                'name' => 'Sinergia Ciberseguridad',
                'description' => 'Empresa de ciberseguridad',
                'last_update' => '2024-08-21',
                'province' => 'Granada',
                'type' => 'Prácticas',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868', '3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0', '08743d2a-d22c-4272-b804-5c91d44dd079'],
            ],
            [
                'id' => Uuid::uuid4(),
                'name' => 'Seidor',
                'description' => 'Consultora tecnológica global. Transformación, Innovación, Customer y Employee Experience,',
                'last_update' => '2024-08-21',
                'province' => 'Nacional',
                'type' => 'Prácticas',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868', '3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0', '08743d2a-d22c-4272-b804-5c91d44dd079'],
            ],
            [
                'id' => Uuid::uuid4(),
                'name' => 'Trevenque Group',
                'description' => 'Grupo Trevenque, una empresa con 30 años de experiencia en el sector de las Tecnologías de la Información y de las Comunicaciones.',
                'last_update' => '2024-08-21',
                'province' => 'Nacional',
                'type' => 'Prácticas',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868', '3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0'],
            ],
            [
                'id' => Uuid::uuid4(),
                'name' => 'Babel',
                'description' => 'Babel es una multinacional tecnológica de origen español especializada en soluciones de transformación digital.',
                'last_update' => '2024-08-21',
                'province' => 'Nacional',
                'type' => 'Prácticas',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868', '3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0'],
            ],
            [
                'id' => Uuid::uuid4(),
                'name' => 'Grupo Solutia',
                'description' => 'En Grupo Solutia ofrecemos servicios a medida, con una atención personal, flexible y especializada, aplicando tecnologías de última generación.',
                'last_update' => '2024-08-21',
                'province' => 'Sevilla',
                'type' => 'Prácticas',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868', '3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0'],
            ],
        ];
    }

    public function getDependencies(): array
    {
        return [ProgramFixtures::class];
    }
}
