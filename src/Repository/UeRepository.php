<?php

namespace App\Repository;

use App\Entity\Inscription;
use App\Entity\Ue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ue|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ue|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ue[]    findAll()
 * @method Ue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ue::class);
    }

    public function search($niveau,$filiere)
    {
        $a= $this->createQueryBuilder('u') ->andWhere('u.niveau = :val1')->andWhere('u.filiere = :val2')
            ->setParameter('val1', $niveau)->setParameter('val2', $filiere)
            ->orderBy('u.id', 'ASC');
        $query=$a->getQuery();

        return $query->execute();
        
    }

    public function ueFiliereNiveau(Inscription $inscription)
    {
        $a= $this->createQueryBuilder('u') ->andWhere('u.niveau = :val1')->andWhere('u.filiere = :val2')
            ->setParameter('val1', $inscription->getNiveau())->setParameter('val2', $inscription->getFiliere());
        $query=$a->getQuery();

        return $query->execute();
        
    }

    // /**
    //  * @return Ue[] Returns an array of Ue objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ue
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
