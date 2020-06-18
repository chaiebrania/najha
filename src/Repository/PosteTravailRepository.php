<?php

namespace App\Repository;

use App\Entity\PosteTravail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PosteTravail|null find($id, $lockMode = null, $lockVersion = null)
 * @method PosteTravail|null findOneBy(array $criteria, array $orderBy = null)
 * @method PosteTravail[]    findAll()
 * @method PosteTravail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PosteTravailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PosteTravail::class);
    }

    // /**
    //  * @return PosteTravail[] Returns an array of PosteTravail objects
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
    public function findOneBySomeField($value): ?PosteTravail
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
