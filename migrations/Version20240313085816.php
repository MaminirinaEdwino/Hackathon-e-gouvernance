<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240313085816 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mariage (id INT AUTO_INCREMENT NOT NULL, demandeur_id INT DEFAULT NULL, cin VARCHAR(255) NOT NULL, fichier_retour VARCHAR(255) NOT NULL, INDEX IDX_2FE8EC2295A6EE59 (demandeur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mariage ADD CONSTRAINT FK_2FE8EC2295A6EE59 FOREIGN KEY (demandeur_id) REFERENCES utilisateurs (id)');
        $this->addSql('ALTER TABLE deces ADD demandeur_id INT DEFAULT NULL, ADD fichier_retour VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE deces ADD CONSTRAINT FK_3D7FEBBC95A6EE59 FOREIGN KEY (demandeur_id) REFERENCES utilisateurs (id)');
        $this->addSql('CREATE INDEX IDX_3D7FEBBC95A6EE59 ON deces (demandeur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mariage DROP FOREIGN KEY FK_2FE8EC2295A6EE59');
        $this->addSql('DROP TABLE mariage');
        $this->addSql('ALTER TABLE deces DROP FOREIGN KEY FK_3D7FEBBC95A6EE59');
        $this->addSql('DROP INDEX IDX_3D7FEBBC95A6EE59 ON deces');
        $this->addSql('ALTER TABLE deces DROP demandeur_id, DROP fichier_retour');
    }
}
