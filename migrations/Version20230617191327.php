<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230617191327 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lesson ADD training_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F3BEFD98D1 FOREIGN KEY (training_id) REFERENCES training (id)');
        $this->addSql('CREATE INDEX IDX_F87474F3BEFD98D1 ON lesson (training_id)');
        $this->addSql('ALTER TABLE person CHANGE preprovision preprovision VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE training DROP FOREIGN KEY FK_D5128A8FCDF80196');
        $this->addSql('DROP INDEX IDX_D5128A8FCDF80196 ON training');
        $this->addSql('ALTER TABLE training DROP lesson_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lesson DROP FOREIGN KEY FK_F87474F3BEFD98D1');
        $this->addSql('DROP INDEX IDX_F87474F3BEFD98D1 ON lesson');
        $this->addSql('ALTER TABLE lesson DROP training_id');
        $this->addSql('ALTER TABLE person CHANGE preprovision preprovision VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE training ADD lesson_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE training ADD CONSTRAINT FK_D5128A8FCDF80196 FOREIGN KEY (lesson_id) REFERENCES lesson (id)');
        $this->addSql('CREATE INDEX IDX_D5128A8FCDF80196 ON training (lesson_id)');
    }
}
