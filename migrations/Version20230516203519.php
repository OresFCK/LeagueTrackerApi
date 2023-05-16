<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230516203519 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE build_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE game_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE target_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE build (id INT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, cost INT NOT NULL, notes TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BDA0F2DBA76ED395 ON build (user_id)');
        $this->addSql('CREATE TABLE game (id INT NOT NULL, user_id INT DEFAULT NULL, length VARCHAR(255) NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, gold INT NOT NULL, teamkills INT NOT NULL, kills INT NOT NULL, deaths INT NOT NULL, assists INT NOT NULL, creepscore INT NOT NULL, visionscore INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_232B318CA76ED395 ON game (user_id)');
        $this->addSql('CREATE TABLE target (id INT NOT NULL, user_id INT DEFAULT NULL, rank VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_466F2FFCA76ED395 ON target (user_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, nickname VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE build ADD CONSTRAINT FK_BDA0F2DBA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE target ADD CONSTRAINT FK_466F2FFCA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE build_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE game_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE target_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('ALTER TABLE build DROP CONSTRAINT FK_BDA0F2DBA76ED395');
        $this->addSql('ALTER TABLE game DROP CONSTRAINT FK_232B318CA76ED395');
        $this->addSql('ALTER TABLE target DROP CONSTRAINT FK_466F2FFCA76ED395');
        $this->addSql('DROP TABLE build');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE target');
        $this->addSql('DROP TABLE "user"');
    }
}
