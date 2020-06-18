<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200617193647 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE poste_travail CHANGE section_id section_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE specific_instrument ADD numero VARCHAR(255) NOT NULL, CHANGE general_instrument_id general_instrument_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE first_name first_name VARCHAR(128) DEFAULT NULL, CHANGE last_name last_name VARCHAR(128) DEFAULT NULL, CHANGE phone_number phone_number VARCHAR(32) DEFAULT NULL, CHANGE password_reset_token password_reset_token VARCHAR(255) DEFAULT NULL, CHANGE token_requested_at token_requested_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE poste_travail CHANGE section_id section_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE specific_instrument DROP numero, CHANGE general_instrument_id general_instrument_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE first_name first_name VARCHAR(128) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE last_name last_name VARCHAR(128) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE phone_number phone_number VARCHAR(32) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE password_reset_token password_reset_token VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE token_requested_at token_requested_at DATETIME DEFAULT \'NULL\'');
    }
}
