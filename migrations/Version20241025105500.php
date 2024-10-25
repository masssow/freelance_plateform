<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241025105500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidature ADD projet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE candidature ADD CONSTRAINT FK_E33BD3B8C18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('CREATE INDEX IDX_E33BD3B8C18272 ON candidature (projet_id)');
        $this->addSql('ALTER TABLE evaluation ADD projet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE evaluation ADD CONSTRAINT FK_1323A575C18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('CREATE INDEX IDX_1323A575C18272 ON evaluation (projet_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidature DROP FOREIGN KEY FK_E33BD3B8C18272');
        $this->addSql('DROP INDEX IDX_E33BD3B8C18272 ON candidature');
        $this->addSql('ALTER TABLE candidature DROP projet_id');
        $this->addSql('ALTER TABLE evaluation DROP FOREIGN KEY FK_1323A575C18272');
        $this->addSql('DROP INDEX IDX_1323A575C18272 ON evaluation');
        $this->addSql('ALTER TABLE evaluation DROP projet_id');
    }
}
