<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230615154817 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lesson DROP FOREIGN KEY FK_F87474F3217BBB47');
        $this->addSql('DROP INDEX IDX_F87474F3217BBB47 ON lesson');
        $this->addSql('ALTER TABLE lesson DROP person_id, DROP max_persons');
        $this->addSql('ALTER TABLE person ADD email VARCHAR(180) NOT NULL, ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', DROP loginname, DROP firstname, DROP preprovision, DROP lastname, DROP dateofbirth, DROP hiring_date, DROP salary, DROP social_sec_number, DROP street, DROP place');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_34DCD176E7927C74 ON person (email)');
        $this->addSql('ALTER TABLE registration DROP FOREIGN KEY FK_62A8A7A7217BBB47');
        $this->addSql('DROP INDEX IDX_62A8A7A7217BBB47 ON registration');
        $this->addSql('ALTER TABLE registration DROP person_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lesson ADD person_id INT DEFAULT NULL, ADD max_persons INT NOT NULL');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F3217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)');
        $this->addSql('CREATE INDEX IDX_F87474F3217BBB47 ON lesson (person_id)');
        $this->addSql('DROP INDEX UNIQ_34DCD176E7927C74 ON person');
        $this->addSql('ALTER TABLE person ADD loginname VARCHAR(255) NOT NULL, ADD firstname VARCHAR(255) NOT NULL, ADD preprovision VARCHAR(255) NOT NULL, ADD lastname VARCHAR(255) NOT NULL, ADD dateofbirth DATE NOT NULL, ADD hiring_date DATE DEFAULT NULL, ADD salary NUMERIC(10, 2) DEFAULT NULL, ADD social_sec_number INT DEFAULT NULL, ADD street VARCHAR(255) DEFAULT NULL, ADD place VARCHAR(255) DEFAULT NULL, DROP email, DROP roles');
        $this->addSql('ALTER TABLE registration ADD person_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE registration ADD CONSTRAINT FK_62A8A7A7217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)');
        $this->addSql('CREATE INDEX IDX_62A8A7A7217BBB47 ON registration (person_id)');
    }
}
