<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210617205357 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, transaction_number INT NOT NULL, email VARCHAR(255) NOT NULL, access INT NOT NULL, pet_id INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE command (id INT AUTO_INCREMENT NOT NULL, users_id INT NOT NULL, product_name VARCHAR(255) NOT NULL, reference VARCHAR(255) NOT NULL, storage VARCHAR(255) NOT NULL, deliver_day DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employee (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, access INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE global_message (id INT AUTO_INCREMENT NOT NULL, creation_time DATETIME NOT NULL, message VARCHAR(255) NOT NULL, creator_id INT NOT NULL, destinator_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pet (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) DEFAULT NULL, race VARCHAR(255) DEFAULT NULL, bage_number VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pviate_messages (id INT AUTO_INCREMENT NOT NULL, creation_time DATETIME NOT NULL, message VARCHAR(255) NOT NULL, creator_id INT NOT NULL, destinator_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sector (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, number_of_people INT DEFAULT NULL, activity VARCHAR(255) DEFAULT NULL, cleanliness INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE command');
        $this->addSql('DROP TABLE employee');
        $this->addSql('DROP TABLE global_message');
        $this->addSql('DROP TABLE pet');
        $this->addSql('DROP TABLE pviate_messages');
        $this->addSql('DROP TABLE sector');
    }
}
