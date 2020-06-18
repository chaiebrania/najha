<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200614092038 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE general_instrument (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, designation LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specific_instrument (id INT AUTO_INCREMENT NOT NULL, min_etendu INT NOT NULL, max_etendu INT NOT NULL, etendu INT NOT NULL, unit VARCHAR(255) NOT NULL, precisionn VARCHAR(255) NOT NULL, frequence_calibrage VARCHAR(255) NOT NULL, resolution VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, date_mise_en_service DATE NOT NULL, serial_number VARCHAR(255) NOT NULL, frequence_etallonage VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(128) DEFAULT NULL, last_name VARCHAR(128) DEFAULT NULL, phone_number VARCHAR(32) DEFAULT NULL, password_reset_token VARCHAR(255) DEFAULT NULL, token_requested_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE general_instrument');
        $this->addSql('DROP TABLE specific_instrument');
        $this->addSql('DROP TABLE user');
    }
}
