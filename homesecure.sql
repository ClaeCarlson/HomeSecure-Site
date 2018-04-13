-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema homesecure
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema homesecure
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `homesecure` DEFAULT CHARACTER SET utf8 ;
USE `homesecure` ;

-- -----------------------------------------------------
-- Table `homesecure`.`sensors`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `homesecure`.`sensors` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `name` VARCHAR(45) NOT NULL COMMENT '',
  `label` VARCHAR(45) NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `homesecure`.`system`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `homesecure`.`system` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `name` VARCHAR(45) NOT NULL COMMENT '',
  `status` INT(11) NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `homesecure`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `homesecure`.`users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `username` VARCHAR(45) NOT NULL COMMENT '',
  `email` VARCHAR(100) NOT NULL COMMENT '',
  `password` VARCHAR(100) NOT NULL COMMENT '',
  `hash` VARCHAR(45) NOT NULL COMMENT '',
  `active` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `homesecure`.`logs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `homesecure`.`logs` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `time` DATETIME NOT NULL COMMENT '',
  `status` INT(11) NOT NULL COMMENT '',
  `sensors_id` INT(11) NULL DEFAULT NULL COMMENT '',
  `users_id` INT(11) NULL DEFAULT NULL COMMENT '',
  `system_id` INT(11) NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_logs_sensors_idx` (`sensors_id` ASC)  COMMENT '',
  INDEX `fk_logs_users1_idx` (`users_id` ASC)  COMMENT '',
  INDEX `fk_logs_system1_idx` (`system_id` ASC)  COMMENT '',
  CONSTRAINT `fk_logs_sensors`
    FOREIGN KEY (`sensors_id`)
    REFERENCES `homesecure`.`sensors` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_logs_system1`
    FOREIGN KEY (`system_id`)
    REFERENCES `homesecure`.`system` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_logs_users`
    FOREIGN KEY (`users_id`)
    REFERENCES `homesecure`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `homesecure`.`preferences`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `homesecure`.`preferences` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `theme` INT(11) NOT NULL COMMENT '',
  `notifications` INT(11) NOT NULL COMMENT '',
  `users_id` INT(11) NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_preferences_users1_idx` (`users_id` ASC)  COMMENT '',
  CONSTRAINT `fk_pref_users`
    FOREIGN KEY (`users_id`)
    REFERENCES `homesecure`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
