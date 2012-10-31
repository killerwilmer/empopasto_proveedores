-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.16


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema mykalydad
--

CREATE DATABASE IF NOT EXISTS mykalydad;
USE mykalydad;

--
-- Definition of table `act`
--

DROP TABLE IF EXISTS `act`;
CREATE TABLE `act` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) DEFAULT NULL,
  `apellido` varchar(200) DEFAULT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  `tipact_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_act_tip_act1` (`tipact_id`),
  KEY `fk_act_pro1` (`pro_id`),
  CONSTRAINT `fk_act_pro1` FOREIGN KEY (`pro_id`) REFERENCES `pro` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_act_tip_act1` FOREIGN KEY (`tipact_id`) REFERENCES `tipact` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `act`
--

/*!40000 ALTER TABLE `act` DISABLE KEYS */;
/*!40000 ALTER TABLE `act` ENABLE KEYS */;


--
-- Definition of table `banprecal`
--

DROP TABLE IF EXISTS `banprecal`;
CREATE TABLE `banprecal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text,
  `codigo` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Banco de preguntas de Alta Calidad';

--
-- Dumping data for table `banprecal`
--

/*!40000 ALTER TABLE `banprecal` DISABLE KEYS */;
/*!40000 ALTER TABLE `banprecal` ENABLE KEYS */;


--
-- Definition of table `banprereg`
--

DROP TABLE IF EXISTS `banprereg`;
CREATE TABLE `banprereg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text,
  `codigo` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Banco de preguntas de registro';

--
-- Dumping data for table `banprereg`
--

/*!40000 ALTER TABLE `banprereg` DISABLE KEYS */;
/*!40000 ALTER TABLE `banprereg` ENABLE KEYS */;


--
-- Definition of table `campopregunta`
--

DROP TABLE IF EXISTS `campopregunta`;
CREATE TABLE `campopregunta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombrecampo` varchar(255) NOT NULL,
  `pregunta_id` int(11) NOT NULL,
  `tipocampo_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_campopregunta_tipocampo1` (`tipocampo_id`),
  KEY `fk_campopregunta_pregunta1` (`pregunta_id`),
  CONSTRAINT `fk_campopregunta_pregunta1` FOREIGN KEY (`pregunta_id`) REFERENCES `pregunta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_campopregunta_tipocampo1` FOREIGN KEY (`tipocampo_id`) REFERENCES `tipocampo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `campopregunta`
--

/*!40000 ALTER TABLE `campopregunta` DISABLE KEYS */;
/*!40000 ALTER TABLE `campopregunta` ENABLE KEYS */;


--
-- Definition of table `car`
--

DROP TABLE IF EXISTS `car`;
CREATE TABLE `car` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) DEFAULT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  `fac_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cac_fac` (`fac_id`),
  CONSTRAINT `fk_cac_fac` FOREIGN KEY (`fac_id`) REFERENCES `fac` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `car`
--

/*!40000 ALTER TABLE `car` DISABLE KEYS */;
/*!40000 ALTER TABLE `car` ENABLE KEYS */;


--
-- Definition of table `con`
--

DROP TABLE IF EXISTS `con`;
CREATE TABLE `con` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Condiciones de las preguntas de registro';

--
-- Dumping data for table `con`
--

/*!40000 ALTER TABLE `con` DISABLE KEYS */;
/*!40000 ALTER TABLE `con` ENABLE KEYS */;


--
-- Definition of table `cue`
--

DROP TABLE IF EXISTS `cue`;
CREATE TABLE `cue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) DEFAULT NULL,
  `per_id` int(11) NOT NULL,
  `tipact_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cue_per1` (`per_id`),
  KEY `fk_cue_tip_act1` (`tipact_id`),
  KEY `fk_cue_pro1` (`pro_id`),
  CONSTRAINT `fk_cue_per1` FOREIGN KEY (`per_id`) REFERENCES `per` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cue_pro1` FOREIGN KEY (`pro_id`) REFERENCES `pro` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cue_tip_act1` FOREIGN KEY (`tipact_id`) REFERENCES `tipact` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Cuestionarios';

--
-- Dumping data for table `cue`
--

/*!40000 ALTER TABLE `cue` DISABLE KEYS */;
INSERT INTO `cue` (`id`,`nombre`,`per_id`,`tipact_id`,`pro_id`) VALUES 
 (1,'Postgrados_ENCUESTA DE AUTOEVALUACIÓN PARA EGRESADOS',1,6,3);
/*!40000 ALTER TABLE `cue` ENABLE KEYS */;


--
-- Definition of table `diapre`
--

DROP TABLE IF EXISTS `diapre`;
CREATE TABLE `diapre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) DEFAULT NULL,
  `observacion` text,
  `existe` tinyint(4) DEFAULT NULL,
  `fec_ela` date DEFAULT NULL,
  `fec_act` date DEFAULT NULL,
  `pro_id` int(11) NOT NULL,
  `per_id` int(11) NOT NULL,
  `ind_id` int(10) unsigned zerofill NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_dia_pre_pro1` (`pro_id`),
  KEY `fk_dia_pre_per1` (`per_id`),
  KEY `fk_dia_pre_ind1` (`ind_id`),
  CONSTRAINT `fk_dia_pre_ind1` FOREIGN KEY (`ind_id`) REFERENCES `ind` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_dia_pre_per1` FOREIGN KEY (`per_id`) REFERENCES `per` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_dia_pre_pro1` FOREIGN KEY (`pro_id`) REFERENCES `pro` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Diagnostico previo';

--
-- Dumping data for table `diapre`
--

/*!40000 ALTER TABLE `diapre` DISABLE KEYS */;
/*!40000 ALTER TABLE `diapre` ENABLE KEYS */;


--
-- Definition of table `fac`
--

DROP TABLE IF EXISTS `fac`;
CREATE TABLE `fac` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) DEFAULT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fac`
--

/*!40000 ALTER TABLE `fac` DISABLE KEYS */;
/*!40000 ALTER TABLE `fac` ENABLE KEYS */;


--
-- Definition of table `facu`
--

DROP TABLE IF EXISTS `facu`;
CREATE TABLE `facu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `facu`
--

/*!40000 ALTER TABLE `facu` DISABLE KEYS */;
INSERT INTO `facu` (`id`,`nombre`) VALUES 
 (1,'Ingenieria'),
 (2,'Ciencias de la salud'),
 (3,'Postgrados y Relaciones Internacionales');
/*!40000 ALTER TABLE `facu` ENABLE KEYS */;


--
-- Definition of table `ind`
--

DROP TABLE IF EXISTS `ind`;
CREATE TABLE `ind` (
  `id` int(10) unsigned zerofill NOT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  `tipind_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ind_tip_ind1` (`tipind_id`),
  KEY `fk_ind_car1` (`car_id`),
  CONSTRAINT `fk_ind_car1` FOREIGN KEY (`car_id`) REFERENCES `car` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ind_tip_ind1` FOREIGN KEY (`tipind_id`) REFERENCES `tipind` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ind`
--

/*!40000 ALTER TABLE `ind` DISABLE KEYS */;
/*!40000 ALTER TABLE `ind` ENABLE KEYS */;


--
-- Definition of table `notcar`
--

DROP TABLE IF EXISTS `notcar`;
CREATE TABLE `notcar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor` double DEFAULT NULL,
  `car_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_not_car_car1` (`car_id`),
  CONSTRAINT `fk_not_car_car1` FOREIGN KEY (`car_id`) REFERENCES `car` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notcar`
--

/*!40000 ALTER TABLE `notcar` DISABLE KEYS */;
/*!40000 ALTER TABLE `notcar` ENABLE KEYS */;


--
-- Definition of table `notind`
--

DROP TABLE IF EXISTS `notind`;
CREATE TABLE `notind` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor` double DEFAULT NULL,
  `ind_id` int(10) unsigned zerofill NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_not_ind_ind1` (`ind_id`),
  CONSTRAINT `fk_not_ind_ind1` FOREIGN KEY (`ind_id`) REFERENCES `ind` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notind`
--

/*!40000 ALTER TABLE `notind` DISABLE KEYS */;
/*!40000 ALTER TABLE `notind` ENABLE KEYS */;


--
-- Definition of table `per`
--

DROP TABLE IF EXISTS `per`;
CREATE TABLE `per` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `fechaini` date DEFAULT NULL,
  `fechafin` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Periodo';

--
-- Dumping data for table `per`
--

/*!40000 ALTER TABLE `per` DISABLE KEYS */;
INSERT INTO `per` (`id`,`nombre`,`fechaini`,`fechafin`) VALUES 
 (1,'2012_semestre_2','2012-09-24',NULL);
/*!40000 ALTER TABLE `per` ENABLE KEYS */;


--
-- Definition of table `pesind`
--

DROP TABLE IF EXISTS `pesind`;
CREATE TABLE `pesind` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) DEFAULT NULL,
  `valor` double DEFAULT NULL,
  `ind_id` int(10) unsigned zerofill NOT NULL,
  `tipact_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pes_ind_ind1` (`ind_id`),
  KEY `fk_pes_ind_tip_act1` (`tipact_id`),
  CONSTRAINT `fk_pes_ind_ind1` FOREIGN KEY (`ind_id`) REFERENCES `ind` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pes_ind_tip_act1` FOREIGN KEY (`tipact_id`) REFERENCES `tipact` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pesind`
--

/*!40000 ALTER TABLE `pesind` DISABLE KEYS */;
/*!40000 ALTER TABLE `pesind` ENABLE KEYS */;


--
-- Definition of table `poncar`
--

DROP TABLE IF EXISTS `poncar`;
CREATE TABLE `poncar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor` double DEFAULT NULL,
  `car_id` int(11) NOT NULL,
  `act_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pon_car_car1` (`car_id`),
  KEY `fk_pon_car_act1` (`act_id`),
  CONSTRAINT `fk_pon_car_act1` FOREIGN KEY (`act_id`) REFERENCES `act` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pon_car_car1` FOREIGN KEY (`car_id`) REFERENCES `car` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `poncar`
--

/*!40000 ALTER TABLE `poncar` DISABLE KEYS */;
/*!40000 ALTER TABLE `poncar` ENABLE KEYS */;


--
-- Definition of table `ponfin`
--

DROP TABLE IF EXISTS `ponfin`;
CREATE TABLE `ponfin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor` double DEFAULT NULL,
  `car_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pon_fin_car1` (`car_id`),
  CONSTRAINT `fk_pon_fin_car1` FOREIGN KEY (`car_id`) REFERENCES `car` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ponfin`
--

/*!40000 ALTER TABLE `ponfin` DISABLE KEYS */;
/*!40000 ALTER TABLE `ponfin` ENABLE KEYS */;


--
-- Definition of table `precal`
--

DROP TABLE IF EXISTS `precal`;
CREATE TABLE `precal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ind_id` int(10) unsigned zerofill NOT NULL,
  `cue_id` int(11) NOT NULL,
  `tippre_id` int(11) NOT NULL,
  `banprecal_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pre_cal_ind1` (`ind_id`),
  KEY `fk_pre_cal_cue1` (`cue_id`),
  KEY `fk_pre_cal_tip_pre1` (`tippre_id`),
  KEY `fk_pre_cal_ban_pre_cal1` (`banprecal_id`),
  CONSTRAINT `fk_pre_cal_ban_pre_cal1` FOREIGN KEY (`banprecal_id`) REFERENCES `banprecal` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pre_cal_cue1` FOREIGN KEY (`cue_id`) REFERENCES `cue` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pre_cal_ind1` FOREIGN KEY (`ind_id`) REFERENCES `ind` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pre_cal_tip_pre1` FOREIGN KEY (`tippre_id`) REFERENCES `tippre` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Preguntas Calidad';

--
-- Dumping data for table `precal`
--

/*!40000 ALTER TABLE `precal` DISABLE KEYS */;
/*!40000 ALTER TABLE `precal` ENABLE KEYS */;


--
-- Definition of table `pregunta`
--

DROP TABLE IF EXISTS `pregunta`;
CREATE TABLE `pregunta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pregunta` text NOT NULL,
  `titulo` text,
  `unica` int(11) NOT NULL,
  `cue_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pregunta_cue1` (`cue_id`),
  CONSTRAINT `fk_pregunta_cue1` FOREIGN KEY (`cue_id`) REFERENCES `cue` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pregunta`
--

/*!40000 ALTER TABLE `pregunta` DISABLE KEYS */;
INSERT INTO `pregunta` (`id`,`pregunta`,`titulo`,`unica`,`cue_id`) VALUES 
 (1,'Pregunta1',NULL,1,1),
 (2,'Pregunta1',NULL,1,1);
/*!40000 ALTER TABLE `pregunta` ENABLE KEYS */;


--
-- Definition of table `prereg`
--

DROP TABLE IF EXISTS `prereg`;
CREATE TABLE `prereg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `con_id` int(11) NOT NULL,
  `cue_id` int(11) NOT NULL,
  `tippre_id` int(11) NOT NULL,
  `banprereg_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pre_reg_con1` (`con_id`),
  KEY `fk_pre_reg_cue1` (`cue_id`),
  KEY `fk_pre_reg_tip_pre1` (`tippre_id`),
  KEY `fk_pre_reg_ban_pre_reg1` (`banprereg_id`),
  CONSTRAINT `fk_pre_reg_ban_pre_reg1` FOREIGN KEY (`banprereg_id`) REFERENCES `banprereg` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pre_reg_con1` FOREIGN KEY (`con_id`) REFERENCES `con` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pre_reg_cue1` FOREIGN KEY (`cue_id`) REFERENCES `cue` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pre_reg_tip_pre1` FOREIGN KEY (`tippre_id`) REFERENCES `tippre` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Preguntas de registro';

--
-- Dumping data for table `prereg`
--

/*!40000 ALTER TABLE `prereg` DISABLE KEYS */;
/*!40000 ALTER TABLE `prereg` ENABLE KEYS */;


--
-- Definition of table `pro`
--

DROP TABLE IF EXISTS `pro`;
CREATE TABLE `pro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `facu_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pro_facu1` (`facu_id`),
  CONSTRAINT `fk_pro_facu1` FOREIGN KEY (`facu_id`) REFERENCES `facu` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pro`
--

/*!40000 ALTER TABLE `pro` DISABLE KEYS */;
INSERT INTO `pro` (`id`,`nombre`,`facu_id`) VALUES 
 (1,'Ingenieria de Sistemas',1),
 (2,'Enfermería',2),
 (3,'Postgrados',3);
/*!40000 ALTER TABLE `pro` ENABLE KEYS */;


--
-- Definition of table `rescalabi`
--

DROP TABLE IF EXISTS `rescalabi`;
CREATE TABLE `rescalabi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor` text NOT NULL,
  `precal_id` int(11) NOT NULL,
  `act_id` int(11) NOT NULL,
  `cue_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_res_cal_abi_pre_cal1` (`precal_id`),
  KEY `fk_res_cal_abi_act1` (`act_id`),
  KEY `fk_res_cal_abi_cue1` (`cue_id`),
  CONSTRAINT `fk_res_cal_abi_act1` FOREIGN KEY (`act_id`) REFERENCES `act` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_res_cal_abi_cue1` FOREIGN KEY (`cue_id`) REFERENCES `cue` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_res_cal_abi_pre_cal1` FOREIGN KEY (`precal_id`) REFERENCES `precal` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Respuestas calidad abiertas';

--
-- Dumping data for table `rescalabi`
--

/*!40000 ALTER TABLE `rescalabi` DISABLE KEYS */;
/*!40000 ALTER TABLE `rescalabi` ENABLE KEYS */;


--
-- Definition of table `rescalcer`
--

DROP TABLE IF EXISTS `rescalcer`;
CREATE TABLE `rescalcer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor` int(11) NOT NULL,
  `precal_id` int(11) NOT NULL,
  `act_id` int(11) NOT NULL,
  `cue_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_res_cal_cer_pre_cal1` (`precal_id`),
  KEY `fk_res_cal_cer_act1` (`act_id`),
  KEY `fk_res_cal_cer_cue1` (`cue_id`),
  CONSTRAINT `fk_res_cal_cer_act1` FOREIGN KEY (`act_id`) REFERENCES `act` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_res_cal_cer_cue1` FOREIGN KEY (`cue_id`) REFERENCES `cue` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_res_cal_cer_pre_cal1` FOREIGN KEY (`precal_id`) REFERENCES `precal` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Respuestas calidad cerradas';

--
-- Dumping data for table `rescalcer`
--

/*!40000 ALTER TABLE `rescalcer` DISABLE KEYS */;
/*!40000 ALTER TABLE `rescalcer` ENABLE KEYS */;


--
-- Definition of table `respuesta`
--

DROP TABLE IF EXISTS `respuesta`;
CREATE TABLE `respuesta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pregunta_id` int(11) NOT NULL,
  `consecutivo` int(11) NOT NULL,
  `campopregunta_id` int(11) NOT NULL,
  `valor` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_respuestas_pregunta1` (`pregunta_id`),
  KEY `fk_respuestas_campopregunta1` (`campopregunta_id`),
  CONSTRAINT `fk_respuestas_campopregunta1` FOREIGN KEY (`campopregunta_id`) REFERENCES `campopregunta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_respuestas_pregunta1` FOREIGN KEY (`pregunta_id`) REFERENCES `pregunta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `respuesta`
--

/*!40000 ALTER TABLE `respuesta` DISABLE KEYS */;
/*!40000 ALTER TABLE `respuesta` ENABLE KEYS */;


--
-- Definition of table `respuestausu`
--

DROP TABLE IF EXISTS `respuestausu`;
CREATE TABLE `respuestausu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pregunta_id` int(11) NOT NULL,
  `registro` int(11) DEFAULT NULL,
  `egresado_int` int(11) NOT NULL,
  `act_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_respuestausu_pregunta1` (`pregunta_id`),
  KEY `fk_respuestausu_act1` (`act_id`),
  CONSTRAINT `fk_respuestausu_act1` FOREIGN KEY (`act_id`) REFERENCES `act` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_respuestausu_pregunta1` FOREIGN KEY (`pregunta_id`) REFERENCES `pregunta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `respuestausu`
--

/*!40000 ALTER TABLE `respuestausu` DISABLE KEYS */;
/*!40000 ALTER TABLE `respuestausu` ENABLE KEYS */;


--
-- Definition of table `resregabi`
--

DROP TABLE IF EXISTS `resregabi`;
CREATE TABLE `resregabi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor` text NOT NULL,
  `prereg_id` int(11) NOT NULL,
  `act_id` int(11) NOT NULL,
  `cue_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_res_reg_abi_pre_reg1` (`prereg_id`),
  KEY `fk_res_reg_abi_act1` (`act_id`),
  KEY `fk_res_reg_abi_cue1` (`cue_id`),
  CONSTRAINT `fk_res_reg_abi_act1` FOREIGN KEY (`act_id`) REFERENCES `act` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_res_reg_abi_cue1` FOREIGN KEY (`cue_id`) REFERENCES `cue` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_res_reg_abi_pre_reg1` FOREIGN KEY (`prereg_id`) REFERENCES `prereg` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Respuestas registro abiertas';

--
-- Dumping data for table `resregabi`
--

/*!40000 ALTER TABLE `resregabi` DISABLE KEYS */;
/*!40000 ALTER TABLE `resregabi` ENABLE KEYS */;


--
-- Definition of table `resregcer`
--

DROP TABLE IF EXISTS `resregcer`;
CREATE TABLE `resregcer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor` int(11) NOT NULL,
  `prereg_id` int(11) NOT NULL,
  `act_id` int(11) NOT NULL,
  `cue_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_res_reg_cer_pre_reg1` (`prereg_id`),
  KEY `fk_res_reg_cer_act1` (`act_id`),
  KEY `fk_res_reg_cer_cue1` (`cue_id`),
  CONSTRAINT `fk_res_reg_cer_act1` FOREIGN KEY (`act_id`) REFERENCES `act` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_res_reg_cer_cue1` FOREIGN KEY (`cue_id`) REFERENCES `cue` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_res_reg_cer_pre_reg1` FOREIGN KEY (`prereg_id`) REFERENCES `prereg` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Respuestas registro cerradas';

--
-- Dumping data for table `resregcer`
--

/*!40000 ALTER TABLE `resregcer` DISABLE KEYS */;
/*!40000 ALTER TABLE `resregcer` ENABLE KEYS */;


--
-- Definition of table `tipact`
--

DROP TABLE IF EXISTS `tipact`;
CREATE TABLE `tipact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipact`
--

/*!40000 ALTER TABLE `tipact` DISABLE KEYS */;
INSERT INTO `tipact` (`id`,`nombre`) VALUES 
 (1,'Administrativo'),
 (2,'Estudiante'),
 (3,'Docente'),
 (4,'Empleador'),
 (5,'Directivo'),
 (6,'Egresado'),
 (7,'Evaluador');
/*!40000 ALTER TABLE `tipact` ENABLE KEYS */;


--
-- Definition of table `tipind`
--

DROP TABLE IF EXISTS `tipind`;
CREATE TABLE `tipind` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) DEFAULT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipind`
--

/*!40000 ALTER TABLE `tipind` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipind` ENABLE KEYS */;


--
-- Definition of table `tipocampo`
--

DROP TABLE IF EXISTS `tipocampo`;
CREATE TABLE `tipocampo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipocampo`
--

/*!40000 ALTER TABLE `tipocampo` DISABLE KEYS */;
INSERT INTO `tipocampo` (`id`,`nombre`) VALUES 
 (1,'int'),
 (2,'text');
/*!40000 ALTER TABLE `tipocampo` ENABLE KEYS */;


--
-- Definition of table `tippre`
--

DROP TABLE IF EXISTS `tippre`;
CREATE TABLE `tippre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) DEFAULT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tippre`
--

/*!40000 ALTER TABLE `tippre` DISABLE KEYS */;
/*!40000 ALTER TABLE `tippre` ENABLE KEYS */;


--
-- Definition of table `tipusu`
--

DROP TABLE IF EXISTS `tipusu`;
CREATE TABLE `tipusu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipusu`
--

/*!40000 ALTER TABLE `tipusu` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipusu` ENABLE KEYS */;


--
-- Definition of table `usu`
--

DROP TABLE IF EXISTS `usu`;
CREATE TABLE `usu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `apellido` varchar(200) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `pass` varchar(200) NOT NULL,
  `tipusu_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usu_tip_usu1` (`tipusu_id`),
  KEY `fk_usu_pro1` (`pro_id`),
  CONSTRAINT `fk_usu_pro1` FOREIGN KEY (`pro_id`) REFERENCES `pro` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usu_tip_usu1` FOREIGN KEY (`tipusu_id`) REFERENCES `tipusu` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usu`
--

/*!40000 ALTER TABLE `usu` DISABLE KEYS */;
/*!40000 ALTER TABLE `usu` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
