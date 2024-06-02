<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240601123258 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE link ADD link_icon_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE link ADD CONSTRAINT FK_36AC99F129DF8DC7 FOREIGN KEY (link_icon_id) REFERENCES link_icon (id)');
        $this->addSql('CREATE INDEX IDX_36AC99F129DF8DC7 ON link (link_icon_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE link DROP FOREIGN KEY FK_36AC99F129DF8DC7');
        $this->addSql('DROP INDEX IDX_36AC99F129DF8DC7 ON link');
        $this->addSql('ALTER TABLE link DROP link_icon_id');
    }
}
