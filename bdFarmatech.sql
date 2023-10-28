-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema dbFarmatech
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `dbFarmatech` ;

-- -----------------------------------------------------
-- Schema dbFarmatech
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `dbFarmatech` DEFAULT CHARACTER SET utf8 ;
USE `dbFarmatech` ;

-- -----------------------------------------------------
-- Table `dbFarmatech`.`produtos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbFarmatech`.`produtos` ;

CREATE TABLE IF NOT EXISTS `dbFarmatech`.`produtos` (
  `idProduto` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NULL,
  `marca` VARCHAR(100) NULL,
  `conteudo` VARCHAR(50) NULL,
  `valor` FLOAT NULL,
  `linkImagem` VARCHAR(50) NULL,
  PRIMARY KEY (`idProduto`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbFarmatech`.`clientes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbFarmatech`.`clientes` ;

CREATE TABLE IF NOT EXISTS `dbFarmatech`.`clientes` (
  `idCliente` INT NOT NULL,
  `nome` VARCHAR(100) NULL,
  `celular` VARCHAR(16) NULL,
  `email` VARCHAR(45) NULL,
  PRIMARY KEY (`idCliente`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbFarmatech`.`vendas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbFarmatech`.`vendas` ;

CREATE TABLE IF NOT EXISTS `dbFarmatech`.`vendas` (
  `idVenda` INT NOT NULL,
  `idCliente` INT NOT NULL,
  `dhVenda` TIMESTAMP NULL DEFAULT current_timestamp(),
  `valor` FLOAT NULL,
  PRIMARY KEY (`idVenda`),
  INDEX `fk_vendas_clientes1_idx` (`idCliente` ASC),
  CONSTRAINT `fk_vendas_clientes1`
    FOREIGN KEY (`idCliente`)
    REFERENCES `dbFarmatech`.`clientes` (`idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbFarmatech`.`usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbFarmatech`.`usuarios` ;

CREATE TABLE IF NOT EXISTS `dbFarmatech`.`usuarios` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NULL,
  `email` VARCHAR(100) NULL,
  `senha` VARCHAR(255) NULL,
  PRIMARY KEY (`idUsuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbFarmatech`.`produtos_da_venda`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dbFarmatech`.`produtos_da_venda` ;

CREATE TABLE IF NOT EXISTS `dbFarmatech`.`produtos_da_venda` (
  `idVenda` INT NOT NULL,
  `idProduto` INT NOT NULL,
  PRIMARY KEY (`idVenda`, `idProduto`),
  INDEX `fk_produtos_da_venda_produtos1_idx` (`idProduto` ASC),
  CONSTRAINT `fk_produtos_da_venda_vendas1`
    FOREIGN KEY (`idVenda`)
    REFERENCES `dbFarmatech`.`vendas` (`idVenda`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_produtos_da_venda_produtos1`
    FOREIGN KEY (`idProduto`)
    REFERENCES `dbFarmatech`.`produtos` (`idProduto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `dbFarmatech`.`produtos`
-- -----------------------------------------------------
START TRANSACTION;
USE `dbFarmatech`;
INSERT INTO `dbFarmatech`.`produtos` (`idProduto`, `nome`, `marca`, `conteudo`, `valor`, `linkImagem`) VALUES (1, 'Dipirona Monoidratada 500mg/ml Solução Gotas 10ml EMS Genérico', 'EMS', '10ml', 5.39, 'dipirona.png');
INSERT INTO `dbFarmatech`.`produtos` (`idProduto`, `nome`, `marca`, `conteudo`, `valor`, `linkImagem`) VALUES (2, 'Novalgina Solução Oral Analgésico e Antitérmico Infantil 100ml', 'Novalgina', '100ml', 40.19, 'novalgina.png');
INSERT INTO `dbFarmatech`.`produtos` (`idProduto`, `nome`, `marca`, `conteudo`, `valor`, `linkImagem`) VALUES (3, 'Antialérgico Allegra Pediátrico 6mg/ml Suspensão Oral 60ml com Seringa', 'Allegra', '60ml', 37.68, 'allegra.png');
INSERT INTO `dbFarmatech`.`produtos` (`idProduto`, `nome`, `marca`, `conteudo`, `valor`, `linkImagem`) VALUES (4, 'Vick VapoRub Descongestionante Pomada 12g', 'Vick', '12g', 14.29, 'vick.png');
INSERT INTO `dbFarmatech`.`produtos` (`idProduto`, `nome`, `marca`, `conteudo`, `valor`, `linkImagem`) VALUES (5, 'Solução Fisiológica 0,9% Needs 500ml', 'Needs', '500ml', 7.99, 'sorofisiologico.png');

COMMIT;


-- -----------------------------------------------------
-- Data for table `dbFarmatech`.`clientes`
-- -----------------------------------------------------
START TRANSACTION;
USE `dbFarmatech`;
INSERT INTO `dbFarmatech`.`clientes` (`idCliente`, `nome`, `celular`, `email`) VALUES (1, 'Rafael Fernandes de Melo Lopes', '18981628848', 'rafael_lopes51@hotmail.com');
INSERT INTO `dbFarmatech`.`clientes` (`idCliente`, `nome`, `celular`, `email`) VALUES (2, 'Victor Amaral', '18999999999', 'victor@hotmail.com');
INSERT INTO `dbFarmatech`.`clientes` (`idCliente`, `nome`, `celular`, `email`) VALUES (3, 'Breno', '18999999999', 'breno@hotmail.com');
INSERT INTO `dbFarmatech`.`clientes` (`idCliente`, `nome`, `celular`, `email`) VALUES (4, 'Pedro', '18976548888', 'pedro@hotmail.com');

COMMIT;


-- -----------------------------------------------------
-- Data for table `dbFarmatech`.`vendas`
-- -----------------------------------------------------
START TRANSACTION;
USE `dbFarmatech`;
INSERT INTO `dbFarmatech`.`vendas` (`idVenda`, `idCliente`, `dhVenda`, `valor`) VALUES (1, 1, '', 100);
INSERT INTO `dbFarmatech`.`vendas` (`idVenda`, `idCliente`, `dhVenda`, `valor`) VALUES (2, 2, '', 200);

COMMIT;


-- -----------------------------------------------------
-- Data for table `dbFarmatech`.`usuarios`
-- -----------------------------------------------------
START TRANSACTION;
USE `dbFarmatech`;
INSERT INTO `dbFarmatech`.`usuarios` (`idUsuario`, `nome`, `email`, `senha`) VALUES (1, 'teste', 'teste@teste.com', '123456');

COMMIT;


-- -----------------------------------------------------
-- Data for table `dbFarmatech`.`produtos_da_venda`
-- -----------------------------------------------------
START TRANSACTION;
USE `dbFarmatech`;
INSERT INTO `dbFarmatech`.`produtos_da_venda` (`idVenda`, `idProduto`) VALUES (1, 1);
INSERT INTO `dbFarmatech`.`produtos_da_venda` (`idVenda`, `idProduto`) VALUES (1, 2);
INSERT INTO `dbFarmatech`.`produtos_da_venda` (`idVenda`, `idProduto`) VALUES (2, 3);
INSERT INTO `dbFarmatech`.`produtos_da_venda` (`idVenda`, `idProduto`) VALUES (2, 4);

COMMIT;

