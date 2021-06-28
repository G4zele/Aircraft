<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210602170453 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE aircraft_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE date_interval_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE date_interval (id INT NOT NULL, startdate DATE DEFAULT NULL, enddate DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE remont ADD time_on_kap_rem INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE date_interval_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE aircraft_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('DROP TABLE date_interval');
        $this->addSql('ALTER TABLE remont DROP time_on_kap_rem');
    }
}
