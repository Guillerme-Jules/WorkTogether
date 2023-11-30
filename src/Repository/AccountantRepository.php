<?php

namespace App\Repository;

use App\Entity\Accountant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Accountant>
 *
 * @method Accountant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Accountant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Accountant[]    findAll()
 * @method Accountant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccountantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Accountant::class);
    }

//    /**
//     * @return Accountant[] Returns an array of Accountant objects
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

//    public function findOneBySomeField($value): ?Accountant
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
