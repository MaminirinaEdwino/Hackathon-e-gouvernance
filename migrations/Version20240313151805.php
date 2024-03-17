<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240313151805 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE deces ADD num_porte INT NOT NULL, CHANGE fichier_retour fichier_retour VARCHAR(255) DEFAULT NULL, CHANGE date_demande date_demande DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE deces DROP num_porte, CHANGE fichier_retour fichier_retour VARCHAR(255) NOT NULL, CHANGE date_demande date_demande DATETIME NOT NULL');
    }
}
