<?php

namespace App\Repository;

use App\Entity\ResultatPartie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ResultatPartie|null find($id, $lockMode = null, $lockVersion = null)
 * @method ResultatPartie|null findOneBy(array $criteria, array $orderBy = null)
 * @method ResultatPartie[]    findAll()
 * @method ResultatPartie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResultatPartieRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ResultatPartie::class);
    }

    // /**
    //  * @return ResultatPartie[] Returns an array of ResultatPartie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ResultatPartie
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
