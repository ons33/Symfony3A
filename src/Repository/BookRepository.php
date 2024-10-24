<?php

namespace App\Repository;

use App\Entity\Book;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Book>
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    //    /**
    //     * @return Book[] Returns an array of Book objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('b.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Book
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function getBooksByAuthor($author){
        return $this->createQueryBuilder('b')
        //select b from app/entity/book
                    ->join('b.author','a')
                    ->addSelect('a')
                    ->where('a.id = :id')
                    ->setParameter('id',$author)
                    ->getQuery()
                    ->getResult();
    }

    public function getBooksByAuthorDQL($author){
       $em= $this->getEntityManager();
       $query = $em->createQuery("Select b from App\Entity\Book b Join b.author a where a.id = :id");
       $query->setParameter('id',$author);
       return $query->getResult();
    }

 

    public function getNbbooks(){
        $em= $this->getEntityManager();
        $query = $em->createQuery('select COUNT(b) From App\Entity\Book b');
        return $query->getSingleScalarResult();
    }
}
