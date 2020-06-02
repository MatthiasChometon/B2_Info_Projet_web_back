<?php

namespace App\Repository;

use App\Entity\FormulesPlats;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method FormulesPlats|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormulesPlats|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormulesPlats[]    findAll()
 * @method FormulesPlats[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormulesPlatsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FormulesPlats::class);
    }

    // /**
    //  * @return FormulesPlats[] Returns an array of FormulesPlats objects
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
    public function findOneBySomeField($value): ?FormulesPlats
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
