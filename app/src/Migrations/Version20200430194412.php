<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200430194412 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE endurance DROP FOREIGN KEY FK_2043FE18BF396750');
        $this->addSql('ALTER TABLE strenght DROP FOREIGN KEY FK_24CFE0CABF396750');
        $this->addSql('DROP TABLE workout');
        $this->addSql('ALTER TABLE endurance ADD user_id INT DEFAULT NULL, ADD equipement_id INT DEFAULT NULL, ADD created_at DATETIME NOT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE endurance ADD CONSTRAINT FK_2043FE18A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE endurance ADD CONSTRAINT FK_2043FE18806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipment (id)');
        $this->addSql('CREATE INDEX IDX_2043FE18A76ED395 ON endurance (user_id)');
        $this->addSql('CREATE INDEX IDX_2043FE18806F0F5C ON endurance (equipement_id)');
        $this->addSql('ALTER TABLE strenght ADD user_id INT DEFAULT NULL, ADD equipement_id INT DEFAULT NULL, ADD created_at DATETIME NOT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE strenght ADD CONSTRAINT FK_24CFE0CAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE strenght ADD CONSTRAINT FK_24CFE0CA806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipment (id)');
        $this->addSql('CREATE INDEX IDX_24CFE0CAA76ED395 ON strenght (user_id)');
        $this->addSql('CREATE INDEX IDX_24CFE0CA806F0F5C ON strenght (equipement_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE workout (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, equipement_id INT DEFAULT NULL, created_at DATETIME NOT NULL, discr VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_649FFB72A76ED395 (user_id), INDEX IDX_649FFB72806F0F5C (equipement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE workout ADD CONSTRAINT FK_649FFB72806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipment (id)');
        $this->addSql('ALTER TABLE workout ADD CONSTRAINT FK_649FFB72A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE endurance DROP FOREIGN KEY FK_2043FE18A76ED395');
        $this->addSql('ALTER TABLE endurance DROP FOREIGN KEY FK_2043FE18806F0F5C');
        $this->addSql('DROP INDEX IDX_2043FE18A76ED395 ON endurance');
        $this->addSql('DROP INDEX IDX_2043FE18806F0F5C ON endurance');
        $this->addSql('ALTER TABLE endurance DROP user_id, DROP equipement_id, DROP created_at, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE endurance ADD CONSTRAINT FK_2043FE18BF396750 FOREIGN KEY (id) REFERENCES workout (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE strenght DROP FOREIGN KEY FK_24CFE0CAA76ED395');
        $this->addSql('ALTER TABLE strenght DROP FOREIGN KEY FK_24CFE0CA806F0F5C');
        $this->addSql('DROP INDEX IDX_24CFE0CAA76ED395 ON strenght');
        $this->addSql('DROP INDEX IDX_24CFE0CA806F0F5C ON strenght');
        $this->addSql('ALTER TABLE strenght DROP user_id, DROP equipement_id, DROP created_at, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE strenght ADD CONSTRAINT FK_24CFE0CABF396750 FOREIGN KEY (id) REFERENCES workout (id) ON DELETE CASCADE');
    }
}
