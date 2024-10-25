<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241025110625 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dashboard ADD utilisateur_id INT NOT NULL');
        $this->addSql('ALTER TABLE dashboard ADD CONSTRAINT FK_5C94FFF8FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5C94FFF8FB88E14F ON dashboard (utilisateur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dashboard DROP FOREIGN KEY FK_5C94FFF8FB88E14F');
        $this->addSql('DROP INDEX UNIQ_5C94FFF8FB88E14F ON dashboard');
        $this->addSql('ALTER TABLE dashboard DROP utilisateur_id');
    }
}
