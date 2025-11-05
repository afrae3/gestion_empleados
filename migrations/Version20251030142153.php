<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251030142153 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer_discount (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, percentage NUMERIC(5, 2) NOT NULL, active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employee (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employee_contract (id INT AUTO_INCREMENT NOT NULL, employee_id INT NOT NULL, contract_type VARCHAR(255) NOT NULL, start_date DATE NOT NULL, end_date DATE DEFAULT NULL, INDEX IDX_79B0799E8C03F15C (employee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employee_vacation (id INT AUTO_INCREMENT NOT NULL, employee_id INT NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, reason VARCHAR(255) DEFAULT NULL, INDEX IDX_73E58EB28C03F15C (employee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sale_invoice (id INT AUTO_INCREMENT NOT NULL, invoice_number VARCHAR(255) NOT NULL, invoice_date DATE NOT NULL, total_amount NUMERIC(10, 2) NOT NULL, paid TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sale_invoice_customer_discount (sale_invoice_id INT NOT NULL, customer_discount_id INT NOT NULL, INDEX IDX_8B0F7F27D4DD15B9 (sale_invoice_id), INDEX IDX_8B0F7F274F374A17 (customer_discount_id), PRIMARY KEY(sale_invoice_id, customer_discount_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE supplier (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE employee_contract ADD CONSTRAINT FK_79B0799E8C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id)');
        $this->addSql('ALTER TABLE employee_vacation ADD CONSTRAINT FK_73E58EB28C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id)');
        $this->addSql('ALTER TABLE sale_invoice_customer_discount ADD CONSTRAINT FK_8B0F7F27D4DD15B9 FOREIGN KEY (sale_invoice_id) REFERENCES sale_invoice (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sale_invoice_customer_discount ADD CONSTRAINT FK_8B0F7F274F374A17 FOREIGN KEY (customer_discount_id) REFERENCES customer_discount (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employee_contract DROP FOREIGN KEY FK_79B0799E8C03F15C');
        $this->addSql('ALTER TABLE employee_vacation DROP FOREIGN KEY FK_73E58EB28C03F15C');
        $this->addSql('ALTER TABLE sale_invoice_customer_discount DROP FOREIGN KEY FK_8B0F7F27D4DD15B9');
        $this->addSql('ALTER TABLE sale_invoice_customer_discount DROP FOREIGN KEY FK_8B0F7F274F374A17');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE customer_discount');
        $this->addSql('DROP TABLE employee');
        $this->addSql('DROP TABLE employee_contract');
        $this->addSql('DROP TABLE employee_vacation');
        $this->addSql('DROP TABLE sale_invoice');
        $this->addSql('DROP TABLE sale_invoice_customer_discount');
        $this->addSql('DROP TABLE supplier');
    }
}
