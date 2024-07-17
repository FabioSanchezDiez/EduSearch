<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240716190949 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE feedback ADD CONSTRAINT FK_D2294458A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE feedback ADD CONSTRAINT FK_D22944583EB8070A FOREIGN KEY (program_id) REFERENCES program (id)');
        $this->addSql('ALTER TABLE feedback ADD CONSTRAINT FK_D229445823EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id)');
        $this->addSql('ALTER TABLE feedback ADD CONSTRAINT FK_D229445810405986 FOREIGN KEY (institution_id) REFERENCES institution (id)');
        $this->addSql('ALTER TABLE institution_program ADD CONSTRAINT FK_F613811610405986 FOREIGN KEY (institution_id) REFERENCES institution (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE institution_program ADD CONSTRAINT FK_F61381163EB8070A FOREIGN KEY (program_id) REFERENCES program (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE program ADD additional_information VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE program ADD CONSTRAINT FK_92ED7784443707B0 FOREIGN KEY (field_id) REFERENCES field (id)');
        $this->addSql('ALTER TABLE subject_program ADD CONSTRAINT FK_376FDB2623EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subject_program ADD CONSTRAINT FK_376FDB263EB8070A FOREIGN KEY (program_id) REFERENCES program (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6493EB8070A FOREIGN KEY (program_id) REFERENCES program (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE feedback DROP FOREIGN KEY FK_D2294458A76ED395');
        $this->addSql('ALTER TABLE feedback DROP FOREIGN KEY FK_D22944583EB8070A');
        $this->addSql('ALTER TABLE feedback DROP FOREIGN KEY FK_D229445823EDC87');
        $this->addSql('ALTER TABLE feedback DROP FOREIGN KEY FK_D229445810405986');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6493EB8070A');
        $this->addSql('ALTER TABLE subject_program DROP FOREIGN KEY FK_376FDB2623EDC87');
        $this->addSql('ALTER TABLE subject_program DROP FOREIGN KEY FK_376FDB263EB8070A');
        $this->addSql('ALTER TABLE program DROP FOREIGN KEY FK_92ED7784443707B0');
        $this->addSql('ALTER TABLE program DROP additional_information');
        $this->addSql('ALTER TABLE institution_program DROP FOREIGN KEY FK_F613811610405986');
        $this->addSql('ALTER TABLE institution_program DROP FOREIGN KEY FK_F61381163EB8070A');
    }
}
