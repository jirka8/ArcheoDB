<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250319232401 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE finds (id SERIAL NOT NULL, location_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(1024) DEFAULT NULL, founded TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, gps VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1CAAA57664D218E ON finds (location_id)');
        $this->addSql('ALTER TABLE finds ADD CONSTRAINT FK_1CAAA57664D218E FOREIGN KEY (location_id) REFERENCES locations (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE categories ADD finds_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE categories ADD CONSTRAINT FK_3AF34668D34ED394 FOREIGN KEY (finds_id) REFERENCES finds (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_3AF34668D34ED394 ON categories (finds_id)');
        $this->addSql('ALTER TABLE datings ADD finds_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE datings ADD CONSTRAINT FK_CAB8AE3DD34ED394 FOREIGN KEY (finds_id) REFERENCES finds (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_CAB8AE3DD34ED394 ON datings (finds_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE categories DROP CONSTRAINT FK_3AF34668D34ED394');
        $this->addSql('ALTER TABLE datings DROP CONSTRAINT FK_CAB8AE3DD34ED394');
        $this->addSql('ALTER TABLE finds DROP CONSTRAINT FK_1CAAA57664D218E');
        $this->addSql('DROP TABLE finds');
        $this->addSql('DROP INDEX IDX_3AF34668D34ED394');
        $this->addSql('ALTER TABLE categories DROP finds_id');
        $this->addSql('DROP INDEX IDX_CAB8AE3DD34ED394');
        $this->addSql('ALTER TABLE datings DROP finds_id');
    }
}
