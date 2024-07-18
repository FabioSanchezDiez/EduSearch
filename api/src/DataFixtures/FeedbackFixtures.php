<?php

namespace App\DataFixtures;

use App\Entity\Feedback;
use App\Entity\Institution;
use App\Entity\Program;
use App\Entity\Subject;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class FeedbackFixtures extends Fixture implements DependentFixtureInterface
{
    private array $feedbackData;

    public function load(ObjectManager $manager): void
    {
        $this->initializeFeedbackData();

        foreach ($this->feedbackData as $feedbackInfo) {
            $feedback = new Feedback();
            $feedback->setId(Uuid::fromString($feedbackInfo['id']));
            $feedback->setFeedback($feedbackInfo['feedback']);
            $feedback->setRating($feedbackInfo['rating']);
            $feedback->setUser($manager->getReference(User::class, Uuid::fromString($feedbackInfo['user_id'])));
            $feedback->setInstitution($feedbackInfo['institution_id'] ? $manager->getReference(Institution::class, Uuid::fromString($feedbackInfo['institution_id'])) : null);
            $feedback->setProgram($feedbackInfo['program_id'] ? $manager->getReference(Program::class, Uuid::fromString($feedbackInfo['program_id'])) : null);
            $feedback->setSubject($feedbackInfo['subject_id'] ? $manager->getReference(Subject::class, Uuid::fromString($feedbackInfo['subject_id'])) : null);
            $manager->persist($feedback);
        }

        $manager->flush();
    }

    private function initializeFeedbackData(): void
    {
        $this->feedbackData = [
            [
                'id' => 'c39cf262-4b3f-4821-8f39-5a3a2fe07358',
                'feedback' => 'Curso muy completo si te quieres dedicar a la programación, completamente recomendado para todos aquellos que quieran aprender desde las bases de la programción hasta como desarrollar aplicaciones completas.',
                'rating' => 5,
                'user_id' => 'f0325753-b06f-475c-a166-7735e58ef1cb',
                'institution_id' => '',
                'program_id' => '2c0892fe-8a29-426b-8c18-e8fb92bf5868',
                'subject_id' => '',
            ]
        ];
    }

    public function getDependencies(): array
    {
        return [UserFixtures::class, ProgramFixtures::class, SubjectFixtures::class, InstitutionFixtures::class];
    }
}
