<?php

namespace App\Repository;

use App\Entity\CustomerTicket;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CustomerTicket>
 *
 * @method CustomerTicket|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerTicket|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerTicket[]    findAll()
 * @method CustomerTicket[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomerTicketRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerTicket::class);
    }

//    /**
//     * @return CustomerTicket[] Returns an array of CustomerTicket objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CustomerTicket
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
