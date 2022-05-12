<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220219175548 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evalu_search_time DROP datum');
        $this->addSql('ALTER TABLE tracking DROP FOREIGN KEY FK_A87C621C1EDE0F55');
        $this->addSql('DROP INDEX IDX_A87C621C1EDE0F55 ON tracking');
        $this->addSql('ALTER TABLE tracking CHANGE projects_id project_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tracking ADD CONSTRAINT FK_A87C621C166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('CREATE INDEX IDX_A87C621C166D1F9C ON tracking (project_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evalu_search_time ADD datum DATETIME NOT NULL');
        $this->addSql('ALTER TABLE tracking DROP FOREIGN KEY FK_A87C621C166D1F9C');
        $this->addSql('DROP INDEX IDX_A87C621C166D1F9C ON tracking');
        $this->addSql('ALTER TABLE tracking CHANGE project_id projects_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tracking ADD CONSTRAINT FK_A87C621C1EDE0F55 FOREIGN KEY (projects_id) REFERENCES project (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_A87C621C1EDE0F55 ON tracking (projects_id)');
    }
}
