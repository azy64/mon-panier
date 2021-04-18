<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210418094643 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, libele VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE couleurs (id INT AUTO_INCREMENT NOT NULL, codecouleur INT NOT NULL, libele VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genres (id INT AUTO_INCREMENT NOT NULL, libele VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paniers (id INT AUTO_INCREMENT NOT NULL, variant_id INT NOT NULL, taille_id INT NOT NULL, couleur_id INT NOT NULL, id_client VARCHAR(255) NOT NULL, date_livraison DATETIME NOT NULL, quantity INT NOT NULL, INDEX IDX_489990363B69A9AF (variant_id), INDEX IDX_48999036FF25611A (taille_id), INDEX IDX_48999036C31BA576 (couleur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produits (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, categorie_id INT NOT NULL, genre_id INT NOT NULL, nom VARCHAR(255) NOT NULL, marque VARCHAR(255) NOT NULL, reference VARCHAR(9) NOT NULL, INDEX IDX_BE2DDF8CC54C8C93 (type_id), INDEX IDX_BE2DDF8CBCF5E72D (categorie_id), INDEX IDX_BE2DDF8C4296D31F (genre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stocks (id INT AUTO_INCREMENT NOT NULL, variant_id INT NOT NULL, quantite INT NOT NULL, UNIQUE INDEX UNIQ_56F798053B69A9AF (variant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tailles (id INT AUTO_INCREMENT NOT NULL, libele VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_produits (id INT AUTO_INCREMENT NOT NULL, libele VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE variants (id INT AUTO_INCREMENT NOT NULL, produit_id INT NOT NULL, couleur_id INT NOT NULL, prix DOUBLE PRECISION NOT NULL, photo LONGTEXT NOT NULL, INDEX IDX_B39853E1F347EFB (produit_id), INDEX IDX_B39853E1C31BA576 (couleur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE variants_tailles (variants_id INT NOT NULL, tailles_id INT NOT NULL, INDEX IDX_BC27F65CA1236AF5 (variants_id), INDEX IDX_BC27F65C1AEC613E (tailles_id), PRIMARY KEY(variants_id, tailles_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE paniers ADD CONSTRAINT FK_489990363B69A9AF FOREIGN KEY (variant_id) REFERENCES variants (id)');
        $this->addSql('ALTER TABLE paniers ADD CONSTRAINT FK_48999036FF25611A FOREIGN KEY (taille_id) REFERENCES tailles (id)');
        $this->addSql('ALTER TABLE paniers ADD CONSTRAINT FK_48999036C31BA576 FOREIGN KEY (couleur_id) REFERENCES couleurs (id)');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8CC54C8C93 FOREIGN KEY (type_id) REFERENCES type_produits (id)');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8CBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8C4296D31F FOREIGN KEY (genre_id) REFERENCES genres (id)');
        $this->addSql('ALTER TABLE stocks ADD CONSTRAINT FK_56F798053B69A9AF FOREIGN KEY (variant_id) REFERENCES variants (id)');
        $this->addSql('ALTER TABLE variants ADD CONSTRAINT FK_B39853E1F347EFB FOREIGN KEY (produit_id) REFERENCES produits (id)');
        $this->addSql('ALTER TABLE variants ADD CONSTRAINT FK_B39853E1C31BA576 FOREIGN KEY (couleur_id) REFERENCES couleurs (id)');
        $this->addSql('ALTER TABLE variants_tailles ADD CONSTRAINT FK_BC27F65CA1236AF5 FOREIGN KEY (variants_id) REFERENCES variants (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE variants_tailles ADD CONSTRAINT FK_BC27F65C1AEC613E FOREIGN KEY (tailles_id) REFERENCES tailles (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8CBCF5E72D');
        $this->addSql('ALTER TABLE paniers DROP FOREIGN KEY FK_48999036C31BA576');
        $this->addSql('ALTER TABLE variants DROP FOREIGN KEY FK_B39853E1C31BA576');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8C4296D31F');
        $this->addSql('ALTER TABLE variants DROP FOREIGN KEY FK_B39853E1F347EFB');
        $this->addSql('ALTER TABLE paniers DROP FOREIGN KEY FK_48999036FF25611A');
        $this->addSql('ALTER TABLE variants_tailles DROP FOREIGN KEY FK_BC27F65C1AEC613E');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8CC54C8C93');
        $this->addSql('ALTER TABLE paniers DROP FOREIGN KEY FK_489990363B69A9AF');
        $this->addSql('ALTER TABLE stocks DROP FOREIGN KEY FK_56F798053B69A9AF');
        $this->addSql('ALTER TABLE variants_tailles DROP FOREIGN KEY FK_BC27F65CA1236AF5');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE couleurs');
        $this->addSql('DROP TABLE genres');
        $this->addSql('DROP TABLE paniers');
        $this->addSql('DROP TABLE produits');
        $this->addSql('DROP TABLE stocks');
        $this->addSql('DROP TABLE tailles');
        $this->addSql('DROP TABLE type_produits');
        $this->addSql('DROP TABLE variants');
        $this->addSql('DROP TABLE variants_tailles');
    }
}
