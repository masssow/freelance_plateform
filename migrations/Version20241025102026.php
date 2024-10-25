<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241025102026 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE freelance_projet (freelance_id INT NOT NULL, projet_id INT NOT NULL, INDEX IDX_8990A75AE8DF656B (freelance_id), INDEX IDX_8990A75AC18272 (projet_id), PRIMARY KEY(freelance_id, projet_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE freelance_projet ADD CONSTRAINT FK_8990A75AE8DF656B FOREIGN KEY (freelance_id) REFERENCES freelance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE freelance_projet ADD CONSTRAINT FK_8990A75AC18272 FOREIGN KEY (projet_id) REFERENCES projet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE candidature ADD freelance_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE candidature ADD CONSTRAINT FK_E33BD3B8E8DF656B FOREIGN KEY (freelance_id) REFERENCES freelance (id)');
        $this->addSql('CREATE INDEX IDX_E33BD3B8E8DF656B ON candidature (freelance_id)');
        $this->addSql('ALTER TABLE evaluation ADD freelance_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE evaluation ADD CONSTRAINT FK_1323A575E8DF656B FOREIGN KEY (freelance_id) REFERENCES freelance (id)');
        $this->addSql('CREATE INDEX IDX_1323A575E8DF656B ON evaluation (freelance_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE freelance_projet DROP FOREIGN KEY FK_8990A75AE8DF656B');
        $this->addSql('ALTER TABLE freelance_projet DROP FOREIGN KEY FK_8990A75AC18272');
        $this->addSql('DROP TABLE freelance_projet');
        $this->addSql('ALTER TABLE candidature DROP FOREIGN KEY FK_E33BD3B8E8DF656B');
        $this->addSql('DROP INDEX IDX_E33BD3B8E8DF656B ON candidature');
        $this->addSql('ALTER TABLE candidature DROP freelance_id');
        $this->addSql('ALTER TABLE evaluation DROP FOREIGN KEY FK_1323A575E8DF656B');
        $this->addSql('DROP INDEX IDX_1323A575E8DF656B ON evaluation');
        $this->addSql('ALTER TABLE evaluation DROP freelance_id');
    }
}
