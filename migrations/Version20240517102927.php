<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240517102927 extends AbstractMigration
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
        $this->addSql('DROP INDEX IDX_D6680DC168011AFE ON project_image');
        $this->addSql('DROP INDEX IDX_D6680DC16C1197C9 ON project_image');
        $this->addSql('ALTER TABLE project_image ADD image_id INT NOT NULL, ADD project_id INT NOT NULL, DROP image_id_id, DROP project_id_id');
        $this->addSql('ALTER TABLE project_image ADD CONSTRAINT FK_D6680DC13DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE project_image ADD CONSTRAINT FK_D6680DC1166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('CREATE INDEX IDX_D6680DC13DA5256D ON project_image (image_id)');
        $this->addSql('CREATE INDEX IDX_D6680DC1166D1F9C ON project_image (project_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project_image DROP FOREIGN KEY FK_D6680DC13DA5256D');
        $this->addSql('ALTER TABLE project_image DROP FOREIGN KEY FK_D6680DC1166D1F9C');
        $this->addSql('DROP INDEX IDX_D6680DC13DA5256D ON project_image');
        $this->addSql('DROP INDEX IDX_D6680DC1166D1F9C ON project_image');
        $this->addSql('ALTER TABLE project_image ADD image_id_id INT NOT NULL, ADD project_id_id INT NOT NULL, DROP image_id, DROP project_id');
        $this->addSql('ALTER TABLE project_image ADD CONSTRAINT FK_D6680DC16C1197C9 FOREIGN KEY (project_id_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE project_image ADD CONSTRAINT FK_D6680DC168011AFE FOREIGN KEY (image_id_id) REFERENCES image (id)');
        $this->addSql('CREATE INDEX IDX_D6680DC168011AFE ON project_image (image_id_id)');
        $this->addSql('CREATE INDEX IDX_D6680DC16C1197C9 ON project_image (project_id_id)');
    }
}
