<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240516131736 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE blog_image (id INT AUTO_INCREMENT NOT NULL, image_id_id INT NOT NULL, blog_id_id INT NOT NULL, INDEX IDX_35D2479768011AFE (image_id_id), INDEX IDX_35D247978FABDD9F (blog_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, path VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE link (id INT AUTO_INCREMENT NOT NULL, path VARCHAR(255) NOT NULL, icon LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE link_project (link_id INT NOT NULL, project_id INT NOT NULL, INDEX IDX_52D58A1BADA40271 (link_id), INDEX IDX_52D58A1B166D1F9C (project_id), PRIMARY KEY(link_id, project_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_image (id INT AUTO_INCREMENT NOT NULL, image_id_id INT NOT NULL, project_id_id INT NOT NULL, INDEX IDX_D6680DC168011AFE (image_id_id), INDEX IDX_D6680DC16C1197C9 (project_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE technology (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(40) NOT NULL, color VARCHAR(60) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE technology_project (technology_id INT NOT NULL, project_id INT NOT NULL, INDEX IDX_6EFD95584235D463 (technology_id), INDEX IDX_6EFD9558166D1F9C (project_id), PRIMARY KEY(technology_id, project_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE blog_image ADD CONSTRAINT FK_35D2479768011AFE FOREIGN KEY (image_id_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE blog_image ADD CONSTRAINT FK_35D247978FABDD9F FOREIGN KEY (blog_id_id) REFERENCES blog (id)');
        $this->addSql('ALTER TABLE link_project ADD CONSTRAINT FK_52D58A1BADA40271 FOREIGN KEY (link_id) REFERENCES link (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE link_project ADD CONSTRAINT FK_52D58A1B166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_image ADD CONSTRAINT FK_D6680DC168011AFE FOREIGN KEY (image_id_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE project_image ADD CONSTRAINT FK_D6680DC16C1197C9 FOREIGN KEY (project_id_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE technology_project ADD CONSTRAINT FK_6EFD95584235D463 FOREIGN KEY (technology_id) REFERENCES technology (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE technology_project ADD CONSTRAINT FK_6EFD9558166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blog_image DROP FOREIGN KEY FK_35D2479768011AFE');
        $this->addSql('ALTER TABLE blog_image DROP FOREIGN KEY FK_35D247978FABDD9F');
        $this->addSql('ALTER TABLE link_project DROP FOREIGN KEY FK_52D58A1BADA40271');
        $this->addSql('ALTER TABLE link_project DROP FOREIGN KEY FK_52D58A1B166D1F9C');
        $this->addSql('ALTER TABLE project_image DROP FOREIGN KEY FK_D6680DC168011AFE');
        $this->addSql('ALTER TABLE project_image DROP FOREIGN KEY FK_D6680DC16C1197C9');
        $this->addSql('ALTER TABLE technology_project DROP FOREIGN KEY FK_6EFD95584235D463');
        $this->addSql('ALTER TABLE technology_project DROP FOREIGN KEY FK_6EFD9558166D1F9C');
        $this->addSql('DROP TABLE blog_image');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE link');
        $this->addSql('DROP TABLE link_project');
        $this->addSql('DROP TABLE project_image');
        $this->addSql('DROP TABLE technology');
        $this->addSql('DROP TABLE technology_project');
    }
}
