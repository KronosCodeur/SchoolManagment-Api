<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230505165207 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, classe_id VARCHAR(255) NOT NULL, classe_nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cours (id INT AUTO_INCREMENT NOT NULL, professeur_id_id INT NOT NULL, classe_id_id INT NOT NULL, matiere_id_id INT NOT NULL, date_cours DATE NOT NULL, heure_cours TIME NOT NULL, INDEX IDX_FDCA8C9CEE1AF529 (professeur_id_id), INDEX IDX_FDCA8C9C3633CA6F (classe_id_id), INDEX IDX_FDCA8C9CF3E43022 (matiere_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enseigner (id INT AUTO_INCREMENT NOT NULL, professeur_id_id INT NOT NULL, matiere_id_id INT NOT NULL, INDEX IDX_663E85CDEE1AF529 (professeur_id_id), INDEX IDX_663E85CDF3E43022 (matiere_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etudiant (id INT AUTO_INCREMENT NOT NULL, classe_id_id INT DEFAULT NULL, etudiant_id VARCHAR(255) NOT NULL, etudiant_nom VARCHAR(255) NOT NULL, etudiant_prenom VARCHAR(255) NOT NULL, INDEX IDX_717E22E33633CA6F (classe_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matiere (id INT AUTO_INCREMENT NOT NULL, matiere_id VARCHAR(255) NOT NULL, matiere_nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professeur (id INT AUTO_INCREMENT NOT NULL, professeur_id VARCHAR(255) NOT NULL, professeur_nom VARCHAR(255) NOT NULL, professeur_prenom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9CEE1AF529 FOREIGN KEY (professeur_id_id) REFERENCES enseigner (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9C3633CA6F FOREIGN KEY (classe_id_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9CF3E43022 FOREIGN KEY (matiere_id_id) REFERENCES enseigner (id)');
        $this->addSql('ALTER TABLE enseigner ADD CONSTRAINT FK_663E85CDEE1AF529 FOREIGN KEY (professeur_id_id) REFERENCES professeur (id)');
        $this->addSql('ALTER TABLE enseigner ADD CONSTRAINT FK_663E85CDF3E43022 FOREIGN KEY (matiere_id_id) REFERENCES matiere (id)');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E33633CA6F FOREIGN KEY (classe_id_id) REFERENCES classe (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9CEE1AF529');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9C3633CA6F');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9CF3E43022');
        $this->addSql('ALTER TABLE enseigner DROP FOREIGN KEY FK_663E85CDEE1AF529');
        $this->addSql('ALTER TABLE enseigner DROP FOREIGN KEY FK_663E85CDF3E43022');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E33633CA6F');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE cours');
        $this->addSql('DROP TABLE enseigner');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE matiere');
        $this->addSql('DROP TABLE professeur');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
