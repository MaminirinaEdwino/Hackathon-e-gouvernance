<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240313090122 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE naissance ADD demandeur_id INT DEFAULT NULL, ADD demadeur_acte_id INT DEFAULT NULL, ADD fichier_retour VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE naissance ADD CONSTRAINT FK_F1D8D90495A6EE59 FOREIGN KEY (demandeur_id) REFERENCES utilisateurs (id)');
        $this->addSql('ALTER TABLE naissance ADD CONSTRAINT FK_F1D8D904EADFC3C5 FOREIGN KEY (demadeur_acte_id) REFERENCES utilisateurs (id)');
        $this->addSql('CREATE INDEX IDX_F1D8D90495A6EE59 ON naissance (demandeur_id)');
        $this->addSql('CREATE INDEX IDX_F1D8D904EADFC3C5 ON naissance (demadeur_acte_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE naissance DROP FOREIGN KEY FK_F1D8D90495A6EE59');
        $this->addSql('ALTER TABLE naissance DROP FOREIGN KEY FK_F1D8D904EADFC3C5');
        $this->addSql('DROP INDEX IDX_F1D8D90495A6EE59 ON naissance');
        $this->addSql('DROP INDEX IDX_F1D8D904EADFC3C5 ON naissance');
        $this->addSql('ALTER TABLE naissance DROP demandeur_id, DROP demadeur_acte_id, DROP fichier_retour');
    }
}
