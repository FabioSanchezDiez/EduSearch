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
                'last_update' => '2024-07-17',
                'province' => 'Granada',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868', '3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0'],
            ],
            [
                'id' => '6c1faa18-ffef-42ee-8ad5-2e9f58781a24',
                'name' => 'IES Francisco Ayala',
                'description' => 'Centro público',
                'last_update' => '2024-07-17',
                'province' => 'Granada',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868', '3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0'],
            ],
            [
                'id' => '77f8f054-dba7-4f49-8c9b-74960a59915a',
                'name' => 'IES Zaidín Vergeles',
                'description' => 'Centro público',
                'last_update' => '2024-07-17',
                'province' => 'Granada',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868', '3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0', '08743d2a-d22c-4272-b804-5c91d44dd079'],
            ],
        ];
    }

    public function getDependencies(): array
    {
        return [ProgramFixtures::class];
    }
}
