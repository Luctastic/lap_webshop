<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240409141010 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // note: insert default countries
        $this->addSql('INSERT INTO country_entity (name, initials) VALUES ("Österreich", "AUT");');
        $this->addSql('INSERT INTO country_entity (name, initials) VALUES ("Deutschland", "GER");');
    }

    public function down(Schema $schema): void
    {
    }
}
