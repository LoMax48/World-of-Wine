<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210608172427 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE batch (id INT AUTO_INCREMENT NOT NULL, fridge_id INT DEFAULT NULL, name_id INT NOT NULL, size INT NOT NULL, date DATE NOT NULL, INDEX IDX_F80B52D414A48E59 (fridge_id), INDEX IDX_F80B52D471179CD6 (name_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contains (id INT AUTO_INCREMENT NOT NULL, name_id INT NOT NULL, booking_id INT NOT NULL, number INT NOT NULL, INDEX IDX_8EFA6A7E71179CD6 (name_id), INDEX IDX_8EFA6A7E3301C60 (booking_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fridge (id INT AUTO_INCREMENT NOT NULL, capacity INT NOT NULL, temperature INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fridge_user (fridge_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_85879C4114A48E59 (fridge_id), INDEX IDX_85879C41A76ED395 (user_id), PRIMARY KEY(fridge_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE name (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, color VARCHAR(255) NOT NULL, sugar INT NOT NULL, degrees INT NOT NULL, sweetness VARCHAR(255) NOT NULL, price INT NOT NULL, description VARCHAR(1023) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, datetime DATETIME NOT NULL, is_confirmed TINYINT(1) NOT NULL, INDEX IDX_F529939819EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE batch ADD CONSTRAINT FK_F80B52D414A48E59 FOREIGN KEY (fridge_id) REFERENCES fridge (id)');
        $this->addSql('ALTER TABLE batch ADD CONSTRAINT FK_F80B52D471179CD6 FOREIGN KEY (name_id) REFERENCES name (id)');
        $this->addSql('ALTER TABLE contains ADD CONSTRAINT FK_8EFA6A7E71179CD6 FOREIGN KEY (name_id) REFERENCES name (id)');
        $this->addSql('ALTER TABLE contains ADD CONSTRAINT FK_8EFA6A7E3301C60 FOREIGN KEY (booking_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE fridge_user ADD CONSTRAINT FK_85879C4114A48E59 FOREIGN KEY (fridge_id) REFERENCES fridge (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fridge_user ADD CONSTRAINT FK_85879C41A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939819EB6921 FOREIGN KEY (client_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE batch DROP FOREIGN KEY FK_F80B52D414A48E59');
        $this->addSql('ALTER TABLE fridge_user DROP FOREIGN KEY FK_85879C4114A48E59');
        $this->addSql('ALTER TABLE batch DROP FOREIGN KEY FK_F80B52D471179CD6');
        $this->addSql('ALTER TABLE contains DROP FOREIGN KEY FK_8EFA6A7E71179CD6');
        $this->addSql('ALTER TABLE contains DROP FOREIGN KEY FK_8EFA6A7E3301C60');
        $this->addSql('DROP TABLE batch');
        $this->addSql('DROP TABLE contains');
        $this->addSql('DROP TABLE fridge');
        $this->addSql('DROP TABLE fridge_user');
        $this->addSql('DROP TABLE name');
        $this->addSql('DROP TABLE `order`');
    }
}
