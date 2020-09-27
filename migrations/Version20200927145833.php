<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200927145833 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE przedmiot ADD kierunek_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE przedmiot ADD CONSTRAINT FK_BF0B9CAB655AD897 FOREIGN KEY (kierunek_id) REFERENCES kierunek (id)');
        $this->addSql('CREATE INDEX IDX_BF0B9CAB655AD897 ON przedmiot (kierunek_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE przedmiot DROP FOREIGN KEY FK_BF0B9CAB655AD897');
        $this->addSql('DROP INDEX IDX_BF0B9CAB655AD897 ON przedmiot');
        $this->addSql('ALTER TABLE przedmiot DROP kierunek_id');
    }
}
