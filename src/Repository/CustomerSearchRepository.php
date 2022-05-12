<?php

namespace App\Repository;

use App\Entity\CustomerSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CustomerSearch|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerSearch|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerSearch[]    findAll()
 * @method CustomerSearch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomerSearchRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerSearch::class);
    }

    // /**
    //  * @return CustomerSearch[] Returns an array of CustomerSearch objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CustomerSearch
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
