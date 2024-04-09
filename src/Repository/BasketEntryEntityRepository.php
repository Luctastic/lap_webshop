<?php

namespace App\Repository;

use App\Entity\BasketEntryEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BasketEntryEntity>
 *
 * @method BasketEntryEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method BasketEntryEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method BasketEntryEntity[]    findAll()
 * @method BasketEntryEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BasketEntryEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BasketEntryEntity::class);
    }

//    /**
//     * @return BasketEntryEntity[] Returns an array of BasketEntryEntity objects
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

//    public function findOneBySomeField($value): ?BasketEntryEntity
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
