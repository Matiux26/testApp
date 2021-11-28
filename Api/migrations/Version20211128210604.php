<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211128210604 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql("CREATE TABLE IF NOT EXISTS public.items(
            id integer NOT NULL,
            name character varying(100) NULL::character varying,
            amount double precision,
            CONSTRAINT items_pkey PRIMARY KEY (id))"
        );
        $this->addSql("INSERT INTO Items (id, name,amount) VALUES (1, 'Produkt 1', 4);");
        $this->addSql("INSERT INTO Items (id, name,amount) VALUES (1, 'Produkt 1', 4);");
        $this->addSql("INSERT INTO Items (id, name,amount) VALUES (2, 'Produkt 2', 12);");
        $this->addSql("INSERT INTO Items (id, name,amount) VALUES (3, 'Produkt 3', 0);");
        $this->addSql("INSERT INTO Items (id, name,amount) VALUES (4, 'Produkt 4', 6);");
        $this->addSql("INSERT INTO Items (id, name,amount) VALUES (5, 'Produkt 5', 2);");
    }
}
