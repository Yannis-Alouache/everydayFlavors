<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240120212506 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ingredient (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, quantity INT NOT NULL, unit VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient_recipe (ingredient_id INT NOT NULL, recipe_id INT NOT NULL, INDEX IDX_36F27176933FE08C (ingredient_id), INDEX IDX_36F2717659D8A214 (recipe_id), PRIMARY KEY(ingredient_id, recipe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipe (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, method LONGTEXT NOT NULL, INDEX IDX_DA88B137F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tool (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tool_recipe (tool_id INT NOT NULL, recipe_id INT NOT NULL, INDEX IDX_BFD9BD2B8F7B22CC (tool_id), INDEX IDX_BFD9BD2B59D8A214 (recipe_id), PRIMARY KEY(tool_id, recipe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ingredient_recipe ADD CONSTRAINT FK_36F27176933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredient_recipe ADD CONSTRAINT FK_36F2717659D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B137F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tool_recipe ADD CONSTRAINT FK_BFD9BD2B8F7B22CC FOREIGN KEY (tool_id) REFERENCES tool (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tool_recipe ADD CONSTRAINT FK_BFD9BD2B59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredient_recipe DROP FOREIGN KEY FK_36F27176933FE08C');
        $this->addSql('ALTER TABLE ingredient_recipe DROP FOREIGN KEY FK_36F2717659D8A214');
        $this->addSql('ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B137F675F31B');
        $this->addSql('ALTER TABLE tool_recipe DROP FOREIGN KEY FK_BFD9BD2B8F7B22CC');
        $this->addSql('ALTER TABLE tool_recipe DROP FOREIGN KEY FK_BFD9BD2B59D8A214');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE ingredient_recipe');
        $this->addSql('DROP TABLE recipe');
        $this->addSql('DROP TABLE tool');
        $this->addSql('DROP TABLE tool_recipe');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
