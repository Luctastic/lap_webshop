<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240409094457 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // note: create default structure
        $this->addSql('CREATE TABLE address_entity (id INT AUTO_INCREMENT NOT NULL, salutation_id INT NOT NULL, customer_shipping_entity_id INT DEFAULT NULL, customer_billing_entity_id INT DEFAULT NULL, country_id INT NOT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, zip_code VARCHAR(10) DEFAULT NULL, city VARCHAR(50) NOT NULL, street VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, additional_address_line VARCHAR(255) DEFAULT NULL, INDEX IDX_3571C1D72E5AD854 (salutation_id), INDEX IDX_3571C1D7A4C2514E (customer_shipping_entity_id), INDEX IDX_3571C1D72127E21E (customer_billing_entity_id), INDEX IDX_3571C1D7F92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE basket_entity (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE basket_entry_entity (id INT AUTO_INCREMENT NOT NULL, basket_entity_id INT NOT NULL, product_id INT, quantity INT NOT NULL, INDEX IDX_7F51A3157920086 (basket_entity_id), INDEX IDX_7F51A3154584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country_entity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) NOT NULL, initials VARCHAR(3) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer_entity (id INT AUTO_INCREMENT NOT NULL, salutation_id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(64) NOT NULL, last_name VARCHAR(64) NOT NULL, INDEX IDX_BFED98392E5AD854 (salutation_id), UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE delivery_entity (id INT AUTO_INCREMENT NOT NULL, state_id INT NOT NULL, delivery_method_id INT NOT NULL, INDEX IDX_1039BDE65D83CC1 (state_id), INDEX IDX_1039BDE65DED75F5 (delivery_method_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE delivery_method_entity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_entity (id INT AUTO_INCREMENT NOT NULL, payment_id INT NOT NULL, state_id INT NOT NULL, basket_id INT NOT NULL, customer_id INT NOT NULL, delivery_id INT NOT NULL, UNIQUE INDEX UNIQ_CDA754BD4C3A3BB (payment_id), INDEX IDX_CDA754BD5D83CC1 (state_id), UNIQUE INDEX UNIQ_CDA754BD1BE1FB52 (basket_id), INDEX IDX_CDA754BD9395C3F3 (customer_id), UNIQUE INDEX UNIQ_CDA754BD12136921 (delivery_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment_entity (id INT AUTO_INCREMENT NOT NULL, payment_method_id INT NOT NULL, state_id INT NOT NULL, INDEX IDX_2B10DFFE5AA1164F (payment_method_id), INDEX IDX_2B10DFFE5D83CC1 (state_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment_method_entity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_entity (id INT AUTO_INCREMENT, price DOUBLE PRECISION NOT NULL, name VARCHAR(255) NOT NULL, product_number VARCHAR(32) NOT NULL, picture_path VARCHAR(128) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // note: versionId as primary would be so that old orders won't update if products get updated
        //        $this->addSql('CREATE TABLE product_entity (id INT AUTO_INCREMENT, version_id VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, name VARCHAR(255) NOT NULL, product_number VARCHAR(32) NOT NULL, picture VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id, version_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salutation_entity (id INT AUTO_INCREMENT NOT NULL, salutation VARCHAR(64) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE state_entity (id INT AUTO_INCREMENT NOT NULL, state VARCHAR(16) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE address_entity ADD CONSTRAINT FK_3571C1D72E5AD854 FOREIGN KEY (salutation_id) REFERENCES salutation_entity (id)');
        $this->addSql('ALTER TABLE address_entity ADD CONSTRAINT FK_3571C1D7A4C2514E FOREIGN KEY (customer_shipping_entity_id) REFERENCES customer_entity (id)');
        $this->addSql('ALTER TABLE address_entity ADD CONSTRAINT FK_3571C1D72127E21E FOREIGN KEY (customer_billing_entity_id) REFERENCES customer_entity (id)');
        $this->addSql('ALTER TABLE address_entity ADD CONSTRAINT FK_3571C1D7F92F3E70 FOREIGN KEY (country_id) REFERENCES country_entity (id)');
        $this->addSql('ALTER TABLE basket_entry_entity ADD CONSTRAINT FK_7F51A3157920086 FOREIGN KEY (basket_entity_id) REFERENCES basket_entity (id)');
        $this->addSql('ALTER TABLE basket_entry_entity ADD CONSTRAINT FK_7F51A3154584665A FOREIGN KEY (product_id) REFERENCES product_entity (id)');
        $this->addSql('ALTER TABLE customer_entity ADD CONSTRAINT FK_BFED98392E5AD854 FOREIGN KEY (salutation_id) REFERENCES salutation_entity (id)');
        $this->addSql('ALTER TABLE delivery_entity ADD CONSTRAINT FK_1039BDE65D83CC1 FOREIGN KEY (state_id) REFERENCES state_entity (id)');
        $this->addSql('ALTER TABLE delivery_entity ADD CONSTRAINT FK_1039BDE65DED75F5 FOREIGN KEY (delivery_method_id) REFERENCES delivery_method_entity (id)');
        $this->addSql('ALTER TABLE order_entity ADD CONSTRAINT FK_CDA754BD4C3A3BB FOREIGN KEY (payment_id) REFERENCES payment_entity (id)');
        $this->addSql('ALTER TABLE order_entity ADD CONSTRAINT FK_CDA754BD5D83CC1 FOREIGN KEY (state_id) REFERENCES state_entity (id)');
        $this->addSql('ALTER TABLE order_entity ADD CONSTRAINT FK_CDA754BD1BE1FB52 FOREIGN KEY (basket_id) REFERENCES basket_entity (id)');
        $this->addSql('ALTER TABLE order_entity ADD CONSTRAINT FK_CDA754BD9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer_entity (id)');
        $this->addSql('ALTER TABLE order_entity ADD CONSTRAINT FK_CDA754BD12136921 FOREIGN KEY (delivery_id) REFERENCES delivery_entity (id)');
        $this->addSql('ALTER TABLE payment_entity ADD CONSTRAINT FK_2B10DFFE5AA1164F FOREIGN KEY (payment_method_id) REFERENCES payment_method_entity (id)');
        $this->addSql('ALTER TABLE payment_entity ADD CONSTRAINT FK_2B10DFFE5D83CC1 FOREIGN KEY (state_id) REFERENCES state_entity (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE address_entity DROP FOREIGN KEY FK_3571C1D72E5AD854');
        $this->addSql('ALTER TABLE address_entity DROP FOREIGN KEY FK_3571C1D7A4C2514E');
        $this->addSql('ALTER TABLE address_entity DROP FOREIGN KEY FK_3571C1D72127E21E');
        $this->addSql('ALTER TABLE address_entity DROP FOREIGN KEY FK_3571C1D7F92F3E70');
        $this->addSql('ALTER TABLE basket_entry_entity DROP FOREIGN KEY FK_7F51A3157920086');
        $this->addSql('ALTER TABLE basket_entry_entity DROP FOREIGN KEY FK_7F51A3154584665A');
        $this->addSql('ALTER TABLE customer_entity DROP FOREIGN KEY FK_BFED98392E5AD854');
        $this->addSql('ALTER TABLE delivery_entity DROP FOREIGN KEY FK_1039BDE65D83CC1');
        $this->addSql('ALTER TABLE delivery_entity DROP FOREIGN KEY FK_1039BDE65DED75F5');
        $this->addSql('ALTER TABLE order_entity DROP FOREIGN KEY FK_CDA754BD4C3A3BB');
        $this->addSql('ALTER TABLE order_entity DROP FOREIGN KEY FK_CDA754BD5D83CC1');
        $this->addSql('ALTER TABLE order_entity DROP FOREIGN KEY FK_CDA754BD1BE1FB52');
        $this->addSql('ALTER TABLE order_entity DROP FOREIGN KEY FK_CDA754BD9395C3F3');
        $this->addSql('ALTER TABLE order_entity DROP FOREIGN KEY FK_CDA754BD12136921');
        $this->addSql('ALTER TABLE payment_entity DROP FOREIGN KEY FK_2B10DFFE5AA1164F');
        $this->addSql('ALTER TABLE payment_entity DROP FOREIGN KEY FK_2B10DFFE5D83CC1');
        $this->addSql('DROP TABLE address_entity');
        $this->addSql('DROP TABLE basket_entity');
        $this->addSql('DROP TABLE basket_entry_entity');
        $this->addSql('DROP TABLE country_entity');
        $this->addSql('DROP TABLE customer_entity');
        $this->addSql('DROP TABLE delivery_entity');
        $this->addSql('DROP TABLE delivery_method_entity');
        $this->addSql('DROP TABLE order_entity');
        $this->addSql('DROP TABLE payment_entity');
        $this->addSql('DROP TABLE payment_method_entity');
        $this->addSql('DROP TABLE product_entity');
        $this->addSql('DROP TABLE salutation_entity');
        $this->addSql('DROP TABLE state_entity');
    }
}
