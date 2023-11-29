<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20231129094756 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add site table into database';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE site (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, commentaire VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE site');
    }
}
