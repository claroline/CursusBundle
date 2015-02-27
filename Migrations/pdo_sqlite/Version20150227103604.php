<?php

namespace Claroline\CursusBundle\Migrations\pdo_sqlite;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/02/27 10:36:06
 */
class Version20150227103604 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE claro_cursusbundle_course (
                id INTEGER NOT NULL, 
                workspace_model_id INTEGER DEFAULT NULL, 
                code VARCHAR(255) NOT NULL, 
                title VARCHAR(255) NOT NULL, 
                description CLOB DEFAULT NULL, 
                public_registration BOOLEAN NOT NULL, 
                public_unregistration BOOLEAN NOT NULL, 
                registration_validation BOOLEAN NOT NULL, 
                tutor_role_name VARCHAR(255) DEFAULT NULL, 
                learner_role_name VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_3359D34977153098 ON claro_cursusbundle_course (code)
        ");
        $this->addSql("
            CREATE INDEX IDX_3359D349EE7F5384 ON claro_cursusbundle_course (workspace_model_id)
        ");
        $this->addSql("
            CREATE TABLE claro_cursusbundle_cursus (
                id INTEGER NOT NULL, 
                course_id INTEGER DEFAULT NULL, 
                parent_id INTEGER DEFAULT NULL, 
                code VARCHAR(255) DEFAULT NULL, 
                title VARCHAR(255) NOT NULL, 
                description CLOB DEFAULT NULL, 
                blocking BOOLEAN NOT NULL, 
                details CLOB DEFAULT NULL, 
                cursus_order INTEGER NOT NULL, 
                root INTEGER DEFAULT NULL, 
                lvl INTEGER NOT NULL, 
                lft INTEGER NOT NULL, 
                rgt INTEGER NOT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_27921C3377153098 ON claro_cursusbundle_cursus (code)
        ");
        $this->addSql("
            CREATE INDEX IDX_27921C33591CC992 ON claro_cursusbundle_cursus (course_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_27921C33727ACA70 ON claro_cursusbundle_cursus (parent_id)
        ");
        $this->addSql("
            CREATE TABLE claro_cursusbundle_course_session_group (
                id INTEGER NOT NULL, 
                group_id INTEGER NOT NULL, 
                session_id INTEGER NOT NULL, 
                registration_date DATETIME NOT NULL, 
                group_type INTEGER NOT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_F27287A4FE54D947 ON claro_cursusbundle_course_session_group (group_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_F27287A4613FECDF ON claro_cursusbundle_course_session_group (session_id)
        ");
        $this->addSql("
            CREATE UNIQUE INDEX cursus_group_unique_course_session_group ON claro_cursusbundle_course_session_group (session_id, group_id)
        ");
        $this->addSql("
            CREATE TABLE claro_cursusbundle_cursus_displayed_word (
                id INTEGER NOT NULL, 
                word VARCHAR(255) NOT NULL, 
                displayed_name VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_14E7B098C3F17511 ON claro_cursusbundle_cursus_displayed_word (word)
        ");
        $this->addSql("
            CREATE TABLE claro_cursusbundle_course_session (
                id INTEGER NOT NULL, 
                course_id INTEGER NOT NULL, 
                workspace_id INTEGER DEFAULT NULL, 
                learner_role_id INTEGER DEFAULT NULL, 
                tutor_role_id INTEGER DEFAULT NULL, 
                session_name VARCHAR(255) NOT NULL, 
                session_status INTEGER NOT NULL, 
                default_session BOOLEAN NOT NULL, 
                creation_date DATETIME NOT NULL, 
                public_registration BOOLEAN NOT NULL, 
                public_unregistration BOOLEAN NOT NULL, 
                registration_validation BOOLEAN NOT NULL, 
                start_date DATETIME DEFAULT NULL, 
                end_date DATETIME DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_C5F56FDE591CC992 ON claro_cursusbundle_course_session (course_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_C5F56FDE82D40A1F ON claro_cursusbundle_course_session (workspace_id)
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_C5F56FDEEF2297F5 ON claro_cursusbundle_course_session (learner_role_id)
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_C5F56FDEBEFB2F13 ON claro_cursusbundle_course_session (tutor_role_id)
        ");
        $this->addSql("
            CREATE TABLE claro_cursus_sessions (
                coursesession_id INTEGER NOT NULL, 
                cursus_id INTEGER NOT NULL, 
                PRIMARY KEY(coursesession_id, cursus_id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_5256A813AE020D6E ON claro_cursus_sessions (coursesession_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_5256A81340AEF4B9 ON claro_cursus_sessions (cursus_id)
        ");
        $this->addSql("
            CREATE TABLE claro_cursusbundle_cursus_group (
                id INTEGER NOT NULL, 
                group_id INTEGER NOT NULL, 
                cursus_id INTEGER NOT NULL, 
                registration_date DATETIME NOT NULL, 
                group_type INTEGER DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_EA4DDE93FE54D947 ON claro_cursusbundle_cursus_group (group_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_EA4DDE9340AEF4B9 ON claro_cursusbundle_cursus_group (cursus_id)
        ");
        $this->addSql("
            CREATE UNIQUE INDEX cursus_group_unique_cursus_group ON claro_cursusbundle_cursus_group (cursus_id, group_id)
        ");
        $this->addSql("
            CREATE TABLE claro_cursusbundle_course_session_user (
                id INTEGER NOT NULL, 
                user_id INTEGER NOT NULL, 
                session_id INTEGER NOT NULL, 
                registration_date DATETIME NOT NULL, 
                user_type INTEGER NOT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_80B4120FA76ED395 ON claro_cursusbundle_course_session_user (user_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_80B4120F613FECDF ON claro_cursusbundle_course_session_user (session_id)
        ");
        $this->addSql("
            CREATE UNIQUE INDEX cursus_user_unique_course_session_user ON claro_cursusbundle_course_session_user (session_id, user_id)
        ");
        $this->addSql("
            CREATE TABLE claro_cursusbundle_course_session_registration_queue (
                id INTEGER NOT NULL, 
                user_id INTEGER NOT NULL, 
                session_id INTEGER NOT NULL, 
                application_date DATETIME NOT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_334FC296A76ED395 ON claro_cursusbundle_course_session_registration_queue (user_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_334FC296613FECDF ON claro_cursusbundle_course_session_registration_queue (session_id)
        ");
        $this->addSql("
            CREATE UNIQUE INDEX session_queue_unique_session_user ON claro_cursusbundle_course_session_registration_queue (session_id, user_id)
        ");
        $this->addSql("
            CREATE TABLE claro_cursusbundle_cursus_user (
                id INTEGER NOT NULL, 
                user_id INTEGER NOT NULL, 
                cursus_id INTEGER NOT NULL, 
                registration_date DATETIME NOT NULL, 
                user_type INTEGER DEFAULT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_8AA52D8A76ED395 ON claro_cursusbundle_cursus_user (user_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_8AA52D840AEF4B9 ON claro_cursusbundle_cursus_user (cursus_id)
        ");
        $this->addSql("
            CREATE UNIQUE INDEX cursus_user_unique_cursus_user ON claro_cursusbundle_cursus_user (cursus_id, user_id)
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP TABLE claro_cursusbundle_course
        ");
        $this->addSql("
            DROP TABLE claro_cursusbundle_cursus
        ");
        $this->addSql("
            DROP TABLE claro_cursusbundle_course_session_group
        ");
        $this->addSql("
            DROP TABLE claro_cursusbundle_cursus_displayed_word
        ");
        $this->addSql("
            DROP TABLE claro_cursusbundle_course_session
        ");
        $this->addSql("
            DROP TABLE claro_cursus_sessions
        ");
        $this->addSql("
            DROP TABLE claro_cursusbundle_cursus_group
        ");
        $this->addSql("
            DROP TABLE claro_cursusbundle_course_session_user
        ");
        $this->addSql("
            DROP TABLE claro_cursusbundle_course_session_registration_queue
        ");
        $this->addSql("
            DROP TABLE claro_cursusbundle_cursus_user
        ");
    }
}