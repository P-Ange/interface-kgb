<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220215101531 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE agents (id INT AUTO_INCREMENT NOT NULL, country_id INT NOT NULL, firstname VARCHAR(60) NOT NULL, lastname VARCHAR(60) NOT NULL, date_of_bith DATE NOT NULL, id_code VARCHAR(40) NOT NULL, INDEX IDX_9596AB6EF92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contacts (id INT AUTO_INCREMENT NOT NULL, country_id INT NOT NULL, firstname VARCHAR(60) NOT NULL, lastname VARCHAR(60) NOT NULL, date_of_birth DATE NOT NULL, code_name VARCHAR(40) NOT NULL, INDEX IDX_33401573F92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mission_types (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE missions (id INT AUTO_INCREMENT NOT NULL, skill_id INT NOT NULL, mission_type_id INT NOT NULL, status_mission_id INT NOT NULL, country_id INT NOT NULL, title VARCHAR(100) NOT NULL, description LONGTEXT NOT NULL, codename VARCHAR(40) NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, INDEX IDX_34F1D47E5585C142 (skill_id), INDEX IDX_34F1D47E547018DE (mission_type_id), INDEX IDX_34F1D47EBF3F4A16 (status_mission_id), INDEX IDX_34F1D47EF92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skills (id INT AUTO_INCREMENT NOT NULL, skill VARCHAR(60) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status_missions (id INT AUTO_INCREMENT NOT NULL, status VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE targets (id INT AUTO_INCREMENT NOT NULL, country_id INT NOT NULL, firstname VARCHAR(60) NOT NULL, lastname VARCHAR(60) NOT NULL, date_of_birth DATE NOT NULL, alias VARCHAR(40) NOT NULL, INDEX IDX_AF431E13F92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE agents ADD CONSTRAINT FK_9596AB6EF92F3E70 FOREIGN KEY (country_id) REFERENCES countries (id)');
        $this->addSql('ALTER TABLE contacts ADD CONSTRAINT FK_33401573F92F3E70 FOREIGN KEY (country_id) REFERENCES countries (id)');
        $this->addSql('ALTER TABLE missions ADD CONSTRAINT FK_34F1D47E5585C142 FOREIGN KEY (skill_id) REFERENCES skills (id)');
        $this->addSql('ALTER TABLE missions ADD CONSTRAINT FK_34F1D47E547018DE FOREIGN KEY (mission_type_id) REFERENCES mission_types (id)');
        $this->addSql('ALTER TABLE missions ADD CONSTRAINT FK_34F1D47EBF3F4A16 FOREIGN KEY (status_mission_id) REFERENCES status_missions (id)');
        $this->addSql('ALTER TABLE missions ADD CONSTRAINT FK_34F1D47EF92F3E70 FOREIGN KEY (country_id) REFERENCES countries (id)');
        $this->addSql('ALTER TABLE targets ADD CONSTRAINT FK_AF431E13F92F3E70 FOREIGN KEY (country_id) REFERENCES countries (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE missions DROP FOREIGN KEY FK_34F1D47E547018DE');
        $this->addSql('ALTER TABLE missions DROP FOREIGN KEY FK_34F1D47E5585C142');
        $this->addSql('ALTER TABLE missions DROP FOREIGN KEY FK_34F1D47EBF3F4A16');
        $this->addSql('DROP TABLE agents');
        $this->addSql('DROP TABLE contacts');
        $this->addSql('DROP TABLE mission_types');
        $this->addSql('DROP TABLE missions');
        $this->addSql('DROP TABLE skills');
        $this->addSql('DROP TABLE status_missions');
        $this->addSql('DROP TABLE targets');
    }
}
