<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241103010624 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE student (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, date_of_birth DATE NOT NULL, phone_number VARCHAR(20) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', learning_style VARCHAR(255) DEFAULT NULL, neurodiversity VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attendance_tracker DROP FOREIGN KEY attendance_tracker_ibfk_1');
        $this->addSql('DROP TABLE attendance_tracker');
        $this->addSql('DROP INDEX student_info_pk ON student_info');
        $this->addSql('ALTER TABLE student_info DROP email, DROP date_of_birth, DROP phone_number, DROP created_at, DROP learning_style, DROP neurodiversity');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE attendance_tracker (id INT AUTO_INCREMENT NOT NULL, student_id INT NOT NULL, attendance_date DATE DEFAULT NULL, status VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, INDEX student_id (student_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE attendance_tracker ADD CONSTRAINT attendance_tracker_ibfk_1 FOREIGN KEY (student_id) REFERENCES student_info (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP TABLE student');
        $this->addSql('ALTER TABLE student_info ADD email VARCHAR(255) NOT NULL, ADD date_of_birth DATE NOT NULL, ADD phone_number VARCHAR(20) NOT NULL, ADD created_at DATETIME DEFAULT CURRENT_TIMESTAMP, ADD learning_style VARCHAR(255) DEFAULT NULL, ADD neurodiversity VARCHAR(255) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX student_info_pk ON student_info (email)');
    }
}
