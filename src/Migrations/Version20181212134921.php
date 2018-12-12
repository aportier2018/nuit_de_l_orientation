<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181212134921 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user_exponent');
        $this->addSql('ALTER TABLE exponent ADD adresse VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL, ADD site VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_exponent (user_id INT NOT NULL, exponent_id INT NOT NULL, INDEX IDX_EB909C50A76ED395 (user_id), INDEX IDX_EB909C508E1D74AC (exponent_id), PRIMARY KEY(user_id, exponent_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE user_exponent ADD CONSTRAINT FK_EB909C508E1D74AC FOREIGN KEY (exponent_id) REFERENCES exponent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_exponent ADD CONSTRAINT FK_EB909C50A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exponent DROP adresse, DROP email, DROP site');
    }
}