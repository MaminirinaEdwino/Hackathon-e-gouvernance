<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240313152026 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE deces ADD demandeur_acte_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE deces ADD CONSTRAINT FK_3D7FEBBCA30210E2 FOREIGN KEY (demandeur_acte_id) REFERENCES utilisateurs (id)');
        $this->addSql('CREATE INDEX IDX_3D7FEBBCA30210E2 ON deces (demandeur_acte_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE deces DROP FOREIGN KEY FK_3D7FEBBCA30210E2');
        $this->addSql('DROP INDEX IDX_3D7FEBBCA30210E2 ON deces');
        $this->addSql('ALTER TABLE deces DROP demandeur_acte_id');
    }
}
