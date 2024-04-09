<?php

namespace App\Repository;

use App\Entity\DeliveryMethodEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DeliveryMethodEntity>
 *
 * @method DeliveryMethodEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method DeliveryMethodEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method DeliveryMethodEntity[]    findAll()
 * @method DeliveryMethodEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeliveryMethodEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DeliveryMethodEntity::class);
    }

    //    /**
    //     * @return DeliveryMethodEntity[] Returns an array of DeliveryMethodEntity objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('d.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?DeliveryMethodEntity
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
