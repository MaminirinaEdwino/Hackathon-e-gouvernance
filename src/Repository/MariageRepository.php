<?php

namespace App\Repository;

use App\Entity\Mariage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Mariage>
 *
 * @method Mariage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mariage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mariage[]    findAll()
 * @method Mariage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MariageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mariage::class);
    }

    //    /**
    //     * @return Mariage[] Returns an array of Mariage objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('m.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Mariage
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
