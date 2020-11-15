<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200430154649 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE workout (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, equipement_id INT DEFAULT NULL, created_at DATETIME NOT NULL, discr VARCHAR(255) NOT NULL, duration INT DEFAULT NULL, speed INT DEFAULT NULL, repetition INT DEFAULT NULL, weight INT DEFAULT NULL, INDEX IDX_649FFB72A76ED395 (user_id), INDEX IDX_649FFB72806F0F5C (equipement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE workout ADD CONSTRAINT FK_649FFB72A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE workout ADD CONSTRAINT FK_649FFB72806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipment (id)');
        $this->addSql('DROP TABLE endurance');
        $this->addSql('DROP TABLE strenght');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE endurance (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, equipement_id INT DEFAULT NULL, created_at DATETIME NOT NULL, duration INT NOT NULL, speed INT NOT NULL, INDEX IDX_2043FE18A76ED395 (user_id), INDEX IDX_2043FE18806F0F5C (equipement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE strenght (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, equipement_id INT DEFAULT NULL, created_at DATETIME NOT NULL, repetition INT NOT NULL, weight INT NOT NULL, INDEX IDX_24CFE0CAA76ED395 (user_id), INDEX IDX_24CFE0CA806F0F5C (equipement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE endurance ADD CONSTRAINT FK_2043FE18806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipment (id)');
        $this->addSql('ALTER TABLE endurance ADD CONSTRAINT FK_2043FE18A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE strenght ADD CONSTRAINT FK_24CFE0CA806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipment (id)');
        $this->addSql('ALTER TABLE strenght ADD CONSTRAINT FK_24CFE0CAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('DROP TABLE workout');
    }
}
