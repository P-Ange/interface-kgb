<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220215103005 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE hiding_places_missions (hiding_places_id INT NOT NULL, missions_id INT NOT NULL, INDEX IDX_59A67E981B3F9D14 (hiding_places_id), INDEX IDX_59A67E9817C042CF (missions_id), PRIMARY KEY(hiding_places_id, missions_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE hiding_places_missions ADD CONSTRAINT FK_59A67E981B3F9D14 FOREIGN KEY (hiding_places_id) REFERENCES hiding_places (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE hiding_places_missions ADD CONSTRAINT FK_59A67E9817C042CF FOREIGN KEY (missions_id) REFERENCES missions (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE hiding_places_missions');
    }
}
