<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231129143308 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE accountant (id INT NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE admin (id INT NOT NULL, PRIMARY KEY (id))');
        $this->addSql('ALTER TABLE accountant ADD CONSTRAINT FK_E7681183BF396750 FOREIGN KEY (id) REFERENCES [user] (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D76BF396750 FOREIGN KEY (id) REFERENCES [user] (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE accountant DROP CONSTRAINT FK_E7681183BF396750');
        $this->addSql('ALTER TABLE admin DROP CONSTRAINT FK_880E0D76BF396750');
        $this->addSql('DROP TABLE accountant');
        $this->addSql('DROP TABLE admin');
    }
}
