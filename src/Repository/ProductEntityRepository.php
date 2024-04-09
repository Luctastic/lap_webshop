<?php

namespace App\Repository;

use App\Entity\ProductEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProductEntity>
 *
 * @method ProductEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductEntity[]    findAll()
 * @method ProductEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductEntity::class);
    }

//    /**
//     * @return ProductEntity[] Returns an array of ProductEntity objects
//     */
//    public function findByLeastOrdered(int $maxAmount = 5): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults($maxAmount)
//            ->getQuery()
//            ->getResult();
//    }

    //    public function findOneBySomeField($value): ?ProductEntity
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
