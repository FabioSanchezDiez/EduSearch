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
        $feedback = new Feedback();
        $feedback->setId(Uuid::uuid4());
        $feedback->setFeedback($feedbackData['feedback']);
        $feedback->setRating($feedbackData['rating']);
        $feedback->setInstitution($this->institutionRepository->find($feedbackData['institution']));
        $feedback->setSubject($this->subjectRepository->find($feedbackData['subject']));
        $feedback->setProgram($this->programRepository->find($feedbackData['program']));
        $feedback->setUser($this->userRepository->find($feedbackData['user']));

        $this->entityManager->persist($feedback);
        $this->entityManager->flush();

        return $feedback;
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
