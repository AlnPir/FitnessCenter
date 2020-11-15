<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200430152918 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE endurance (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, equipement_id INT DEFAULT NULL, created_at DATETIME NOT NULL, duration INT NOT NULL, speed INT NOT NULL, INDEX IDX_2043FE18A76ED395 (user_id), INDEX IDX_2043FE18806F0F5C (equipement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipment (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE modality (id INT AUTO_INCREMENT NOT NULL, offer_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, periodicity INT NOT NULL, INDEX IDX_307988C053C674EE (offer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE strenght (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, equipement_id INT DEFAULT NULL, created_at DATETIME NOT NULL, repetition INT NOT NULL, weight INT NOT NULL, INDEX IDX_24CFE0CAA76ED395 (user_id), INDEX IDX_24CFE0CA806F0F5C (equipement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE endurance ADD CONSTRAINT FK_2043FE18A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE endurance ADD CONSTRAINT FK_2043FE18806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipment (id)');
        $this->addSql('ALTER TABLE modality ADD CONSTRAINT FK_307988C053C674EE FOREIGN KEY (offer_id) REFERENCES offer (id)');
        $this->addSql('ALTER TABLE strenght ADD CONSTRAINT FK_24CFE0CAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE strenght ADD CONSTRAINT FK_24CFE0CA806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipment (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE endurance DROP FOREIGN KEY FK_2043FE18806F0F5C');
        $this->addSql('ALTER TABLE strenght DROP FOREIGN KEY FK_24CFE0CA806F0F5C');
        $this->addSql('DROP TABLE endurance');
        $this->addSql('DROP TABLE equipment');
        $this->addSql('DROP TABLE modality');
        $this->addSql('DROP TABLE strenght');
    }
}
