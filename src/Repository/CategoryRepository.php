<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BenneAVerre|null find($id, $lockMode = null, $lockVersion = null)
 * @method BenneAVerre|null findOneBy(array $criteria, array $orderBy = null)
 * @method BenneAVerre[]    findAll()
 * @method BenneAVerre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

     /**
      * @return Category[] Returns an array of Category objects
     */

    
    public function findByCategory($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.nom = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }
    
}
