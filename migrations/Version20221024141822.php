<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221024141822 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F52E93BA0');
        $this->addSql('DROP INDEX IDX_C53D045F52E93BA0 ON image');
        $this->addSql('ALTER TABLE image CHANGE voiture_id_id voiture_id INT NOT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F181A8BA FOREIGN KEY (voiture_id) REFERENCES voitures (id)');
        $this->addSql('CREATE INDEX IDX_C53D045F181A8BA ON image (voiture_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F181A8BA');
        $this->addSql('DROP INDEX IDX_C53D045F181A8BA ON image');
        $this->addSql('ALTER TABLE image CHANGE voiture_id voiture_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F52E93BA0 FOREIGN KEY (voiture_id_id) REFERENCES voitures (id)');
        $this->addSql('CREATE INDEX IDX_C53D045F52E93BA0 ON image (voiture_id_id)');
    }
}
