-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema farmacia
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `farmacia` ;

-- -----------------------------------------------------
-- Schema farmacia
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `farmacia` DEFAULT CHARACTER SET utf8 ;
USE `farmacia` ;

-- -----------------------------------------------------
-- Table `farmacia`.`produtos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `farmacia`.`produtos` ;

CREATE TABLE IF NOT EXISTS `farmacia`.`produtos` (
  `idProduto` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NULL,
  `marca` VARCHAR(100) NULL,
  `conteudo` VARCHAR(50) NULL,
  `valor` FLOAT NULL,
  `imagem` VARCHAR(50) NULL,
  PRIMARY KEY (`idProduto`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `farmacia`.`clientes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `farmacia`.`clientes` ;

CREATE TABLE IF NOT EXISTS `farmacia`.`clientes` (
  `idCliente` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NULL,
  `celular` VARCHAR(16) NULL,
  `email` VARCHAR(45) NULL,
  PRIMARY KEY (`idCliente`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `farmacia`.`vendas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `farmacia`.`vendas` ;

CREATE TABLE IF NOT EXISTS `farmacia`.`vendas` (
  `idVenda` INT NOT NULL AUTO_INCREMENT,
  `idCliente` INT NOT NULL,
  `dhVenda` TIMESTAMP NULL DEFAULT current_timestamp(),
  `valor` FLOAT NULL,
  PRIMARY KEY (`idVenda`),
  INDEX `fk_vendas_clientes1_idx` (`idCliente` ASC),
  CONSTRAINT `fk_vendas_clientes1`
    FOREIGN KEY (`idCliente`)
    REFERENCES `farmacia`.`clientes` (`idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `farmacia`.`usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `farmacia`.`usuario` ;

CREATE TABLE IF NOT EXISTS `farmacia`.`usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `tipo` varchar(10) NOT NULL,
  `data_cadastro` datetime NOT NULL DEFAULT current_timestamp(),
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- -----------------------------------------------------
-- Table `farmacia`.`produtos_da_venda`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `farmacia`.`produtos_da_venda` ;

CREATE TABLE IF NOT EXISTS `farmacia`.`produtos_da_venda` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `idVenda` INT NOT NULL,
  `idProduto` INT NOT NULL,
  `quantidade` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_produtos_da_venda_produtos1_idx` (`idProduto` ASC),
  CONSTRAINT `fk_produtos_da_venda_vendas1`
    FOREIGN KEY (`idVenda`)
    REFERENCES `farmacia`.`vendas` (`idVenda`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_produtos_da_venda_produtos1`
    FOREIGN KEY (`idProduto`)
    REFERENCES `farmacia`.`produtos` (`idProduto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `farmacia`.`produtos`
-- -----------------------------------------------------
START TRANSACTION;
USE `farmacia`;
INSERT INTO `farmacia`.`produtos` (`idProduto`, `nome`, `marca`, `conteudo`, `valor`, `imagem`) VALUES (1, 'Dipirona Monoidratada 500mg/ml Solução Gotas 10ml EMS Genérico', 'EMS', '10ml', 5.39, 'dipirona.png');
INSERT INTO `farmacia`.`produtos` (`idProduto`, `nome`, `marca`, `conteudo`, `valor`, `imagem`) VALUES (2, 'Novalgina Solução Oral Analgésico e Antitérmico Infantil 100ml', 'Novalgina', '100ml', 40.19, 'novalgina.png');
INSERT INTO `farmacia`.`produtos` (`idProduto`, `nome`, `marca`, `conteudo`, `valor`, `imagem`) VALUES (3, 'Antialérgico Allegra Pediátrico 6mg/ml Suspensão Oral 60ml com Seringa', 'Allegra', '60ml', 37.68, 'allegra.png');
INSERT INTO `farmacia`.`produtos` (`idProduto`, `nome`, `marca`, `conteudo`, `valor`, `imagem`) VALUES (4, 'Vick VapoRub Descongestionante Pomada 12g', 'Vick', '12g', 14.29, 'vick.png');
INSERT INTO `farmacia`.`produtos` (`idProduto`, `nome`, `marca`, `conteudo`, `valor`, `imagem`) VALUES (5, 'Solução Fisiológica 0,9% Needs 500ml', 'Needs', '500ml', 7.99, 'sorofisiologico.png');

COMMIT;


-- -----------------------------------------------------
-- Data for table `farmacia`.`clientes`
-- -----------------------------------------------------
START TRANSACTION;
USE `farmacia`;
INSERT INTO `farmacia`.`clientes` (`idCliente`, `nome`, `celular`, `email`) VALUES (1, 'Rafael', '18981628848', 'rafael@hotmail.com');
INSERT INTO `farmacia`.`clientes` (`idCliente`, `nome`, `celular`, `email`) VALUES (2, 'Victor', '18999999999', 'victor@hotmail.com');
INSERT INTO `farmacia`.`clientes` (`idCliente`, `nome`, `celular`, `email`) VALUES (3, 'Breno', '18999999999', 'breno@hotmail.com');
INSERT INTO `farmacia`.`clientes` (`idCliente`, `nome`, `celular`, `email`) VALUES (4, 'Pedro', '18976548888', 'pedro@hotmail.com');

COMMIT;


-- -----------------------------------------------------
-- Data for table `farmacia`.`vendas`
-- -----------------------------------------------------
START TRANSACTION;
USE `farmacia`;
INSERT INTO `farmacia`.`vendas` (`idVenda`, `idCliente`, `dhVenda`, `valor`) VALUES (1, 1, '12/11/2023 05:01:50', 10);
INSERT INTO `farmacia`.`vendas` (`idVenda`, `idCliente`, `dhVenda`, `valor`) VALUES (2, 2, '13/11/2023 05:01:50', 20);
INSERT INTO `farmacia`.`vendas` (`idVenda`, `idCliente`, `dhVenda`, `valor`) VALUES (3, 4, '14/11/2023 05:01:50', 40);

COMMIT;

-- -----------------------------------------------------
-- Data for table `farmacia`.`produtos_da_venda`
-- -----------------------------------------------------
START TRANSACTION;
USE `farmacia`;
INSERT INTO `farmacia`.`produtos_da_venda` (`id`,`idVenda`, `idProduto`,`quantidade` ) VALUES (1, 1, 1, 1);
INSERT INTO `farmacia`.`produtos_da_venda` (`id`,`idVenda`, `idProduto`,`quantidade` ) VALUES (2, 1, 2, 1);
INSERT INTO `farmacia`.`produtos_da_venda` (`id`,`idVenda`, `idProduto`,`quantidade` ) VALUES (3, 2, 3, 1);
INSERT INTO `farmacia`.`produtos_da_venda` (`id`,`idVenda`, `idProduto`,`quantidade` ) VALUES (4, 2, 4, 1);

COMMIT;
