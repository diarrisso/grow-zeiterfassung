<?php

namespace App\Repository;
use App\Entity\Tracking;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\EvaluSearchTime;
use App\Data\SearchData;
use Doctrine\ORM\QueryBuilder;

use Proxies\__CG__\App\Entity\Tasks;
use function dd;

/**
 * @method Tracking|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tracking|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tracking[]
 * @method Tracking[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @ORM\Embedded
 * @ORM\Entity
 */
class TrackingRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     * @param PaginatorInterface $paginator
     */
      private  $paginator;
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tracking::class);
    }
    public function findByUsersAndDate($user)
    {
        $qb = $this->createQueryBuilder('a');
        $qb->where('a.user = :user')
            ->setParameter('user', $user)
            ->orderBy('a.createdAt', 'DESC');
        return $qb->getQuery()
            ->getResult();
    }

    /**
     * @return array
     * @param $user
     */
    public function findAllTracTasks($user): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql ='
           SELECT p.created_at,
            p.internal_commentary,
            t.name AS Aulgaben, 
           CASE WHEN TIMEDIFF(end,start) > 0
           THEN TIMEDIFF(end , start) 
           ELSE 0 END 
           As Zeiten FROM tracking p
           left join tasks t on p.task_id = t.id
           WHERE p.user_id = :user_id
           ORDER BY p.created_at ASC';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['user_id' => $user]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }

    public function findAllBytracking()
    {
        return $this->createQueryBuilder('t')
            ->getQuery()
            ->getResult()
            ;
    }

    public function serachParojectTaskTracking(EvaluSearchTime $evaluSearchTime )
    {
        $qb =  $this->createQueryBuilder('t');
        $qb->select(' t.internalCommentary, t.end, t.start , tas.name, tas.description, p.description, p.projectName , u.nachname, p.customer  ' );
        $qb->leftJoin('t.task', 'tas', 't.task_id=tas.task_id');
        $qb->leftJoin('t.projects', 'p', 'p.id=tas.task_id');
        $qb->leftJoin('t.user', 'u', 'u.id=t.user_id');


        if (!empty($evaluSearchTime->project)) {
            $qb=$qb
                ->andWhere('p.projectNameLIKE :p')
                ->setParameter('t,' ,"%{$evaluSearchTime->t}%");
        }

        if (!empty($evaluSearchTime->tasks)) {
            $qb=$qb
                ->andWhere('tas.name LIKE :tas')
                ->setParameter('tas,' ,"%{$evaluSearchTime->tas}%");
        }

        if (!empty($evaluSearchTime->customer)) {
            $qb=$qb
                ->andWhere('p.customer LIKE :p')
                ->setParameter('p,' ,"%{$evaluSearchTime->p}%");
        }


        return  $qb->getQuery()->getScalarResult();
    }

    /**
     * @return PaginatorInterface
     * @param SearchData $search
     * script search for dashbord
     */

    public function findSearch(SearchData $search)
    {
        $query = $this->getSearchQuery($search)->getQuery();
        return $query;


    }

    public function findSearchAll() : Array
    {
        $query = $this->createQueryBuilder('t');
        $query->select(' t.internalCommentary, 
        t.end, t.start , tas.name, tas.description, 
        p.description, p.projectName ,
        u.nachname,t.createdAt,t.total' );
        $query->leftJoin('t.task','tas','t.task_id=tas.task_id');
        $query->leftJoin('t.project', 'p', 'p.id=tas.task_id');
        $query->leftJoin('t.user', 'u', 't.user_id=u.id');
        return $query->getQuery()->getResult();
    }
    private  function getSearchQuery(SearchData $search): QueryBuilder
    {
        $query =  $this->createQueryBuilder('t');
        $query->select(' t.internalCommentary, t.end, 
        t.start , tas.name, 
        tas.description, 
        p.description, 
        p.projectName , 
        u.nachname ,t.createdAt,t.total' );
        $query->leftJoin('t.task', 'tas','t.task_id=tas.task_id');
        $query->leftJoin('t.project', 'p','p.id=tas.task_id');
        $query->leftJoin('t.user', 'u','t.user_id=u.id');
        if (!empty($search->q)) {
            $query= $query
            ->andWhere('tas.name LIKE :q')
            ->setParameter('q', "%{$search->q}%");}
        if (!empty($search->project)) {
            $query= $query
            ->andWhere('p.id  IN (:project)')
            ->setParameter('project', $search->project);
        }
        if (!empty($search->tasks)) {
            $query= $query
            ->andWhere('tas.name LIKE :tasks')
            ->setParameter('tasks', "%{$search->tasks}%");
        }
        if (!empty($search->user)) {
            $query= $query
                ->andWhere('u.id IN (:user)')
                ->setParameter('user', $search->user);
        }
        if (!empty($search->customer)) {
            $query= $query
                ->andWhere('u.id IN (:user)')
                ->setParameter('user', $search->user);
        }
        if (!empty($search->minDate)) {
            $query = $query
                ->andWhere('t.createdAt >= :minDate')
                ->setParameter('minDate', $search->minDate);
        }
        if (!empty($search->maxDate)) {
            $query = $query
                ->andWhere('t.createdAt <= :maxDate')
                ->setParameter('maxDate', $search->maxDate);
        }
        return $query;
    }


    public  function getALLWorkingHourByProject ()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql ='
           SELECT  p.project_name, 
              SEC_TO_TIME(SUM(TIME_TO_SEC(end) - TIME_TO_SEC(start))) AS GesamtStunden
           FROM
               tracking t
            JOIN project p ON t.project_id = p.id
        GROUP BY p.project_name';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public  function getALLWorkingHourByTasks ()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql ='SELECT   u.nachname, tas.name,
         SEC_TO_TIME(SUM(TIME_TO_SEC(end) - TIME_TO_SEC(start))) AS GesamtStunden
FROM
    tracking t
        JOIN Tasks tas ON t.task_id = tas.id
        JOIN user u on u.id = t.user_id
GROUP BY tas.name, u.nachname';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function gettrackingtimeByuserByInterval($user): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql ='SELECT   SEC_TO_TIME(SUM(TIME_TO_SEC(end) - TIME_TO_SEC(start))) AS timediff
               FROM tracking t
               join user u on t.user_id = u.id;
               WHERE created_at BETWEEN "2022-02-22" AND "2022.02.24"  AND t.user_id=u.id';
               $stmt = $conn->prepare($sql);
               $resultSet = $stmt->executeQuery();
               // returns an array of arrays (i.e. a raw data set)
                return $resultSet->fetchAll();
    }












}
