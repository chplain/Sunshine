<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180527111710 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE sunshine_form_attribute (id INTEGER NOT NULL, type INTEGER DEFAULT NULL, form INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(50) NOT NULL, storage_type VARCHAR(50) NOT NULL, position INTEGER NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, created_by VARCHAR(255) DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FED656E18CDE5729 ON sunshine_form_attribute (type)');
        $this->addSql('CREATE INDEX IDX_FED656E15288FD4F ON sunshine_form_attribute (form)');
        $this->addSql('CREATE TABLE sunshine_form_form (id INTEGER NOT NULL, type INTEGER DEFAULT NULL, owner INTEGER DEFAULT NULL, state INTEGER DEFAULT NULL, name VARCHAR(50) NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, created_by VARCHAR(255) DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_64B09B978CDE5729 ON sunshine_form_form (type)');
        $this->addSql('CREATE INDEX IDX_64B09B97CF60E67C ON sunshine_form_form (owner)');
        $this->addSql('CREATE INDEX IDX_64B09B97A393D2FB ON sunshine_form_form (state)');
        $this->addSql('DROP INDEX IDX_D2ACF2CC998666D1');
        $this->addSql('CREATE TEMPORARY TABLE __temp__sunshine_admin_options AS SELECT id, choice_id, display_name, value, order_number, enabled, enabled_search, type FROM sunshine_admin_options');
        $this->addSql('DROP TABLE sunshine_admin_options');
        $this->addSql('CREATE TABLE sunshine_admin_options (id INTEGER NOT NULL, choice_id INTEGER DEFAULT NULL, display_name VARCHAR(60) NOT NULL COLLATE BINARY, value INTEGER UNSIGNED NOT NULL, order_number INTEGER UNSIGNED NOT NULL, enabled BOOLEAN NOT NULL, enabled_search BOOLEAN NOT NULL, type INTEGER UNSIGNED NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_D2ACF2CC998666D1 FOREIGN KEY (choice_id) REFERENCES sunshine_admin_choice (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO sunshine_admin_options (id, choice_id, display_name, value, order_number, enabled, enabled_search, type) SELECT id, choice_id, display_name, value, order_number, enabled, enabled_search, type FROM __temp__sunshine_admin_options');
        $this->addSql('DROP TABLE __temp__sunshine_admin_options');
        $this->addSql('CREATE INDEX IDX_D2ACF2CC998666D1 ON sunshine_admin_options (choice_id)');
        $this->addSql('DROP INDEX idx_business_unit_enabled');
        $this->addSql('DROP INDEX idx_business_unit_name');
        $this->addSql('DROP INDEX IDX_9390175416F4F95B');
        $this->addSql('DROP INDEX IDX_93901754727ACA70');
        $this->addSql('DROP INDEX IDX_93901754979B1AD6');
        $this->addSql('DROP INDEX UNIQ_93901754B2797DCF');
        $this->addSql('DROP INDEX UNIQ_93901754FA48C76A');
        $this->addSql('DROP INDEX UNIQ_939017549AA369FC');
        $this->addSql('DROP INDEX UNIQ_939017549DDD045B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__sunshine_organization_business_unit AS SELECT id, bu_manager_user_id, pre_manager, bu_admin, document_receiver, company_id, parent_id, root, name, code, order_number, enabled, created_space, description, lft, lvl, rgt, deleted_at, created_at, updated_at, created_by, updated_by FROM sunshine_organization_business_unit');
        $this->addSql('DROP TABLE sunshine_organization_business_unit');
        $this->addSql('CREATE TABLE sunshine_organization_business_unit (id INTEGER NOT NULL, bu_manager_user_id INTEGER DEFAULT NULL, pre_manager INTEGER DEFAULT NULL, bu_admin INTEGER DEFAULT NULL, document_receiver INTEGER DEFAULT NULL, company_id INTEGER DEFAULT NULL, parent_id INTEGER DEFAULT NULL, root INTEGER DEFAULT NULL, name VARCHAR(100) NOT NULL COLLATE BINARY, code VARCHAR(10) DEFAULT NULL COLLATE BINARY, order_number INTEGER UNSIGNED DEFAULT NULL, enabled BOOLEAN DEFAULT NULL, created_space BOOLEAN DEFAULT NULL, description CLOB DEFAULT NULL COLLATE BINARY, lft INTEGER DEFAULT NULL, lvl INTEGER DEFAULT NULL, rgt INTEGER DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, created_by VARCHAR(255) DEFAULT NULL COLLATE BINARY, updated_by VARCHAR(255) DEFAULT NULL COLLATE BINARY, PRIMARY KEY(id), CONSTRAINT FK_939017549DDD045B FOREIGN KEY (bu_manager_user_id) REFERENCES sunshine_organization_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_939017549AA369FC FOREIGN KEY (pre_manager) REFERENCES sunshine_organization_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_93901754FA48C76A FOREIGN KEY (bu_admin) REFERENCES sunshine_organization_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_93901754B2797DCF FOREIGN KEY (document_receiver) REFERENCES sunshine_organization_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_93901754979B1AD6 FOREIGN KEY (company_id) REFERENCES sunshine_organization_company (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_93901754727ACA70 FOREIGN KEY (parent_id) REFERENCES sunshine_organization_business_unit (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9390175416F4F95B FOREIGN KEY (root) REFERENCES sunshine_organization_business_unit (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO sunshine_organization_business_unit (id, bu_manager_user_id, pre_manager, bu_admin, document_receiver, company_id, parent_id, root, name, code, order_number, enabled, created_space, description, lft, lvl, rgt, deleted_at, created_at, updated_at, created_by, updated_by) SELECT id, bu_manager_user_id, pre_manager, bu_admin, document_receiver, company_id, parent_id, root, name, code, order_number, enabled, created_space, description, lft, lvl, rgt, deleted_at, created_at, updated_at, created_by, updated_by FROM __temp__sunshine_organization_business_unit');
        $this->addSql('DROP TABLE __temp__sunshine_organization_business_unit');
        $this->addSql('CREATE INDEX idx_business_unit_enabled ON sunshine_organization_business_unit (enabled)');
        $this->addSql('CREATE INDEX idx_business_unit_name ON sunshine_organization_business_unit (name)');
        $this->addSql('CREATE INDEX IDX_9390175416F4F95B ON sunshine_organization_business_unit (root)');
        $this->addSql('CREATE INDEX IDX_93901754727ACA70 ON sunshine_organization_business_unit (parent_id)');
        $this->addSql('CREATE INDEX IDX_93901754979B1AD6 ON sunshine_organization_business_unit (company_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_93901754B2797DCF ON sunshine_organization_business_unit (document_receiver)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_93901754FA48C76A ON sunshine_organization_business_unit (bu_admin)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_939017549AA369FC ON sunshine_organization_business_unit (pre_manager)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_939017549DDD045B ON sunshine_organization_business_unit (bu_manager_user_id)');
        $this->addSql('DROP INDEX IDX_8D25992C32C8A3DE');
        $this->addSql('DROP INDEX IDX_8D25992CC54C8C93');
        $this->addSql('CREATE TEMPORARY TABLE __temp__sunshine_organization_company AS SELECT id, type_id, organization_id, name, code, order_number, foreign_name, alias_name, legal_person, address, zip_code, phone, fax, website, mail, office_address, description, deleted_at, created_at, updated_at, created_by, updated_by FROM sunshine_organization_company');
        $this->addSql('DROP TABLE sunshine_organization_company');
        $this->addSql('CREATE TABLE sunshine_organization_company (id INTEGER NOT NULL, type_id INTEGER DEFAULT NULL, organization_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, code VARCHAR(10) DEFAULT NULL COLLATE BINARY, order_number INTEGER UNSIGNED DEFAULT NULL, foreign_name VARCHAR(255) DEFAULT NULL COLLATE BINARY, alias_name VARCHAR(20) DEFAULT NULL COLLATE BINARY, legal_person VARCHAR(50) DEFAULT NULL COLLATE BINARY, address VARCHAR(255) DEFAULT NULL COLLATE BINARY, zip_code VARCHAR(20) DEFAULT NULL COLLATE BINARY, phone VARCHAR(30) DEFAULT NULL COLLATE BINARY, fax VARCHAR(30) DEFAULT NULL COLLATE BINARY, website VARCHAR(60) DEFAULT NULL COLLATE BINARY, mail VARCHAR(255) DEFAULT NULL COLLATE BINARY, office_address VARCHAR(255) DEFAULT NULL COLLATE BINARY, description CLOB DEFAULT NULL COLLATE BINARY, deleted_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, created_by VARCHAR(255) DEFAULT NULL COLLATE BINARY, updated_by VARCHAR(255) DEFAULT NULL COLLATE BINARY, PRIMARY KEY(id), CONSTRAINT FK_8D25992CC54C8C93 FOREIGN KEY (type_id) REFERENCES sunshine_admin_options (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_8D25992C32C8A3DE FOREIGN KEY (organization_id) REFERENCES sunshine_organization_organization (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO sunshine_organization_company (id, type_id, organization_id, name, code, order_number, foreign_name, alias_name, legal_person, address, zip_code, phone, fax, website, mail, office_address, description, deleted_at, created_at, updated_at, created_by, updated_by) SELECT id, type_id, organization_id, name, code, order_number, foreign_name, alias_name, legal_person, address, zip_code, phone, fax, website, mail, office_address, description, deleted_at, created_at, updated_at, created_by, updated_by FROM __temp__sunshine_organization_company');
        $this->addSql('DROP TABLE __temp__sunshine_organization_company');
        $this->addSql('CREATE INDEX IDX_8D25992C32C8A3DE ON sunshine_organization_company (organization_id)');
        $this->addSql('CREATE INDEX IDX_8D25992CC54C8C93 ON sunshine_organization_company (type_id)');
        $this->addSql('DROP INDEX UNIQ_AB7407AF75402301');
        $this->addSql('DROP INDEX UNIQ_AB7407AF642B8210');
        $this->addSql('CREATE TEMPORARY TABLE __temp__sunshine_organization_organization AS SELECT id, admin_id, organization_type_options_id, name, foreign_name, alias_name, legal_person, address, zip_code, phone, fax, website, mail, office_address, description, deleted_at, created_at, updated_at, created_by, updated_by FROM sunshine_organization_organization');
        $this->addSql('DROP TABLE sunshine_organization_organization');
        $this->addSql('CREATE TABLE sunshine_organization_organization (id INTEGER NOT NULL, admin_id INTEGER DEFAULT NULL, organization_type_options_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, foreign_name VARCHAR(255) DEFAULT NULL COLLATE BINARY, alias_name VARCHAR(20) DEFAULT NULL COLLATE BINARY, legal_person VARCHAR(50) DEFAULT NULL COLLATE BINARY, address VARCHAR(255) DEFAULT NULL COLLATE BINARY, zip_code VARCHAR(20) DEFAULT NULL COLLATE BINARY, phone VARCHAR(30) DEFAULT NULL COLLATE BINARY, fax VARCHAR(30) DEFAULT NULL COLLATE BINARY, website VARCHAR(60) DEFAULT NULL COLLATE BINARY, mail VARCHAR(255) DEFAULT NULL COLLATE BINARY, office_address VARCHAR(255) DEFAULT NULL COLLATE BINARY, description CLOB DEFAULT NULL COLLATE BINARY, deleted_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, created_by VARCHAR(255) DEFAULT NULL COLLATE BINARY, updated_by VARCHAR(255) DEFAULT NULL COLLATE BINARY, PRIMARY KEY(id), CONSTRAINT FK_AB7407AF642B8210 FOREIGN KEY (admin_id) REFERENCES sunshine_admin_admin (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_AB7407AF75402301 FOREIGN KEY (organization_type_options_id) REFERENCES sunshine_admin_options (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO sunshine_organization_organization (id, admin_id, organization_type_options_id, name, foreign_name, alias_name, legal_person, address, zip_code, phone, fax, website, mail, office_address, description, deleted_at, created_at, updated_at, created_by, updated_by) SELECT id, admin_id, organization_type_options_id, name, foreign_name, alias_name, legal_person, address, zip_code, phone, fax, website, mail, office_address, description, deleted_at, created_at, updated_at, created_by, updated_by FROM __temp__sunshine_organization_organization');
        $this->addSql('DROP TABLE __temp__sunshine_organization_organization');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AB7407AF75402301 ON sunshine_organization_organization (organization_type_options_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AB7407AF642B8210 ON sunshine_organization_organization (admin_id)');
        $this->addSql('DROP INDEX IDX_F6939C0BF7EF7F7D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__sunshine_organization_title AS SELECT id, title_type_options_id, name, code, order_number, enabled, description, deleted_at, created_at, updated_at, created_by, updated_by FROM sunshine_organization_title');
        $this->addSql('DROP TABLE sunshine_organization_title');
        $this->addSql('CREATE TABLE sunshine_organization_title (id INTEGER NOT NULL, title_type_options_id INTEGER DEFAULT NULL, name VARCHAR(50) NOT NULL COLLATE BINARY, code VARCHAR(20) DEFAULT NULL COLLATE BINARY, order_number INTEGER UNSIGNED NOT NULL, enabled BOOLEAN NOT NULL, description CLOB DEFAULT NULL COLLATE BINARY, deleted_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, created_by VARCHAR(255) DEFAULT NULL COLLATE BINARY, updated_by VARCHAR(255) DEFAULT NULL COLLATE BINARY, PRIMARY KEY(id), CONSTRAINT FK_F6939C0BF7EF7F7D FOREIGN KEY (title_type_options_id) REFERENCES sunshine_admin_options (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO sunshine_organization_title (id, title_type_options_id, name, code, order_number, enabled, description, deleted_at, created_at, updated_at, created_by, updated_by) SELECT id, title_type_options_id, name, code, order_number, enabled, description, deleted_at, created_at, updated_at, created_by, updated_by FROM __temp__sunshine_organization_title');
        $this->addSql('DROP TABLE __temp__sunshine_organization_title');
        $this->addSql('CREATE INDEX IDX_F6939C0BF7EF7F7D ON sunshine_organization_title (title_type_options_id)');
        $this->addSql('DROP INDEX UNIQ_250B7F26F199F03E');
        $this->addSql('DROP INDEX UNIQ_250B7F262D4027C1');
        $this->addSql('DROP INDEX IDX_250B7F26F02843D3');
        $this->addSql('DROP INDEX IDX_250B7F261ADCB13C');
        $this->addSql('DROP INDEX IDX_250B7F262B36786B');
        $this->addSql('DROP INDEX IDX_250B7F2630FCDC3A');
        $this->addSql('DROP INDEX IDX_250B7F26D89B899D');
        $this->addSql('DROP INDEX UNIQ_250B7F26E7927C74');
        $this->addSql('DROP INDEX UNIQ_250B7F26444F97DD');
        $this->addSql('CREATE TEMPORARY TABLE __temp__sunshine_organization_user AS SELECT id, user_business_unit_id, user_company_id, title, second_title, service_grade, type_choice_id, gender_choice_id, username, phone, password, email, is_active, real_name, roles, employee_number, order_number, education, birthday, address, description, citizenship, deleted_at, created_at, updated_at, created_by, updated_by FROM sunshine_organization_user');
        $this->addSql('DROP TABLE sunshine_organization_user');
        $this->addSql('CREATE TABLE sunshine_organization_user (id INTEGER NOT NULL, user_business_unit_id INTEGER DEFAULT NULL, user_company_id INTEGER DEFAULT NULL, title INTEGER DEFAULT NULL, second_title INTEGER DEFAULT NULL, service_grade INTEGER DEFAULT NULL, type_choice_id INTEGER DEFAULT NULL, gender_choice_id INTEGER DEFAULT NULL, username VARCHAR(25) NOT NULL COLLATE BINARY, phone VARCHAR(30) NOT NULL COLLATE BINARY, password VARCHAR(64) NOT NULL COLLATE BINARY, email VARCHAR(60) DEFAULT NULL COLLATE BINARY, is_active BOOLEAN NOT NULL, real_name VARCHAR(50) DEFAULT NULL COLLATE BINARY, roles CLOB DEFAULT NULL COLLATE BINARY --(DC2Type:json_array)
        , employee_number VARCHAR(255) DEFAULT NULL COLLATE BINARY, order_number INTEGER UNSIGNED DEFAULT NULL, education VARCHAR(30) DEFAULT NULL COLLATE BINARY, birthday DATE DEFAULT NULL, address VARCHAR(255) DEFAULT NULL COLLATE BINARY, description CLOB DEFAULT NULL COLLATE BINARY, citizenship VARCHAR(10) DEFAULT NULL COLLATE BINARY, deleted_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, created_by VARCHAR(255) DEFAULT NULL COLLATE BINARY, updated_by VARCHAR(255) DEFAULT NULL COLLATE BINARY, PRIMARY KEY(id), CONSTRAINT FK_250B7F26D89B899D FOREIGN KEY (user_business_unit_id) REFERENCES sunshine_organization_business_unit (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_250B7F2630FCDC3A FOREIGN KEY (user_company_id) REFERENCES sunshine_organization_company (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_250B7F262B36786B FOREIGN KEY (title) REFERENCES sunshine_organization_title (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_250B7F261ADCB13C FOREIGN KEY (second_title) REFERENCES sunshine_organization_title (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_250B7F26F02843D3 FOREIGN KEY (service_grade) REFERENCES sunshine_organization_service_grade (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_250B7F262D4027C1 FOREIGN KEY (type_choice_id) REFERENCES sunshine_admin_choice (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_250B7F26F199F03E FOREIGN KEY (gender_choice_id) REFERENCES sunshine_admin_choice (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO sunshine_organization_user (id, user_business_unit_id, user_company_id, title, second_title, service_grade, type_choice_id, gender_choice_id, username, phone, password, email, is_active, real_name, roles, employee_number, order_number, education, birthday, address, description, citizenship, deleted_at, created_at, updated_at, created_by, updated_by) SELECT id, user_business_unit_id, user_company_id, title, second_title, service_grade, type_choice_id, gender_choice_id, username, phone, password, email, is_active, real_name, roles, employee_number, order_number, education, birthday, address, description, citizenship, deleted_at, created_at, updated_at, created_by, updated_by FROM __temp__sunshine_organization_user');
        $this->addSql('DROP TABLE __temp__sunshine_organization_user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_250B7F26F199F03E ON sunshine_organization_user (gender_choice_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_250B7F262D4027C1 ON sunshine_organization_user (type_choice_id)');
        $this->addSql('CREATE INDEX IDX_250B7F26F02843D3 ON sunshine_organization_user (service_grade)');
        $this->addSql('CREATE INDEX IDX_250B7F261ADCB13C ON sunshine_organization_user (second_title)');
        $this->addSql('CREATE INDEX IDX_250B7F262B36786B ON sunshine_organization_user (title)');
        $this->addSql('CREATE INDEX IDX_250B7F2630FCDC3A ON sunshine_organization_user (user_company_id)');
        $this->addSql('CREATE INDEX IDX_250B7F26D89B899D ON sunshine_organization_user (user_business_unit_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_250B7F26E7927C74 ON sunshine_organization_user (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_250B7F26444F97DD ON sunshine_organization_user (phone)');
        $this->addSql('DROP INDEX UNIQ_6E31BA11CF5A1F55');
        $this->addSql('DROP INDEX UNIQ_6E31BA11B5CDEEB3');
        $this->addSql('DROP INDEX UNIQ_6E31BA11AFF355D1');
        $this->addSql('DROP INDEX IDX_6E31BA115A3F32AD');
        $this->addSql('CREATE TEMPORARY TABLE __temp__sunshine_organization_work_group AS SELECT id, group_business_unit_id, group_manager_id, group_type_choice_id, group_authority_choice_id, name, order_num, enabled, deleted_at, created_at, updated_at, created_by, updated_by FROM sunshine_organization_work_group');
        $this->addSql('DROP TABLE sunshine_organization_work_group');
        $this->addSql('CREATE TABLE sunshine_organization_work_group (id INTEGER NOT NULL, group_business_unit_id INTEGER DEFAULT NULL, group_manager_id INTEGER DEFAULT NULL, group_type_choice_id INTEGER DEFAULT NULL, group_authority_choice_id INTEGER DEFAULT NULL, name VARCHAR(50) NOT NULL COLLATE BINARY, order_num INTEGER UNSIGNED NOT NULL, enabled BOOLEAN NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, created_by VARCHAR(255) DEFAULT NULL COLLATE BINARY, updated_by VARCHAR(255) DEFAULT NULL COLLATE BINARY, PRIMARY KEY(id), CONSTRAINT FK_6E31BA115A3F32AD FOREIGN KEY (group_business_unit_id) REFERENCES sunshine_organization_business_unit (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_6E31BA11AFF355D1 FOREIGN KEY (group_manager_id) REFERENCES sunshine_organization_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_6E31BA11B5CDEEB3 FOREIGN KEY (group_type_choice_id) REFERENCES sunshine_admin_choice (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_6E31BA11CF5A1F55 FOREIGN KEY (group_authority_choice_id) REFERENCES sunshine_admin_choice (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO sunshine_organization_work_group (id, group_business_unit_id, group_manager_id, group_type_choice_id, group_authority_choice_id, name, order_num, enabled, deleted_at, created_at, updated_at, created_by, updated_by) SELECT id, group_business_unit_id, group_manager_id, group_type_choice_id, group_authority_choice_id, name, order_num, enabled, deleted_at, created_at, updated_at, created_by, updated_by FROM __temp__sunshine_organization_work_group');
        $this->addSql('DROP TABLE __temp__sunshine_organization_work_group');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6E31BA11CF5A1F55 ON sunshine_organization_work_group (group_authority_choice_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6E31BA11B5CDEEB3 ON sunshine_organization_work_group (group_type_choice_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6E31BA11AFF355D1 ON sunshine_organization_work_group (group_manager_id)');
        $this->addSql('CREATE INDEX IDX_6E31BA115A3F32AD ON sunshine_organization_work_group (group_business_unit_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE sunshine_form_attribute');
        $this->addSql('DROP TABLE sunshine_form_form');
        $this->addSql('DROP INDEX IDX_D2ACF2CC998666D1');
        $this->addSql('CREATE TEMPORARY TABLE __temp__sunshine_admin_options AS SELECT id, choice_id, display_name, value, order_number, enabled, enabled_search, type FROM sunshine_admin_options');
        $this->addSql('DROP TABLE sunshine_admin_options');
        $this->addSql('CREATE TABLE sunshine_admin_options (id INTEGER NOT NULL, choice_id INTEGER DEFAULT NULL, display_name VARCHAR(60) NOT NULL, value INTEGER UNSIGNED NOT NULL, order_number INTEGER UNSIGNED NOT NULL, enabled BOOLEAN NOT NULL, enabled_search BOOLEAN NOT NULL, type INTEGER UNSIGNED NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO sunshine_admin_options (id, choice_id, display_name, value, order_number, enabled, enabled_search, type) SELECT id, choice_id, display_name, value, order_number, enabled, enabled_search, type FROM __temp__sunshine_admin_options');
        $this->addSql('DROP TABLE __temp__sunshine_admin_options');
        $this->addSql('CREATE INDEX IDX_D2ACF2CC998666D1 ON sunshine_admin_options (choice_id)');
        $this->addSql('DROP INDEX UNIQ_939017549DDD045B');
        $this->addSql('DROP INDEX UNIQ_939017549AA369FC');
        $this->addSql('DROP INDEX UNIQ_93901754FA48C76A');
        $this->addSql('DROP INDEX UNIQ_93901754B2797DCF');
        $this->addSql('DROP INDEX IDX_93901754979B1AD6');
        $this->addSql('DROP INDEX IDX_93901754727ACA70');
        $this->addSql('DROP INDEX IDX_9390175416F4F95B');
        $this->addSql('DROP INDEX idx_business_unit_name');
        $this->addSql('DROP INDEX idx_business_unit_enabled');
        $this->addSql('CREATE TEMPORARY TABLE __temp__sunshine_organization_business_unit AS SELECT id, bu_manager_user_id, pre_manager, bu_admin, document_receiver, company_id, parent_id, root, name, code, order_number, enabled, created_space, description, lft, lvl, rgt, deleted_at, created_at, updated_at, created_by, updated_by FROM sunshine_organization_business_unit');
        $this->addSql('DROP TABLE sunshine_organization_business_unit');
        $this->addSql('CREATE TABLE sunshine_organization_business_unit (id INTEGER NOT NULL, bu_manager_user_id INTEGER DEFAULT NULL, pre_manager INTEGER DEFAULT NULL, bu_admin INTEGER DEFAULT NULL, document_receiver INTEGER DEFAULT NULL, company_id INTEGER DEFAULT NULL, parent_id INTEGER DEFAULT NULL, root INTEGER DEFAULT NULL, name VARCHAR(100) NOT NULL, code VARCHAR(10) DEFAULT NULL, order_number INTEGER UNSIGNED DEFAULT NULL, enabled BOOLEAN DEFAULT NULL, created_space BOOLEAN DEFAULT NULL, description CLOB DEFAULT NULL, lft INTEGER DEFAULT NULL, lvl INTEGER DEFAULT NULL, rgt INTEGER DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, created_by VARCHAR(255) DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO sunshine_organization_business_unit (id, bu_manager_user_id, pre_manager, bu_admin, document_receiver, company_id, parent_id, root, name, code, order_number, enabled, created_space, description, lft, lvl, rgt, deleted_at, created_at, updated_at, created_by, updated_by) SELECT id, bu_manager_user_id, pre_manager, bu_admin, document_receiver, company_id, parent_id, root, name, code, order_number, enabled, created_space, description, lft, lvl, rgt, deleted_at, created_at, updated_at, created_by, updated_by FROM __temp__sunshine_organization_business_unit');
        $this->addSql('DROP TABLE __temp__sunshine_organization_business_unit');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_939017549DDD045B ON sunshine_organization_business_unit (bu_manager_user_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_939017549AA369FC ON sunshine_organization_business_unit (pre_manager)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_93901754FA48C76A ON sunshine_organization_business_unit (bu_admin)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_93901754B2797DCF ON sunshine_organization_business_unit (document_receiver)');
        $this->addSql('CREATE INDEX IDX_93901754979B1AD6 ON sunshine_organization_business_unit (company_id)');
        $this->addSql('CREATE INDEX IDX_93901754727ACA70 ON sunshine_organization_business_unit (parent_id)');
        $this->addSql('CREATE INDEX IDX_9390175416F4F95B ON sunshine_organization_business_unit (root)');
        $this->addSql('CREATE INDEX idx_business_unit_name ON sunshine_organization_business_unit (name)');
        $this->addSql('CREATE INDEX idx_business_unit_enabled ON sunshine_organization_business_unit (enabled)');
        $this->addSql('DROP INDEX IDX_8D25992CC54C8C93');
        $this->addSql('DROP INDEX IDX_8D25992C32C8A3DE');
        $this->addSql('CREATE TEMPORARY TABLE __temp__sunshine_organization_company AS SELECT id, type_id, organization_id, name, code, order_number, foreign_name, alias_name, legal_person, address, zip_code, phone, fax, website, mail, office_address, description, deleted_at, created_at, updated_at, created_by, updated_by FROM sunshine_organization_company');
        $this->addSql('DROP TABLE sunshine_organization_company');
        $this->addSql('CREATE TABLE sunshine_organization_company (id INTEGER NOT NULL, type_id INTEGER DEFAULT NULL, organization_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(10) DEFAULT NULL, order_number INTEGER UNSIGNED DEFAULT NULL, foreign_name VARCHAR(255) DEFAULT NULL, alias_name VARCHAR(20) DEFAULT NULL, legal_person VARCHAR(50) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, zip_code VARCHAR(20) DEFAULT NULL, phone VARCHAR(30) DEFAULT NULL, fax VARCHAR(30) DEFAULT NULL, website VARCHAR(60) DEFAULT NULL, mail VARCHAR(255) DEFAULT NULL, office_address VARCHAR(255) DEFAULT NULL, description CLOB DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, created_by VARCHAR(255) DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO sunshine_organization_company (id, type_id, organization_id, name, code, order_number, foreign_name, alias_name, legal_person, address, zip_code, phone, fax, website, mail, office_address, description, deleted_at, created_at, updated_at, created_by, updated_by) SELECT id, type_id, organization_id, name, code, order_number, foreign_name, alias_name, legal_person, address, zip_code, phone, fax, website, mail, office_address, description, deleted_at, created_at, updated_at, created_by, updated_by FROM __temp__sunshine_organization_company');
        $this->addSql('DROP TABLE __temp__sunshine_organization_company');
        $this->addSql('CREATE INDEX IDX_8D25992CC54C8C93 ON sunshine_organization_company (type_id)');
        $this->addSql('CREATE INDEX IDX_8D25992C32C8A3DE ON sunshine_organization_company (organization_id)');
        $this->addSql('DROP INDEX UNIQ_AB7407AF642B8210');
        $this->addSql('DROP INDEX UNIQ_AB7407AF75402301');
        $this->addSql('CREATE TEMPORARY TABLE __temp__sunshine_organization_organization AS SELECT id, admin_id, organization_type_options_id, name, foreign_name, alias_name, legal_person, address, zip_code, phone, fax, website, mail, office_address, description, deleted_at, created_at, updated_at, created_by, updated_by FROM sunshine_organization_organization');
        $this->addSql('DROP TABLE sunshine_organization_organization');
        $this->addSql('CREATE TABLE sunshine_organization_organization (id INTEGER NOT NULL, admin_id INTEGER DEFAULT NULL, organization_type_options_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, foreign_name VARCHAR(255) DEFAULT NULL, alias_name VARCHAR(20) DEFAULT NULL, legal_person VARCHAR(50) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, zip_code VARCHAR(20) DEFAULT NULL, phone VARCHAR(30) DEFAULT NULL, fax VARCHAR(30) DEFAULT NULL, website VARCHAR(60) DEFAULT NULL, mail VARCHAR(255) DEFAULT NULL, office_address VARCHAR(255) DEFAULT NULL, description CLOB DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, created_by VARCHAR(255) DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO sunshine_organization_organization (id, admin_id, organization_type_options_id, name, foreign_name, alias_name, legal_person, address, zip_code, phone, fax, website, mail, office_address, description, deleted_at, created_at, updated_at, created_by, updated_by) SELECT id, admin_id, organization_type_options_id, name, foreign_name, alias_name, legal_person, address, zip_code, phone, fax, website, mail, office_address, description, deleted_at, created_at, updated_at, created_by, updated_by FROM __temp__sunshine_organization_organization');
        $this->addSql('DROP TABLE __temp__sunshine_organization_organization');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AB7407AF642B8210 ON sunshine_organization_organization (admin_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AB7407AF75402301 ON sunshine_organization_organization (organization_type_options_id)');
        $this->addSql('DROP INDEX IDX_F6939C0BF7EF7F7D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__sunshine_organization_title AS SELECT id, title_type_options_id, name, code, order_number, enabled, description, deleted_at, created_at, updated_at, created_by, updated_by FROM sunshine_organization_title');
        $this->addSql('DROP TABLE sunshine_organization_title');
        $this->addSql('CREATE TABLE sunshine_organization_title (id INTEGER NOT NULL, title_type_options_id INTEGER DEFAULT NULL, name VARCHAR(50) NOT NULL, code VARCHAR(20) DEFAULT NULL, order_number INTEGER UNSIGNED NOT NULL, enabled BOOLEAN NOT NULL, description CLOB DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, created_by VARCHAR(255) DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO sunshine_organization_title (id, title_type_options_id, name, code, order_number, enabled, description, deleted_at, created_at, updated_at, created_by, updated_by) SELECT id, title_type_options_id, name, code, order_number, enabled, description, deleted_at, created_at, updated_at, created_by, updated_by FROM __temp__sunshine_organization_title');
        $this->addSql('DROP TABLE __temp__sunshine_organization_title');
        $this->addSql('CREATE INDEX IDX_F6939C0BF7EF7F7D ON sunshine_organization_title (title_type_options_id)');
        $this->addSql('DROP INDEX UNIQ_250B7F26444F97DD');
        $this->addSql('DROP INDEX UNIQ_250B7F26E7927C74');
        $this->addSql('DROP INDEX IDX_250B7F26D89B899D');
        $this->addSql('DROP INDEX IDX_250B7F2630FCDC3A');
        $this->addSql('DROP INDEX IDX_250B7F262B36786B');
        $this->addSql('DROP INDEX IDX_250B7F261ADCB13C');
        $this->addSql('DROP INDEX IDX_250B7F26F02843D3');
        $this->addSql('DROP INDEX UNIQ_250B7F262D4027C1');
        $this->addSql('DROP INDEX UNIQ_250B7F26F199F03E');
        $this->addSql('CREATE TEMPORARY TABLE __temp__sunshine_organization_user AS SELECT id, user_business_unit_id, user_company_id, title, second_title, service_grade, type_choice_id, gender_choice_id, username, phone, password, email, is_active, real_name, roles, employee_number, order_number, education, birthday, address, description, citizenship, deleted_at, created_at, updated_at, created_by, updated_by FROM sunshine_organization_user');
        $this->addSql('DROP TABLE sunshine_organization_user');
        $this->addSql('CREATE TABLE sunshine_organization_user (id INTEGER NOT NULL, user_business_unit_id INTEGER DEFAULT NULL, user_company_id INTEGER DEFAULT NULL, title INTEGER DEFAULT NULL, second_title INTEGER DEFAULT NULL, service_grade INTEGER DEFAULT NULL, type_choice_id INTEGER DEFAULT NULL, gender_choice_id INTEGER DEFAULT NULL, username VARCHAR(25) NOT NULL, phone VARCHAR(30) NOT NULL, password VARCHAR(64) NOT NULL, email VARCHAR(60) DEFAULT NULL, is_active BOOLEAN NOT NULL, real_name VARCHAR(50) DEFAULT NULL, roles CLOB DEFAULT NULL --(DC2Type:json_array)
        , employee_number VARCHAR(255) DEFAULT NULL, order_number INTEGER UNSIGNED DEFAULT NULL, education VARCHAR(30) DEFAULT NULL, birthday DATE DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, description CLOB DEFAULT NULL, citizenship VARCHAR(10) DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, created_by VARCHAR(255) DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO sunshine_organization_user (id, user_business_unit_id, user_company_id, title, second_title, service_grade, type_choice_id, gender_choice_id, username, phone, password, email, is_active, real_name, roles, employee_number, order_number, education, birthday, address, description, citizenship, deleted_at, created_at, updated_at, created_by, updated_by) SELECT id, user_business_unit_id, user_company_id, title, second_title, service_grade, type_choice_id, gender_choice_id, username, phone, password, email, is_active, real_name, roles, employee_number, order_number, education, birthday, address, description, citizenship, deleted_at, created_at, updated_at, created_by, updated_by FROM __temp__sunshine_organization_user');
        $this->addSql('DROP TABLE __temp__sunshine_organization_user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_250B7F26444F97DD ON sunshine_organization_user (phone)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_250B7F26E7927C74 ON sunshine_organization_user (email)');
        $this->addSql('CREATE INDEX IDX_250B7F26D89B899D ON sunshine_organization_user (user_business_unit_id)');
        $this->addSql('CREATE INDEX IDX_250B7F2630FCDC3A ON sunshine_organization_user (user_company_id)');
        $this->addSql('CREATE INDEX IDX_250B7F262B36786B ON sunshine_organization_user (title)');
        $this->addSql('CREATE INDEX IDX_250B7F261ADCB13C ON sunshine_organization_user (second_title)');
        $this->addSql('CREATE INDEX IDX_250B7F26F02843D3 ON sunshine_organization_user (service_grade)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_250B7F262D4027C1 ON sunshine_organization_user (type_choice_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_250B7F26F199F03E ON sunshine_organization_user (gender_choice_id)');
        $this->addSql('DROP INDEX IDX_6E31BA115A3F32AD');
        $this->addSql('DROP INDEX UNIQ_6E31BA11AFF355D1');
        $this->addSql('DROP INDEX UNIQ_6E31BA11B5CDEEB3');
        $this->addSql('DROP INDEX UNIQ_6E31BA11CF5A1F55');
        $this->addSql('CREATE TEMPORARY TABLE __temp__sunshine_organization_work_group AS SELECT id, group_business_unit_id, group_manager_id, group_type_choice_id, group_authority_choice_id, name, order_num, enabled, deleted_at, created_at, updated_at, created_by, updated_by FROM sunshine_organization_work_group');
        $this->addSql('DROP TABLE sunshine_organization_work_group');
        $this->addSql('CREATE TABLE sunshine_organization_work_group (id INTEGER NOT NULL, group_business_unit_id INTEGER DEFAULT NULL, group_manager_id INTEGER DEFAULT NULL, group_type_choice_id INTEGER DEFAULT NULL, group_authority_choice_id INTEGER DEFAULT NULL, name VARCHAR(50) NOT NULL, order_num INTEGER UNSIGNED NOT NULL, enabled BOOLEAN NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, created_by VARCHAR(255) DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO sunshine_organization_work_group (id, group_business_unit_id, group_manager_id, group_type_choice_id, group_authority_choice_id, name, order_num, enabled, deleted_at, created_at, updated_at, created_by, updated_by) SELECT id, group_business_unit_id, group_manager_id, group_type_choice_id, group_authority_choice_id, name, order_num, enabled, deleted_at, created_at, updated_at, created_by, updated_by FROM __temp__sunshine_organization_work_group');
        $this->addSql('DROP TABLE __temp__sunshine_organization_work_group');
        $this->addSql('CREATE INDEX IDX_6E31BA115A3F32AD ON sunshine_organization_work_group (group_business_unit_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6E31BA11AFF355D1 ON sunshine_organization_work_group (group_manager_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6E31BA11B5CDEEB3 ON sunshine_organization_work_group (group_type_choice_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6E31BA11CF5A1F55 ON sunshine_organization_work_group (group_authority_choice_id)');
    }
}
