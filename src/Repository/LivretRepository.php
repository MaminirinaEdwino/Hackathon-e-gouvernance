<?php

namespace App\Repository;

use App\Entity\Livret;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Livret>
 *
 * @method Livret|null find($id, $lockMode = null, $lockVersion = null)
 * @method Livret|null findOneBy(array $criteria, array $orderBy = null)
 * @method Livret[]    findAll()
 * @method Livret[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivretRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Livret::class);
    }

    //    /**
    //     * @return Livret[] Returns an array of Livret objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('l.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Livret
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
