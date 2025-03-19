<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250319230551 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE datings (id SERIAL NOT NULL, parent_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CAB8AE3D727ACA70 ON datings (parent_id)');
        $this->addSql('ALTER TABLE datings ADD CONSTRAINT FK_CAB8AE3D727ACA70 FOREIGN KEY (parent_id) REFERENCES datings (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE datings DROP CONSTRAINT FK_CAB8AE3D727ACA70');
        $this->addSql('DROP TABLE datings');
    }
}
