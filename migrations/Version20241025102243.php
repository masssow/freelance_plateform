<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241025102243 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evaluation ADD client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE evaluation ADD CONSTRAINT FK_1323A57519EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_1323A57519EB6921 ON evaluation (client_id)');
        $this->addSql('ALTER TABLE projet ADD client_createur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA972E924DE FOREIGN KEY (client_createur_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_50159CA972E924DE ON projet (client_createur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evaluation DROP FOREIGN KEY FK_1323A57519EB6921');
        $this->addSql('DROP INDEX IDX_1323A57519EB6921 ON evaluation');
        $this->addSql('ALTER TABLE evaluation DROP client_id');
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA972E924DE');
        $this->addSql('DROP INDEX IDX_50159CA972E924DE ON projet');
        $this->addSql('ALTER TABLE projet DROP client_createur_id');
    }
}
