<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181105110052 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE exponent_motcle (exponent_id INT NOT NULL, motcle_id INT NOT NULL, INDEX IDX_3670FBDF8E1D74AC (exponent_id), INDEX IDX_3670FBDF1D93C8D9 (motcle_id), PRIMARY KEY(exponent_id, motcle_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE test (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE exponent_motcle ADD CONSTRAINT FK_3670FBDF8E1D74AC FOREIGN KEY (exponent_id) REFERENCES exponent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exponent_motcle ADD CONSTRAINT FK_3670FBDF1D93C8D9 FOREIGN KEY (motcle_id) REFERENCES motcle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exponent ADD mc_id INT NOT NULL');
        $this->addSql('ALTER TABLE exponent ADD CONSTRAINT FK_B1D78501713002E FOREIGN KEY (mc_id) REFERENCES motcle (id)');
        $this->addSql('CREATE INDEX IDX_B1D78501713002E ON exponent (mc_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE exponent_motcle');
        $this->addSql('DROP TABLE test');
        $this->addSql('ALTER TABLE exponent DROP FOREIGN KEY FK_B1D78501713002E');
        $this->addSql('DROP INDEX IDX_B1D78501713002E ON exponent');
        $this->addSql('ALTER TABLE exponent DROP mc_id');
    }
}
