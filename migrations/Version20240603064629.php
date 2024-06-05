<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240603064629 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE link_project DROP FOREIGN KEY FK_52D58A1B166D1F9C');
        $this->addSql('ALTER TABLE link_project DROP FOREIGN KEY FK_52D58A1BADA40271');
        $this->addSql('DROP TABLE link_project');
        $this->addSql('ALTER TABLE link ADD project_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE link ADD CONSTRAINT FK_36AC99F16C1197C9 FOREIGN KEY (project_id_id) REFERENCES project (id)');
        $this->addSql('CREATE INDEX IDX_36AC99F16C1197C9 ON link (project_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE link_project (link_id INT NOT NULL, project_id INT NOT NULL, INDEX IDX_52D58A1B166D1F9C (project_id), INDEX IDX_52D58A1BADA40271 (link_id), PRIMARY KEY(link_id, project_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE link_project ADD CONSTRAINT FK_52D58A1B166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE link_project ADD CONSTRAINT FK_52D58A1BADA40271 FOREIGN KEY (link_id) REFERENCES link (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE link DROP FOREIGN KEY FK_36AC99F16C1197C9');
        $this->addSql('DROP INDEX IDX_36AC99F16C1197C9 ON link');
        $this->addSql('ALTER TABLE link DROP project_id_id');
    }
}
