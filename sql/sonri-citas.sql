DROP DATABASE IF EXISTS `sonri-citas`;
CREATE DATABASE `sonri-citas` DEFAULT CHARACTER SET latin1 COLLATE latin1_bin;

/* Tabla client */
DROP TABLE IF EXISTS `sonri-citas`.`client`;
CREATE TABLE `sonri-citas`.`client` (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`firstname` VARCHAR( 50 ) NOT NULL ,
`middlename` VARCHAR( 50 ) NULL DEFAULT NULL ,
`firstlastname` VARCHAR( 50 ) NOT NULL ,
`secondlastname` VARCHAR( 50 ) NOT NULL ,
`sex` ENUM( 'm', 'f' ) NOT NULL ,
`documenttype` ENUM( 'cc', 'ti', 'rc', 'pa', 'ce' ) NOT NULL ,
`documentnumber` DOUBLE NOT NULL ,
`birthdate` DATE NOT NULL ,
`bloodtype` ENUM( 'on', 'op', 'an', 'ap', 'bn', 'bp', 'abn', 'abp' ) NULL DEFAULT NULL ,
`address` VARCHAR( 50 ) NOT NULL ,
`phonehome` VARCHAR( 50 ) NOT NULL ,
`phoneoffice` VARCHAR( 50 ) NULL DEFAULT NULL ,
`cellnumber` VARCHAR( 50 ) NULL DEFAULT NULL ,
`email` VARCHAR( 50 ) NOT NULL DEFAULT 'NN@NN.NN' ,
`maritalstatus` ENUM( 'sol', 'cas', 'unl', 'sep', 'div', 'viu' ) NOT NULL ,
`occupation` VARCHAR( 50 ) NOT NULL ,
`active` BOOL NOT NULL DEFAULT TRUE
) ENGINE = InnoDB CHARACTER SET latin1 COLLATE latin1_bin;

/* Tabla specialty */
DROP TABLE IF EXISTS `sonri-citas`.`specialty`;
CREATE TABLE `sonri-citas`.`specialty` (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`name` VARCHAR( 100 ) NOT NULL ,
`comments` VARCHAR( 300 ) NULL DEFAULT NULL 
) ENGINE = InnoDB CHARACTER SET latin1 COLLATE latin1_bin;

/* Tabla user */
DROP TABLE IF EXISTS `sonri-citas`.`user`;
CREATE TABLE `sonri-citas`.`user` (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`firstname` VARCHAR( 50 ) NOT NULL ,
`middlename` VARCHAR( 50 ) NULL DEFAULT NULL ,
`firstlastname` VARCHAR( 50 ) NOT NULL ,
`secondlastname` VARCHAR( 50 ) NOT NULL ,
`sex` ENUM( 'm', 'f' ) NOT NULL ,
`documenttype` ENUM( 'cc', 'ti', 'rc', 'pa', 'ce' ) NOT NULL ,
`documentnumber` DOUBLE NOT NULL ,
`birthdate` DATE NOT NULL ,
`bloodtype` ENUM( 'on', 'op', 'an', 'ap', 'bn', 'bp', 'abn', 'abp' ) NULL DEFAULT NULL ,
`address` VARCHAR( 50 ) NOT NULL ,
`phonehome` VARCHAR( 50 ) NOT NULL ,
`phoneoffice` VARCHAR( 50 ) NULL DEFAULT NULL ,
`cellnumber` VARCHAR( 50 ) NULL DEFAULT NULL ,
`email` VARCHAR( 50 ) NOT NULL DEFAULT 'NNN@NNN.NNN',
`maritalstatus` ENUM( 'sol', 'cas', 'unl', 'sep', 'div', 'viu' ) NOT NULL ,
`id_specialty` INT UNSIGNED NULL DEFAULT NULL ,
`active` BOOL NOT NULL DEFAULT TRUE ,
`doctor` BOOL NOT NULL DEFAULT TRUE ,
`username` VARCHAR( 50 ) NOT NULL ,
`password` VARCHAR( 32 ) NOT NULL ,
`privileges` ENUM( 'sec', 'doc', 'man', 'web' ) NOT NULL ,
FOREIGN KEY ( `id_specialty` ) REFERENCES `sonri-citas`.`specialty` ( `id` )
) ENGINE = InnoDB CHARACTER SET latin1 COLLATE latin1_bin;

/* Tabla treatment_type */
DROP TABLE IF EXISTS `sonri-citas`.`treatmenttype`;
CREATE TABLE `sonri-citas`.`treatmenttype` (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`name` VARCHAR( 100 ) NOT NULL ,
`comments` VARCHAR( 300 ) NULL DEFAULT NULL 
) ENGINE = InnoDB CHARACTER SET latin1 COLLATE latin1_bin;

/* Tabla treatment */
DROP TABLE IF EXISTS `sonri-citas`.`treatment`;
CREATE TABLE `sonri-citas`.`treatment` (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`code` VARCHAR( 5 ) NOT NULL ,
`name` VARCHAR( 100 ) NOT NULL ,
`price` INT UNSIGNED NOT NULL ,
`active` BOOL NOT NULL DEFAULT TRUE ,
`id_treatmenttype` INT UNSIGNED NOT NULL ,
`comments` VARCHAR( 300 ) NULL DEFAULT NULL ,
UNIQUE ( `code` ),
FOREIGN KEY ( `id_treatmenttype` ) REFERENCES `sonri-citas`.`treatmenttype` ( `id` )
) ENGINE = InnoDB CHARACTER SET latin1 COLLATE latin1_bin;

/* Tabla treatmentcontrol */
DROP TABLE IF EXISTS `sonri-citas`.`treatmentcontrol`;
CREATE TABLE `sonri-citas`.`treatmentcontrol` (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`id_client` INT UNSIGNED NOT NULL ,
`id_treatment` INT UNSIGNED NOT NULL ,
`state` ENUM( 'pro', 'com', 'can' ) NOT NULL ,
`comments` VARCHAR( 300 ) NULL DEFAULT NULL ,
FOREIGN KEY ( `id_client` ) REFERENCES `sonri-citas`.`client` ( `id` ) ,
FOREIGN KEY ( `id_treatment` ) REFERENCES `sonri-citas`.`treatment` ( `id` )
) ENGINE = InnoDB CHARACTER SET latin1 COLLATE latin1_bin;

/* Tabla appointment */
DROP TABLE IF EXISTS `sonri-citas`.`appointment`;
CREATE TABLE `sonri-citas`.`appointment` (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`id_client` INT UNSIGNED NOT NULL ,
`id_doctor` INT UNSIGNED NOT NULL ,
`date` DATE NOT NULL ,
`starttime` TIME NOT NULL ,
`endtime` TIME NOT NULL ,
`type` ENUM( 'val', 'tra', 'con' ) NOT NULL ,
`id_treatment` INT UNSIGNED NOT NULL ,
`quantity` INT UNSIGNED NOT NULL DEFAULT 1,
`status` ENUM( 'sol', 'con', 'cum', 'inc', 'can' ) NOT NULL ,
`comments` VARCHAR( 300 ) default NULL ,
FOREIGN KEY ( `id_client` ) REFERENCES `sonri-citas`.`client` ( `id` ),
FOREIGN KEY ( `id_doctor` ) REFERENCES `sonri-citas`.`user` ( `id` ),
FOREIGN KEY ( `id_treatment` ) REFERENCES `sonri-citas`.`treatment` ( `id` )
) ENGINE = InnoDB CHARACTER SET latin1 COLLATE latin1_bin;

/* Insercion de las especialidades */
INSERT INTO `sonri-citas`.`specialty`(`name`) VALUES("Endodoncista");
INSERT INTO `sonri-citas`.`specialty`(`name`) VALUES("General");
INSERT INTO `sonri-citas`.`specialty`(`name`) VALUES("Higienista");
INSERT INTO `sonri-citas`.`specialty`(`name`) VALUES("Odontopediatra");
INSERT INTO `sonri-citas`.`specialty`(`name`) VALUES("Ortodoncista");
INSERT INTO `sonri-citas`.`specialty`(`name`) VALUES("Periodoncista");

/* Insercion de los codigos de los tratamientos y tipos de tratamientos */
INSERT INTO `sonri-citas`.`treatmenttype`(`name`) VALUES("REHABILITACI�N - PR�TESIS FIJA");
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R01","Corona Acr�lico Temporal Autocurado",111430,1);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R06","Corona Temporal (Policarboxilato)",95710,1);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R80","Corona Temporal Acr�lico Termocurado",125710,1);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R84","Corona Metal Porcelana Richmond",857140,1);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R64","Corona Metal Porcelana Vita Vmk 95 Plus",928570,1);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R69","Corona Metal Porcelana Ceramco Plus",698570,1);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R70","Corona en Hombro Porcelana Plus",1435710,1);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R71","Corona Inceram-Plus",1688570,1);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R114","Corona alta est�tica",1585710,1);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R117","Corona est�tica",988570,1);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R51","Corona Metal Cer�mica Implantosoportada",1742860,1);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R52","Corona Cer�mica Implantosoportada",2042860,1);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R19","Incrustaci�n en Metal",567140,1);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R22","Incrustaci�n Cer�mica",1491430,1);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R115","Incrustaci�n est�tica",1331430,1);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R14","N�cleos en Dientes Unirradiculares",312860,1);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R15","N�cleos en Dientes Birradiculares",348570,1);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R16","N�cleos en Dientes Multirradiculares",367140,1);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R96","N�cleos Indirectos",241430,1);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R116","Carillas",1165710,1);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R23","Carillas Anteriores en Porcelana",1500000,1);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("A09","Recementaci�n de Corona",78570,1);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R12","Reconstrucci�n en Ionomero de Vidrio",201130,1);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R13","Remoci�n de Puentes y Coronas (x Cuadrante)",218570,1);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R56","Gu�a Qx Implante Unico o Parcial",367140,1);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R57","Gu�a Qx Implante Pr�tesis Total",617140,1);

INSERT INTO `sonri-citas`.`treatmenttype`(`name`) VALUES("REHABILITACI�N - PR�TESIS REMOVIBLE");
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R25","Dentomucosoportada",888570,2);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R26","Dentomucosoportada con 2 Anclajes (Remanium) No Incluye Dientes",1178570,2);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R27","Dentomucosoportada con 4 Anclajes (Remanium) no Incluye Dientes",1352860,2);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R97","Removible Flexident",1638570,2);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R29","Diente a Reemplazar (Biodent)",77140,2);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R30","Diente a Reemplazar (Duratone)",111430,2);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R31","Diente a Reemplazar (Isosit)",168570,2);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R32","Diente a Reemplazar(Super C)",85710,2);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R24","Mucosoportada (Acrilico Hasta 6 Und.)",682260,2);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R33","Dentadura Total Sup. o Inf. (Dientes en Acr�lico)",825710,2);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R34","Dentadura Total Sup. o Inf.(Dientes en Isosit)",1748570,2);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R35","Dentadura Total Sup. o Inf. (Dientes en Duratone)",1375000,2);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R60","Dentadura Sup o Inf. Total Duratone Triplex",1397000,2);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R62","Dentadura Sup o Inf. Total Isosit Triplex",2057140,2);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R112","Mucosoportada Inmediata Transicional",710000,2);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R54","Sobredentadura Implantosoportada En Dientes Duratone",1264290,2);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R55","Sobredentadura Implantosoportada En Dientes Isosit",1968570,2);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R37","Rebases con Laboratorio Solo(no Garant�as)",311430,2);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R40","Reparaci�n de Dientes Biodent o Super C",90000,2);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R42","Reparaci�n Pr�tesis Total o Mucosoportada",130000,2);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R86","Reparaci�n Dentomucosoportada",152860,2);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R87","Reparaci�n Diente Duratone",115710,2);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R88","Reparaci�n Diente Isosit",175710,2);

INSERT INTO `sonri-citas`.`treatmenttype`(`name`) VALUES("REHABILITACI�N - L�NEA DE IMPLANTES");
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("I123","Total removible natura (sobredentadura con dos implantes)",11342860,3);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("I120","Individual Natural (REH DIENTE �NICO CON IMPLANTE CORONA MP)",5325710,3);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("I121","Individual Natural PLUS (REH DIENTE �NICO CON IMPLANTE CP)",5775710,3);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("I122","Parcial fijo Natural (REH 3 UNIDADES 2 IMP. 3 CMP)",11700000,3);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("I124","Total fija natural inferior(H�brida incluye 4 implantes)",14250000,3);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("I125","Total fija natural superior(H�brida incluye 4 implantes)",21750000,3);

INSERT INTO `sonri-citas`.`treatmenttype`(`name`) VALUES("REHABILITACI�N - OTROS");
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R102","Set Up Unidad",28570,4);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("R109","Cambio Nylon Ajustes",80000,4);

INSERT INTO `sonri-citas`.`treatmenttype`(`name`) VALUES("REHABILITACI�N - OCLUSI�N");
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("D01","Placa de Relaci�n C�ntrica En Acetato",498000,5);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("D02","Placa Miorrelajante en Latex",567140,5);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("D03","Placa Protrusiva o Reposicionadora",668570,5);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("D04","Desprogramador Anterior",231430,5);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("D05","Cita de Tallado Selectivo",50000,5);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("D08","Ajuste de Oclusi�n",120000,5);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("D09","Placa para Levantar Mordida",280000,5);

INSERT INTO `sonri-citas`.`treatmenttype`(`name`) VALUES("CIRUG�A ORAL � EXODONCIA");
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("A10","Extracci�n M�todo Cerrado Simple",71430,6);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("C01","Extracci�n M�todo Abierto Simple",317140,6);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("C02","Extracci�n M�todo Abierto Complejo",400000,6);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("C20","Combo Exodoncia M�todo Abierto x 4",1004290,6);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("C21","Combo Exodoncia Hasta 4 Premolares Paciente en Tto. de Ortodoncia",268570,6);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("D06","Exodoncia Simple(terceros molares erupcionados)",130000,6);

INSERT INTO `sonri-citas`.`treatmenttype`(`name`) VALUES("CIRUG�A ORAL � OTRAS CIRUG�AS");
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("A11","Drenaje Absceso Intraoral",95710,7);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("C03","Remodelado Oseo por Cuadrante (no Incluye Exodoncia)",431000,7);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("C04","Hiperplasias (x Cuadrante)",340000,7);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("C05","Profundizaci�n Reborde (x Cuadrante)",358570,7);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("C06","Capuchones Pericoronarios",230000,7);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("C07","Frenillectom�a Labial",230000,7);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("C08","Frenillectom�a Lingual",244290,7);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("C09","Amputaciones o Hemisecciones Radiculares",444290,7);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("C10","Otras Cirug�as de Tejido Blando",262860,7);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("C11","Reimplantes (sin Endodoncia)",445710,7);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("C12","Excisi�n de Torus Palatino",467140,7);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("C13","Excisi�n de Torus Lingual Bilateral",505710,7);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("C16","Ventana Quir�rgica / Orto (mucosa)",372860,7);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("C17","Ventana Quir�rgica / Orto (osea)",467140,7);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("C19","Biopsia",270000,7);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("C22","Injertos Onlay (vg) + Inlay (cog) (no Incluye Material) Bloque",692860,7);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("C23","Colocaci�n Mini-implante Ortod�ntico",440000,7);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("C25","Elevaci�n de Seno (no Incluye Materiales)",932860,7);

INSERT INTO `sonri-citas`.`treatmenttype`(`name`) VALUES("CIRUG�A ORAL � CIRUG�AS IMPLANTES");
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("I30","Implante Tapered Screw Vent (Fase Quir�rgica)",3327140,8);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("I31","Implante Screw Vent (Fase Quir�rgica)",2800000,8);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("I32","Implante Swiss Plus (Fase Quir�rgica)",3327140,8);

INSERT INTO `sonri-citas`.`treatmenttype`(`name`) VALUES("DIAGN�STICO Y PREVENCI�N - DIAGN�STICO Y ATENCI�N");
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("A01","Examen Cl�nico - Diagnostico",0,9);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("A02","Plan de Tratamiento",0,9);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("A04","Atenci�n Prioritaria en Odontolog�a",125710,9);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("D07","Radiograf�a Oclusal",27140,9);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T01","Modelos de Estudio",41430,9);

INSERT INTO `sonri-citas`.`treatmenttype`(`name`) VALUES("DIAGN�STICO Y PREVENCI�N - PREVENCI�N");
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("A05","Fisioterapia Oral",34290,10);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("A06","Profilaxis",40000,10);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("A07","Aplicaci�n de Fl�or",41430,10);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("A08","Sellantes de Fisura Por Diente",35710,10);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("Pp1","Plan prevenci�n Gingivitis",127140,10);

INSERT INTO `sonri-citas`.`treatmenttype`(`name`) VALUES("ODONTOLOG�A GENERAL - BLANQUEAMIENTO");
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("E11","Blanqueamiento en Gel ( 1 Arcada)",337140,11);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("E14","Blanqueamiento por Luz ( 1 Arcada)",265710,11);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("E16","Blanqueamiento Total Activado por Luz( 2 Arcadas)",472860,11);

INSERT INTO `sonri-citas`.`treatmenttype`(`name`) VALUES("ODONTOLOG�A GENERAL - OBTURACI�N EN AMALGAMA");
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("O01","Obturaci�n 1 Superficie en Amalgama",91430,12);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("O02","Obturaci�n 2 Superficies en Amalgama",128570,12);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("O03","Obturaci�n 3 Superficies en Amalgama",144290,12);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("O04","Obturaci�n 4 Superficies en Amalgama",214290,12);

INSERT INTO `sonri-citas`.`treatmenttype`(`name`) VALUES("ODONTOLOG�A GENERAL - OBTURACI�N EN RESINA");
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("O05","Obturaci�n 1 Sup. Resina Fotocurado Ant.",85710,13);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("O06","Obturaci�n 2 Sup. Resina Fotocurado Ant.",124290,13);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("O07","Obturaci�n 3 Sup. Resina Fotocurado Ant.",151430,13);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("O08","Obturaci�n 4 Sup. Resina Fotocurado Ant.",222860,13);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("O11","Obturaci�n 1 Sup. Resina Fotocurado Post.",105710,13);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("O12","Obturaci�n 2 Sup. Resina Fotocurado Post.",148570,13);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("O13","Obturaci�n 3 Sup. Resina Fotocurado Post.",178570,13);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("O14","Obturaci�n 4 Sup. Resina Fotocurado Post.",248570,13);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("O10","Carillas de Resina",268570,13);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("O09","Comp�mero 1 Superficie",134290,13);

INSERT INTO `sonri-citas`.`treatmenttype`(`name`) VALUES("ODONTOLOG�A GENERAL - OBTURACI�N EN RESINA ALTA EST�TICA");
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("O020","Obturaci�n Resina Est�tica 1 Superficie",178570,14);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("O021","Obturaci�n Resina Est�tica 2 Superficies",198570,14);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("O022","Obturaci�n Resina Est�tica 3 Superficies",245710,14);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("O023","Carilla en Resina Alta Est�tica",341430,14);

INSERT INTO `sonri-citas`.`treatmenttype`(`name`) VALUES("ORTODONCIA - TRATAMIENTO DE ORTODONCIA PREVENTIVA");
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T04","Tratamiento Preventivo (12 Cuotas no Placas)",1260000,15);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T81","Tratamiento Preventivo (Incluye Placa Clarificaci�n B)",1025710,15);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T82","Tratamiento Preventivo (Incluye Placa Clasificaci�n C)",1117140,15);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T83","Tratamiento Preventivo (Incluye Placa Clasificaci�n D)",1161430,15);

INSERT INTO `sonri-citas`.`treatmenttype`(`name`) VALUES("ORTODONCIA - TRATAMIENTO DE ORTODONCIA CORRECTIVA");
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T161","Tto. Correctivo Ortodoncia Turbo 12",4010000,16);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T167","Tto. Correctivo Ortodoncia Turbo 12 Premium",4265710,16);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T163","Tto. Correctivo Ortodoncia Turbo 18",4910000,16);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T179","Tto. Correctivo Ortodoncia Turbo 18 Premium",5067140,16);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T159","Tratamiento Correctivo Speed 18",3024290,16);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T166","Tratamiento Correctivo Speed 18 Premium",3230000,16);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T158","Tratamiento Correctivo Minitin 21",2742860,16);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T164","Tratamiento Correctivo Minitin 21 Premium",2949290,16);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T177","Ortodoncia Americana",2132860,16);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T178","Ortodoncia Americana Premium",2320000,16);

INSERT INTO `sonri-citas`.`treatmenttype`(`name`) VALUES("ORTODONCIA - MEDIOS CASOS");
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T139","Tratamiento Correctivo Ortodoncia Est�ndar Medio Caso",1695710,17);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T140","Tratamiento Correctivo Ortodoncia Speed 18 Medio Caso",1791430,17);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T141","Tratamiento Correctivo Ortodoncia Minitin 21 Medio Caso",1732860,17);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T154","Movimiento Menor De Ortodoncia O Tracci�n Ortod�ntica",1052860,17);

INSERT INTO `sonri-citas`.`treatmenttype`(`name`) VALUES("ORTODONCIA - CONTROLES ADICIONALES");
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T29","Control Adicional Ortodoncia Est�ndar",51430,18);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T84","Control Adicional de T�cnica Roth",68570,18);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T143","Control Adicional de T�cnica MBT",84290,18);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T169","Control Adicional de T�cnica MBT Autoligado",101430,18);

INSERT INTO `sonri-citas`.`treatmenttype`(`name`) VALUES("ORTODONCIA - REPARACI�N BRACKETS");
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T144","Reparaci�n Bracket Est�ndar, Roth y MBT",35710,19);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T156","Reparaci�n Bracket Turbo Autoligado met�lico",97140,19);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T175","Reparaci�n Bracket Cer�mico Roth y MBT",65710,19);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T176","Reparaci�n Bracket Cer�mico MBT Autoligado",105710,19);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T33","Reparaci�n Bracket Cer�mico Est�ndar",61430,19);

INSERT INTO `sonri-citas`.`treatmenttype`(`name`) VALUES("ORTODONCIA - PLACAS");
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("N13","Bionator",575710,20);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("N14","Placa Sup. o Inf. de Planas con Tornillo de Expansi�n",515710,20);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("N15","Placa de Eiseler con Tornillo para Progenie",600000,20);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("N16","Activador de Frankel",691430,20);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("N17","Bimler",691430,20);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T06","Plano Inclinado",310000,20);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T07","Bot�n Palatino",391430,20);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T08","Arco Lingual",391430,20);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T10","Quad-Helix",382860,20);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T11","Rejilla Lingual",382860,20);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T12","Rejilla Lingual con Bot�n de Nance",431430,20);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T14","Bompereta Labial",391430,20);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T18","Barra Traspalatina",300000,20);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T27","Retenedor Superior o Inferior (Hawley, fijo, est�tico)",210000,20);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T35","Placa Hawley con Tornillo de Protusi�n o Distalaci�n",358570,20);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T36","Bolideglutor",320000,20);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T37","Reganadores de Espacio (Benack o Setlin)",391430,20);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T38","Bihelix",300000,20);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T39","Hyrax",691430,20);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T40","Fliper",358570,20);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T41","P�ndulo",391430,20);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T42","Pendx",408570,20);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T43","Twin Block",591430,20);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T44","F�rula de Magnamara con Tornillo de Expansi�n",665710,20);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T45","Simoes Network I, II, III y IV",498570,20);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T46","Kinetor de Stockfish",581430,20);

INSERT INTO `sonri-citas`.`treatmenttype`(`name`) VALUES("ORTODONCIA - OTROS");
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T23","Reparaci�n Aparato Ortopedia",92860,21);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("T52","Retiro de Brackets",135710,21);

INSERT INTO `sonri-citas`.`treatmenttype`(`name`) VALUES("ODONTOPEDIATR�A - PREVENCI�N");
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("N01","Adaptaci�n por Sesi�n",30000,22);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("N22","Profilaxis Pedi�trico",35710,22);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("N23","Paquete Preventivo",190000,22);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("N24","Obturaci�n Resina Preventiva (Incluye Sellantes)",54290,22);

INSERT INTO `sonri-citas`.`treatmenttype`(`name`) VALUES("ODONTOPEDIATR�A - OBTURACI�N RESINAS");
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("N02","Obturaci�n Temporales en Resina",100000,23);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("N03","Obturaci�n Temporales en Compomero",114290,23);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("N05","Carilla en Resina",255710,23);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("N06","Resinas en Forma Pl�stica",212860,23);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("N25","Obturaci�n 1 Superficie Diente Temporal en Resina",82860,23);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("N26","Obturaci�n 2 Superficie o + Diente Temporal en Resina",98570,23);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("N27","Obturaci�n 1 Superficie Diente Temporal en Amalgama",60000,23);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("N28","Obturaci�n 2 Superficie o + Diente Temporal en Amalgama",75710,23);

INSERT INTO `sonri-citas`.`treatmenttype`(`name`) VALUES("ODONTOPEDIATR�A - CIRUG�A");
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("N29","Exodoncia Simple en Diente Temporal",48570,24);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("N30","Exodoncia de Ra�ces",65710,24);

INSERT INTO `sonri-citas`.`treatmenttype`(`name`) VALUES("ODONTOPEDIATR�A - ENDODONCIA");
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("N18","Endodoncia en Dientes Unitemporales",135710,25);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("N19","Endodoncia en Dientes Multitemporales",167140,25);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("N20","Pulpotomia en Dientes Temporales",115710,25);

INSERT INTO `sonri-citas`.`treatmenttype`(`name`) VALUES("ODONTOPEDIATR�A - OTROS");
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("N07","Mantenedor de Espacios Unilateral",284570,26);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("N08","Placa Est�tica",437140,26);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("N09","Corona Metal no Precioso",114290,26);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("N10","Corona de Policarboxilato",125710,26);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("N31","Control de Placa Ortop�dica",57140,26);

INSERT INTO `sonri-citas`.`treatmenttype`(`name`) VALUES("PERIODONCIA");
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("P01","Remoci�n C�lculos Supra. (x Cuadrante)",85710,27);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("P02","Remoci�n de C�lculos Sub. (x Cuadrante)",160000,27);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("P03","Gingivoplastia o Gingivectomia (x Cuadrante)",284430,27);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("P04","Curetaje a Campo Abierto (x Cuadrante)",404290,27);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("P05","Cirug�a Mucogingival para Cubrimento de Recesi�n",340000,27);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("P06","Cirug�a Mucogingival para Manejo de Rebordes",608570,27);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("P08","Colocaci�n de Membranas Reabsorvibles (no Incluye Membrana)",455710,27);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("P09","Alargamiento Corona Cl�nica sin Osteotomia (x Diente)",268570,27);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("P10","Alargamiento Corona Cl�nica con Osteotomia (x Diente)",397140,27);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("P11","Cu�a Distal o Mesial por Diente",290000,27);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("P12","Regeneraci�n Osea Guiada (Gbr- Sp) Injerto Oseo Particulado (sin Material)",412860,27);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("P13","Control Quirurgico",75710,27);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("P15","Gingivoplastia o Gingivectomia x Sextante de 1 a 3 Dientes)",217140,27);

INSERT INTO `sonri-citas`.`treatmenttype`(`name`) VALUES("ENDODONCIA");
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("E01","En Dientes Unirradiculares",244290,28);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("E02","En Dientes Birradiculares",388570,28);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("E03","En Dientes Multirradiculares",475710,28);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("E04","Apexificaciones",425710,28);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("E05","Apexogenesis",435710,28);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("E06","Desobturaciones (x Diente)",118570,28);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("E07","Ferulizaci�n",288570,28);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("E08","Reparaci�n Perforaciones",247140,28);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("E09","Apicectom�a Inferiores",608570,28);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("E10","Apicectom�a Posteriores",608570,28);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("E13","Blanqueamiento Dientes no Vitales(ses)",185710,28);

INSERT INTO `sonri-citas`.`treatmenttype`(`name`) VALUES("VENTA DIRECTA");
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("105","El�sticos de Ortodoncia 3/16",3000,29);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("107","Reposici�n de Tarjeta Sonr�a",7000,29);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("114","Fisioterapia Oral de Ortodoncia (kit)",36000,29);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("118","Posicionadores",95000,29);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("119","Arco Tracci�n Extraoral",35000,29);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("121","Fisioterapia Retenedores (cajita)",8000,29);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("122","Fisioterapias Preventiva (kit Pedi�trico)",18000,29);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("131","Tarjeta Sonr�a",33000,29);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("190","Tarjeta Familiar",84000,29);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("191","Tarjeta Familiar (teniendo La Individual)",54000,29);
INSERT INTO `sonri-citas`.`treatment`(`code`,`name`,`price`,`id_treatmenttype`) VALUES("106","A Radiograf�a Periapicales (Paciente Particular)",7000,29);
