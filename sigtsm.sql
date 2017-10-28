-- MySQL Script generated by MySQL Workbench
-- Sat Oct 28 17:48:35 2017
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema transmarim
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema transmarim
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `transmarim` DEFAULT CHARACTER SET utf8 ;
USE `transmarim` ;

-- -----------------------------------------------------
-- Table `transmarim`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `transmarim`.`usuario` (
  `idusuario` INT NOT NULL AUTO_INCREMENT,
  `idchofer` INT NULL,
  `nombre` VARCHAR(100) NOT NULL,
  `login` VARCHAR(20) NOT NULL,
  `clave` VARCHAR(100) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `imagen` VARCHAR(45) NULL,
  `condicion` TINYINT NOT NULL DEFAULT 1,
  PRIMARY KEY (`idusuario`),
  UNIQUE INDEX `login_UNIQUE` (`login` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `transmarim`.`seguro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `transmarim`.`seguro` (
  `idseguro` INT NOT NULL AUTO_INCREMENT,
  `numero` INT NOT NULL,
  `fechaven` DATE NOT NULL,
  `tipo_seguro` VARCHAR(45) NOT NULL,
  `condicion` TINYINT NOT NULL DEFAULT 1,
  PRIMARY KEY (`idseguro`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `transmarim`.`vehiculo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `transmarim`.`vehiculo` (
  `idvehiculo` INT NOT NULL AUTO_INCREMENT,
  `idseguro` INT NOT NULL,
  `placa` VARCHAR(10) NOT NULL,
  `modelo` VARCHAR(45) NOT NULL,
  `anovehiculo` INT NOT NULL,
  `imagen` VARCHAR(50) NULL,
  `condicion` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idvehiculo`),
  INDEX `fk_vehiculo_seguro_idx` (`idseguro` ASC),
  CONSTRAINT `fk_vehiculo_seguro`
    FOREIGN KEY (`idseguro`)
    REFERENCES `transmarim`.`seguro` (`idseguro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `transmarim`.`licencia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `transmarim`.`licencia` (
  `idlicencia` INT NOT NULL AUTO_INCREMENT,
  `grado` TINYINT(10) NOT NULL,
  `fechaven` DATE NOT NULL,
  `imagen` VARCHAR(45) NULL,
  `condicion` TINYINT NOT NULL DEFAULT 1,
  PRIMARY KEY (`idlicencia`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `transmarim`.`certificado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `transmarim`.`certificado` (
  `idcertificado` INT NOT NULL AUTO_INCREMENT,
  `numero` INT NOT NULL,
  `fechaven` DATE NOT NULL,
  `condicion` TINYINT NOT NULL DEFAULT 1,
  PRIMARY KEY (`idcertificado`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `transmarim`.`chofer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `transmarim`.`chofer` (
  `idchofer` INT NOT NULL AUTO_INCREMENT,
  `idvehiculo` INT NOT NULL,
  `idlicencia` INT NOT NULL,
  `idcertificado` INT NOT NULL,
  `nombre` VARCHAR(50) NOT NULL,
  `cedula` INT NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `imagen` VARCHAR(50) NULL,
  `telefono` BIGINT(20) NULL,
  `fechanac` DATE NULL,
  `direccion` VARCHAR(100) NULL,
  `condicion` TINYINT NOT NULL DEFAULT 1,
  PRIMARY KEY (`idchofer`),
  INDEX `fk_chofer_vehiculo_idx` (`idvehiculo` ASC),
  INDEX `fk_chofer_licencia_idx` (`idlicencia` ASC),
  INDEX `fk_chofer_certificado_idx` (`idcertificado` ASC),
  UNIQUE INDEX `idvehiculo_UNIQUE` (`idvehiculo` ASC),
  UNIQUE INDEX `idlicencia_UNIQUE` (`idlicencia` ASC),
  UNIQUE INDEX `idcertificado_UNIQUE` (`idcertificado` ASC),
  CONSTRAINT `fk_chofer_vehiculo`
    FOREIGN KEY (`idvehiculo`)
    REFERENCES `transmarim`.`vehiculo` (`idvehiculo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_chofer_licencia`
    FOREIGN KEY (`idlicencia`)
    REFERENCES `transmarim`.`licencia` (`idlicencia`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_chofer_certificado`
    FOREIGN KEY (`idcertificado`)
    REFERENCES `transmarim`.`certificado` (`idcertificado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `transmarim`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `transmarim`.`cliente` (
  `idcliente` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `codigo` BIGINT NOT NULL,
  `tipo_documento` VARCHAR(20) NOT NULL,
  `direccion` VARCHAR(45) NOT NULL,
  `telefono` BIGINT NULL,
  `email` VARCHAR(45) NULL,
  `condicion` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idcliente`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `transmarim`.`centro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `transmarim`.`centro` (
  `idcentro` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `condicion` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idcentro`),
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `transmarim`.`tickettsm`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `transmarim`.`tickettsm` (
  `idtickettsm` INT NOT NULL AUTO_INCREMENT,
  `idcliente` INT NOT NULL,
  `idchofer` INT NOT NULL,
  `idcentro` INT NOT NULL,
  `codigo` INT NOT NULL,
  `fecha` DATE NOT NULL,
  `fechapago` DATE NOT NULL,
  `montop` DECIMAL(20,2) NOT NULL,
  `montoret` DECIMAL(20,2) NOT NULL,
  `montoc` DECIMAL(20,2) NULL,
  `descripcion` VARCHAR(255) NULL,
  `estado` TINYINT NOT NULL DEFAULT 0,
  `condicion` TINYINT NOT NULL DEFAULT 1,
  PRIMARY KEY (`idtickettsm`),
  UNIQUE INDEX `codigo_UNIQUE` (`codigo` ASC),
  INDEX `fk_tickettsm_cliente_idx` (`idcliente` ASC),
  INDEX `fk_tickettsm_chofer_idx` (`idchofer` ASC),
  INDEX `fk_tickettsm_centro_idx` (`idcentro` ASC),
  CONSTRAINT `fk_tickettsm_cliente`
    FOREIGN KEY (`idcliente`)
    REFERENCES `transmarim`.`cliente` (`idcliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tickettsm_chofer`
    FOREIGN KEY (`idchofer`)
    REFERENCES `transmarim`.`chofer` (`idchofer`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tickettsm_centro`
    FOREIGN KEY (`idcentro`)
    REFERENCES `transmarim`.`centro` (`idcentro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `transmarim`.`permiso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `transmarim`.`permiso` (
  `idpermiso` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idpermiso`),
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `transmarim`.`usuario_permiso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `transmarim`.`usuario_permiso` (
  `idusuario_permiso` INT NOT NULL AUTO_INCREMENT,
  `idusuario` INT NOT NULL,
  `idpermiso` INT NOT NULL,
  PRIMARY KEY (`idusuario_permiso`),
  INDEX `fk_permiso_usuario_permiso_idx` (`idpermiso` ASC),
  INDEX `fk_usuario_usuario_permiso_idx` (`idusuario` ASC),
  CONSTRAINT `fk_usuario_permiso_permiso`
    FOREIGN KEY (`idpermiso`)
    REFERENCES `transmarim`.`permiso` (`idpermiso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_permiso_usuario`
    FOREIGN KEY (`idusuario`)
    REFERENCES `transmarim`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `transmarim`.`descuento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `transmarim`.`descuento` (
  `iddescuento` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `condicion` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`iddescuento`),
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `transmarim`.`chofer_descuento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `transmarim`.`chofer_descuento` (
  `idchofer_descuento` INT NOT NULL AUTO_INCREMENT,
  `iddescuento` INT NOT NULL,
  `idchofer` INT NOT NULL,
  `montodesc` DECIMAL(20,2) NULL,
  `porcentaje` INT NULL,
  `fecha` DATETIME NOT NULL,
  PRIMARY KEY (`idchofer_descuento`),
  INDEX `fk_descuento_cliente_descuento_idx` (`iddescuento` ASC),
  INDEX `fk_cliente_descuento_chofer_idx` (`idchofer` ASC),
  CONSTRAINT `fk_chofer_descuento_descuento`
    FOREIGN KEY (`iddescuento`)
    REFERENCES `transmarim`.`descuento` (`iddescuento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_chofer_descuento_chofer`
    FOREIGN KEY (`idchofer`)
    REFERENCES `transmarim`.`chofer` (`idchofer`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `transmarim`.`ticketcaribe`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `transmarim`.`ticketcaribe` (
  `idticketcaribe` INT NOT NULL AUTO_INCREMENT,
  `idcliente` INT NOT NULL,
  `idchofer` INT NOT NULL,
  `idcentro` INT NOT NULL,
  `codigo` INT NOT NULL,
  `fecha` DATE NOT NULL,
  `fechapago` DATE NOT NULL,
  `montop` DECIMAL(20,2) NOT NULL,
  `montoret` DECIMAL(20,2) NOT NULL,
  `montoc` DECIMAL(20,2) NULL,
  `descripcion` VARCHAR(255) NULL,
  `estado` TINYINT NOT NULL DEFAULT 0,
  `condicion` TINYINT NOT NULL DEFAULT 1,
  PRIMARY KEY (`idticketcaribe`),
  UNIQUE INDEX `codigo_UNIQUE` (`codigo` ASC),
  INDEX `fk_ticketcaribe_cliente_idx` (`idcliente` ASC),
  INDEX `fk_ticketcaribe_chofer_idx` (`idchofer` ASC),
  INDEX `fk_ticketcaribe_centro_idx` (`idcentro` ASC),
  CONSTRAINT `fk_ticketcaribe_cliente`
    FOREIGN KEY (`idcliente`)
    REFERENCES `transmarim`.`cliente` (`idcliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ticketcaribe_chofer`
    FOREIGN KEY (`idchofer`)
    REFERENCES `transmarim`.`chofer` (`idchofer`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ticketcaribe_centro`
    FOREIGN KEY (`idcentro`)
    REFERENCES `transmarim`.`centro` (`idcentro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `transmarim`.`tarifa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `transmarim`.`tarifa` (
  `idtarifa` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `montotsmp` DECIMAL(20,2) NOT NULL,
  `montotsmc` DECIMAL(20,2) NOT NULL,
  `montocaribec` DECIMAL(20,2) NOT NULL,
  PRIMARY KEY (`idtarifa`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `transmarim`.`chat`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `transmarim`.`chat` (
  `idchat` INT NOT NULL AUTO_INCREMENT,
  `idchofer` INT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `tiempo` VARCHAR(45) NOT NULL,
  `comentario` TEXT(255) NOT NULL,
  PRIMARY KEY (`idchat`),
  INDEX `fk_chat_chofer_id_idx` (`idchofer` ASC),
  CONSTRAINT `fk_chat_chofer`
    FOREIGN KEY (`idchofer`)
    REFERENCES `transmarim`.`chofer` (`idchofer`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `transmarim`.`talonario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `transmarim`.`talonario` (
  `idtalonario` INT NOT NULL AUTO_INCREMENT,
  `idchofer` INT NOT NULL,
  `desde` INT NOT NULL,
  `hasta` INT NOT NULL,
  `fecha` DATE NULL,
  PRIMARY KEY (`idtalonario`),
  INDEX `fk_talonario_chofer_idx` (`idchofer` ASC),
  CONSTRAINT `fk_talonario_chofer`
    FOREIGN KEY (`idchofer`)
    REFERENCES `transmarim`.`chofer` (`idchofer`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
