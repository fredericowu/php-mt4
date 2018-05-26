DROP DATABASE mt4_fred;

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `mt4_fred` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mt4_fred` ;

-- -----------------------------------------------------
-- Table `mt4_fred`.`auth_user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mt4_fred`.`auth_user` (
  `auth_user_id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  `name` VARCHAR(255) NULL,
  PRIMARY KEY (`auth_user_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mt4_fred`.`auth_permission`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mt4_fred`.`auth_permission` (
  `auth_permission_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `description` VARCHAR(255) NULL,
  PRIMARY KEY (`auth_permission_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mt4_fred`.`auth_user_permission`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mt4_fred`.`auth_user_permission` (
  `auth_user_permission_id` INT NOT NULL AUTO_INCREMENT,
  `auth_user_id` INT NOT NULL,
  `auth_permission_id` INT NOT NULL,
  PRIMARY KEY (`auth_user_permission_id`, `auth_user_id`, `auth_permission_id`),
  INDEX `fk_auth_user_permission_auth_user_idx` (`auth_user_id` ASC),
  INDEX `fk_auth_user_permission_auth_permission1_idx` (`auth_permission_id` ASC),
  CONSTRAINT `fk_auth_user_permission_auth_user`
    FOREIGN KEY (`auth_user_id`)
    REFERENCES `mt4_fred`.`auth_user` (`auth_user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_auth_user_permission_auth_permission1`
    FOREIGN KEY (`auth_permission_id`)
    REFERENCES `mt4_fred`.`auth_permission` (`auth_permission_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mt4_fred`.`auth_token`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mt4_fred`.`auth_token` (
  `auth_token_id` INT NOT NULL AUTO_INCREMENT,
  `auth_user_id` INT NOT NULL,
  PRIMARY KEY (`auth_token_id`, `auth_user_id`),
  INDEX `fk_auth_token_auth_user1_idx` (`auth_user_id` ASC),
  CONSTRAINT `fk_auth_token_auth_user1`
    FOREIGN KEY (`auth_user_id`)
    REFERENCES `mt4_fred`.`auth_user` (`auth_user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mt4_fred`.`device_type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mt4_fred`.`device_type` (
  `device_type_id` INT NOT NULL,
  `name` VARCHAR(45) NULL,
  `description` VARCHAR(255) NULL,
  PRIMARY KEY (`device_type_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mt4_fred`.`device`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mt4_fred`.`device` (
  `device_id` INT NOT NULL AUTO_INCREMENT,
  `auth_user_id` INT NOT NULL COMMENT 'Created by user',
  `device_type_id` INT NOT NULL,
  `hostname` VARCHAR(255) NULL,
  `ip` VARCHAR(15) NULL,
  `vendor` VARCHAR(255) NULL,
  `model` VARCHAR(255) NULL,
  `is_active` INT NOT NULL DEFAULT 0 COMMENT '1 = Active\n0 = Inactive',
  `datetime_creation` DATETIME NOT NULL,
  PRIMARY KEY (`device_id`, `auth_user_id`, `device_type_id`),
  INDEX `fk_device_auth_user1_idx` (`auth_user_id` ASC),
  INDEX `fk_device_device_type1_idx` (`device_type_id` ASC),
  CONSTRAINT `fk_device_auth_user1`
    FOREIGN KEY (`auth_user_id`)
    REFERENCES `mt4_fred`.`auth_user` (`auth_user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_device_device_type1`
    FOREIGN KEY (`device_type_id`)
    REFERENCES `mt4_fred`.`device_type` (`device_type_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
