<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240313082137 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employes ADD porte_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE employes ADD CONSTRAINT FK_A94BC0F06BCC8323 FOREIGN KEY (porte_id) REFERENCES porte (id)');
        $this->addSql('CREATE INDEX IDX_A94BC0F06BCC8323 ON employes (porte_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employes DROP FOREIGN KEY FK_A94BC0F06BCC8323');
        $this->addSql('DROP INDEX IDX_A94BC0F06BCC8323 ON employes');
        $this->addSql('ALTER TABLE employes DROP porte_id');
    }
}
