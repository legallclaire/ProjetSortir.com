<?php

namespace App\Repository;

use App\Entity\Etats;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Etats|null find($id, $lockMode = null, $lockVersion = null)
 * @method Etats|null findOneBy(array $criteria, array $orderBy = null)
 * @method Etats[]    findAll()
 * @method Etats[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtatsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Etats::class);
    }

    // /**
    //  * @return Etats[] Returns an array of Etats objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Etats
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
