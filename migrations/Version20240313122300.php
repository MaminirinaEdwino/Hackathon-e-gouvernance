<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240313122300 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE deces ADD confirmation TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE livret ADD confirmation TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE mariage ADD confirmation TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE naissance ADD confirmer TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE deces DROP confirmation');
        $this->addSql('ALTER TABLE livret DROP confirmation');
        $this->addSql('ALTER TABLE mariage DROP confirmation');
        $this->addSql('ALTER TABLE naissance DROP confirmer');
    }
}
