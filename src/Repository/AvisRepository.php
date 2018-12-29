<?php

namespace App\Repository;

use App\Entity\Avis;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Avis|null find($id, $lockMode = null, $lockVersion = null)
 * @method Avis|null findOneBy(array $criteria, array $orderBy = null)
 * @method Avis[]    findAll()
 * @method Avis[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AvisRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Avis::class);
    }

    public function findAvgRating($id)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT Avg(a.rating) as sum
                FROM App\Entity\Avis a WHERE a.produit = :id'
            )
            ->setParameter('id', $id)
            ->getSingleScalarResult();
    }

    public function findStarOne($id)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT COUNT(a) as count
                FROM App\Entity\Avis a Where a.produit = :id AND a.rating = 1'
            )
            ->setParameter('id', $id)
            ->getSingleScalarResult();
    }

    public function findStarTwo($id)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT COUNT(a) as count
                FROM App\Entity\Avis a Where a.produit = :id AND a.rating = 2'
            )
            ->setParameter('id', $id)
            ->getSingleScalarResult();
    }

    public function findStarThree($id)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT COUNT(a) as count
                FROM App\Entity\Avis a Where a.produit = :id AND a.rating = 3'
            )
            ->setParameter('id', $id)
            ->getSingleScalarResult();
    }

    public function findStarFour($id)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT COUNT(a) as count
                FROM App\Entity\Avis a Where a.produit = :id AND a.rating = 4'
            )
            ->setParameter('id', $id)
            ->getSingleScalarResult();
    }

    public function findStarFive($id)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT COUNT(a) as count
                FROM App\Entity\Avis a Where a.produit = :id AND a.rating = 5'
            )
            ->setParameter('id', $id)
            ->getSingleScalarResult();
    }

    // /**
    //  * @return Avis[] Returns an array of Avis objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
     */

    /*
    public function findOneBySomeField($value): ?Avis
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
     */
}
