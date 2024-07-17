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
            $institution->setName($institutionInfo['name']);
            $institution->setDescription($institutionInfo['description']);
            $institution->setLastUpdate(new \DateTime($institutionInfo['last_update']));
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
                'name' => 'IES Hermenegildo Lanz',
                'description' => 'Centro público',
                'last_update' => '2024-07-17',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868', '3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0'],
            ],
            [
                'name' => 'IES Francisco Ayala',
                'description' => 'Centro público',
                'last_update' => '2024-07-17',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868', '3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0'],
            ],
            [
                'name' => 'IES Zaidín Vergeles',
                'description' => 'Centro público',
                'last_update' => '2024-07-17',
                'programs' => ['2c0892fe-8a29-426b-8c18-e8fb92bf5868', '3eee4e2a-5072-48b3-a9c3-8f0c36a76fc0', '08743d2a-d22c-4272-b804-5c91d44dd079'],
            ],
        ];
    }

    public function getDependencies(): array
    {
        return [ProgramFixtures::class];
    }
}
