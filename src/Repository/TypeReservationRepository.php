<?php

namespace App\Repository;

use App\Entity\TypeReservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeReservation>
 *
 * @method TypeReservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeReservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeReservation[]    findAll()
 * @method TypeReservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeReservation::class);
    }

//    /**
//     * @return TypeReservation[] Returns an array of TypeReservation objects
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

//    public function findOneBySomeField($value): ?TypeReservation
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
