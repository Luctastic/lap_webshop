<?php

namespace App\Repository;

use App\Entity\StateEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StateEntity>
 *
 * @method StateEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method StateEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method StateEntity[]    findAll()
 * @method StateEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StateEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StateEntity::class);
    }

//    /**
//     * @return StateEntity[] Returns an array of StateEntity objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?StateEntity
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
