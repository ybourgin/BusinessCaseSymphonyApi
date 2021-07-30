<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210730083432 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annonce (id INT AUTO_INCREMENT NOT NULL, modele_id INT NOT NULL, carburant_id INT NOT NULL, garage_id INT NOT NULL, reference INT NOT NULL, titre VARCHAR(255) NOT NULL, kilometrage INT NOT NULL, prix NUMERIC(9, 2) NOT NULL, annee INT NOT NULL, description LONGTEXT DEFAULT NULL, date_creation DATE NOT NULL, est_manuelle TINYINT(1) DEFAULT NULL, INDEX IDX_F65593E5AC14B70A (modele_id), INDEX IDX_F65593E532DAAD24 (carburant_id), INDEX IDX_F65593E5C4FFF555 (garage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE annonce_categorie_voiture (annonce_id INT NOT NULL, categorie_voiture_id INT NOT NULL, INDEX IDX_F1F834FD8805AB2F (annonce_id), INDEX IDX_F1F834FD9F486216 (categorie_voiture_id), PRIMARY KEY(annonce_id, categorie_voiture_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carburant (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_voiture (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE garage (id INT AUTO_INCREMENT NOT NULL, professionnel_id INT NOT NULL, nom VARCHAR(255) NOT NULL, telephone VARCHAR(10) NOT NULL, siret VARCHAR(14) NOT NULL, adresse_ligne1 VARCHAR(50) NOT NULL, adresse_ligne2 VARCHAR(50) DEFAULT NULL, adresse_ligne3 VARCHAR(50) DEFAULT NULL, ville VARCHAR(50) NOT NULL, code_postal VARCHAR(50) NOT NULL, INDEX IDX_9F26610B8A49CC82 (professionnel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, annonce_id INT DEFAULT NULL, libelle VARCHAR(50) DEFAULT NULL, path VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, taille DOUBLE PRECISION NOT NULL, type VARCHAR(50) NOT NULL, INDEX IDX_C53D045F8805AB2F (annonce_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marque (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE modele (id INT AUTO_INCREMENT NOT NULL, marque_id INT NOT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_100285584827B9B2 (marque_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professionnel (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, adresse_mail VARCHAR(50) NOT NULL, telephone VARCHAR(10) NOT NULL, siren VARCHAR(14) NOT NULL, garages VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_7A28C10FAA08CB10 (login), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5AC14B70A FOREIGN KEY (modele_id) REFERENCES modele (id)');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E532DAAD24 FOREIGN KEY (carburant_id) REFERENCES carburant (id)');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5C4FFF555 FOREIGN KEY (garage_id) REFERENCES garage (id)');
        $this->addSql('ALTER TABLE annonce_categorie_voiture ADD CONSTRAINT FK_F1F834FD8805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE annonce_categorie_voiture ADD CONSTRAINT FK_F1F834FD9F486216 FOREIGN KEY (categorie_voiture_id) REFERENCES categorie_voiture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE garage ADD CONSTRAINT FK_9F26610B8A49CC82 FOREIGN KEY (professionnel_id) REFERENCES professionnel (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F8805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id)');
        $this->addSql('ALTER TABLE modele ADD CONSTRAINT FK_100285584827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce_categorie_voiture DROP FOREIGN KEY FK_F1F834FD8805AB2F');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F8805AB2F');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E532DAAD24');
        $this->addSql('ALTER TABLE annonce_categorie_voiture DROP FOREIGN KEY FK_F1F834FD9F486216');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5C4FFF555');
        $this->addSql('ALTER TABLE modele DROP FOREIGN KEY FK_100285584827B9B2');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5AC14B70A');
        $this->addSql('ALTER TABLE garage DROP FOREIGN KEY FK_9F26610B8A49CC82');
        $this->addSql('DROP TABLE annonce');
        $this->addSql('DROP TABLE annonce_categorie_voiture');
        $this->addSql('DROP TABLE carburant');
        $this->addSql('DROP TABLE categorie_voiture');
        $this->addSql('DROP TABLE garage');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE marque');
        $this->addSql('DROP TABLE modele');
        $this->addSql('DROP TABLE professionnel');
    }
}
