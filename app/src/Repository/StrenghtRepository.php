<?php

namespace App\Repository;

use App\Entity\Strenght;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Strenght|null find($id, $lockMode = null, $lockVersion = null)
 * @method Strenght|null findOneBy(array $criteria, array $orderBy = null)
 * @method Strenght[]    findAll()
 * @method Strenght[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StrenghtRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Strenght::class);
    }

    public function findAllJoinedToUser($userId)
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT s, u
                FROM App\Entity\Strenght s
                INNER JOIN s.user u
                WHERE s.user = :id
                ORDER BY s.created_at DESC'
        )->setParameter('id', $userId);

        return $query->getResult();
    }

    // /**
    //  * @return Strenght[] Returns an array of Strenght objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Strenght
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
