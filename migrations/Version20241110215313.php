<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241110215313 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student_info CHANGE ethnicity ethnicity VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE student_info RENAME INDEX learning_style__fk TO IDX_F4AA4A8F9EBD646A');
        $this->addSql('ALTER TABLE student_info RENAME INDEX neurodiversity__fk TO IDX_F4AA4A8FDD6A6B1C');
        $this->addSql('ALTER TABLE student_info RENAME INDEX gender__fk TO IDX_F4AA4A8F708A0E0');
        $this->addSql('ALTER TABLE student_info RENAME INDEX payment_status__fk TO IDX_F4AA4A8F28DE2F95');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student_info CHANGE ethnicity ethnicity VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE student_info RENAME INDEX idx_f4aa4a8fdd6a6b1c TO neurodiversity__fk');
        $this->addSql('ALTER TABLE student_info RENAME INDEX idx_f4aa4a8f28de2f95 TO payment_status__fk');
        $this->addSql('ALTER TABLE student_info RENAME INDEX idx_f4aa4a8f708a0e0 TO gender__fk');
        $this->addSql('ALTER TABLE student_info RENAME INDEX idx_f4aa4a8f9ebd646a TO learning_style__fk');
    }
}
