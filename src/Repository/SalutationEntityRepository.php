<?php

namespace App\Repository;

use App\Entity\SalutationEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SalutationEntity>
 *
 * @method SalutationEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method SalutationEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method SalutationEntity[]    findAll()
 * @method SalutationEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SalutationEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SalutationEntity::class);
    }

    /**
     * @return SalutationEntity Returns the found salutationEntity object
     */
    public function findBySalutation(string $salutation): SalutationEntity
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.salutation = :val')
            ->setParameter('val', $salutation)
            ->getQuery()
            ->getResult()[0];
    }

    //    public function findOneBySomeField($value): ?SalutationEntity
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
