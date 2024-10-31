<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241031164600 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sous_categorie_metier ADD categorie_metier_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sous_categorie_metier ADD CONSTRAINT FK_934EFB8B4049F527 FOREIGN KEY (categorie_metier_id) REFERENCES categorie_metier (id)');
        $this->addSql('CREATE INDEX IDX_934EFB8B4049F527 ON sous_categorie_metier (categorie_metier_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sous_categorie_metier DROP FOREIGN KEY FK_934EFB8B4049F527');
        $this->addSql('DROP INDEX IDX_934EFB8B4049F527 ON sous_categorie_metier');
        $this->addSql('ALTER TABLE sous_categorie_metier DROP categorie_metier_id');
    }
}
