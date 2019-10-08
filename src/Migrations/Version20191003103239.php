<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191003103239 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE ingredient (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, quantity INTEGER NOT NULL)');
        $this->addSql('DROP INDEX IDX_DA88B137FCFA9DAE');
        $this->addSql('CREATE TEMPORARY TABLE __temp__recipe AS SELECT id, difficulty_id, name, image, cookingtime FROM recipe');
        $this->addSql('DROP TABLE recipe');
        $this->addSql('CREATE TABLE recipe (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, difficulty_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, image VARCHAR(255) DEFAULT NULL COLLATE BINARY, cookingtime INTEGER DEFAULT NULL, CONSTRAINT FK_DA88B137FCFA9DAE FOREIGN KEY (difficulty_id) REFERENCES difficulty (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO recipe (id, difficulty_id, name, image, cookingtime) SELECT id, difficulty_id, name, image, cookingtime FROM __temp__recipe');
        $this->addSql('DROP TABLE __temp__recipe');
        $this->addSql('CREATE INDEX IDX_DA88B137FCFA9DAE ON recipe (difficulty_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP INDEX IDX_DA88B137FCFA9DAE');
        $this->addSql('CREATE TEMPORARY TABLE __temp__recipe AS SELECT id, difficulty_id, name, image, cookingtime FROM recipe');
        $this->addSql('DROP TABLE recipe');
        $this->addSql('CREATE TABLE recipe (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, difficulty_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, cookingtime INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO recipe (id, difficulty_id, name, image, cookingtime) SELECT id, difficulty_id, name, image, cookingtime FROM __temp__recipe');
        $this->addSql('DROP TABLE __temp__recipe');
        $this->addSql('CREATE INDEX IDX_DA88B137FCFA9DAE ON recipe (difficulty_id)');
    }
}
