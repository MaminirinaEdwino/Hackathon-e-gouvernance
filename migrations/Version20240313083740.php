<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240313083740 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE naissance (id INT AUTO_INCREMENT NOT NULL, pere_id INT DEFAULT NULL, mere_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, sexe TINYINT(1) NOT NULL, date_naissance DATE NOT NULL, lieu_naissance VARCHAR(255) NOT NULL, INDEX IDX_F1D8D9043FD73900 (pere_id), INDEX IDX_F1D8D90439DEC40E (mere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE naissance ADD CONSTRAINT FK_F1D8D9043FD73900 FOREIGN KEY (pere_id) REFERENCES utilisateurs (id)');
        $this->addSql('ALTER TABLE naissance ADD CONSTRAINT FK_F1D8D90439DEC40E FOREIGN KEY (mere_id) REFERENCES utilisateurs (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE naissance DROP FOREIGN KEY FK_F1D8D9043FD73900');
        $this->addSql('ALTER TABLE naissance DROP FOREIGN KEY FK_F1D8D90439DEC40E');
        $this->addSql('DROP TABLE naissance');
    }
}
