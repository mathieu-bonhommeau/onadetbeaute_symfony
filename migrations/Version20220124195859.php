<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220124195859 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE onad_et_beaute ADD facebook_client_id INT NOT NULL, ADD facebook_user_id INT NOT NULL, ADD facebook_client_secret VARCHAR(255) NOT NULL, ADD facebook_redirect_uri VARCHAR(255) NOT NULL, ADD facebook_page_id INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE onad_et_beaute DROP facebook_client_id, DROP facebook_user_id, DROP facebook_client_secret, DROP facebook_redirect_uri, DROP facebook_page_id');
    }
}
