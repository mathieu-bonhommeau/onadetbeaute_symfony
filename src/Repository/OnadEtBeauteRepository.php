<?php

namespace App\Repository;

use App\Entity\OnadEtBeaute;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OnadEtBeaute|null find($id, $lockMode = null, $lockVersion = null)
 * @method OnadEtBeaute|null findOneBy(array $criteria, array $orderBy = null)
 * @method OnadEtBeaute[]    findAll()
 * @method OnadEtBeaute[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OnadEtBeauteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OnadEtBeaute::class);
    }

    // /**
    //  * @return OnadEtBeaute[] Returns an array of OnadEtBeaute objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OnadEtBeaute
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
