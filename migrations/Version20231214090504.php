<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231214090504 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tool (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tool_recipe (tool_id INT NOT NULL, recipe_id INT NOT NULL, INDEX IDX_BFD9BD2B8F7B22CC (tool_id), INDEX IDX_BFD9BD2B59D8A214 (recipe_id), PRIMARY KEY(tool_id, recipe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tool_recipe ADD CONSTRAINT FK_BFD9BD2B8F7B22CC FOREIGN KEY (tool_id) REFERENCES tool (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tool_recipe ADD CONSTRAINT FK_BFD9BD2B59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipe ADD name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tool_recipe DROP FOREIGN KEY FK_BFD9BD2B8F7B22CC');
        $this->addSql('ALTER TABLE tool_recipe DROP FOREIGN KEY FK_BFD9BD2B59D8A214');
        $this->addSql('DROP TABLE tool');
        $this->addSql('DROP TABLE tool_recipe');
        $this->addSql('ALTER TABLE recipe DROP name');
    }
}
