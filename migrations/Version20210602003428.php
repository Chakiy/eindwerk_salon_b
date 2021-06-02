<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210602003428 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE images ADD service_image_id INT NOT NULL');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6AC4D37E50 FOREIGN KEY (service_image_id) REFERENCES services (id)');
        $this->addSql('CREATE INDEX IDX_E01FBE6AC4D37E50 ON images (service_image_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6AC4D37E50');
        $this->addSql('DROP INDEX IDX_E01FBE6AC4D37E50 ON images');
        $this->addSql('ALTER TABLE images DROP service_image_id');
    }
}
