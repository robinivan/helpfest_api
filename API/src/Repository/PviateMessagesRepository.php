<?php

namespace App\Repository;

use App\Entity\PviateMessages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PviateMessages|null find($id, $lockMode = null, $lockVersion = null)
 * @method PviateMessages|null findOneBy(array $criteria, array $orderBy = null)
 * @method PviateMessages[]    findAll()
 * @method PviateMessages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PviateMessagesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PviateMessages::class);
    }

    // /**
    //  * @return PviateMessages[] Returns an array of PviateMessages objects
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
    public function findOneBySomeField($value): ?PviateMessages
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
