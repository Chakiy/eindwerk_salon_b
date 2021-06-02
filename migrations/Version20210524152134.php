<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210524152134 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointment ADD customer_app_id INT NOT NULL');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F844C842FD7C FOREIGN KEY (customer_app_id) REFERENCES customer (id)');
        $this->addSql('CREATE INDEX IDX_FE38F844C842FD7C ON appointment (customer_app_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F844C842FD7C');
        $this->addSql('DROP INDEX IDX_FE38F844C842FD7C ON appointment');
        $this->addSql('ALTER TABLE appointment DROP customer_app_id');
    }
}
