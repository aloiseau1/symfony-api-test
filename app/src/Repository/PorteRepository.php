<?php

namespace App\Repository;

use App\Entity\Gestionnaire;
use App\Entity\Porte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Porte>
 *
 * @method Porte|null find($id, $lockMode = null, $lockVersion = null)
 * @method Porte|null findOneBy(array $criteria, array $orderBy = null)
 * @method Porte[]    findAll()
 * @method Porte[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PorteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Porte::class);
    }

    /**
     * @return Porte[] Returns an array of Porte objects
     */
    public function findByLatestInsert(int $recentId = 9): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.id > :recentId')
            ->setParameter('recentId', $recentId)
            ->getQuery()
            ->getResult()
        ;
    }

//    public function findOneBySomeField($value): ?Gestionnaire
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
