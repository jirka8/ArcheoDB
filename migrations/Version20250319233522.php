<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250319233522 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE finds (id SERIAL NOT NULL, location_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(1024) NOT NULL, gps VARCHAR(255) DEFAULT NULL, founded TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1CAAA57664D218E ON finds (location_id)');
        $this->addSql('CREATE TABLE finds_categories (finds_id INT NOT NULL, categories_id INT NOT NULL, PRIMARY KEY(finds_id, categories_id))');
        $this->addSql('CREATE INDEX IDX_5AC0C323D34ED394 ON finds_categories (finds_id)');
        $this->addSql('CREATE INDEX IDX_5AC0C323A21214B7 ON finds_categories (categories_id)');
        $this->addSql('CREATE TABLE finds_datings (finds_id INT NOT NULL, datings_id INT NOT NULL, PRIMARY KEY(finds_id, datings_id))');
        $this->addSql('CREATE INDEX IDX_DCCB6395D34ED394 ON finds_datings (finds_id)');
        $this->addSql('CREATE INDEX IDX_DCCB6395BFCC19E0 ON finds_datings (datings_id)');
        $this->addSql('ALTER TABLE finds ADD CONSTRAINT FK_1CAAA57664D218E FOREIGN KEY (location_id) REFERENCES locations (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE finds_categories ADD CONSTRAINT FK_5AC0C323D34ED394 FOREIGN KEY (finds_id) REFERENCES finds (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE finds_categories ADD CONSTRAINT FK_5AC0C323A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE finds_datings ADD CONSTRAINT FK_DCCB6395D34ED394 FOREIGN KEY (finds_id) REFERENCES finds (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE finds_datings ADD CONSTRAINT FK_DCCB6395BFCC19E0 FOREIGN KEY (datings_id) REFERENCES datings (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE finds DROP CONSTRAINT FK_1CAAA57664D218E');
        $this->addSql('ALTER TABLE finds_categories DROP CONSTRAINT FK_5AC0C323D34ED394');
        $this->addSql('ALTER TABLE finds_categories DROP CONSTRAINT FK_5AC0C323A21214B7');
        $this->addSql('ALTER TABLE finds_datings DROP CONSTRAINT FK_DCCB6395D34ED394');
        $this->addSql('ALTER TABLE finds_datings DROP CONSTRAINT FK_DCCB6395BFCC19E0');
        $this->addSql('DROP TABLE finds');
        $this->addSql('DROP TABLE finds_categories');
        $this->addSql('DROP TABLE finds_datings');
    }
}
