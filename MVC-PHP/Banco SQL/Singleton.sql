-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema singleton
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema singleton
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `singleton` DEFAULT CHARACTER SET utf8 ;
USE `singleton` ;

-- -----------------------------------------------------
-- Table `singleton`.`categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `singleton`.`categoria` (
  `id_categoria` INT(11) NOT NULL AUTO_INCREMENT,
  `nome_categoria` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`id_categoria`))
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `singleton`.`empresa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `singleton`.`empresa` (
  `id_empresa` INT(11) NOT NULL AUTO_INCREMENT,
  `nome_empresa` VARCHAR(50) NULL DEFAULT NULL,
  `status` CHAR(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id_empresa`))
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `singleton`.`pessoa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `singleton`.`pessoa` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(150) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `singleton`.`produto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `singleton`.`produto` (
  `id_produto` INT(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` INT(11) NULL DEFAULT NULL,
  `nome_produto` VARCHAR(100) NULL DEFAULT NULL,
  `valor` DECIMAL(12,2) NULL DEFAULT NULL,
  `status` CHAR(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id_produto`),
  INDEX `categoria_produto_idx` (`id_categoria` ASC),
  CONSTRAINT `categoria_produto`
    FOREIGN KEY (`id_categoria`)
    REFERENCES `singleton`.`categoria` (`id_categoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `singleton`.`tbl_caixa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `singleton`.`tbl_caixa` (
  `data` DATE NOT NULL,
  `saldoinicial` DECIMAL(13,2) NULL DEFAULT NULL,
  `entradas` DECIMAL(13,2) NULL DEFAULT NULL,
  `saidas` DECIMAL(13,2) NULL DEFAULT NULL,
  `saldofinal` DECIMAL(13,2) NULL DEFAULT NULL,
  `status` VARCHAR(7) NULL DEFAULT NULL,
  PRIMARY KEY (`data`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `singleton`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `singleton`.`usuario` (
  `id` INT(11) NOT NULL,
  `nome` VARCHAR(45) NULL DEFAULT NULL,
  `login` VARCHAR(45) NULL DEFAULT NULL,
  `senha` VARCHAR(32) NULL DEFAULT NULL,
  `status` CHAR(1) NULL DEFAULT NULL,
  `thumbnail_path` VARCHAR(100) NULL DEFAULT NULL,
  `id_empresa` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `empresa_usuario_idx` (`id_empresa` ASC),
  CONSTRAINT `empresa_usuario`
    FOREIGN KEY (`id_empresa`)
    REFERENCES `singleton`.`empresa` (`id_empresa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
