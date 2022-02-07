<?php

namespace App\Repository;

use App\Entity\Bands;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Bands|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bands|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bands[]    findAll()
 * @method Bands[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BandsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bands::class);
    }



    // /**
    //  * @return Bands[] Returns an array of Bands objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bands
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
