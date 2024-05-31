<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240531071959 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE auth_attempt ADD user_id INT DEFAULT NULL, DROP user');
        $this->addSql('ALTER TABLE auth_attempt ADD CONSTRAINT FK_56C82295A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_56C82295A76ED395 ON auth_attempt (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE auth_attempt DROP FOREIGN KEY FK_56C82295A76ED395');
        $this->addSql('DROP INDEX UNIQ_56C82295A76ED395 ON auth_attempt');
        $this->addSql('ALTER TABLE auth_attempt ADD user VARCHAR(255) NOT NULL, DROP user_id');
    }
}
