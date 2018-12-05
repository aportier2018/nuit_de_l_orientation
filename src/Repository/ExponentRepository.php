<?php

namespace App\Repository;


use App\Entity\Exponent;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Exponent|null find($id, $lockMode = null, $lockVersion = null)
 * @method Exponent|null findOneBy(array $criteria, array $orderBy = null)
 * @method Exponent[]    findAll()
 * @method Exponent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExponentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Exponent::class);
    }

//    /**
//     * @return Exponent[] Returns an array of Exponent objects
//     */
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
    public function findOneBySomeField($value): ?Exponent
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
