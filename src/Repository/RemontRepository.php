<?php

namespace App\Repository;

use App\Entity\Remont;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Remont|null find($id, $lockMode = null, $lockVersion = null)
 * @method Remont|null findOneBy(array $criteria, array $orderBy = null)
 * @method Remont[]    findAll()
 * @method Remont[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RemontRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Remont::class);
    }

    // /**
    //  * @return Remont[] Returns an array of Remont objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Remont
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
