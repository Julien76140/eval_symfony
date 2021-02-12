<?php

namespace App\Repository;

use App\Entity\Film;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BenneAVerre|null find($id, $lockMode = null, $lockVersion = null)
 * @method BenneAVerre|null findOneBy(array $criteria, array $orderBy = null)
 * @method BenneAVerre[]    findAll()
 * @method BenneAVerre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FilmRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Film::class);
    }

     /**
      * @return Film[] Returns an array of FilmRepository objects
     */

    
    public function findByCategoryId($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.category_id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }
    
}
