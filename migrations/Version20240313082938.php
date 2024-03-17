<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240313082938 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateurs ADD pere_id INT DEFAULT NULL, ADD mere_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateurs ADD CONSTRAINT FK_497B315E3FD73900 FOREIGN KEY (pere_id) REFERENCES utilisateurs (id)');
        $this->addSql('ALTER TABLE utilisateurs ADD CONSTRAINT FK_497B315E39DEC40E FOREIGN KEY (mere_id) REFERENCES utilisateurs (id)');
        $this->addSql('CREATE INDEX IDX_497B315E3FD73900 ON utilisateurs (pere_id)');
        $this->addSql('CREATE INDEX IDX_497B315E39DEC40E ON utilisateurs (mere_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateurs DROP FOREIGN KEY FK_497B315E3FD73900');
        $this->addSql('ALTER TABLE utilisateurs DROP FOREIGN KEY FK_497B315E39DEC40E');
        $this->addSql('DROP INDEX IDX_497B315E3FD73900 ON utilisateurs');
        $this->addSql('DROP INDEX IDX_497B315E39DEC40E ON utilisateurs');
        $this->addSql('ALTER TABLE utilisateurs DROP pere_id, DROP mere_id');
    }
}
