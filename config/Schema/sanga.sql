SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `sanga`.`zips`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sanga`.`zips` (
  `id` VARCHAR(25) NOT NULL,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_hungarian_ci;


-- -----------------------------------------------------
-- Table `sanga`.`countries`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sanga`.`countries` (
  `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_hungarian_ci;


-- -----------------------------------------------------
-- Table `sanga`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sanga`.`users` (
  `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  `realname` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `phone` VARCHAR(45) NULL,
  `active` TINYINT(1) NULL,
  `role` VARCHAR(45) NULL,
  `created` DATETIME NULL,
  `modified` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_hungarian_ci;


-- -----------------------------------------------------
-- Table `sanga`.`linkups`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sanga`.`linkups` (
  `id` MEDIUMINT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_hungarian_ci;


-- -----------------------------------------------------
-- Table `sanga`.`linkups_users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sanga`.`linkups_users` (
  `linkups_id` MEDIUMINT NOT NULL,
  `users_id` SMALLINT UNSIGNED NOT NULL,
  `role` VARCHAR(45) NULL,
  PRIMARY KEY (`linkups_id`, `users_id`),
  INDEX `fk_linkups_has_users_users1_idx` (`users_id` ASC),
  INDEX `fk_linkups_has_users_linkups_idx` (`linkups_id` ASC),
  CONSTRAINT `fk_linkups_has_users_linkups`
    FOREIGN KEY (`linkups_id`)
    REFERENCES `sanga`.`linkups` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_linkups_has_users_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `sanga`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_hungarian_ci
COMMENT = 'Minek ki a gazdája. A user rálát a contactok ezen linkupjaih /* comment truncated */ /*oz kapcsolódó history eseményekre*/';


-- -----------------------------------------------------
-- Table `sanga`.`eventgroups`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sanga`.`eventgroups` (
  `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_hungarian_ci;


-- -----------------------------------------------------
-- Table `sanga`.`events`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sanga`.`events` (
  `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `eventgroups_id` SMALLINT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_events_eventgroups1_idx` (`eventgroups_id` ASC),
  CONSTRAINT `fk_events_eventgroups1`
    FOREIGN KEY (`eventgroups_id`)
    REFERENCES `sanga`.`eventgroups` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_hungarian_ci;


-- -----------------------------------------------------
-- Table `sanga`.`notifications`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sanga`.`notifications` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `notification` VARCHAR(255) NULL,
  `unread` TINYINT(1) NULL DEFAULT 1,
  `created` DATETIME NULL,
  `users_id` SMALLINT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`, `users_id`),
  INDEX `fk_notifications_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_notifications_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `sanga`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_hungarian_ci;


-- -----------------------------------------------------
-- Table `sanga`.`grouptypes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sanga`.`grouptypes` (
  `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_hungarian_ci;


-- -----------------------------------------------------
-- Table `sanga`.`groups`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sanga`.`groups` (
  `id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `grouptypes_id` SMALLINT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`, `grouptypes_id`),
  INDEX `fk_groups_grouptypes1_idx` (`grouptypes_id` ASC),
  CONSTRAINT `fk_groups_grouptypes1`
    FOREIGN KEY (`grouptypes_id`)
    REFERENCES `sanga`.`grouptypes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_hungarian_ci;


-- -----------------------------------------------------
-- Table `sanga`.`contactsources`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sanga`.`contactsources` (
  `id` SMALLINT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_hungarian_ci;


-- -----------------------------------------------------
-- Table `sanga`.`contacts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sanga`.`contacts` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `contactname` VARCHAR(45) NULL,
  `countries_id` SMALLINT UNSIGNED NOT NULL,
  `zips_id` VARCHAR(25) NOT NULL,
  `address` VARCHAR(45) NULL,
  `phone` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `birth` DATE NULL,
  `active` TINYINT(1) NULL,
  `comment` TEXT NULL,
  `created` DATETIME NULL,
  `modified` DATETIME NULL,
  `contactsources_id` SMALLINT NOT NULL,
  PRIMARY KEY (`id`, `contactsources_id`),
  INDEX `fk_contacts_zips1_idx` (`zips_id` ASC),
  INDEX `fk_contacts_countries1_idx` (`countries_id` ASC),
  INDEX `fk_contacts_contactsources1_idx` (`contactsources_id` ASC),
  CONSTRAINT `fk_contacts_zips1`
    FOREIGN KEY (`zips_id`)
    REFERENCES `sanga`.`zips` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contacts_countries1`
    FOREIGN KEY (`countries_id`)
    REFERENCES `sanga`.`countries` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contacts_contactsources1`
    FOREIGN KEY (`contactsources_id`)
    REFERENCES `sanga`.`contactsources` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_hungarian_ci;


-- -----------------------------------------------------
-- Table `sanga`.`contacts_users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sanga`.`contacts_users` (
  `contacts_id` INT UNSIGNED NOT NULL,
  `users_id` SMALLINT UNSIGNED NOT NULL,
  PRIMARY KEY (`contacts_id`, `users_id`),
  INDEX `fk_contacts_has_users_users1_idx` (`users_id` ASC),
  INDEX `fk_contacts_has_users_contacts1_idx` (`contacts_id` ASC),
  CONSTRAINT `fk_contacts_has_users_contacts1`
    FOREIGN KEY (`contacts_id`)
    REFERENCES `sanga`.`contacts` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contacts_has_users_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `sanga`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_hungarian_ci
COMMENT = 'Melyik contact melyik useré';


-- -----------------------------------------------------
-- Table `sanga`.`contacts_groups`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sanga`.`contacts_groups` (
  `groups_id` MEDIUMINT UNSIGNED NOT NULL,
  `contacts_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`groups_id`, `contacts_id`),
  INDEX `fk_groups_has_contacts_contacts1_idx` (`contacts_id` ASC),
  INDEX `fk_groups_has_contacts_groups1_idx` (`groups_id` ASC),
  CONSTRAINT `fk_groups_has_contacts_groups1`
    FOREIGN KEY (`groups_id`)
    REFERENCES `sanga`.`groups` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_groups_has_contacts_contacts1`
    FOREIGN KEY (`contacts_id`)
    REFERENCES `sanga`.`contacts` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_hungarian_ci;


-- -----------------------------------------------------
-- Table `sanga`.`histories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sanga`.`histories` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `date` DATE NULL,
  `contacts_id` INT UNSIGNED NOT NULL,
  `users_id` SMALLINT UNSIGNED NOT NULL,
  `detail` VARCHAR(255) NULL,
  `amount` DECIMAL(10,2) NULL,
  `events_id` SMALLINT UNSIGNED NOT NULL,
  `groups_id` MEDIUMINT UNSIGNED NOT NULL,
  `created` DATETIME NULL,
  `modified` DATETIME NULL,
  PRIMARY KEY (`id`, `contacts_id`, `users_id`, `events_id`),
  INDEX `fk_histories_contacts1_idx` (`contacts_id` ASC),
  INDEX `fk_histories_users1_idx` (`users_id` ASC),
  INDEX `fk_histories_events1_idx` (`events_id` ASC),
  INDEX `fk_histories_groups1_idx` (`groups_id` ASC),
  CONSTRAINT `fk_histories_contacts1`
    FOREIGN KEY (`contacts_id`)
    REFERENCES `sanga`.`contacts` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_histories_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `sanga`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_histories_events1`
    FOREIGN KEY (`events_id`)
    REFERENCES `sanga`.`events` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_histories_groups1`
    FOREIGN KEY (`groups_id`)
    REFERENCES `sanga`.`groups` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_hungarian_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
