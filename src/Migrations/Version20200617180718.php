<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200617180718 extends AbstractMigration
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
        $this->addSql('ALTER TABLE specific_instrument ADD general_instrument_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE specific_instrument ADD CONSTRAINT FK_FDB0285BE1F4A435 FOREIGN KEY (general_instrument_id) REFERENCES general_instrument (id)');
        $this->addSql('CREATE INDEX IDX_FDB0285BE1F4A435 ON specific_instrument (general_instrument_id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE first_name first_name VARCHAR(128) DEFAULT NULL, CHANGE last_name last_name VARCHAR(128) DEFAULT NULL, CHANGE phone_number phone_number VARCHAR(32) DEFAULT NULL, CHANGE password_reset_token password_reset_token VARCHAR(255) DEFAULT NULL, CHANGE token_requested_at token_requested_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE poste_travail CHANGE section_id section_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE specific_instrument DROP FOREIGN KEY FK_FDB0285BE1F4A435');
        $this->addSql('DROP INDEX IDX_FDB0285BE1F4A435 ON specific_instrument');
        $this->addSql('ALTER TABLE specific_instrument DROP general_instrument_id');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE first_name first_name VARCHAR(128) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE last_name last_name VARCHAR(128) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE phone_number phone_number VARCHAR(32) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE password_reset_token password_reset_token VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE token_requested_at token_requested_at DATETIME DEFAULT \'NULL\'');
    }
}
