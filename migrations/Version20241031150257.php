<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241031150257 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE freelance ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, ADD taux_horaire DOUBLE PRECISION DEFAULT NULL, ADD ville VARCHAR(255) DEFAULT NULL, CHANGE competences competences VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE freelance DROP nom, DROP prenom, DROP taux_horaire, DROP ville, CHANGE competences competences LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\'');
    }
}
