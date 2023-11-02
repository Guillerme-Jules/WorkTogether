<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231016140833 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE customer (id INT NOT NULL, first_name NVARCHAR(255) NOT NULL, last_name NVARCHAR(255) NOT NULL, birthday DATE NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE pack (id INT IDENTITY NOT NULL, name NVARCHAR(255) NOT NULL, price NUMERIC(7, 2) NOT NULL, number_slot INT NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE rack (id INT IDENTITY NOT NULL, number_slot INT NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE reservation (id INT IDENTITY NOT NULL, pack_id INT NOT NULL, type_reservation_id INT NOT NULL, client_id INT NOT NULL, code NVARCHAR(255) NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, price NUMERIC(7, 2) NOT NULL, percentage INT NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE INDEX IDX_42C849551919B217 ON reservation (pack_id)');
        $this->addSql('CREATE INDEX IDX_42C84955EEF1BE73 ON reservation (type_reservation_id)');
        $this->addSql('CREATE INDEX IDX_42C8495519EB6921 ON reservation (client_id)');
        $this->addSql('CREATE TABLE type_reservation (id INT IDENTITY NOT NULL, name NVARCHAR(255) NOT NULL, percentage INT NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE type_unit (id INT IDENTITY NOT NULL, name NVARCHAR(255) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE unit (id INT IDENTITY NOT NULL, reservation_id INT, rack_id INT NOT NULL, type_unit_id INT, location_slot INT NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE INDEX IDX_DCBB0C53B83297E7 ON unit (reservation_id)');
        $this->addSql('CREATE INDEX IDX_DCBB0C538E86A33E ON unit (rack_id)');
        $this->addSql('CREATE INDEX IDX_DCBB0C53D09C1FF8 ON unit (type_unit_id)');
        $this->addSql('CREATE TABLE [user] (id INT IDENTITY NOT NULL, email NVARCHAR(180) NOT NULL, roles VARCHAR(MAX) NOT NULL, password NVARCHAR(255) NOT NULL, discr NVARCHAR(255) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON [user] (email) WHERE email IS NOT NULL');
        $this->addSql('EXEC sp_addextendedproperty N\'MS_Description\', N\'(DC2Type:json)\', N\'SCHEMA\', \'dbo\', N\'TABLE\', \'user\', N\'COLUMN\', roles');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT IDENTITY NOT NULL, body VARCHAR(MAX) NOT NULL, headers VARCHAR(MAX) NOT NULL, queue_name NVARCHAR(190) NOT NULL, created_at DATETIME2(6) NOT NULL, available_at DATETIME2(6) NOT NULL, delivered_at DATETIME2(6), PRIMARY KEY (id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('EXEC sp_addextendedproperty N\'MS_Description\', N\'(DC2Type:datetime_immutable)\', N\'SCHEMA\', \'dbo\', N\'TABLE\', \'messenger_messages\', N\'COLUMN\', created_at');
        $this->addSql('EXEC sp_addextendedproperty N\'MS_Description\', N\'(DC2Type:datetime_immutable)\', N\'SCHEMA\', \'dbo\', N\'TABLE\', \'messenger_messages\', N\'COLUMN\', available_at');
        $this->addSql('EXEC sp_addextendedproperty N\'MS_Description\', N\'(DC2Type:datetime_immutable)\', N\'SCHEMA\', \'dbo\', N\'TABLE\', \'messenger_messages\', N\'COLUMN\', delivered_at');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09BF396750 FOREIGN KEY (id) REFERENCES [user] (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849551919B217 FOREIGN KEY (pack_id) REFERENCES pack (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955EEF1BE73 FOREIGN KEY (type_reservation_id) REFERENCES type_reservation (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495519EB6921 FOREIGN KEY (client_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE unit ADD CONSTRAINT FK_DCBB0C53B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('ALTER TABLE unit ADD CONSTRAINT FK_DCBB0C538E86A33E FOREIGN KEY (rack_id) REFERENCES rack (id)');
        $this->addSql('ALTER TABLE unit ADD CONSTRAINT FK_DCBB0C53D09C1FF8 FOREIGN KEY (type_unit_id) REFERENCES type_unit (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer DROP CONSTRAINT FK_81398E09BF396750');
        $this->addSql('ALTER TABLE reservation DROP CONSTRAINT FK_42C849551919B217');
        $this->addSql('ALTER TABLE reservation DROP CONSTRAINT FK_42C84955EEF1BE73');
        $this->addSql('ALTER TABLE reservation DROP CONSTRAINT FK_42C8495519EB6921');
        $this->addSql('ALTER TABLE unit DROP CONSTRAINT FK_DCBB0C53B83297E7');
        $this->addSql('ALTER TABLE unit DROP CONSTRAINT FK_DCBB0C538E86A33E');
        $this->addSql('ALTER TABLE unit DROP CONSTRAINT FK_DCBB0C53D09C1FF8');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE pack');
        $this->addSql('DROP TABLE rack');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE type_reservation');
        $this->addSql('DROP TABLE type_unit');
        $this->addSql('DROP TABLE unit');
        $this->addSql('DROP TABLE [user]');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
