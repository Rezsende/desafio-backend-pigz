<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250502212933 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE item (id SERIAL NOT NULL, lista_id INT NOT NULL, descricao VARCHAR(255) NOT NULL, preco DOUBLE PRECISION NOT NULL, valor DOUBLE PRECISION NOT NULL, quantidade INT NOT NULL, total DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_1F1B251E6736D68F ON item (lista_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE lista (id SERIAL NOT NULL, usuario_id INT NOT NULL, nome VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_FB9FEEEDDB38439E ON lista (usuario_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE item ADD CONSTRAINT FK_1F1B251E6736D68F FOREIGN KEY (lista_id) REFERENCES lista (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE lista ADD CONSTRAINT FK_FB9FEEEDDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE
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
            ALTER TABLE lista DROP CONSTRAINT FK_FB9FEEEDDB38439E
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE item
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE lista
        SQL);
    }
}
