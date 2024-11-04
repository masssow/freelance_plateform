<?php

namespace App\Repository;

use App\Entity\Projet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Projet>
 */
class ProjetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Projet::class);
    }



    /**
     * @return String Returns an array of Projet objects
     */
    public function findPublishedProjets(?string $status = Projet::STATUS_PUBLISHED): array
    {
        return $this->createQueryBuilder('p')
            ->Where('p.status LIKE :status')
            ->setParameter('status', Projet::STATUS_PUBLISHED)
            // ->orderBy('p.createdAt', 'DESC') // Optionnel : pour afficher les plus récents en premier
            ->getQuery()
            ->getResult()
        ;
    }


   
       /**
        * @return Projet[] Returns an array of Projet objects
        */
       public function searchProjet($value): array
       {
           return $this->createQueryBuilder('p')
               ->Where('p.titre LIKE :val')
               ->setParameter('val', '%'. $value.'%')
            //    ->orderBy('p.id', 'ASC')
            //    ->setMaxResults(10)
               ->getQuery()
               ->getResult()
            // ->andWhere('p.exampleField = :val')
           ;
       }

       
        /**
         * @return Projet[] Returns an array of Projet objects
         */
        public function searchProjetPaginator($value)
        {
            return $this->createQueryBuilder('p')
                ->Where('p.titre LIKE :val')
                ->setParameter('val', '%' . $value . '%')
                //    ->orderBy('p.id', 'ASC')
                //    ->setMaxResults(10)
                // ->getQuery()
                // ->getResult()
                // ->andWhere('p.exampleField = :val')
            ;
        }


    //    public function findOneBySomeField($value): ?Projet
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
