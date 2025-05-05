<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250505132732 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE item (id SERIAL NOT NULL, lista_id INT NOT NULL, descricao VARCHAR(255) NOT NULL, concluida BOOLEAN NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_1F1B251E6736D68F ON item (lista_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE item ADD CONSTRAINT FK_1F1B251E6736D68F FOREIGN KEY (lista_id) REFERENCES lista (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE item DROP CONSTRAINT FK_1F1B251E6736D68F
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE item
        SQL);
    }
}
