<?php

namespace App\Repository;

use App\Entity\Przedmiot;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Przedmiot|null find($id, $lockMode = null, $lockVersion = null)
 * @method Przedmiot|null findOneBy(array $criteria, array $orderBy = null)
 * @method Przedmiot[]    findAll()
 * @method Przedmiot[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrzedmiotRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Przedmiot::class);
    }

    // /**
    //  * @return Przedmiot[] Returns an array of Przedmiot objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Przedmiot
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
