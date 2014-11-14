SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `viisa` ;
CREATE SCHEMA IF NOT EXISTS `viisa` DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci ;
USE `viisa` ;

-- -----------------------------------------------------
-- Table `viisa`.`TipoUsuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `viisa`.`TipoUsuario` ;

CREATE  TABLE IF NOT EXISTS `viisa`.`TipoUsuario` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `desc` TEXT NULL ,
  `Enable` INT NULL DEFAULT 1 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = big5
COLLATE = big5_chinese_ci;


-- -----------------------------------------------------
-- Table `viisa`.`Usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `viisa`.`Usuario` ;

CREATE  TABLE IF NOT EXISTS `viisa`.`Usuario` (
  `tipoUsuario` INT NOT NULL ,
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `contrasena` TEXT NULL ,
  `nombre` VARCHAR(45) NULL ,
  `apellido` VARCHAR(45) NULL ,
  `email` TEXT NULL ,
  `foto` TEXT NULL ,
  `enabled` INT NULL DEFAULT 1 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viisa`.`Familiar`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `viisa`.`Familiar` ;

CREATE  TABLE IF NOT EXISTS `viisa`.`Familiar` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `usuario` INT(11) NOT NULL ,
  `vinculo` TEXT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viisa`.`Estudiante`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `viisa`.`Estudiante` ;

CREATE  TABLE IF NOT EXISTS `viisa`.`Estudiante` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `usuario` INT(11) NOT NULL ,
  `familiar` INT NOT NULL ,
  `grado` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viisa`.`Materias`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `viisa`.`Materias` ;

CREATE  TABLE IF NOT EXISTS `viisa`.`Materias` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NULL ,
  `enabled` INT NULL DEFAULT 1 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viisa`.`Autores`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `viisa`.`Autores` ;

CREATE  TABLE IF NOT EXISTS `viisa`.`Autores` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NULL ,
  `enabled` INT NULL DEFAULT 1 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viisa`.`Editoriales`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `viisa`.`Editoriales` ;

CREATE  TABLE IF NOT EXISTS `viisa`.`Editoriales` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NULL ,
  `enabled` INT NULL DEFAULT 1 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viisa`.`Libro`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `viisa`.`Libro` ;

CREATE  TABLE IF NOT EXISTS `viisa`.`Libro` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `materia` INT NOT NULL ,
  `autor` INT NOT NULL ,
  `editorial` INT NOT NULL ,
  `nombre` VARCHAR(45) NULL ,
  `descripcion` TEXT NULL ,
  `enabled` INT NULL DEFAULT 1 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viisa`.`Ejemplares`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `viisa`.`Ejemplares` ;

CREATE  TABLE IF NOT EXISTS `viisa`.`Ejemplares` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `codigo` TEXT NOT NULL ,
  `libro` INT NOT NULL ,
  `descripcion` TEXT NULL ,
  `enabled` INT NULL DEFAULT 1 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viisa`.`Prestamo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `viisa`.`Prestamo` ;

CREATE  TABLE IF NOT EXISTS `viisa`.`Prestamo` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `estado` INT(11) NULL ,
  `usuario` INT(11) NOT NULL ,
  `ejemplar` INT(11) NOT NULL ,
  `enabled` INT NULL DEFAULT 1 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viisa`.`Personal`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `viisa`.`Personal` ;

CREATE  TABLE IF NOT EXISTS `viisa`.`Personal` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `usuario` INT(11) NOT NULL ,
  `descripcion` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `viisa`.`TipoUsuario`
-- -----------------------------------------------------
START TRANSACTION;
USE `viisa`;
INSERT INTO `viisa`.`TipoUsuario` (`id`, `desc`, `Enable`) VALUES (1, 'directivo', 1);
INSERT INTO `viisa`.`TipoUsuario` (`id`, `desc`, `Enable`) VALUES (2, 'docente', 1);
INSERT INTO `viisa`.`TipoUsuario` (`id`, `desc`, `Enable`) VALUES (3, 'bibliotecario', 1);
INSERT INTO `viisa`.`TipoUsuario` (`id`, `desc`, `Enable`) VALUES (4, 'estudiente', 1);
INSERT INTO `viisa`.`TipoUsuario` (`id`, `desc`, `Enable`) VALUES (5, 'familiar', 1);
INSERT INTO `viisa`.`TipoUsuario` (`id`, `desc`, `Enable`) VALUES (6, 'administrador', 1);

COMMIT;

-- -----------------------------------------------------
-- Data for table `viisa`.`Usuario`
-- -----------------------------------------------------
START TRANSACTION;
USE `viisa`;
INSERT INTO `viisa`.`Usuario` (`tipoUsuario`, `id`, `contrasena`, `nombre`, `apellido`, `email`, `foto`, `enabled`) VALUES (4, 1, 'est123456', 'ana', 'lopez', 'ana.lopez@col.com', NULL, 1);
INSERT INTO `viisa`.`Usuario` (`tipoUsuario`, `id`, `contrasena`, `nombre`, `apellido`, `email`, `foto`, `enabled`) VALUES (5, 2, 'fam123456', 'carlos', 'lopez', 'carlos.lopez@col.com', NULL, 1);
INSERT INTO `viisa`.`Usuario` (`tipoUsuario`, `id`, `contrasena`, `nombre`, `apellido`, `email`, `foto`, `enabled`) VALUES (1, 3, 'dir123456', 'camila', 'restrepo', 'camila.restrepo@col.com', NULL, 1);
INSERT INTO `viisa`.`Usuario` (`tipoUsuario`, `id`, `contrasena`, `nombre`, `apellido`, `email`, `foto`, `enabled`) VALUES (2, 4, 'doc123456', 'diana', 'gomez', 'diana.gomez@col.com', NULL, 1);
INSERT INTO `viisa`.`Usuario` (`tipoUsuario`, `id`, `contrasena`, `nombre`, `apellido`, `email`, `foto`, `enabled`) VALUES (3, 5, 'bic123456', 'lucia', 'murillo', 'lucia.murillo@col.com', NULL, 1);
INSERT INTO `viisa`.`Usuario` (`tipoUsuario`, `id`, `contrasena`, `nombre`, `apellido`, `email`, `foto`, `enabled`) VALUES (6, 6, 'admin123456', 'diana', 'sarmiento', 'diana.sarmiento@mail.com', NULL, 1);

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
INSERT INTO `viisa`.`Materias` (`id`, `nombre`, `enabled`) VALUES (1, 'matematicas', 1);
INSERT INTO `viisa`.`Materias` (`id`, `nombre`, `enabled`) VALUES (2, 'español', 1);
INSERT INTO `viisa`.`Materias` (`id`, `nombre`, `enabled`) VALUES (3, 'biologia', 1);
INSERT INTO `viisa`.`Materias` (`id`, `nombre`, `enabled`) VALUES (4, 'ingles', 1);
INSERT INTO `viisa`.`Materias` (`id`, `nombre`, `enabled`) VALUES (5, 'quimica', 1);
INSERT INTO `viisa`.`Materias` (`id`, `nombre`, `enabled`) VALUES (6, 'fisica', 1);
INSERT INTO `viisa`.`Materias` (`id`, `nombre`, `enabled`) VALUES (7, 'estadistica', 1);

COMMIT;

-- -----------------------------------------------------
-- Data for table `viisa`.`Autores`
-- -----------------------------------------------------
START TRANSACTION;
USE `viisa`;
INSERT INTO `viisa`.`Autores` (`id`, `nombre`, `enabled`) VALUES (1, 'camilo', 1);

COMMIT;

-- -----------------------------------------------------
-- Data for table `viisa`.`Editoriales`
-- -----------------------------------------------------
START TRANSACTION;
USE `viisa`;
INSERT INTO `viisa`.`Editoriales` (`id`, `nombre`, `enabled`) VALUES (1, 'norma', 1);

COMMIT;

-- -----------------------------------------------------
-- Data for table `viisa`.`Libro`
-- -----------------------------------------------------
START TRANSACTION;
USE `viisa`;
INSERT INTO `viisa`.`Libro` (`id`, `materia`, `autor`, `editorial`, `nombre`, `descripcion`, `enabled`) VALUES (1, 1, 1, 1, 'calculo analitico', NULL, 1);

COMMIT;

-- -----------------------------------------------------
-- Data for table `viisa`.`Ejemplares`
-- -----------------------------------------------------
START TRANSACTION;
USE `viisa`;
INSERT INTO `viisa`.`Ejemplares` (`id`, `codigo`, `libro`, `descripcion`, `enabled`) VALUES (1, 'cal0912', 1, '', 1);

COMMIT;

-- -----------------------------------------------------
-- Data for table `viisa`.`Prestamo`
-- -----------------------------------------------------
START TRANSACTION;
USE `viisa`;
INSERT INTO `viisa`.`Prestamo` (`id`, `estado`, `usuario`, `ejemplar`, `enabled`) VALUES (1, 1, 1, 1, 1);

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
