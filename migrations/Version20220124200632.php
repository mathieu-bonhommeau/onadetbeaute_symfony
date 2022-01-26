<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220124200632 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE onad_et_beaute CHANGE facebook_client_id facebook_client_id BIGINT NOT NULL, CHANGE facebook_user_id facebook_user_id BIGINT NOT NULL, CHANGE facebook_page_id facebook_page_id BIGINT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE onad_et_beaute CHANGE facebook_client_id facebook_client_id INT NOT NULL, CHANGE facebook_user_id facebook_user_id INT NOT NULL, CHANGE facebook_page_id facebook_page_id INT NOT NULL');
    }
}
