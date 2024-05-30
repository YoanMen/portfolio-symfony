<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240530072620 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE auth_attempt (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, attempt INT NOT NULL, ip VARCHAR(120) DEFAULT NULL, UNIQUE INDEX UNIQ_56C82295A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE auth_attempt ADD CONSTRAINT FK_56C82295A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE link CHANGE label label VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE auth_attempt DROP FOREIGN KEY FK_56C82295A76ED395');
        $this->addSql('DROP TABLE auth_attempt');
        $this->addSql('ALTER TABLE link CHANGE label label VARCHAR(40) NOT NULL');
    }
}
