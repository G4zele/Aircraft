<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210602134701 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE aircraft_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE eff_explo_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE fly_out_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE remont_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE aircraft (id INT NOT NULL, type VARCHAR(255) NOT NULL, board_number VARCHAR(255) NOT NULL, create_date DATE NOT NULL, create_place VARCHAR(255) NOT NULL, fix_date DATE DEFAULT NULL, fix_place VARCHAR(255) DEFAULT NULL, explo_year VARCHAR(255) NOT NULL, fly_time_hours INT NOT NULL, sit_downs INT NOT NULL, fly_time_minutes INT NOT NULL, explo_time_minutes INT NOT NULL, explo_time_hours INT NOT NULL, fly_left_minutes INT NOT NULL, fly_left_hours INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE eff_explo (id INT NOT NULL, plane_id_id INT NOT NULL, state VARCHAR(255) NOT NULL, time_of_state INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4C2AFAF84D3790A5 ON eff_explo (plane_id_id)');
        $this->addSql('CREATE TABLE fly_out (id INT NOT NULL, plane_id_id INT NOT NULL, date DATE NOT NULL, flying_time INT NOT NULL, time_before_fly INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2B3B40414D3790A5 ON fly_out (plane_id_id)');
        $this->addSql('CREATE TABLE remont (id INT NOT NULL, plane_id_id INT NOT NULL, time_on_to INT DEFAULT NULL, time_on_oper_to INT DEFAULT NULL, time_of_mid_rem INT DEFAULT NULL, time_dir INT DEFAULT NULL, time_ystr INT DEFAULT NULL, trud_dop INT DEFAULT NULL, trud_main INT DEFAULT NULL, trud_de_mont INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_802BA59B4D3790A5 ON remont (plane_id_id)');
        $this->addSql('ALTER TABLE eff_explo ADD CONSTRAINT FK_4C2AFAF84D3790A5 FOREIGN KEY (plane_id_id) REFERENCES plane (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE fly_out ADD CONSTRAINT FK_2B3B40414D3790A5 FOREIGN KEY (plane_id_id) REFERENCES plane (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE remont ADD CONSTRAINT FK_802BA59B4D3790A5 FOREIGN KEY (plane_id_id) REFERENCES plane (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE plane ADD include BOOLEAN DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE aircraft_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE eff_explo_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE fly_out_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE remont_id_seq CASCADE');
        $this->addSql('DROP TABLE aircraft');
        $this->addSql('DROP TABLE eff_explo');
        $this->addSql('DROP TABLE fly_out');
        $this->addSql('DROP TABLE remont');
        $this->addSql('ALTER TABLE plane DROP include');
    }
}
