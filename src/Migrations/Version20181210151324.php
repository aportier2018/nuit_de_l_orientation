<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181210151324 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE archive_exponent DROP FOREIGN KEY FK_2672B73C2956195F');
        $this->addSql('ALTER TABLE archive_user DROP FOREIGN KEY FK_BDB600D22956195F');
        $this->addSql('DROP TABLE archive');
        $this->addSql('DROP TABLE archive_exponent');
        $this->addSql('DROP TABLE archive_user');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE archive (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE archive_exponent (archive_id INT NOT NULL, exponent_id INT NOT NULL, INDEX IDX_2672B73C2956195F (archive_id), INDEX IDX_2672B73C8E1D74AC (exponent_id), PRIMARY KEY(archive_id, exponent_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE archive_user (archive_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_BDB600D22956195F (archive_id), INDEX IDX_BDB600D2A76ED395 (user_id), PRIMARY KEY(archive_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE archive_exponent ADD CONSTRAINT FK_2672B73C2956195F FOREIGN KEY (archive_id) REFERENCES archive (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE archive_exponent ADD CONSTRAINT FK_2672B73C8E1D74AC FOREIGN KEY (exponent_id) REFERENCES exponent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE archive_user ADD CONSTRAINT FK_BDB600D22956195F FOREIGN KEY (archive_id) REFERENCES archive (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE archive_user ADD CONSTRAINT FK_BDB600D2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }
}
