<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240313091845 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE date_demande (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE deces ADD date_demande DATETIME NOT NULL, ADD date_retour DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE livret ADD demandeur_id INT DEFAULT NULL, ADD fichier_retour VARCHAR(255) NOT NULL, ADD date_demande DATETIME NOT NULL, ADD date_retour DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE livret ADD CONSTRAINT FK_C15120795A6EE59 FOREIGN KEY (demandeur_id) REFERENCES utilisateurs (id)');
        $this->addSql('CREATE INDEX IDX_C15120795A6EE59 ON livret (demandeur_id)');
        $this->addSql('ALTER TABLE mariage ADD date_demande DATETIME NOT NULL, ADD date_retour DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE naissance ADD date_demande DATETIME NOT NULL, ADD date_retour DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE date_demande');
        $this->addSql('ALTER TABLE deces DROP date_demande, DROP date_retour');
        $this->addSql('ALTER TABLE livret DROP FOREIGN KEY FK_C15120795A6EE59');
        $this->addSql('DROP INDEX IDX_C15120795A6EE59 ON livret');
        $this->addSql('ALTER TABLE livret DROP demandeur_id, DROP fichier_retour, DROP date_demande, DROP date_retour');
        $this->addSql('ALTER TABLE mariage DROP date_demande, DROP date_retour');
        $this->addSql('ALTER TABLE naissance DROP date_demande, DROP date_retour');
    }
}
