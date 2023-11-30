<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20231129151522 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add porte table to database';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE porte (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, comments VARCHAR(255) NOT NULL, version INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE porte');
    }
}
