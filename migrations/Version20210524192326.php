<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210524192326 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cost ADD service_id INT NOT NULL');
        $this->addSql('ALTER TABLE cost ADD CONSTRAINT FK_182694FCED5CA9E6 FOREIGN KEY (service_id) REFERENCES services (id)');
        $this->addSql('CREATE INDEX IDX_182694FCED5CA9E6 ON cost (service_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cost DROP FOREIGN KEY FK_182694FCED5CA9E6');
        $this->addSql('DROP INDEX IDX_182694FCED5CA9E6 ON cost');
        $this->addSql('ALTER TABLE cost DROP service_id');
    }
}
