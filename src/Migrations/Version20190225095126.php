<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190225095126 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE championnat (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partie (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, statut VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partie_user (partie_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_D4C3EF8E075F7A4 (partie_id), INDEX IDX_D4C3EF8A76ED395 (user_id), PRIMARY KEY(partie_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE resultat_partie (id INT AUTO_INCREMENT NOT NULL, partie_id INT NOT NULL, user_id INT NOT NULL, place VARCHAR(25) DEFAULT NULL, points VARCHAR(255) DEFAULT NULL, INDEX IDX_6D0A6360E075F7A4 (partie_id), INDEX IDX_6D0A6360A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE partie_user ADD CONSTRAINT FK_D4C3EF8E075F7A4 FOREIGN KEY (partie_id) REFERENCES partie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE partie_user ADD CONSTRAINT FK_D4C3EF8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE resultat_partie ADD CONSTRAINT FK_6D0A6360E075F7A4 FOREIGN KEY (partie_id) REFERENCES partie (id)');
        $this->addSql('ALTER TABLE resultat_partie ADD CONSTRAINT FK_6D0A6360A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD est_pom TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE partie_user DROP FOREIGN KEY FK_D4C3EF8E075F7A4');
        $this->addSql('ALTER TABLE resultat_partie DROP FOREIGN KEY FK_6D0A6360E075F7A4');
        $this->addSql('DROP TABLE championnat');
        $this->addSql('DROP TABLE partie');
        $this->addSql('DROP TABLE partie_user');
        $this->addSql('DROP TABLE resultat_partie');
        $this->addSql('ALTER TABLE user DROP est_pom');
    }
}
