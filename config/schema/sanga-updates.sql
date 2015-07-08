-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Hoszt: localhost
-- Létrehozás ideje: 2015. Már 20. 14:25
-- Szerver verzió: 5.5.41-0ubuntu0.14.04.1
-- PHP verzió: 5.5.9-1ubuntu4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Adatbázis: `sanga`
--

DELIMITER $$
--
-- Függvények
--
CREATE DEFINER=`root`@`localhost` FUNCTION `levenshtein`( s1 VARCHAR(255), s2 VARCHAR(255) ) RETURNS int(11)
    DETERMINISTIC
BEGIN
    DECLARE s1_len, s2_len, i, j, c, c_temp, cost INT;
    DECLARE s1_char CHAR;
    -- max strlen=255
    DECLARE cv0, cv1 VARBINARY(256);
    SET s1_len = CHAR_LENGTH(s1), s2_len = CHAR_LENGTH(s2), cv1 = 0x00, j = 1, i = 1, c = 0;
    IF s1 = s2 THEN
      RETURN 0;
    ELSEIF s1_len = 0 THEN
      RETURN s2_len;
    ELSEIF s2_len = 0 THEN
      RETURN s1_len;
	ELSEIF ISNULL(s1_len) THEN
	  RETURN s2_len;
	ELSEIF ISNULL(s2_len) THEN
	  RETURN s1_len;

    ELSE
      WHILE j <= s2_len DO
        SET cv1 = CONCAT(cv1, UNHEX(HEX(j))), j = j + 1;
      END WHILE;
      WHILE i <= s1_len DO
        SET s1_char = SUBSTRING(s1, i, 1), c = i, cv0 = UNHEX(HEX(i)), j = 1;
        WHILE j <= s2_len DO
          SET c = c + 1;
          IF s1_char = SUBSTRING(s2, j, 1) THEN 
            SET cost = 0; ELSE SET cost = 1;
          END IF;
          SET c_temp = CONV(HEX(SUBSTRING(cv1, j, 1)), 16, 10) + cost;
          IF c > c_temp THEN SET c = c_temp; END IF;
            SET c_temp = CONV(HEX(SUBSTRING(cv1, j+1, 1)), 16, 10) + 1;
            IF c > c_temp THEN 
              SET c = c_temp; 
            END IF;
            SET cv0 = CONCAT(cv0, UNHEX(HEX(c))), j = j + 1;
        END WHILE;
        SET cv1 = cv0, i = i + 1;
      END WHILE;
    END IF;
    RETURN c;
  END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `contactname` varchar(45) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `zip_id` mediumint(8) unsigned DEFAULT NULL,
  `address` varchar(45) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `phone` varchar(45) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `email` varchar(45) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `birth` date DEFAULT NULL,
  `sex` tinyint(4) DEFAULT NULL COMMENT '1: male\n2: female',
  `workplace` varchar(100) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `family_id` char(13) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `contactsource_id` smallint(6) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  `comment` text COLLATE utf8_hungarian_ci,
  `google_id` varchar(32) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_contacts_zips1_idx` (`zip_id`),
  KEY `fk_contacts_contactsources1_idx` (`contactsource_id`),
  KEY `families` (`family_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `contactsources`
--

CREATE TABLE IF NOT EXISTS `contactsources` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_hungarian_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `contacts_groups`
--

CREATE TABLE IF NOT EXISTS `contacts_groups` (
  `group_id` mediumint(8) unsigned NOT NULL,
  `contact_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`group_id`,`contact_id`),
  KEY `fk_groups_has_contacts_contacts1_idx` (`contact_id`),
  KEY `fk_groups_has_contacts_groups1_idx` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci COMMENT='Contacts are members of these groups';

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `contacts_skills`
--

CREATE TABLE IF NOT EXISTS `contacts_skills` (
  `contact_id` int(10) unsigned NOT NULL,
  `skill_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`contact_id`,`skill_id`),
  KEY `fk_contacts_has_experties_experties1_idx` (`skill_id`),
  KEY `fk_contacts_has_experties_contacts1_idx` (`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci COMMENT='Which skills are owned by the contact';

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `contacts_users`
--

CREATE TABLE IF NOT EXISTS `contacts_users` (
  `contact_id` int(10) unsigned NOT NULL,
  `user_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`contact_id`,`user_id`),
  KEY `fk_contacts_has_users_users1_idx` (`user_id`),
  KEY `fk_contacts_has_users_contacts1_idx` (`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci COMMENT='Who is/are the contact person(s) of the user';

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_hungarian_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `user_id` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_events_users1_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `description` varchar(100) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `admin_user_id` smallint(5) unsigned NOT NULL COMMENT 'admin could add or remove users to/from the group in groups_users table',
  `shared` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'All users will see the existence of this group, but not its members',
  PRIMARY KEY (`id`),
  KEY `fk_groups_users1_idx` (`admin_user_id`),
  KEY `publics` (`shared`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `groups_users`
--

CREATE TABLE IF NOT EXISTS `groups_users` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` mediumint(8) unsigned NOT NULL,
  `user_id` smallint(5) unsigned NOT NULL,
  `intersection_group_id` mediumint(8) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_groups_has_users_users1_idx` (`user_id`),
  KEY `fk_groups_has_users_groups1_idx` (`group_id`),
  KEY `fk_groups_users_groups1_idx` (`intersection_group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci COMMENT='What groups'' members or groups intersection are available for rw for the user' ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `histories`
--

CREATE TABLE IF NOT EXISTS `histories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_id` int(10) unsigned NOT NULL,
  `date` date DEFAULT NULL,
  `user_id` smallint(5) unsigned DEFAULT NULL,
  `group_id` mediumint(8) unsigned DEFAULT NULL,
  `event_id` smallint(5) unsigned NOT NULL,
  `detail` varchar(255) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `unit_id` smallint(5) unsigned DEFAULT NULL,
  `family` tinyint(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_histories_contacts1_idx` (`contact_id`),
  KEY `fk_histories_users1_idx` (`user_id`),
  KEY `fk_histories_events1_idx` (`event_id`),
  KEY `fk_histories_groups1_idx` (`group_id`),
  KEY `fk_histories_units1_idx` (`unit_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` smallint(5) unsigned NOT NULL,
  `notification` text COLLATE utf8_hungarian_ci,
  `unread` tinyint(1) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_notifications_users1_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rbruteforcelogs`
--

CREATE TABLE IF NOT EXISTS `rbruteforcelogs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `data` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rbruteforces`
--

CREATE TABLE IF NOT EXISTS `rbruteforces` (
  `ip` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `expire` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`expire`),
  KEY `ip` (`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(40) NOT NULL,
  `data` text,
  `expires` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `skills`
--

CREATE TABLE IF NOT EXISTS `skills` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_hungarian_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `units`
--

CREATE TABLE IF NOT EXISTS `units` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `usergroups`
--

CREATE TABLE IF NOT EXISTS `usergroups` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) CHARACTER SET utf8 NOT NULL,
  `admin_user_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usergroups_users1_idx` (`admin_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `realname` varchar(45) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `email` varchar(45) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `phone` varchar(45) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  `role` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '0: nincs joga\n1: user \n9: CRM admin\n10: admin',
  `google_contacts_refresh_token` varchar(64) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users_usergroups`
--

CREATE TABLE IF NOT EXISTS `users_usergroups` (
  `user_id` smallint(5) unsigned NOT NULL,
  `usergroup_id` smallint(6) NOT NULL,
  PRIMARY KEY (`user_id`,`usergroup_id`),
  KEY `fk_usergroups_has_users_users1_idx` (`user_id`),
  KEY `fk_usergroups_has_users_usergroups1_idx` (`usergroup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `zips`
--

CREATE TABLE IF NOT EXISTS `zips` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `country_id` smallint(5) unsigned NOT NULL,
  `zip` varchar(45) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `name` varchar(45) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  PRIMARY KEY (`id`,`country_id`),
  KEY `zip` (`zip`),
  KEY `name` (`name`),
  KEY `fk_zips_countries1_idx` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci  ;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `fk_contacts_contactsources1` FOREIGN KEY (`contactsource_id`) REFERENCES `contactsources` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_contacts_zips1` FOREIGN KEY (`zip_id`) REFERENCES `zips` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Megkötések a táblához `contacts_groups`
--
ALTER TABLE `contacts_groups`
  ADD CONSTRAINT `fk_groups_has_contacts_contacts1` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_groups_has_contacts_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Megkötések a táblához `contacts_skills`
--
ALTER TABLE `contacts_skills`
  ADD CONSTRAINT `fk_contacts_has_experties_contacts1` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_contacts_has_experties_experties1` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Megkötések a táblához `contacts_users`
--
ALTER TABLE `contacts_users`
  ADD CONSTRAINT `fk_contacts_has_users_contacts1` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_contacts_has_users_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Megkötések a táblához `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `fk_events_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Megkötések a táblához `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `fk_groups_users1` FOREIGN KEY (`admin_user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Megkötések a táblához `groups_users`
--
ALTER TABLE `groups_users`
  ADD CONSTRAINT `fk_groups_has_users_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_groups_has_users_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_groups_users_groups1` FOREIGN KEY (`intersection_group_id`) REFERENCES `groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Megkötések a táblához `histories`
--
ALTER TABLE `histories`
  ADD CONSTRAINT `fk_histories_contacts1` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_histories_events1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_histories_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_histories_units1` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_histories_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Megkötések a táblához `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `fk_notifications_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Megkötések a táblához `usergroups`
--
ALTER TABLE `usergroups`
  ADD CONSTRAINT `fk_usergroups_users1` FOREIGN KEY (`admin_user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Megkötések a táblához `users_usergroups`
--
ALTER TABLE `users_usergroups`
  ADD CONSTRAINT `fk_usergroups_has_users_usergroups1` FOREIGN KEY (`usergroup_id`) REFERENCES `usergroups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usergroups_has_users_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Megkötések a táblához `zips`
--
ALTER TABLE `zips`
  ADD CONSTRAINT `fk_zips_countries1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

ALTER TABLE `users` ADD `resettoken` VARCHAR( 32 ) NOT NULL AFTER `role` ;

ALTER TABLE `sanga`.`contacts` 
ADD COLUMN `workplace_zip_id` MEDIUMINT(8) UNSIGNED NULL DEFAULT NULL AFTER `workplace`,
ADD COLUMN `workplace_address` VARCHAR(45) NULL DEFAULT NULL AFTER `workplace_zip_id`,
ADD COLUMN `workplace_phone` VARCHAR(45) NULL DEFAULT NULL AFTER `workplace_address`,
ADD COLUMN `workplace_email` VARCHAR(45) NULL DEFAULT NULL AFTER `workplace_phone`,
ADD INDEX `fk_contacts_zips2_idx` (`workplace_zip_id` ASC);

ALTER TABLE `sanga`.`contacts` 
ADD CONSTRAINT `fk_contacts_zips2`
  FOREIGN KEY (`workplace_zip_id`)
  REFERENCES `sanga`.`zips` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
 
 CREATE TABLE IF NOT EXISTS `sanga`.`settings` (
  `id` SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` SMALLINT(5) UNSIGNED NOT NULL,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `value` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_settings_users1_idx` (`user_id` ASC),
  CONSTRAINT `fk_settings_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `sanga`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

ALTER TABLE `sanga`.`contacts` 
CHANGE COLUMN `name` `legalname` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_hungarian_ci' NULL DEFAULT NULL ;

ALTER TABLE `sanga`.`notifications` 
DROP COLUMN `sender_id`,
ADD COLUMN `sender_id` SMALLINT(5) UNSIGNED NOT NULL DEFAULT 1 AFTER `id`,
ADD INDEX `fk_notifications_users2_idx` (`sender_id` ASC),
DROP INDEX `fk_notifications_users2_idx` ;

ALTER TABLE `sanga`.`notifications` 
ADD CONSTRAINT `fk_notifications_users2`
  FOREIGN KEY (`sender_id`)
  REFERENCES `sanga`.`users` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
  
ALTER TABLE `sanga`.`users` ADD COLUMN `last_login` DATETIME NULL DEFAULT NULL AFTER `modified`;



--
-- Tábla szerkezet ehhez a táblához `documents`
--

CREATE TABLE `documents` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `contact_id` int(11) NOT NULL,
 `document_name` varchar(255) NOT NULL,
 `file_type` varchar(50) NOT NULL,
 `document_size` bigint(20) NOT NULL,
 `document_data` mediumblob NOT NULL,
 `created` datetime NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8

ALTER TABLE `documents` ADD `file_name` VARCHAR(200) NOT NULL AFTER `document_name`;

ALTER TABLE `sanga`.`documents` 
DROP COLUMN `contact_id`,
ADD COLUMN `contact_id` INT(10) UNSIGNED NOT NULL AFTER `id`,
ADD INDEX `fk_documents_contacts1_idx` (`contact_id` ASC);

ALTER TABLE `sanga`.`documents` 
ADD CONSTRAINT `fk_documents_contacts1`
  FOREIGN KEY (`contact_id`)
  REFERENCES `sanga`.`contacts` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
  
ALTER TABLE `sanga`.`documents` 
CHANGE COLUMN `document_name` `name` VARCHAR(255) NOT NULL ,
CHANGE COLUMN `document_size` `size` BIGINT(20) NOT NULL ,
CHANGE COLUMN `document_data` `data` MEDIUMBLOB NOT NULL ;

DROP function IF EXISTS `levenshtein_emptyasnull`;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` FUNCTION `levenshtein_emptyasnull`( s1 VARCHAR(255), s2 VARCHAR(255) ) RETURNS int(11)
    DETERMINISTIC
BEGIN
    DECLARE s1_len, s2_len, i, j, c, c_temp, cost INT;
    DECLARE s1_char CHAR;
    -- max strlen=255
    DECLARE cv0, cv1 VARBINARY(256);
    SET s1_len = CHAR_LENGTH(s1), s2_len = CHAR_LENGTH(s2), cv1 = 0x00, j = 1, i = 1, c = 0;
    -- handle empty vales as NULL
    IF s1_len = 0 THEN
      RETURN NULL;
    ELSEIF s2_len = 0 THEN
      RETURN NULL;
	ELSEIF ISNULL(s1_len) THEN
	  RETURN NULL;
	ELSEIF ISNULL(s2_len) THEN
	  RETURN NULL;
	ELSEIF s1 = s2 THEN
      RETURN 0; 

    ELSE
      WHILE j <= s2_len DO
        SET cv1 = CONCAT(cv1, UNHEX(HEX(j))), j = j + 1;
      END WHILE;
      WHILE i <= s1_len DO
        SET s1_char = SUBSTRING(s1, i, 1), c = i, cv0 = UNHEX(HEX(i)), j = 1;
        WHILE j <= s2_len DO
          SET c = c + 1;
          IF s1_char = SUBSTRING(s2, j, 1) THEN 
            SET cost = 0; ELSE SET cost = 1;
          END IF;
          SET c_temp = CONV(HEX(SUBSTRING(cv1, j, 1)), 16, 10) + cost;
          IF c > c_temp THEN SET c = c_temp; END IF;
            SET c_temp = CONV(HEX(SUBSTRING(cv1, j+1, 1)), 16, 10) + 1;
            IF c > c_temp THEN 
              SET c = c_temp; 
            END IF;
            SET cv0 = CONCAT(cv0, UNHEX(HEX(c))), j = j + 1;
        END WHILE;
        SET cv1 = cv0, i = i + 1;
      END WHILE;
    END IF;
    RETURN c;
  END$$
DELIMITER ;

ALTER TABLE `sanga`.`documents` ADD `user_id` INT(10) NOT NULL AFTER `contact_id`;

ALTER TABLE `sanga`.`documents` ADD INDEX `fk_documents_users1_idx` (`user_id` ASC);

ALTER TABLE `sanga`.`documents` 
DROP COLUMN `user_id`,
ADD COLUMN `user_id` SMALLINT(5) UNSIGNED NOT NULL AFTER `contact_id`,
DROP PRIMARY KEY,
ADD PRIMARY KEY (`id`, `user_id`),
ADD INDEX `fk_documents_users1_idx1` (`user_id` ASC),
DROP INDEX `fk_documents_users1_idx` ;

ALTER TABLE `sanga`.`documents` 
ADD CONSTRAINT `fk_documents_users1`
  FOREIGN KEY (`user_id`)
  REFERENCES `sanga`.`users` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

INSERT INTO `reseller10_sanga`.`settings` (`id` ,`user_id` ,`name` ,`value`)
VALUES (NULL , '1', 'default_groups', 'a:2:{i:0;i:6;i:1;i:7;}');

