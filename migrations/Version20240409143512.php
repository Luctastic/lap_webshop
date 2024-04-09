<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240409143512 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE basket_entry_entity CHANGE product_id product_id INT NOT NULL');
        $this->addSql('ALTER TABLE customer_entity ADD basket_id INT NOT NULL');
        $this->addSql('ALTER TABLE customer_entity ADD CONSTRAINT FK_BFED98391BE1FB52 FOREIGN KEY (basket_id) REFERENCES basket_entity (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BFED98391BE1FB52 ON customer_entity (basket_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer_entity DROP FOREIGN KEY FK_BFED98391BE1FB52');
        $this->addSql('DROP INDEX UNIQ_BFED98391BE1FB52 ON customer_entity');
        $this->addSql('ALTER TABLE customer_entity DROP basket_id');
        $this->addSql('ALTER TABLE basket_entry_entity CHANGE product_id product_id INT DEFAULT NULL');
    }
}
