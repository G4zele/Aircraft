<?php

namespace App\Repository;

use App\Entity\EffExplo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EffExplo|null find($id, $lockMode = null, $lockVersion = null)
 * @method EffExplo|null findOneBy(array $criteria, array $orderBy = null)
 * @method EffExplo[]    findAll()
 * @method EffExplo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EffExploRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EffExplo::class);
    }

    // /**
    //  * @return EffExplo[] Returns an array of EffExplo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EffExplo
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
