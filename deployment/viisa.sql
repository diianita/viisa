SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `viisa` DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci ;
USE `viisa` ;

-- -----------------------------------------------------
-- Table `viisa`.`TipoUsuario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `viisa`.`TipoUsuario` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `desc` TEXT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viisa`.`Usuario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `viisa`.`Usuario` (
  `tipoUsuario` INT NOT NULL ,
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `contasena` TEXT NULL ,
  `nombre` VARCHAR(45) NULL ,
  `apellido` VARCHAR(45) NULL ,
  `email` TEXT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Usuario_TipoUsuario` (`tipoUsuario` ASC) ,
  CONSTRAINT `fk_Usuario_TipoUsuario`
    FOREIGN KEY (`tipoUsuario` )
    REFERENCES `viisa`.`TipoUsuario` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viisa`.`Familiar`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `viisa`.`Familiar` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `usuario` INT(11) NOT NULL ,
  `vinculo` TEXT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Familiar_Usuario1` (`usuario` ASC) ,
  CONSTRAINT `fk_Familiar_Usuario1`
    FOREIGN KEY (`usuario` )
    REFERENCES `viisa`.`Usuario` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viisa`.`Estudiante`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `viisa`.`Estudiante` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `usuario` INT(11) NOT NULL ,
  `familiar` INT NOT NULL ,
  `grado` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Estudiante_Usuario1` (`usuario` ASC) ,
  INDEX `fk_Estudiante_Familiar1` (`familiar` ASC) ,
  CONSTRAINT `fk_Estudiante_Usuario1`
    FOREIGN KEY (`usuario` )
    REFERENCES `viisa`.`Usuario` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Estudiante_Familiar1`
    FOREIGN KEY (`familiar` )
    REFERENCES `viisa`.`Familiar` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viisa`.`Materias`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `viisa`.`Materias` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viisa`.`Libro`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `viisa`.`Libro` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `materia` INT NOT NULL ,
  `nombre` VARCHAR(45) NULL ,
  `autor` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Libro_Materias1` (`materia` ASC) ,
  CONSTRAINT `fk_Libro_Materias1`
    FOREIGN KEY (`materia` )
    REFERENCES `viisa`.`Materias` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viisa`.`Ejemplares`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `viisa`.`Ejemplares` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `codigo` TEXT NOT NULL ,
  `libro` INT NOT NULL ,
  `descripcion` TEXT NULL ,
  INDEX `fk_Ejemplares_Libro1` (`libro` ASC) ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_Ejemplares_Libro1`
    FOREIGN KEY (`libro` )
    REFERENCES `viisa`.`Libro` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viisa`.`Prestamo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `viisa`.`Prestamo` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `estado` INT(11) NULL ,
  `usuario` INT(11) NOT NULL ,
  `ejemplar` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Prestamo_Usuario1` (`usuario` ASC) ,
  INDEX `fk_Prestamo_Ejemplares1` (`ejemplar` ASC) ,
  CONSTRAINT `fk_Prestamo_Usuario1`
    FOREIGN KEY (`usuario` )
    REFERENCES `viisa`.`Usuario` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Prestamo_Ejemplares1`
    FOREIGN KEY (`ejemplar` )
    REFERENCES `viisa`.`Ejemplares` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viisa`.`Personal`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `viisa`.`Personal` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `usuario` INT(11) NOT NULL ,
  `descripcion` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Docente_Usuario1` (`usuario` ASC) ,
  CONSTRAINT `fk_Docente_Usuario1`
    FOREIGN KEY (`usuario` )
    REFERENCES `viisa`.`Usuario` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `viisa`.`TipoUsuario`
-- -----------------------------------------------------
START TRANSACTION;
USE `viisa`;
INSERT INTO `viisa`.`TipoUsuario` (`id`, `desc`) VALUES (1, 'directivo');
INSERT INTO `viisa`.`TipoUsuario` (`id`, `desc`) VALUES (2, 'docente');
INSERT INTO `viisa`.`TipoUsuario` (`id`, `desc`) VALUES (3, 'bibliotecario');
INSERT INTO `viisa`.`TipoUsuario` (`id`, `desc`) VALUES (4, 'estudiente');
INSERT INTO `viisa`.`TipoUsuario` (`id`, `desc`) VALUES (5, 'familiar');

COMMIT;

-- -----------------------------------------------------
-- Data for table `viisa`.`Usuario`
-- -----------------------------------------------------
START TRANSACTION;
USE `viisa`;
INSERT INTO `viisa`.`Usuario` (`tipoUsuario`, `id`, `contasena`, `nombre`, `apellido`, `email`) VALUES (4, 1, 'est123456', 'ana', 'lopez', 'ana.lopez@col.com');
INSERT INTO `viisa`.`Usuario` (`tipoUsuario`, `id`, `contasena`, `nombre`, `apellido`, `email`) VALUES (5, 2, 'fam123456', 'carlos', 'lopez', 'carlos.lopez@col.com');
INSERT INTO `viisa`.`Usuario` (`tipoUsuario`, `id`, `contasena`, `nombre`, `apellido`, `email`) VALUES (1, 3, 'dir123456', 'camila', 'restrepo', 'camila.restrepo@col.com');
INSERT INTO `viisa`.`Usuario` (`tipoUsuario`, `id`, `contasena`, `nombre`, `apellido`, `email`) VALUES (2, 4, 'doc123456', 'diana', 'gomez', 'diana.gomez@col.com');
INSERT INTO `viisa`.`Usuario` (`tipoUsuario`, `id`, `contasena`, `nombre`, `apellido`, `email`) VALUES (3, 5, 'bic123456', 'lucia', 'murillo', 'lucia.murillo@col.com');

COMMIT;

-- -----------------------------------------------------
-- Data for table `viisa`.`Familiar`
-- -----------------------------------------------------
START TRANSACTION;
USE `viisa`;
INSERT INTO `viisa`.`Familiar` (`id`, `usuario`, `vinculo`) VALUES (1, 2, 'padre');

COMMIT;

-- -----------------------------------------------------
-- Data for table `viisa`.`Estudiante`
-- -----------------------------------------------------
START TRANSACTION;
USE `viisa`;
INSERT INTO `viisa`.`Estudiante` (`id`, `usuario`, `familiar`, `grado`) VALUES (1, 2, 1, 'noveno');

COMMIT;

-- -----------------------------------------------------
-- Data for table `viisa`.`Materias`
-- -----------------------------------------------------
START TRANSACTION;
USE `viisa`;
INSERT INTO `viisa`.`Materias` (`id`, `nombre`) VALUES (1, 'matematicas');
INSERT INTO `viisa`.`Materias` (`id`, `nombre`) VALUES (2, 'español');
INSERT INTO `viisa`.`Materias` (`id`, `nombre`) VALUES (3, 'biologia');
INSERT INTO `viisa`.`Materias` (`id`, `nombre`) VALUES (4, 'ingles');
INSERT INTO `viisa`.`Materias` (`id`, `nombre`) VALUES (5, 'quimica');
INSERT INTO `viisa`.`Materias` (`id`, `nombre`) VALUES (6, 'fisica');
INSERT INTO `viisa`.`Materias` (`id`, `nombre`) VALUES (7, 'estadistica');

COMMIT;

-- -----------------------------------------------------
-- Data for table `viisa`.`Libro`
-- -----------------------------------------------------
START TRANSACTION;
USE `viisa`;
INSERT INTO `viisa`.`Libro` (`id`, `materia`, `nombre`, `autor`) VALUES (1, 1, 'calculo analitico', 'graciela morentes');

COMMIT;

-- -----------------------------------------------------
-- Data for table `viisa`.`Ejemplares`
-- -----------------------------------------------------
START TRANSACTION;
USE `viisa`;
INSERT INTO `viisa`.`Ejemplares` (`id`, `codigo`, `libro`, `descripcion`) VALUES (1, 'cal0912', 1, '');

COMMIT;

-- -----------------------------------------------------
-- Data for table `viisa`.`Prestamo`
-- -----------------------------------------------------
START TRANSACTION;
USE `viisa`;
INSERT INTO `viisa`.`Prestamo` (`id`, `estado`, `usuario`, `ejemplar`) VALUES (1, 1, 1, 1);

COMMIT;

-- -----------------------------------------------------
-- Data for table `viisa`.`Personal`
-- -----------------------------------------------------
START TRANSACTION;
USE `viisa`;
INSERT INTO `viisa`.`Personal` (`id`, `usuario`, `descripcion`) VALUES (1, 3, 'rectora');
INSERT INTO `viisa`.`Personal` (`id`, `usuario`, `descripcion`) VALUES (2, 4, 'ingles');
INSERT INTO `viisa`.`Personal` (`id`, `usuario`, `descripcion`) VALUES (3, 5, 'bibliotecario');

COMMIT;
