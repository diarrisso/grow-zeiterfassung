<?php

namespace App\Repository;

use App\Entity\ProjectDate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProjectDate|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectDate|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectDate[]    findAll()
 * @method ProjectDate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectDateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjectDate::class);
    }

    // /**
    //  * @return ProjectDate[] Returns an array of ProjectDate objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProjectDate
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
