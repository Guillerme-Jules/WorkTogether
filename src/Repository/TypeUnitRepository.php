<?php

namespace App\Repository;

use App\Entity\TypeUnit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeUnit>
 *
 * @method TypeUnit|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeUnit|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeUnit[]    findAll()
 * @method TypeUnit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeUnitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeUnit::class);
    }

//    /**
//     * @return TypeUnit[] Returns an array of TypeUnit objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TypeUnit
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
