<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200413181441 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE commandes_restaurants (commandes_id INT NOT NULL, restaurants_id INT NOT NULL, INDEX IDX_E006979F4DCA160A (restaurants_id), INDEX IDX_E006979F8BF5C2E6 (commandes_id), PRIMARY KEY(commandes_id, restaurants_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE commandes_restaurants ADD CONSTRAINT FK_E006979F4DCA160A FOREIGN KEY (restaurants_id) REFERENCES restaurants (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commandes_restaurants ADD CONSTRAINT FK_E006979F8BF5C2E6 FOREIGN KEY (commandes_id) REFERENCES commandes (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
