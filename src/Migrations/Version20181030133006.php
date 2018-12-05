<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181030133006 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, exponent_id INT NOT NULL, name_cat VARCHAR(255) NOT NULL, INDEX IDX_64C19C18E1D74AC (exponent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE espace (id INT AUTO_INCREMENT NOT NULL, name_space VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exponent (id INT AUTO_INCREMENT NOT NULL, name_exp VARCHAR(255) NOT NULL, activity VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exponent_motcle (exponent_id INT NOT NULL, motcle_id INT NOT NULL, INDEX IDX_3670FBDF8E1D74AC (exponent_id), INDEX IDX_3670FBDF1D93C8D9 (motcle_id), PRIMARY KEY(exponent_id, motcle_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE motcle (id INT AUTO_INCREMENT NOT NULL, name_mc VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C18E1D74AC FOREIGN KEY (exponent_id) REFERENCES exponent (id)');
        $this->addSql('ALTER TABLE exponent_motcle ADD CONSTRAINT FK_3670FBDF8E1D74AC FOREIGN KEY (exponent_id) REFERENCES exponent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exponent_motcle ADD CONSTRAINT FK_3670FBDF1D93C8D9 FOREIGN KEY (motcle_id) REFERENCES motcle (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C18E1D74AC');
        $this->addSql('ALTER TABLE exponent_motcle DROP FOREIGN KEY FK_3670FBDF8E1D74AC');
        $this->addSql('ALTER TABLE exponent_motcle DROP FOREIGN KEY FK_3670FBDF1D93C8D9');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE espace');
        $this->addSql('DROP TABLE exponent');
        $this->addSql('DROP TABLE exponent_motcle');
        $this->addSql('DROP TABLE motcle');
    }
}
