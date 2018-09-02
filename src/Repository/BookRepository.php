<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Book::class);
    }

    /**
     * @return Book[] Returns an array of Book objects
     */

    public function findByDateAndNationality($before_date = null, $after_date = null, $nationality = null)
    {
        $q = $this->createQueryBuilder('b');

        if ($before_date) {
            $q->andWhere('b.creation_date < :bd')
                ->setParameter('bd', $before_date);
        }
        if ($after_date) {
            $q->andWhere('b.creation_date > :ad')
                ->setParameter('ad', $after_date);
        }
        if ($nationality) {
            $q->join('b.author', 'a')
                ->addSelect('a')
                ->andWhere('a.nationality = :nat')
                ->setParameter('nat', $nationality);
        }
        $q = $q->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery();
        return $q->getResult();
    }


    /*
    public function findOneBySomeField($value): ?Book
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
