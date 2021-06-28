<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210601140438 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE aircraft_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE plane_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE plane (id INT NOT NULL, type VARCHAR(255) NOT NULL, board_number VARCHAR(255) NOT NULL, release_date DATE NOT NULL, release_place VARCHAR(255) NOT NULL, fix_date DATE DEFAULT NULL, fix_place VARCHAR(255) DEFAULT NULL, explo_time INT NOT NULL, fix_explo_time INT DEFAULT NULL, starting_explo_time INT NOT NULL, fly_time INT NOT NULL, sit_downs INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP TABLE aircraft');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE plane_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE aircraft_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE aircraft (id INT NOT NULL, type VARCHAR(255) NOT NULL, board_number VARCHAR(255) NOT NULL, create_date DATE NOT NULL, create_place VARCHAR(255) NOT NULL, fix_date DATE DEFAULT NULL, fix_place VARCHAR(255) DEFAULT NULL, explo_year VARCHAR(255) NOT NULL, sit_downs INT NOT NULL, fly_left_hours VARCHAR(255) NOT NULL, fly_time_hours INT NOT NULL, fly_time_minutes INT NOT NULL, explo_time_minutes INT NOT NULL, explo_time_hours INT NOT NULL, fly_left_minutes INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN aircraft.fly_left_hours IS \'(DC2Type:dateinterval)\'');
        $this->addSql('DROP TABLE plane');
    }
}
