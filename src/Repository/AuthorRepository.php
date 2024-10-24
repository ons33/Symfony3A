<?php

namespace App\Repository;

use App\Entity\Author;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Author>
 */
class AuthorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Author::class);
    }

    //    /**
    //     * @return Author[] Returns an array of Author objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Author
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

//qb
    public function getAuthorsOrdredByName(){
        //$req = "Select * from author as a order by a.name";
        $reqQueryBuilder = $this->createQueryBuilder('a')
                                ->orderBy('a.name','ASC');
        $query = $reqQueryBuilder->getQuery();
        return $query->getResult();
    }
//dql
    public function getAuthorsOrdredByNameDQL(){
        $em = $this->getEntityManager();
        $query = $em->createQuery("Select a from App\Entity\Author a order by a.name ASC");
        return $query->getResult();

    }
//qb
    public function getAuthorsByName($name){
        return $this->createQueryBuilder('a')
                ->where('a.name LIKE :n')
                ->setParameter('n',$name)
                ->getQuery()
                ->getResult();
    }
//dql
    public function getAuthorsByNameDQL($name){
        $em = $this->getEntityManager();
        $query = $em->createQuery("select a from App\Entity\Author a where a.name LIKE :n");
        $query->setParameter('n',$name);
        return $query->getResult();
    }

}
