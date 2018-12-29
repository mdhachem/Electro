<?php

namespace App\Repository;

use App\Entity\LigneCommande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LigneCommande|null find($id, $lockMode = null, $lockVersion = null)
 * @method LigneCommande|null findOneBy(array $criteria, array $orderBy = null)
 * @method LigneCommande[]    findAll()
 * @method LigneCommande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LigneCommandeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LigneCommande::class);
    }

    public function FindTotalPrix()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT SUM(l.prix) AS TOTAL
                FROM App\Entity\LigneCommande l'
            )
            ->getSingleScalarResult();
    }

    // /**
    //  * @return LigneCommande[] Returns an array of LigneCommande objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
     */

    /*
    public function findOneBySomeField($value): ?LigneCommande
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
     */
}
