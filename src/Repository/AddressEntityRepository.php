<?php

namespace App\Repository;

use App\Entity\AddressEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AddressEntity>
 *
 * @method AddressEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method AddressEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method AddressEntity[]    findAll()
 * @method AddressEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AddressEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AddressEntity::class);
    }

//    /**
//     * @return AddressEntity[] Returns an array of AddressEntity objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AddressEntity
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
