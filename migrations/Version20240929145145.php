<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240929145145 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_login_codes DROP FOREIGN KEY FK_4AC6CF4CA76ED395');
        $this->addSql('DROP TABLE user_login_codes');
        $this->addSql('DROP TABLE password_resets');
        $this->addSql('ALTER TABLE receipts ADD file_name VARCHAR(255) NOT NULL, DROP filename, DROP storage_filename, DROP media_type');
        $this->addSql('ALTER TABLE transactions DROP was_reviewed');
        $this->addSql('ALTER TABLE users DROP verified_at, DROP two_factor');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_login_codes (id INT UNSIGNED AUTO_INCREMENT NOT NULL, user_id INT UNSIGNED DEFAULT NULL, code VARCHAR(6) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_unicode_ci`, is_active TINYINT(1) DEFAULT 1 NOT NULL, expiration DATETIME NOT NULL, INDEX IDX_4AC6CF4CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE password_resets (id INT UNSIGNED AUTO_INCREMENT NOT NULL, email VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_unicode_ci`, token VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_unicode_ci`, is_active TINYINT(1) DEFAULT 1 NOT NULL, expiration DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE user_login_codes ADD CONSTRAINT FK_4AC6CF4CA76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE users ADD verified_at DATETIME DEFAULT NULL, ADD two_factor TINYINT(1) DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE transactions ADD was_reviewed TINYINT(1) DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE receipts ADD storage_filename VARCHAR(255) NOT NULL, ADD media_type VARCHAR(255) NOT NULL, CHANGE file_name filename VARCHAR(255) NOT NULL');
    }
}
