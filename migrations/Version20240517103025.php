<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240517103025 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blog_image DROP FOREIGN KEY FK_35D247978FABDD9F');
        $this->addSql('ALTER TABLE blog_image DROP FOREIGN KEY FK_35D2479768011AFE');
        $this->addSql('DROP INDEX IDX_35D247978FABDD9F ON blog_image');
        $this->addSql('DROP INDEX IDX_35D2479768011AFE ON blog_image');
        $this->addSql('ALTER TABLE blog_image ADD image_id INT NOT NULL, ADD blog_id INT NOT NULL, DROP image_id_id, DROP blog_id_id');
        $this->addSql('ALTER TABLE blog_image ADD CONSTRAINT FK_35D247973DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE blog_image ADD CONSTRAINT FK_35D24797DAE07E97 FOREIGN KEY (blog_id) REFERENCES blog (id)');
        $this->addSql('CREATE INDEX IDX_35D247973DA5256D ON blog_image (image_id)');
        $this->addSql('CREATE INDEX IDX_35D24797DAE07E97 ON blog_image (blog_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blog_image DROP FOREIGN KEY FK_35D247973DA5256D');
        $this->addSql('ALTER TABLE blog_image DROP FOREIGN KEY FK_35D24797DAE07E97');
        $this->addSql('DROP INDEX IDX_35D247973DA5256D ON blog_image');
        $this->addSql('DROP INDEX IDX_35D24797DAE07E97 ON blog_image');
        $this->addSql('ALTER TABLE blog_image ADD image_id_id INT NOT NULL, ADD blog_id_id INT NOT NULL, DROP image_id, DROP blog_id');
        $this->addSql('ALTER TABLE blog_image ADD CONSTRAINT FK_35D247978FABDD9F FOREIGN KEY (blog_id_id) REFERENCES blog (id)');
        $this->addSql('ALTER TABLE blog_image ADD CONSTRAINT FK_35D2479768011AFE FOREIGN KEY (image_id_id) REFERENCES image (id)');
        $this->addSql('CREATE INDEX IDX_35D247978FABDD9F ON blog_image (blog_id_id)');
        $this->addSql('CREATE INDEX IDX_35D2479768011AFE ON blog_image (image_id_id)');
    }
}
