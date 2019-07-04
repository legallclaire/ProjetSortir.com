<?php

namespace App\Repository;

use App\Entity\Sorties;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Sorties|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sorties|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sorties[]    findAll()
 * @method Sorties[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SortiesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Sorties::class);
    }

    // /**
    //  * @return Sorties[] Returns an array of Sorties objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sorties
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findAllParticipants(){
        $qb = $this->createQueryBuilder('s');
        $qb->addSelect('p');
        $qb->join('s.participants', 'c');
        $qb->where('p.id = :participants_id');
    }

    public function findSortieRecherche($mot)
    {
        $qb = $this->createQueryBuilder('s');
        $qb->where('s.nom LIKE :mot');
        $qb->setParameter('mot', '%'.$mot.'%');
        $query=$qb->getQuery();
        return $query->getResult();
    }

    public function findSortieBySites($site){
        $qb = $this->createQueryBuilder('s');
        $qb->addSelect('si');
        $qb->leftJoin('s.site', 'si');
        $qb->where('si.nom_site = :site');
        $qb->setParameter('site', $site);
        $query=$qb->getQuery();
        return $query->getResult();
    }

    //    Récupération de la liste des sortie en fonction du nom de la sortie et du site
    public function findSortieFiltres($site,$mot)
    {
        $qb = $this->createQueryBuilder('s');
        $qb->addSelect('si');
        $qb->leftJoin('s.site', 'si');
        $qb->where('si.nom_site = :site');
        $qb->andWhere('s.nom LIKE :mot');
        $qb->setParameter('site', $site);
        $qb->setParameter('mot', '%'.$mot.'%');
        $query=$qb->getQuery();
        return $query->getResult();
    }


}
