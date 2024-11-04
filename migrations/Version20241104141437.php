<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241104141437 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `admin` (id INT NOT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, privileges INT NOT NULL, historique_moderation LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE avatar (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidature (id INT AUTO_INCREMENT NOT NULL, freelance_id INT DEFAULT NULL, projet_id INT DEFAULT NULL, date_candidature DATETIME NOT NULL, statut VARCHAR(255) NOT NULL, message_freelance LONGTEXT DEFAULT NULL, INDEX IDX_E33BD3B8E8DF656B (freelance_id), INDEX IDX_E33BD3B8C18272 (projet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_metier (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT NOT NULL, nom_entreprise VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, budget_total DOUBLE PRECISION DEFAULT NULL, ville_entreprise VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dashboard (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, projets_en_cours LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', paiements_attendus LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', evaluations_recues LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_5C94FFF8FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evaluation (id INT AUTO_INCREMENT NOT NULL, freelance_id INT DEFAULT NULL, client_id INT DEFAULT NULL, projet_id INT DEFAULT NULL, note DOUBLE PRECISION NOT NULL, commentaire LONGTEXT DEFAULT NULL, date DATETIME NOT NULL, INDEX IDX_1323A575E8DF656B (freelance_id), INDEX IDX_1323A57519EB6921 (client_id), INDEX IDX_1323A575C18272 (projet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE freelance (id INT NOT NULL, cv VARCHAR(255) DEFAULT NULL, portfolio VARCHAR(255) DEFAULT NULL, competences VARCHAR(255) DEFAULT NULL, experiences LONGTEXT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, taux_horaire DOUBLE PRECISION DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE freelance_projet (freelance_id INT NOT NULL, projet_id INT NOT NULL, INDEX IDX_8990A75AE8DF656B (freelance_id), INDEX IDX_8990A75AC18272 (projet_id), PRIMARY KEY(freelance_id, projet_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, expediteur_id INT DEFAULT NULL, destinataire_id INT DEFAULT NULL, contenu LONGTEXT NOT NULL, date_envoi DATETIME NOT NULL, INDEX IDX_B6BD307F10335F61 (expediteur_id), INDEX IDX_B6BD307FA4F84F6E (destinataire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE metier (id INT AUTO_INCREMENT NOT NULL, sous_categorie_metier_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, active TINYINT(1) NOT NULL, INDEX IDX_51A00D8CED0D6523 (sous_categorie_metier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notification (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, type VARCHAR(255) NOT NULL, contenu LONGTEXT NOT NULL, date DATETIME NOT NULL, lue TINYINT(1) NOT NULL, INDEX IDX_BF5476CAFB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paiement (id INT AUTO_INCREMENT NOT NULL, projet_id INT NOT NULL, freelance_id INT NOT NULL, montant DOUBLE PRECISION NOT NULL, date_paiement DATETIME NOT NULL, statut VARCHAR(255) NOT NULL, method_paiement VARCHAR(255) NOT NULL, INDEX IDX_B1DC7A1EC18272 (projet_id), INDEX IDX_B1DC7A1EE8DF656B (freelance_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projet (id INT AUTO_INCREMENT NOT NULL, client_createur_id INT DEFAULT NULL, metier_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, competences_requises VARCHAR(255) NOT NULL, budget DOUBLE PRECISION DEFAULT NULL, date_publication DATETIME NOT NULL, date_limite_candidature DATETIME DEFAULT NULL, status VARCHAR(50) NOT NULL, INDEX IDX_50159CA972E924DE (client_createur_id), INDEX IDX_50159CA9ED16FA20 (metier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sous_categorie_metier (id INT AUTO_INCREMENT NOT NULL, categorie_metier_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, active TINYINT(1) NOT NULL, INDEX IDX_934EFB8B4049F527 (categorie_metier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, avatar VARCHAR(255) DEFAULT NULL, type VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `admin` ADD CONSTRAINT FK_880E0D76BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE candidature ADD CONSTRAINT FK_E33BD3B8E8DF656B FOREIGN KEY (freelance_id) REFERENCES freelance (id)');
        $this->addSql('ALTER TABLE candidature ADD CONSTRAINT FK_E33BD3B8C18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dashboard ADD CONSTRAINT FK_5C94FFF8FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE evaluation ADD CONSTRAINT FK_1323A575E8DF656B FOREIGN KEY (freelance_id) REFERENCES freelance (id)');
        $this->addSql('ALTER TABLE evaluation ADD CONSTRAINT FK_1323A57519EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE evaluation ADD CONSTRAINT FK_1323A575C18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE freelance ADD CONSTRAINT FK_48ABC675BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE freelance_projet ADD CONSTRAINT FK_8990A75AE8DF656B FOREIGN KEY (freelance_id) REFERENCES freelance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE freelance_projet ADD CONSTRAINT FK_8990A75AC18272 FOREIGN KEY (projet_id) REFERENCES projet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F10335F61 FOREIGN KEY (expediteur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FA4F84F6E FOREIGN KEY (destinataire_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE metier ADD CONSTRAINT FK_51A00D8CED0D6523 FOREIGN KEY (sous_categorie_metier_id) REFERENCES sous_categorie_metier (id)');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CAFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1EC18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1EE8DF656B FOREIGN KEY (freelance_id) REFERENCES freelance (id)');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA972E924DE FOREIGN KEY (client_createur_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA9ED16FA20 FOREIGN KEY (metier_id) REFERENCES metier (id)');
        $this->addSql('ALTER TABLE sous_categorie_metier ADD CONSTRAINT FK_934EFB8B4049F527 FOREIGN KEY (categorie_metier_id) REFERENCES categorie_metier (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `admin` DROP FOREIGN KEY FK_880E0D76BF396750');
        $this->addSql('ALTER TABLE candidature DROP FOREIGN KEY FK_E33BD3B8E8DF656B');
        $this->addSql('ALTER TABLE candidature DROP FOREIGN KEY FK_E33BD3B8C18272');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455BF396750');
        $this->addSql('ALTER TABLE dashboard DROP FOREIGN KEY FK_5C94FFF8FB88E14F');
        $this->addSql('ALTER TABLE evaluation DROP FOREIGN KEY FK_1323A575E8DF656B');
        $this->addSql('ALTER TABLE evaluation DROP FOREIGN KEY FK_1323A57519EB6921');
        $this->addSql('ALTER TABLE evaluation DROP FOREIGN KEY FK_1323A575C18272');
        $this->addSql('ALTER TABLE freelance DROP FOREIGN KEY FK_48ABC675BF396750');
        $this->addSql('ALTER TABLE freelance_projet DROP FOREIGN KEY FK_8990A75AE8DF656B');
        $this->addSql('ALTER TABLE freelance_projet DROP FOREIGN KEY FK_8990A75AC18272');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F10335F61');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FA4F84F6E');
        $this->addSql('ALTER TABLE metier DROP FOREIGN KEY FK_51A00D8CED0D6523');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CAFB88E14F');
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1EC18272');
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1EE8DF656B');
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA972E924DE');
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA9ED16FA20');
        $this->addSql('ALTER TABLE sous_categorie_metier DROP FOREIGN KEY FK_934EFB8B4049F527');
        $this->addSql('DROP TABLE `admin`');
        $this->addSql('DROP TABLE avatar');
        $this->addSql('DROP TABLE candidature');
        $this->addSql('DROP TABLE categorie_metier');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE dashboard');
        $this->addSql('DROP TABLE evaluation');
        $this->addSql('DROP TABLE freelance');
        $this->addSql('DROP TABLE freelance_projet');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE metier');
        $this->addSql('DROP TABLE notification');
        $this->addSql('DROP TABLE paiement');
        $this->addSql('DROP TABLE projet');
        $this->addSql('DROP TABLE sous_categorie_metier');
        $this->addSql('DROP TABLE user');
    }
}
