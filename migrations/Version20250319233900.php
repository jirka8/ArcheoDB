<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250319233900 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE finds ADD COLUMN gps_new geometry(POINT, 4326)');
        $this->addSql('ALTER TABLE finds DROP COLUMN gps');
        $this->addSql('ALTER TABLE finds RENAME COLUMN gps_new TO gps');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE finds ALTER gps TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE finds ALTER gps DROP NOT NULL');
    }
}
