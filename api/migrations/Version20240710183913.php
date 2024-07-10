<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240710183913 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE feedback (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, program_id INT DEFAULT NULL, subject_id INT DEFAULT NULL, institution_id INT DEFAULT NULL, feedback VARCHAR(255) NOT NULL, rating INT NOT NULL, INDEX IDX_D2294458A76ED395 (user_id), INDEX IDX_D22944583EB8070A (program_id), INDEX IDX_D229445823EDC87 (subject_id), INDEX IDX_D229445810405986 (institution_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE institution (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, last_update DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE institution_program (institution_id INT NOT NULL, program_id INT NOT NULL, INDEX IDX_F613811610405986 (institution_id), INDEX IDX_F61381163EB8070A (program_id), PRIMARY KEY(institution_id, program_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subject (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subject_program (subject_id INT NOT NULL, program_id INT NOT NULL, INDEX IDX_376FDB2623EDC87 (subject_id), INDEX IDX_376FDB263EB8070A (program_id), PRIMARY KEY(subject_id, program_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE feedback ADD CONSTRAINT FK_D2294458A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE feedback ADD CONSTRAINT FK_D22944583EB8070A FOREIGN KEY (program_id) REFERENCES program (id)');
        $this->addSql('ALTER TABLE feedback ADD CONSTRAINT FK_D229445823EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id)');
        $this->addSql('ALTER TABLE feedback ADD CONSTRAINT FK_D229445810405986 FOREIGN KEY (institution_id) REFERENCES institution (id)');
        $this->addSql('ALTER TABLE institution_program ADD CONSTRAINT FK_F613811610405986 FOREIGN KEY (institution_id) REFERENCES institution (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE institution_program ADD CONSTRAINT FK_F61381163EB8070A FOREIGN KEY (program_id) REFERENCES program (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subject_program ADD CONSTRAINT FK_376FDB2623EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subject_program ADD CONSTRAINT FK_376FDB263EB8070A FOREIGN KEY (program_id) REFERENCES program (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD program_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6493EB8070A FOREIGN KEY (program_id) REFERENCES program (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6493EB8070A ON user (program_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE feedback DROP FOREIGN KEY FK_D2294458A76ED395');
        $this->addSql('ALTER TABLE feedback DROP FOREIGN KEY FK_D22944583EB8070A');
        $this->addSql('ALTER TABLE feedback DROP FOREIGN KEY FK_D229445823EDC87');
        $this->addSql('ALTER TABLE feedback DROP FOREIGN KEY FK_D229445810405986');
        $this->addSql('ALTER TABLE institution_program DROP FOREIGN KEY FK_F613811610405986');
        $this->addSql('ALTER TABLE institution_program DROP FOREIGN KEY FK_F61381163EB8070A');
        $this->addSql('ALTER TABLE subject_program DROP FOREIGN KEY FK_376FDB2623EDC87');
        $this->addSql('ALTER TABLE subject_program DROP FOREIGN KEY FK_376FDB263EB8070A');
        $this->addSql('DROP TABLE feedback');
        $this->addSql('DROP TABLE institution');
        $this->addSql('DROP TABLE institution_program');
        $this->addSql('DROP TABLE subject');
        $this->addSql('DROP TABLE subject_program');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6493EB8070A');
        $this->addSql('DROP INDEX IDX_8D93D6493EB8070A ON user');
        $this->addSql('ALTER TABLE user DROP program_id');
    }
}
