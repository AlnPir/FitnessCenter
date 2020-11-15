<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200430194146 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE endurance (id INT NOT NULL, duration INT NOT NULL, speed INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE strenght (id INT NOT NULL, repetition INT NOT NULL, weight INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE endurance ADD CONSTRAINT FK_2043FE18BF396750 FOREIGN KEY (id) REFERENCES workout (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE strenght ADD CONSTRAINT FK_24CFE0CABF396750 FOREIGN KEY (id) REFERENCES workout (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE workout DROP duration, DROP speed, DROP repetition, DROP weight');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE endurance');
        $this->addSql('DROP TABLE strenght');
        $this->addSql('ALTER TABLE workout ADD duration INT DEFAULT NULL, ADD speed INT DEFAULT NULL, ADD repetition INT DEFAULT NULL, ADD weight INT DEFAULT NULL');
    }
}
