<?php

namespace App\Repository;

use App\Entity\StudentInfo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StudentInfo>
 */
class StudentInfoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StudentInfo::class);
    }

    //    /**
    //     * @return StudentInfo[] Returns an array of StudentInfo objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?StudentInfo
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
    public function searchByName(string $term): array
    {
        return $this->createQueryBuilder('s')
            ->where('LOWER(s.firstName) LIKE LOWER(:term)')
            ->orWhere('LOWER(s.lastName) LIKE LOWER(:term)')
            // Add other fields you want to search
            ->setParameter('term', '%'.strtolower($term).'%')
            ->setMaxResults(10) // Limit results
            ->getQuery()
            ->getResult();
    }
}
