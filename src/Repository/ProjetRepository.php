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
    

    public function searchProjects(?string $titre, ?string $competence, ?int $budgetMax, ?string $nomEntreprise): array
    {
        $qb = $this->createQueryBuilder('p')
            ->join('p.clientCreateur', 'c') // Association avec le client pour obtenir le nom de l'entreprise
            ->addSelect('c');

        if ($titre) {
            $qb->andWhere('p.titre LIKE :titre')
            ->setParameter('titre', '%' . $titre . '%');
        }

        if ($competence) {
            $qb->andWhere('p.competencesRequises LIKE :competence')
            ->setParameter('competence', '%' . $competence . '%');
        }

        if ($budgetMax) {
            $qb->andWhere('p.budget <= :budgetMax')
            ->setParameter('budgetMax', $budgetMax);
        }

        if ($nomEntreprise) {
            $qb->andWhere('c.nomEntreprise LIKE :nomEntreprise')
            ->setParameter('nomEntreprise', '%' . $nomEntreprise . '%');
        }

        $qb->andWhere('p.status = :status')
        ->setParameter('status', Projet::STATUS_PUBLISHED);

        return $qb->getQuery()->getResult();
    }

    //    /**
    //     * @return Projet[] Returns an array of Projet objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

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
