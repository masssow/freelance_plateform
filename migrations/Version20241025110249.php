<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241025110249 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE paiement ADD projet_id INT NOT NULL, ADD freelance_id INT NOT NULL');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1EC18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1EE8DF656B FOREIGN KEY (freelance_id) REFERENCES freelance (id)');
        $this->addSql('CREATE INDEX IDX_B1DC7A1EC18272 ON paiement (projet_id)');
        $this->addSql('CREATE INDEX IDX_B1DC7A1EE8DF656B ON paiement (freelance_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1EC18272');
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1EE8DF656B');
        $this->addSql('DROP INDEX IDX_B1DC7A1EC18272 ON paiement');
        $this->addSql('DROP INDEX IDX_B1DC7A1EE8DF656B ON paiement');
        $this->addSql('ALTER TABLE paiement DROP projet_id, DROP freelance_id');
    }
}
