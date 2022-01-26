<?php

namespace App\Repository;

use App\Entity\FacebookPost;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FacebookPost|null find($id, $lockMode = null, $lockVersion = null)
 * @method FacebookPost|null findOneBy(array $criteria, array $orderBy = null)
 * @method FacebookPost[]    findAll()
 * @method FacebookPost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FacebookPostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FacebookPost::class);
    }

    // /**
    //  * @return FacebookPost[] Returns an array of FacebookPost objects
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
    public function findOneBySomeField($value): ?FacebookPost
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
