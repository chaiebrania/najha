<?php

namespace App\Repository;

use App\Entity\GeneralInstrument;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GeneralInstrument|null find($id, $lockMode = null, $lockVersion = null)
 * @method GeneralInstrument|null findOneBy(array $criteria, array $orderBy = null)
 * @method GeneralInstrument[]    findAll()
 * @method GeneralInstrument[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GeneralInstrumentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GeneralInstrument::class);
    }

    // /**
    //  * @return GeneralInstrument[] Returns an array of GeneralInstrument objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GeneralInstrument
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
