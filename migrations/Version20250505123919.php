<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250505123919 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP SEQUENCE item_id_seq CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE voto DROP CONSTRAINT fkfgj7pqu54afvx0dpuf0ecxox5
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE item DROP CONSTRAINT fk_1f1b251e6736d68f
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE voto
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE associado
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE pauta
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE item
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE item_id_seq INCREMENT BY 1 MINVALUE 1 START 1
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE voto (id BIGINT NOT NULL, pauta_id BIGINT DEFAULT NULL, cpf VARCHAR(11) DEFAULT NULL, data_voto TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, opcao VARCHAR(10) DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_BAC56C7AA9945F91 ON voto (pauta_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE associado (id BIGINT NOT NULL, cpf VARCHAR(255) DEFAULT NULL, nome VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE pauta (id BIGINT NOT NULL, data_abertura TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, data_fechamento TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, descricao VARCHAR(255) DEFAULT NULL, sessao_ativa BOOLEAN DEFAULT NULL, titulo VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE item (id SERIAL NOT NULL, lista_id INT NOT NULL, descricao VARCHAR(255) NOT NULL, preco DOUBLE PRECISION NOT NULL, valor DOUBLE PRECISION NOT NULL, quantidade INT NOT NULL, total DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX idx_1f1b251e6736d68f ON item (lista_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE voto ADD CONSTRAINT fkfgj7pqu54afvx0dpuf0ecxox5 FOREIGN KEY (pauta_id) REFERENCES pauta (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE item ADD CONSTRAINT fk_1f1b251e6736d68f FOREIGN KEY (lista_id) REFERENCES lista (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }
}
