<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210526081450 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contract (id INT AUTO_INCREMENT NOT NULL, id_user INT NOT NULL, num_contract VARCHAR(255) NOT NULL, id_company INT NOT NULL, date_conclusion DATE DEFAULT NULL, date_activation DATE DEFAULT NULL, date_ending DATE DEFAULT NULL, sum INT DEFAULT NULL, dept INT DEFAULT NULL, date_dept DATE DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, dock VARCHAR(255) DEFAULT NULL, date_payment DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP INDEX email ON company');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE contract');
        $this->addSql('CREATE UNIQUE INDEX email ON company (email)');
    }
}
