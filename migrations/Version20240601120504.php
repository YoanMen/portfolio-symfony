<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240601120504 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project_icon_project DROP FOREIGN KEY FK_A72B6F9D166D1F9C');
        $this->addSql('ALTER TABLE project_icon_project DROP FOREIGN KEY FK_A72B6F9DC2A7DB57');
        $this->addSql('DROP TABLE project_icon_project');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE project_icon_project (project_icon_id INT NOT NULL, project_id INT NOT NULL, INDEX IDX_A72B6F9DC2A7DB57 (project_icon_id), INDEX IDX_A72B6F9D166D1F9C (project_id), PRIMARY KEY(project_icon_id, project_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE project_icon_project ADD CONSTRAINT FK_A72B6F9D166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_icon_project ADD CONSTRAINT FK_A72B6F9DC2A7DB57 FOREIGN KEY (project_icon_id) REFERENCES project_icon (id) ON DELETE CASCADE');
    }
}
