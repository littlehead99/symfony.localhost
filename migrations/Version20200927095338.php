<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200927095338 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE kierunek (id INT AUTO_INCREMENT NOT NULL, nazwa VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE przedmiot (id INT AUTO_INCREMENT NOT NULL, nazwa VARCHAR(255) NOT NULL, prowadzacy VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student_przedmiot (student_id INT NOT NULL, przedmiot_id INT NOT NULL, INDEX IDX_D8655D2BCB944F1A (student_id), INDEX IDX_D8655D2BF94A6B90 (przedmiot_id), PRIMARY KEY(student_id, przedmiot_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE student_przedmiot ADD CONSTRAINT FK_D8655D2BCB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE student_przedmiot ADD CONSTRAINT FK_D8655D2BF94A6B90 FOREIGN KEY (przedmiot_id) REFERENCES przedmiot (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE student ADD kierunek_id INT DEFAULT NULL, ADD nazwa VARCHAR(255) NOT NULL, DROP name, DROP subject, CHANGE year_of_birth data_urodzenia VARCHAR(4) NOT NULL');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33655AD897 FOREIGN KEY (kierunek_id) REFERENCES kierunek (id)');
        $this->addSql('CREATE INDEX IDX_B723AF33655AD897 ON student (kierunek_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33655AD897');
        $this->addSql('ALTER TABLE student_przedmiot DROP FOREIGN KEY FK_D8655D2BF94A6B90');
        $this->addSql('DROP TABLE kierunek');
        $this->addSql('DROP TABLE przedmiot');
        $this->addSql('DROP TABLE student_przedmiot');
        $this->addSql('DROP INDEX IDX_B723AF33655AD897 ON student');
        $this->addSql('ALTER TABLE student ADD subject VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP kierunek_id, CHANGE nazwa name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE data_urodzenia year_of_birth VARCHAR(4) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
