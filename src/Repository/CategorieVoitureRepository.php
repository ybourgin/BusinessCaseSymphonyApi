<?php

namespace App\Repository;

use App\Entity\CategorieVoiture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CategorieVoiture|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieVoiture|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieVoiture[]    findAll()
 * @method CategorieVoiture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieVoitureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategorieVoiture::class);
    }

    // /**
    //  * @return CategorieVoiture[] Returns an array of CategorieVoiture objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CategorieVoiture
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
