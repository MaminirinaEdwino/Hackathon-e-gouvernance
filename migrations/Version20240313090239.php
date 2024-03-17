<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240313090239 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE certification_legalisation ADD demandeur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE certification_legalisation ADD CONSTRAINT FK_F641CB8C95A6EE59 FOREIGN KEY (demandeur_id) REFERENCES utilisateurs (id)');
        $this->addSql('CREATE INDEX IDX_F641CB8C95A6EE59 ON certification_legalisation (demandeur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE certification_legalisation DROP FOREIGN KEY FK_F641CB8C95A6EE59');
        $this->addSql('DROP INDEX IDX_F641CB8C95A6EE59 ON certification_legalisation');
        $this->addSql('ALTER TABLE certification_legalisation DROP demandeur_id');
    }
}
