<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240517110530 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project_image DROP FOREIGN KEY FK_D6680DC16C1197C9');
        $this->addSql('ALTER TABLE project_image DROP FOREIGN KEY FK_D6680DC168011AFE');
        $this->addSql('ALTER TABLE blog_image DROP FOREIGN KEY FK_35D247978FABDD9F');
        $this->addSql('ALTER TABLE blog_image DROP FOREIGN KEY FK_35D2479768011AFE');
        $this->addSql('DROP TABLE project_image');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE blog_image');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE project_image (id INT AUTO_INCREMENT NOT NULL, image_id_id INT NOT NULL, project_id_id INT NOT NULL, INDEX IDX_D6680DC168011AFE (image_id_id), INDEX IDX_D6680DC16C1197C9 (project_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', image_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, path VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE blog_image (id INT AUTO_INCREMENT NOT NULL, image_id_id INT NOT NULL, blog_id_id INT NOT NULL, INDEX IDX_35D247978FABDD9F (blog_id_id), INDEX IDX_35D2479768011AFE (image_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE project_image ADD CONSTRAINT FK_D6680DC16C1197C9 FOREIGN KEY (project_id_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE project_image ADD CONSTRAINT FK_D6680DC168011AFE FOREIGN KEY (image_id_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE blog_image ADD CONSTRAINT FK_35D247978FABDD9F FOREIGN KEY (blog_id_id) REFERENCES blog (id)');
        $this->addSql('ALTER TABLE blog_image ADD CONSTRAINT FK_35D2479768011AFE FOREIGN KEY (image_id_id) REFERENCES image (id)');
    }
}
