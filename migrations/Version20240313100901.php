<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240313100901 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateurs ADD porte_id INT DEFAULT NULL, ADD profession_employes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateurs ADD CONSTRAINT FK_497B315E6BCC8323 FOREIGN KEY (porte_id) REFERENCES porte (id)');
        $this->addSql('ALTER TABLE utilisateurs ADD CONSTRAINT FK_497B315E2E752996 FOREIGN KEY (profession_employes_id) REFERENCES profession (id)');
        $this->addSql('CREATE INDEX IDX_497B315E6BCC8323 ON utilisateurs (porte_id)');
        $this->addSql('CREATE INDEX IDX_497B315E2E752996 ON utilisateurs (profession_employes_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateurs DROP FOREIGN KEY FK_497B315E6BCC8323');
        $this->addSql('ALTER TABLE utilisateurs DROP FOREIGN KEY FK_497B315E2E752996');
        $this->addSql('DROP INDEX IDX_497B315E6BCC8323 ON utilisateurs');
        $this->addSql('DROP INDEX IDX_497B315E2E752996 ON utilisateurs');
        $this->addSql('ALTER TABLE utilisateurs DROP porte_id, DROP profession_employes_id');
    }
}
