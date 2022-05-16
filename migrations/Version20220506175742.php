<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220506175742 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prestation DROP INDEX UNIQ_51C88FAD83B83B7D, ADD INDEX IDX_51C88FAD83B83B7D (photo_in_promote_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prestation DROP INDEX IDX_51C88FAD83B83B7D, ADD UNIQUE INDEX UNIQ_51C88FAD83B83B7D (photo_in_promote_id)');
    }
}
