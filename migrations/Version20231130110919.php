<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231130110919 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE customer_ticket (id INT IDENTITY NOT NULL, customer_id INT NOT NULL, name NVARCHAR(255) NOT NULL, description NVARCHAR(500) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE INDEX IDX_266571F29395C3F3 ON customer_ticket (customer_id)');
        $this->addSql('ALTER TABLE customer_ticket ADD CONSTRAINT FK_266571F29395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer_ticket DROP CONSTRAINT FK_266571F29395C3F3');
        $this->addSql('DROP TABLE customer_ticket');
    }
}
