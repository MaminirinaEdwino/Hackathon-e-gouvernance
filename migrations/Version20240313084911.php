<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240313084911 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE deces ADD utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE deces ADD CONSTRAINT FK_3D7FEBBCFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3D7FEBBCFB88E14F ON deces (utilisateur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE deces DROP FOREIGN KEY FK_3D7FEBBCFB88E14F');
        $this->addSql('DROP INDEX UNIQ_3D7FEBBCFB88E14F ON deces');
        $this->addSql('ALTER TABLE deces DROP utilisateur_id');
    }
}