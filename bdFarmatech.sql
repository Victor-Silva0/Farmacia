-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema dbFarmatech
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema dbFarmatech
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `dbFarmatech` DEFAULT CHARACTER SET utf8 ;
USE `dbFarmatech` ;

-- -----------------------------------------------------
-- Table `dbFarmatech`.`produtos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbFarmatech`.`produtos` (
  `idProduto` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NULL,
  `marca` VARCHAR(100) NULL,
  `conteudo` VARCHAR(50) NULL,
  `valor` FLOAT NULL,
  `linkImagem` VARCHAR(100) NULL,
  PRIMARY KEY (`idProduto`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbFarmatech`.`clientes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbFarmatech`.`clientes` (
  `CPFCliente` INT NOT NULL,
  `nome` VARCHAR(100) NULL,
  `celular` VARCHAR(12) NULL,
  `email` VARCHAR(45) NULL,
  PRIMARY KEY (`CPFCliente`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbFarmatech`.`vendas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbFarmatech`.`vendas` (
  `idVenda` INT NOT NULL AUTO_INCREMENT,
  `CPFCliente` INT(11) NOT NULL,
  `dhVenda` TIMESTAMP NULL DEFAULT current_timestamp(),
  `valor` FLOAT NULL,
  PRIMARY KEY (`idVenda`),
  INDEX `fk_vendas_clientes1_idx` (`CPFCliente` ASC),
  CONSTRAINT `fk_vendas_clientes1`
    FOREIGN KEY (`CPFCliente`)
    REFERENCES `dbFarmatech`.`clientes` (`CPFCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbFarmatech`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbFarmatech`.`usuarios` (
  `idUsuario` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NULL,
  `email` VARCHAR(100) NULL,
  `senha` VARCHAR(255) NULL,
  PRIMARY KEY (`idUsuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbFarmatech`.`produtos_da_vendas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbFarmatech`.`produtos_da_vendas` (
  `idVenda` INT NOT NULL,
  `idProduto` INT NOT NULL,
  PRIMARY KEY (`idVenda`, `idProduto`),
  INDEX `fk_produtos_has_vendas_vendas1_idx` (`idVenda` ASC),
  INDEX `fk_produtos_has_vendas_produtos_idx` (`idProduto` ASC),
  CONSTRAINT `fk_produtos_has_vendas_produtos`
    FOREIGN KEY (`idProduto`)
    REFERENCES `dbFarmatech`.`produtos` (`idProduto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_produtos_has_vendas_vendas1`
    FOREIGN KEY (`idVenda`)
    REFERENCES `dbFarmatech`.`vendas` (`idVenda`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
