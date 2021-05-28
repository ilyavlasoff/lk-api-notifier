<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210528155225 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE user_devices_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE receiver (id VARCHAR(2048) NOT NULL, mute_private_messages BOOLEAN DEFAULT NULL, mute_discussion_messages BOOLEAN DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE user_devices (id INT NOT NULL, user_id VARCHAR(2048) NOT NULL, fcm_key VARCHAR(4096) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_490A5090A76ED395 ON user_devices (user_id)');
        $this->addSql('ALTER TABLE user_devices ADD CONSTRAINT FK_490A5090A76ED395 FOREIGN KEY (user_id) REFERENCES receiver (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE user_devices DROP CONSTRAINT FK_490A5090A76ED395');
        $this->addSql('DROP SEQUENCE user_devices_id_seq CASCADE');
        $this->addSql('DROP TABLE receiver');
        $this->addSql('DROP TABLE user_devices');
    }
}
