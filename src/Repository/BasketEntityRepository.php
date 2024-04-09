<?php

namespace App\Repository;

use App\Entity\BasketEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BasketEntity>
 *
 * @method BasketEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method BasketEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method BasketEntity[]    findAll()
 * @method BasketEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BasketEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BasketEntity::class);
    }

    //    /**
    //     * @return BasketEntity[] Returns an array of BasketEntity objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('b.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?BasketEntity
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
