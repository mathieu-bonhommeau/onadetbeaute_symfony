<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211203191916 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, prestation_id INT DEFAULT NULL, path VARCHAR(255) NOT NULL, front_photo TINYINT(1) DEFAULT NULL, is_my_works_photo TINYINT(1) DEFAULT NULL, INDEX IDX_14B784189E45C554 (prestation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestation (id INT AUTO_INCREMENT NOT NULL, photo_in_promote_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, price DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_51C88FAD83B83B7D (photo_in_promote_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestation_type (id INT AUTO_INCREMENT NOT NULL, photo_in_promote_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_D06A719583B83B7D (photo_in_promote_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestationphp (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B784189E45C554 FOREIGN KEY (prestation_id) REFERENCES prestation (id)');
        $this->addSql('ALTER TABLE prestation ADD CONSTRAINT FK_51C88FAD83B83B7D FOREIGN KEY (photo_in_promote_id) REFERENCES photo (id)');
        $this->addSql('ALTER TABLE prestation_type ADD CONSTRAINT FK_D06A719583B83B7D FOREIGN KEY (photo_in_promote_id) REFERENCES photo (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prestation DROP FOREIGN KEY FK_51C88FAD83B83B7D');
        $this->addSql('ALTER TABLE prestation_type DROP FOREIGN KEY FK_D06A719583B83B7D');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B784189E45C554');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE prestation');
        $this->addSql('DROP TABLE prestation_type');
        $this->addSql('DROP TABLE prestationphp');
    }
}
