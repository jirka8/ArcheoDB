<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250319233023 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categories DROP CONSTRAINT fk_3af34668d34ed394');
        $this->addSql('ALTER TABLE datings DROP CONSTRAINT fk_cab8ae3dd34ed394');
        $this->addSql('DROP SEQUENCE finds_id_seq CASCADE');
        $this->addSql('ALTER TABLE finds DROP CONSTRAINT fk_1caaa57664d218e');
        $this->addSql('DROP TABLE finds');
        $this->addSql('DROP INDEX idx_3af34668d34ed394');
        $this->addSql('ALTER TABLE categories DROP finds_id');
        $this->addSql('DROP INDEX idx_cab8ae3dd34ed394');
        $this->addSql('ALTER TABLE datings DROP finds_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE finds_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE finds (id SERIAL NOT NULL, location_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(1024) DEFAULT NULL, founded TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, gps VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_1caaa57664d218e ON finds (location_id)');
        $this->addSql('ALTER TABLE finds ADD CONSTRAINT fk_1caaa57664d218e FOREIGN KEY (location_id) REFERENCES locations (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE categories ADD finds_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE categories ADD CONSTRAINT fk_3af34668d34ed394 FOREIGN KEY (finds_id) REFERENCES finds (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_3af34668d34ed394 ON categories (finds_id)');
        $this->addSql('ALTER TABLE datings ADD finds_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE datings ADD CONSTRAINT fk_cab8ae3dd34ed394 FOREIGN KEY (finds_id) REFERENCES finds (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_cab8ae3dd34ed394 ON datings (finds_id)');
    }
}
