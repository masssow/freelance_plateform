<?php

// src/DataFixtures/UserFixtures.php
namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\Freelance;
use App\Entity\Projet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Créer quelques freelances
        $freelances = [];
        for ($i = 1; $i <= 5; $i++) {
            $freelance = new Freelance();
            $freelance->setEmail("freelance{$i}@mail.com")
                ->setNom("NomFreelance{$i}")
                ->setPrenom("PrenomFreelance{$i}")
                ->setCv("cv{$i}.pdf")
                ->setPortfolio("http://portfolio{$i}.com")
                ->setCompetences("PHP, Symfony, JavaScript")
                ->setExperiences("Expérience en développement web de 5 ans")
                ->setTauxHoraire(rand(35, 80))
                ->setVille("VilleFreelance{$i}");

            $hashedPassword = $this->passwordHasher->hashPassword($freelance, 'Passpass1');
            $freelance->setPassword($hashedPassword);

            $manager->persist($freelance);
            $freelances[] = $freelance; // Ajouter le freelance au tableau
        }

        // Créer quelques clients et leurs projets avec différents statuts
        for ($i = 1; $i <= 3; $i++) {
            $client = new Client();
            $client->setEmail("client{$i}@mail.com")
                ->setNomEntreprise("Entreprise{$i}")
                ->setAdresse("24 Rue de Paris {$i}")
                ->setBudgetTotal(rand(10000, 50000))
                ->setVilleEntreprise("Madrid{$i}");

            $hashedPassword = $this->passwordHasher->hashPassword($client, 'Passpass1');
            $client->setPassword($hashedPassword);

            $manager->persist($client);

            // Créer des projets avec différents statuts
            $statuses = [
                Projet::STATUS_CREATED,
                Projet::STATUS_PUBLISHED,
                Projet::STATUS_IN_PROGRESS,
                Projet::STATUS_COMPLETED,
                Projet::STATUS_CANCELLED
            ];

            foreach ($statuses as $status) {
                $projet = new Projet();
                $projet->setTitre("Projet {$status} du client {$i}")
                    ->setDescription("Description du projet avec statut {$status} pour le client {$i}")
                    ->setCompetencesRequises("Symfony, PHP, JavaScript") // Ajout de compétences requises
                    ->setBudget(rand(500, 5000))
                    ->setDatePublication(new \DateTime())
                    ->setDateLimiteCandidature((new \DateTime())->modify('+30 days'))
                    ->setStatus($status)
                    ->setClientCreateur($client);

                $client->addProjetsPubly($projet);

                // Associe des freelances aléatoires aux projets en cours ou terminés
                if (in_array($status, [Projet::STATUS_IN_PROGRESS, Projet::STATUS_COMPLETED])) {
                    for ($j = 0; $j < 2; $j++) {
                        $randomFreelance = $freelances[array_rand($freelances)]; // Sélectionner un freelance aléatoire
                        $projet->addFreelance($randomFreelance);
                    }
                }

                $manager->persist($projet);
            }
        }

        $manager->flush();
    }
}
