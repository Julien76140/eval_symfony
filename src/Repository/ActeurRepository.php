<?php

namespace App\Repository;

use App\Entity\Acteur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BenneAVerre|null find($id, $lockMode = null, $lockVersion = null)
 * @method BenneAVerre|null findOneBy(array $criteria, array $orderBy = null)
 * @method BenneAVerre[]    findAll()
 * @method BenneAVerre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActeurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Acteur::class);
    }

     /**
      * @return Acteur[] Returns an array of Acteur objects
     */

    
    public function findByNom($value) 
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.nom = :val or b.prenom = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }
    
}
