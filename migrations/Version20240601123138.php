<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240601123138 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE link_icon_link DROP FOREIGN KEY FK_487318ACADA40271');
        $this->addSql('ALTER TABLE link_icon_link DROP FOREIGN KEY FK_487318AC29DF8DC7');
        $this->addSql('DROP TABLE link_icon_link');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE link_icon_link (link_icon_id INT NOT NULL, link_id INT NOT NULL, INDEX IDX_487318ACADA40271 (link_id), INDEX IDX_487318AC29DF8DC7 (link_icon_id), PRIMARY KEY(link_icon_id, link_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE link_icon_link ADD CONSTRAINT FK_487318ACADA40271 FOREIGN KEY (link_id) REFERENCES link (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE link_icon_link ADD CONSTRAINT FK_487318AC29DF8DC7 FOREIGN KEY (link_icon_id) REFERENCES link_icon (id) ON DELETE CASCADE');
    }
}
