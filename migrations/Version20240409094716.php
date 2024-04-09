<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Defaults;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240409094716 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // note: insert default states
        $this->addSql('INSERT INTO state_entity (id, state) VALUES ("' . Defaults::STATE_OPEN_ID . '", "' . Defaults::STATE_OPEN . '");');
        $this->addSql('INSERT INTO state_entity (id, state) VALUES ("' . Defaults::STATE_IN_PROGRESS_ID . '", "' . Defaults::STATE_IN_PROGRESS . '");');
        $this->addSql('INSERT INTO state_entity (id, state) VALUES ("' . Defaults::STATE_FAILED_ID . '", "' . Defaults::STATE_FAILED . '");');
        $this->addSql('INSERT INTO state_entity (id, state) VALUES ("' . Defaults::STATE_DONE_ID . '", "' . Defaults::STATE_DONE . '");');
        $this->addSql('INSERT INTO state_entity (id, state) VALUES ("' . Defaults::STATE_IN_DELIVERY_ID . '", "' . Defaults::STATE_IN_DELIVERY . '");');
    }

    public function down(Schema $schema): void
    {
    }
}
