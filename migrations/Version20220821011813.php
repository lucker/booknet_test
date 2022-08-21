<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220821011813 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE payment_methods_country_code_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE payment_methods_country_code (id INT NOT NULL, payment_method_id INT NOT NULL, country_code VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D31425A85AA1164F ON payment_methods_country_code (payment_method_id)');
        $this->addSql('ALTER TABLE payment_methods_country_code ADD CONSTRAINT FK_D31425A85AA1164F FOREIGN KEY (payment_method_id) REFERENCES payment_methods (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE payment_methods_lang DROP CONSTRAINT FK_C3C8865DA0CE293E');
        $this->addSql('DROP INDEX IDX_C3C8865DA0CE293E');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE payment_methods_country_code_id_seq CASCADE');
        $this->addSql('ALTER TABLE payment_methods_country_code DROP CONSTRAINT FK_D31425A85AA1164F');
        $this->addSql('DROP TABLE payment_methods_country_code');
        $this->addSql('ALTER TABLE payment_methods_lang DROP CONSTRAINT fk_c3c8865da0ce293e');
        $this->addSql('DROP INDEX idx_c3c8865da0ce293e');
        $this->addSql('ALTER TABLE payment_methods_lang ADD CONSTRAINT fk_c3c8865da0ce293e FOREIGN KEY (payment_method_id) REFERENCES payment_methods (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_c3c8865da0ce293e ON payment_methods_lang (payment_method_id)');
    }
}
