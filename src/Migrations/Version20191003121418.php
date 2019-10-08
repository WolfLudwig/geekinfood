<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191003121418 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE instruction (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, recipe_id INTEGER DEFAULT NULL, content CLOB NOT NULL)');
        $this->addSql('CREATE INDEX IDX_7BBAE15659D8A214 ON instruction (recipe_id)');
        $this->addSql('DROP INDEX IDX_DA88B137FCFA9DAE');
        $this->addSql('CREATE TEMPORARY TABLE __temp__recipe AS SELECT id, difficulty_id, name, image, cookingtime FROM recipe');
        $this->addSql('DROP TABLE recipe');
        $this->addSql('CREATE TABLE recipe (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, difficulty_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, image VARCHAR(255) DEFAULT NULL COLLATE BINARY, cookingtime INTEGER DEFAULT NULL, CONSTRAINT FK_DA88B137FCFA9DAE FOREIGN KEY (difficulty_id) REFERENCES difficulty (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO recipe (id, difficulty_id, name, image, cookingtime) SELECT id, difficulty_id, name, image, cookingtime FROM __temp__recipe');
        $this->addSql('DROP TABLE __temp__recipe');
        $this->addSql('CREATE INDEX IDX_DA88B137FCFA9DAE ON recipe (difficulty_id)');
        $this->addSql('DROP INDEX IDX_6BAF7870F8BD700D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ingredient AS SELECT id, unit_id, name, quantity FROM ingredient');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('CREATE TABLE ingredient (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, unit_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, quantity INTEGER NOT NULL, CONSTRAINT FK_6BAF7870F8BD700D FOREIGN KEY (unit_id) REFERENCES unit (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO ingredient (id, unit_id, name, quantity) SELECT id, unit_id, name, quantity FROM __temp__ingredient');
        $this->addSql('DROP TABLE __temp__ingredient');
        $this->addSql('CREATE INDEX IDX_6BAF7870F8BD700D ON ingredient (unit_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE instruction');
        $this->addSql('DROP INDEX IDX_6BAF7870F8BD700D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ingredient AS SELECT id, unit_id, name, quantity FROM ingredient');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('CREATE TABLE ingredient (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, unit_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, quantity INTEGER NOT NULL)');
        $this->addSql('INSERT INTO ingredient (id, unit_id, name, quantity) SELECT id, unit_id, name, quantity FROM __temp__ingredient');
        $this->addSql('DROP TABLE __temp__ingredient');
        $this->addSql('CREATE INDEX IDX_6BAF7870F8BD700D ON ingredient (unit_id)');
        $this->addSql('DROP INDEX IDX_DA88B137FCFA9DAE');
        $this->addSql('CREATE TEMPORARY TABLE __temp__recipe AS SELECT id, difficulty_id, name, image, cookingtime FROM recipe');
        $this->addSql('DROP TABLE recipe');
        $this->addSql('CREATE TABLE recipe (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, difficulty_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, cookingtime INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO recipe (id, difficulty_id, name, image, cookingtime) SELECT id, difficulty_id, name, image, cookingtime FROM __temp__recipe');
        $this->addSql('DROP TABLE __temp__recipe');
        $this->addSql('CREATE INDEX IDX_DA88B137FCFA9DAE ON recipe (difficulty_id)');
    }
}
