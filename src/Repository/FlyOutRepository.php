<?php

namespace App\Repository;

use App\Entity\FlyOut;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FlyOut|null find($id, $lockMode = null, $lockVersion = null)
 * @method FlyOut|null findOneBy(array $criteria, array $orderBy = null)
 * @method FlyOut[]    findAll()
 * @method FlyOut[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FlyOutRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FlyOut::class);
    }

    // /**
    //  * @return FlyOut[] Returns an array of FlyOut objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FlyOut
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
