<?php

namespace App\Repository;

use App\Entity\Prestationphp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Prestationphp|null find($id, $lockMode = null, $lockVersion = null)
 * @method Prestationphp|null findOneBy(array $criteria, array $orderBy = null)
 * @method Prestationphp[]    findAll()
 * @method Prestationphp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrestationphpRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Prestationphp::class);
    }

    // /**
    //  * @return Prestationphp[] Returns an array of Prestationphp objects
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
    public function findOneBySomeField($value): ?Prestationphp
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
