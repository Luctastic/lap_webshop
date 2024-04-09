<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240409134526 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // note: insert default salutations
        $this->addSql('INSERT INTO salutation_entity (salutation) VALUES ("Herr");');
        $this->addSql('INSERT INTO salutation_entity (salutation) VALUES ("Frau");');
        $this->addSql('INSERT INTO salutation_entity (salutation) VALUES ("Keine Angabe");');
    }

    public function down(Schema $schema): void
    {
    }
}
