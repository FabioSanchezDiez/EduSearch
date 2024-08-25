<?php

namespace App\Repository;

use App\Entity\Feedback;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Ramsey\Uuid\Uuid;

/**
 * @extends ServiceEntityRepository<Feedback>
 */
class FeedbackRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, private EntityManagerInterface $entityManager, private InstitutionRepository $institutionRepository, private SubjectRepository $subjectRepository, private ProgramRepository $programRepository, private UserRepository $userRepository)
    {
        parent::__construct($registry, Feedback::class);
    }

    public function createFeedback(array $feedbackData): Feedback
    {

        $user = $this->userRepository->findOneBy(['email' => $feedbackData['user']]);
        $program = $this->programRepository->find($feedbackData['program']);

        $existingFeedback = $this->findOneBy(['user' => $user, 'program' => $program]);

        if ($existingFeedback) {
            throw new \InvalidArgumentException('Ya has enviado una opinión para este programa');
        }

        if ($this->containsProhibitedContent($feedbackData['feedback'])) {
            throw new \InvalidArgumentException('El feedback contiene contenido no permitido.');
        }

        $feedback = new Feedback();
        $feedback->setId(Uuid::uuid4());
        $feedback->setFeedback($feedbackData['feedback']);
        $feedback->setProgram($program);
        $feedback->setUser($user);

        $this->entityManager->persist($feedback);
        $this->entityManager->flush();

        return $feedback;
    }

    private function containsProhibitedContent(string $content): bool
    {
        $prohibitedWords = ['mierda', 'joder', 'imbecil', 'idiota', 'maldito'];

        foreach ($prohibitedWords as $word) {
            if (stripos($content, $word) !== false) {
                return true;
            }
        }

        if ($this->containsRepetitiveSpam($content)) {
            return true;
        }

        return false;
    }

    private function containsRepetitiveSpam(string $content): bool
    {
        if (preg_match('/(.)\\1{9,}/', $content)) {
            return true;
        }

        if (preg_match('/([a-zA-Z]{2,})\\1{2,}/', $content)) {
            return true;
        }

        return false;
    }


    //    /**
    //     * @return Feedback[] Returns an array of Feedback objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('f.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Feedback
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
