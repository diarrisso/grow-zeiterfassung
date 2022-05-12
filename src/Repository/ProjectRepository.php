<?php

namespace App\Repository;

use App\Entity\Project;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Project|null find($id, $lockMode = null, $lockVersion = null)
 * @method Project|null findOneBy(array $criteria, array $orderBy = null)
 * @method Project[]    findAll()
 * @method Project[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Project::class);
    }


    public function findAllWithSearch()
    {
        return $this->_em->getConnection()->executeQuery(
            'SELECT projects_id, SEC_TO_TIME(SUM(TIME_TO_SEC(end) - TIME_TO_SEC(start))) AS timediff
              FROM tracking t
               GROUP BY t.projects_id'
        )->fetchAllAssociative();
    }











    // /**
    //  * @return Project[] Returns an array of Project objects
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

    /*public function findByCustomeCcreatedProject($project, $customer): ?Project
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.createdAt <= :minval')
            ->setParameter('maxValue',$minvalue)
            ->andWhere('p.createdAt >=:maxval')
            ->setMaxResults('maxvalue',$maxvalue)
            ->orderBy('p.id','ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }*/

    public function findByCustomeCcreatedProject($project, $customer,$tasks)
    {
        $dbl = 'SELECT  u.nachname, p.project_name,p.description ,ta.name, ta.description AS Aufgaben, t.internal_commentary,
                CASE WHEN TIMEDIFF( end , start) > 0 THEN TIMEDIFF(end , start) ELSE 0 END As Zeiten
                from
                tracking t
                JOIN tasks ta ON t.task_id = ta.id
                JOIN project p ON  p.id= ta.project_id
                JOIN user u ON    t.user_id=u.id
                ORDER BY  project_name';



    }


}
