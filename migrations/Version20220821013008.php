<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220821013008 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE payment_methods_user_os_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE payment_methods_user_os (id INT NOT NULL, payment_method_id INT NOT NULL, user_os VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8385C32F5AA1164F ON payment_methods_user_os (payment_method_id)');
        $this->addSql('ALTER TABLE payment_methods_user_os ADD CONSTRAINT FK_8385C32F5AA1164F FOREIGN KEY (payment_method_id) REFERENCES payment_methods (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER INDEX idx_c3c8865da0ce293e RENAME TO IDX_C3C8865D5AA1164F');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE payment_methods_user_os_id_seq CASCADE');
        $this->addSql('ALTER TABLE payment_methods_user_os DROP CONSTRAINT FK_8385C32F5AA1164F');
        $this->addSql('DROP TABLE payment_methods_user_os');
        $this->addSql('ALTER INDEX idx_c3c8865d5aa1164f RENAME TO idx_c3c8865da0ce293e');
    }
}
