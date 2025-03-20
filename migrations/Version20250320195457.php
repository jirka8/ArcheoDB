<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250320195457 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX uniq_1caaa57664d218e');
        $this->addSql('ALTER TABLE finds ALTER gps SET NOT NULL');
        $this->addSql('CREATE INDEX IDX_1CAAA57664D218E ON finds (location_id)');
        $this->addSql('DROP INDEX uniq_17e64aba61220ea6');
        $this->addSql('CREATE INDEX IDX_17E64ABA61220EA6 ON locations (creator_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX IDX_1CAAA57664D218E');
        $this->addSql('ALTER TABLE finds ALTER gps DROP NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX uniq_1caaa57664d218e ON finds (location_id)');
        $this->addSql('DROP INDEX IDX_17E64ABA61220EA6');
        $this->addSql('CREATE UNIQUE INDEX uniq_17e64aba61220ea6 ON locations (creator_id)');
    }
}
