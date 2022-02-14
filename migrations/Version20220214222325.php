<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220214222325 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prestation ADD prestation_type_id INT NOT NULL');
        $this->addSql('ALTER TABLE prestation ADD CONSTRAINT FK_51C88FAD6DA7F0A FOREIGN KEY (prestation_type_id) REFERENCES prestation_type (id)');
        $this->addSql('CREATE INDEX IDX_51C88FAD6DA7F0A ON prestation (prestation_type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prestation DROP FOREIGN KEY FK_51C88FAD6DA7F0A');
        $this->addSql('DROP INDEX IDX_51C88FAD6DA7F0A ON prestation');
        $this->addSql('ALTER TABLE prestation DROP prestation_type_id');
    }
}
