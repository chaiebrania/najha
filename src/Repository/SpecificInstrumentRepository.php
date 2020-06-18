<?php

namespace App\Repository;

use App\Entity\SpecificInstrument;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SpecificInstrument|null find($id, $lockMode = null, $lockVersion = null)
 * @method SpecificInstrument|null findOneBy(array $criteria, array $orderBy = null)
 * @method SpecificInstrument[]    findAll()
 * @method SpecificInstrument[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpecificInstrumentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SpecificInstrument::class);
    }

    // /**
    //  * @return SpecificInstrument[] Returns an array of SpecificInstrument objects
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
    public function findOneBySomeField($value): ?SpecificInstrument
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
