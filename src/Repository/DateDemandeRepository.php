<?php

namespace App\Repository;

use App\Entity\DateDemande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DateDemande>
 *
 * @method DateDemande|null find($id, $lockMode = null, $lockVersion = null)
 * @method DateDemande|null findOneBy(array $criteria, array $orderBy = null)
 * @method DateDemande[]    findAll()
 * @method DateDemande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DateDemandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DateDemande::class);
    }

    //    /**
    //     * @return DateDemande[] Returns an array of DateDemande objects
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

    //    public function findOneBySomeField($value): ?DateDemande
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
