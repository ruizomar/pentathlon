DROP TABLE IF EXISTS arrestos;

CREATE TABLE `arrestos` (
  `id` varchar(45) NOT NULL,
  `arrestado` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `motivo` varchar(45) DEFAULT NULL,
  `matriculaarrestador` varchar(45) DEFAULT NULL,
  `matricula_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`,`arrestado`),
  KEY `fk_arrestos_elementos1_idx` (`arrestado`),
  KEY `fk_arrestos_matriculas1_idx` (`matricula_id`),
  CONSTRAINT `fk_arrestos_elementos1` FOREIGN KEY (`arrestado`) REFERENCES `elementos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_arrestos_matriculas1` FOREIGN KEY (`matricula_id`) REFERENCES `matriculas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS ascensos;

CREATE TABLE `ascensos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grado_id` int(11) NOT NULL,
  `elemento_id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id`,`elemento_id`,`grado_id`),
  KEY `fk_ascensos_grados1_idx` (`grado_id`),
  KEY `fk_ascensos_elementos1_idx` (`elemento_id`),
  CONSTRAINT `fk_ascensos_elementos1` FOREIGN KEY (`elemento_id`) REFERENCES `elementos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_ascensos_grados1` FOREIGN KEY (`grado_id`) REFERENCES `grados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=231 DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS asistencias;

CREATE TABLE `asistencias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `companiasysubzona_id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `tipo` int(1) DEFAULT NULL,
  `elemento_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`elemento_id`),
  KEY `fk_asistencias_elementos1_idx` (`elemento_id`),
  KEY `fk_asistencias_companiasysubzonas1_idx` (`companiasysubzona_id`),
  CONSTRAINT `fk_asistencias_companiasysubzonas1` FOREIGN KEY (`companiasysubzona_id`) REFERENCES `companiasysubzonas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_asistencias_elementos1` FOREIGN KEY (`elemento_id`) REFERENCES `elementos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS cargo_elemento;

CREATE TABLE `cargo_elemento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `cargo_id` int(11) NOT NULL,
  `elemento_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cargosobtenido_cargos1_idx` (`cargo_id`),
  KEY `fk_cargosobtenido_elementos1` (`elemento_id`),
  CONSTRAINT `fk_cargosobtenido_cargos1` FOREIGN KEY (`cargo_id`) REFERENCES `cargos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_cargosobtenido_elementos1` FOREIGN KEY (`elemento_id`) REFERENCES `elementos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS cargos;

CREATE TABLE `cargos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS companiasysubzonas;

CREATE TABLE `companiasysubzonas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS concursantes;

CREATE TABLE `concursantes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `paterno` varchar(45) DEFAULT NULL,
  `materno` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `escuela` varchar(45) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `evento_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_concursantes_eventos1_idx` (`evento_id`),
  CONSTRAINT `fk_concursantes_eventos1` FOREIGN KEY (`evento_id`) REFERENCES `eventos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS documentos;

CREATE TABLE `documentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `elemento_id` int(11) NOT NULL,
  `ruta` varchar(45) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_documentos_elementos1_idx` (`elemento_id`),
  CONSTRAINT `fk_documentos_elementos1` FOREIGN KEY (`elemento_id`) REFERENCES `elementos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=691 DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS donativos;

CREATE TABLE `donativos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `paterno` varchar(45) NOT NULL,
  `materno` varchar(45) NOT NULL,
  `donativo` int(6) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS elemento_evento;

CREATE TABLE `elemento_evento` (
  `elemento_id` int(11) NOT NULL,
  `evento_id` int(11) NOT NULL,
  PRIMARY KEY (`elemento_id`,`evento_id`),
  KEY `fk_elementos_has_eventos_eventos1_idx` (`evento_id`),
  KEY `fk_elementos_has_eventos_elementos1_idx` (`elemento_id`),
  CONSTRAINT `fk_elementos_has_eventos_elementos1` FOREIGN KEY (`elemento_id`) REFERENCES `elementos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_elementos_has_eventos_eventos1` FOREIGN KEY (`evento_id`) REFERENCES `eventos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS elemento_examen;

CREATE TABLE `elemento_examen` (
  `elemento_id` int(11) NOT NULL,
  `examen_id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `calificacion` int(11) DEFAULT NULL,
  PRIMARY KEY (`elemento_id`,`examen_id`),
  KEY `fk_elementos_has_examens_examens1_idx` (`examen_id`),
  KEY `fk_elementos_has_examens_elementos1_idx` (`elemento_id`),
  CONSTRAINT `fk_elementos_has_examens_elementos1` FOREIGN KEY (`elemento_id`) REFERENCES `elementos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_elementos_has_examens_examens1` FOREIGN KEY (`examen_id`) REFERENCES `examens` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS elementos;

CREATE TABLE `elementos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `persona_id` int(11) NOT NULL,
  `estatura` int(11) DEFAULT NULL,
  `peso` int(11) DEFAULT NULL,
  `ocupacion` varchar(45) DEFAULT NULL,
  `estadocivil` varchar(45) DEFAULT NULL,
  `fechanacimiento` date DEFAULT NULL,
  `escolaridad` varchar(45) DEFAULT NULL,
  `escuela` varchar(45) DEFAULT NULL,
  `fechaingreso` date DEFAULT NULL,
  `lugarnacimiento` varchar(45) DEFAULT NULL,
  `curp` varchar(45) DEFAULT NULL,
  `calle` varchar(45) DEFAULT NULL,
  `colonia` varchar(45) DEFAULT NULL,
  `cp` varchar(45) DEFAULT NULL,
  `municipio` varchar(45) DEFAULT NULL,
  `reclutamiento` int(11) DEFAULT NULL,
  `alergias` varchar(45) DEFAULT NULL,
  `adiccion` varchar(45) DEFAULT NULL,
  `tipoarma_id` int(11) NOT NULL,
  `tipocuerpo_id` int(11) NOT NULL,
  `companiasysubzona_id` int(11) NOT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `tiposangre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`,`persona_id`),
  KEY `fk_elementos_personas1_idx` (`persona_id`),
  KEY `fk_elementos_armas1_idx` (`tipoarma_id`),
  KEY `fk_elementos_cuerpos1_idx` (`tipocuerpo_id`),
  KEY `fk_elementos_companiasysubzonas1_idx` (`companiasysubzona_id`),
  CONSTRAINT `fk_elementos_armas1` FOREIGN KEY (`tipoarma_id`) REFERENCES `tipoarmas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_elementos_companiasysubzonas1` FOREIGN KEY (`companiasysubzona_id`) REFERENCES `companiasysubzonas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_elementos_cuerpos1` FOREIGN KEY (`tipocuerpo_id`) REFERENCES `tipocuerpos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_elementos_personas1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=231 DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS emails;

CREATE TABLE `emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `persona_id` int(11) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`,`persona_id`),
  KEY `fk_emails_personas1_idx` (`persona_id`),
  CONSTRAINT `fk_emails_personas1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS eventos;

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `lugar` varchar(45) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `precio` int(11) DEFAULT NULL,
  `tipoevento_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_eventos_tipoeventos1_idx` (`tipoevento_id`),
  CONSTRAINT `fk_eventos_tipoeventos1` FOREIGN KEY (`tipoevento_id`) REFERENCES `tipoeventos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS examens;

CREATE TABLE `examens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `grado_id` int(11) NOT NULL DEFAULT '0',
  `precio` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`grado_id`),
  KEY `fk_examens_grados1_idx` (`grado_id`),
  CONSTRAINT `fk_examens_grados1` FOREIGN KEY (`grado_id`) REFERENCES `grados` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS facebooks;

CREATE TABLE `facebooks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `persona_id` int(11) NOT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`,`persona_id`),
  KEY `fk_Facebooks_personas1_idx` (`persona_id`),
  CONSTRAINT `fk_Facebooks_personas1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS grados;

CREATE TABLE `grados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `imagen` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS matriculas;

CREATE TABLE `matriculas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `elemento_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_matriculas_elementos1_idx` (`elemento_id`),
  CONSTRAINT `fk_matriculas_elementos1` FOREIGN KEY (`elemento_id`) REFERENCES `elementos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20801063079 DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS pagos;

CREATE TABLE `pagos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `elemento_id` int(11) NOT NULL,
  `concepto` varchar(45) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `cantidad` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pagos_elementos1_idx` (`elemento_id`),
  CONSTRAINT `fk_pagos_elementos1` FOREIGN KEY (`elemento_id`) REFERENCES `elementos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=235 DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS personas;

CREATE TABLE `personas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `apellidopaterno` varchar(45) DEFAULT NULL,
  `apellidomaterno` varchar(45) DEFAULT NULL,
  `sexo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=461 DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS reconocimientos;

CREATE TABLE `reconocimientos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `elemento_id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `lugar` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`,`elemento_id`),
  KEY `fk_reconocimientos_elementos1_idx` (`elemento_id`),
  CONSTRAINT `fk_reconocimientos_elementos1` FOREIGN KEY (`elemento_id`) REFERENCES `elementos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS reminders;

CREATE TABLE `reminders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` varchar(100) NOT NULL,
  `token_live` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_reminder_user1` (`user_id`),
  CONSTRAINT `fk_reminder_user1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS role_user;

CREATE TABLE `role_user` (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`role_id`,`user_id`),
  KEY `fk_roles_has_usuarios_usuarios1_idx` (`user_id`),
  KEY `fk_roles_has_usuarios_roles1_idx` (`role_id`),
  CONSTRAINT `fk_roles_has_usuarios_roles1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_roles_has_usuarios_usuarios1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS roles;

CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS status;

CREATE TABLE `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `elemento_id` int(11) NOT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `inicio` date DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`,`elemento_id`),
  KEY `fk_status_elementos1_idx` (`elemento_id`),
  CONSTRAINT `fk_status_elementos1` FOREIGN KEY (`elemento_id`) REFERENCES `elementos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=231 DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS telefonos;

CREATE TABLE `telefonos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `persona_id` int(11) NOT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`,`persona_id`),
  KEY `fk_telefonos_personas1_idx` (`persona_id`),
  CONSTRAINT `fk_telefonos_personas1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS tipoarmas;

CREATE TABLE `tipoarmas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS tipocuerpos;

CREATE TABLE `tipocuerpos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS tipoeventos;

CREATE TABLE `tipoeventos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS tutores;

CREATE TABLE `tutores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `persona_id` int(11) NOT NULL,
  `elemento_id` int(11) NOT NULL,
  `relacion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tutores_personas1_idx` (`persona_id`),
  KEY `fk_tutores_elementos1_idx` (`elemento_id`),
  CONSTRAINT `fk_tutores_elementos1` FOREIGN KEY (`elemento_id`) REFERENCES `elementos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tutores_personas1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=231 DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS twitters;

CREATE TABLE `twitters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `persona_id` int(11) NOT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`,`persona_id`),
  KEY `fk_twitters_personas1_idx` (`persona_id`),
  CONSTRAINT `fk_twitters_personas1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS users;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `elemento_id` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`,`elemento_id`),
  KEY `fk_usuarios_elementos1_idx` (`elemento_id`),
  CONSTRAINT `fk_usuarios_elementos1` FOREIGN KEY (`elemento_id`) REFERENCES `elementos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=231 DEFAULT CHARSET=utf8;




INSERT INTO ascensos VALUES("1","2","1","2013-06-30");
INSERT INTO ascensos VALUES("2","5","2","2013-05-11");
INSERT INTO ascensos VALUES("3","2","3","2013-06-30");
INSERT INTO ascensos VALUES("4","2","4","2013-06-30");
INSERT INTO ascensos VALUES("5","2","5","2013-06-30");
INSERT INTO ascensos VALUES("6","2","6","2013-06-30");
INSERT INTO ascensos VALUES("7","2","7","2013-06-30");
INSERT INTO ascensos VALUES("8","2","8","2013-06-30");
INSERT INTO ascensos VALUES("9","2","9","2013-06-30");
INSERT INTO ascensos VALUES("10","2","10","2013-06-30");
INSERT INTO ascensos VALUES("11","2","11","2013-06-30");
INSERT INTO ascensos VALUES("12","2","12","2013-06-30");
INSERT INTO ascensos VALUES("13","2","13","2013-06-30");
INSERT INTO ascensos VALUES("14","2","14","2013-06-30");
INSERT INTO ascensos VALUES("15","2","15","2013-06-30");
INSERT INTO ascensos VALUES("16","2","16","2013-06-30");
INSERT INTO ascensos VALUES("17","2","17","2013-06-30");
INSERT INTO ascensos VALUES("18","2","18","2013-06-30");
INSERT INTO ascensos VALUES("19","2","19","2013-06-30");
INSERT INTO ascensos VALUES("20","2","20","2013-06-30");
INSERT INTO ascensos VALUES("21","2","21","2013-06-30");
INSERT INTO ascensos VALUES("22","2","22","2013-06-30");
INSERT INTO ascensos VALUES("23","2","23","2013-06-30");
INSERT INTO ascensos VALUES("24","2","24","2013-06-30");
INSERT INTO ascensos VALUES("25","2","25","2013-06-30");
INSERT INTO ascensos VALUES("26","2","26","2013-06-30");
INSERT INTO ascensos VALUES("27","2","27","2013-06-30");
INSERT INTO ascensos VALUES("28","2","28","2013-06-30");
INSERT INTO ascensos VALUES("29","2","29","2013-06-30");
INSERT INTO ascensos VALUES("30","2","30","2013-06-30");
INSERT INTO ascensos VALUES("31","4","31","2013-06-30");
INSERT INTO ascensos VALUES("32","2","32","2013-06-30");
INSERT INTO ascensos VALUES("33","2","33","2013-06-30");
INSERT INTO ascensos VALUES("34","2","34","2013-06-30");
INSERT INTO ascensos VALUES("35","2","35","2013-06-30");
INSERT INTO ascensos VALUES("36","2","36","2013-06-30");
INSERT INTO ascensos VALUES("37","2","37","2013-06-30");
INSERT INTO ascensos VALUES("38","2","38","2013-06-30");
INSERT INTO ascensos VALUES("39","2","39","2013-06-30");
INSERT INTO ascensos VALUES("40","2","40","2013-06-30");
INSERT INTO ascensos VALUES("41","2","41","2013-06-30");
INSERT INTO ascensos VALUES("42","2","42","2013-06-30");
INSERT INTO ascensos VALUES("43","2","43","2013-06-30");
INSERT INTO ascensos VALUES("44","2","44","2013-06-30");
INSERT INTO ascensos VALUES("45","2","45","2013-06-30");
INSERT INTO ascensos VALUES("46","2","46","2013-06-30");
INSERT INTO ascensos VALUES("47","2","47","2013-06-30");
INSERT INTO ascensos VALUES("48","2","48","2013-06-30");
INSERT INTO ascensos VALUES("49","2","49","2013-06-30");
INSERT INTO ascensos VALUES("50","2","50","2013-06-30");
INSERT INTO ascensos VALUES("51","2","51","2013-06-30");
INSERT INTO ascensos VALUES("52","2","52","2013-06-30");
INSERT INTO ascensos VALUES("53","2","53","2013-06-30");
INSERT INTO ascensos VALUES("54","2","54","2013-06-30");
INSERT INTO ascensos VALUES("55","2","55","2013-06-30");
INSERT INTO ascensos VALUES("56","2","56","2013-06-30");
INSERT INTO ascensos VALUES("57","2","57","2013-06-30");
INSERT INTO ascensos VALUES("58","2","58","2013-06-30");
INSERT INTO ascensos VALUES("59","2","59","2013-06-30");
INSERT INTO ascensos VALUES("60","2","60","2013-06-30");
INSERT INTO ascensos VALUES("61","2","61","2013-06-30");
INSERT INTO ascensos VALUES("62","2","62","2013-06-30");
INSERT INTO ascensos VALUES("63","2","63","2013-06-30");
INSERT INTO ascensos VALUES("64","2","64","2013-06-30");
INSERT INTO ascensos VALUES("65","2","65","2013-06-30");
INSERT INTO ascensos VALUES("66","2","66","2013-06-30");
INSERT INTO ascensos VALUES("67","2","67","2013-06-30");
INSERT INTO ascensos VALUES("68","2","68","2013-06-30");
INSERT INTO ascensos VALUES("69","2","69","2013-06-30");
INSERT INTO ascensos VALUES("70","2","70","2013-06-30");
INSERT INTO ascensos VALUES("71","2","71","2013-06-30");
INSERT INTO ascensos VALUES("72","2","72","2013-06-30");
INSERT INTO ascensos VALUES("73","2","73","2013-06-30");
INSERT INTO ascensos VALUES("74","2","74","2013-06-30");
INSERT INTO ascensos VALUES("75","2","75","2013-06-30");
INSERT INTO ascensos VALUES("76","2","76","2013-06-30");
INSERT INTO ascensos VALUES("77","2","77","2013-06-30");
INSERT INTO ascensos VALUES("78","4","78","2013-06-30");
INSERT INTO ascensos VALUES("79","2","79","2013-06-30");
INSERT INTO ascensos VALUES("80","2","80","2013-06-30");
INSERT INTO ascensos VALUES("81","2","81","2013-06-30");
INSERT INTO ascensos VALUES("82","2","82","2013-06-30");
INSERT INTO ascensos VALUES("83","2","83","2013-06-30");
INSERT INTO ascensos VALUES("84","2","84","2013-06-30");
INSERT INTO ascensos VALUES("85","2","85","2013-06-30");
INSERT INTO ascensos VALUES("86","2","86","2013-06-30");
INSERT INTO ascensos VALUES("87","2","87","2013-06-30");
INSERT INTO ascensos VALUES("88","2","88","2013-06-30");
INSERT INTO ascensos VALUES("89","2","89","2013-06-30");
INSERT INTO ascensos VALUES("90","2","90","2013-06-30");
INSERT INTO ascensos VALUES("91","2","91","2013-06-30");
INSERT INTO ascensos VALUES("92","2","92","2013-06-30");
INSERT INTO ascensos VALUES("93","2","93","2013-06-30");
INSERT INTO ascensos VALUES("94","2","94","2013-06-30");
INSERT INTO ascensos VALUES("95","2","95","2013-06-30");
INSERT INTO ascensos VALUES("96","2","96","2013-06-30");
INSERT INTO ascensos VALUES("97","2","97","2013-06-30");
INSERT INTO ascensos VALUES("98","2","98","2013-06-30");
INSERT INTO ascensos VALUES("99","2","99","2013-06-30");
INSERT INTO ascensos VALUES("100","2","100","2013-06-30");
INSERT INTO ascensos VALUES("101","2","101","2013-06-30");
INSERT INTO ascensos VALUES("102","2","102","2013-06-30");
INSERT INTO ascensos VALUES("103","2","103","2013-06-30");
INSERT INTO ascensos VALUES("104","2","104","2013-06-30");
INSERT INTO ascensos VALUES("105","2","105","2013-06-30");
INSERT INTO ascensos VALUES("106","2","106","2013-06-30");
INSERT INTO ascensos VALUES("107","2","107","2013-06-30");
INSERT INTO ascensos VALUES("108","2","108","2013-06-30");
INSERT INTO ascensos VALUES("109","2","109","2013-06-30");
INSERT INTO ascensos VALUES("110","2","110","2013-06-30");
INSERT INTO ascensos VALUES("111","2","111","2013-06-30");
INSERT INTO ascensos VALUES("112","2","112","2013-06-30");
INSERT INTO ascensos VALUES("113","2","113","2013-06-30");
INSERT INTO ascensos VALUES("114","2","114","2013-06-30");
INSERT INTO ascensos VALUES("115","2","115","2013-06-30");
INSERT INTO ascensos VALUES("116","2","116","2013-06-30");
INSERT INTO ascensos VALUES("117","2","117","2013-06-30");
INSERT INTO ascensos VALUES("118","2","118","2013-06-30");
INSERT INTO ascensos VALUES("119","2","119","2013-06-30");
INSERT INTO ascensos VALUES("120","2","120","2013-06-30");
INSERT INTO ascensos VALUES("121","2","121","2013-06-30");
INSERT INTO ascensos VALUES("122","2","122","2013-06-30");
INSERT INTO ascensos VALUES("123","2","123","2013-06-30");
INSERT INTO ascensos VALUES("124","2","124","2013-06-30");
INSERT INTO ascensos VALUES("125","2","125","2013-06-30");
INSERT INTO ascensos VALUES("126","2","126","2013-06-30");
INSERT INTO ascensos VALUES("127","2","127","2013-06-30");
INSERT INTO ascensos VALUES("128","2","128","2013-06-30");
INSERT INTO ascensos VALUES("129","2","129","2013-06-30");
INSERT INTO ascensos VALUES("130","2","130","2013-06-30");
INSERT INTO ascensos VALUES("131","2","131","2013-06-30");
INSERT INTO ascensos VALUES("132","2","132","2013-06-30");
INSERT INTO ascensos VALUES("133","2","133","2013-06-30");
INSERT INTO ascensos VALUES("134","2","134","2013-06-30");
INSERT INTO ascensos VALUES("135","2","135","2013-06-30");
INSERT INTO ascensos VALUES("136","2","136","2013-06-30");
INSERT INTO ascensos VALUES("137","2","137","2013-06-30");
INSERT INTO ascensos VALUES("138","2","138","2013-06-30");
INSERT INTO ascensos VALUES("139","2","139","2013-06-30");
INSERT INTO ascensos VALUES("140","2","140","2013-06-30");
INSERT INTO ascensos VALUES("141","2","141","2013-06-30");
INSERT INTO ascensos VALUES("142","2","142","2013-06-30");
INSERT INTO ascensos VALUES("143","2","143","2013-06-30");
INSERT INTO ascensos VALUES("144","2","144","2013-06-30");
INSERT INTO ascensos VALUES("145","2","145","2013-06-30");
INSERT INTO ascensos VALUES("146","2","146","2013-06-30");
INSERT INTO ascensos VALUES("147","2","147","2013-06-30");
INSERT INTO ascensos VALUES("148","2","148","2013-06-30");
INSERT INTO ascensos VALUES("149","2","149","2013-06-30");
INSERT INTO ascensos VALUES("150","2","150","2013-06-30");
INSERT INTO ascensos VALUES("151","2","151","2013-06-30");
INSERT INTO ascensos VALUES("152","2","152","2013-06-30");
INSERT INTO ascensos VALUES("153","2","153","2013-06-30");
INSERT INTO ascensos VALUES("154","2","154","2013-06-30");
INSERT INTO ascensos VALUES("155","2","155","2013-06-30");
INSERT INTO ascensos VALUES("156","2","156","2013-06-30");
INSERT INTO ascensos VALUES("157","2","157","2013-06-30");
INSERT INTO ascensos VALUES("158","2","158","2013-06-30");
INSERT INTO ascensos VALUES("159","2","159","2013-06-30");
INSERT INTO ascensos VALUES("160","2","160","2013-06-30");
INSERT INTO ascensos VALUES("161","2","161","2013-06-30");
INSERT INTO ascensos VALUES("162","2","162","2013-06-30");
INSERT INTO ascensos VALUES("163","2","163","2013-06-30");
INSERT INTO ascensos VALUES("164","2","164","2013-06-30");
INSERT INTO ascensos VALUES("165","2","165","2013-06-30");
INSERT INTO ascensos VALUES("166","2","166","2013-06-30");
INSERT INTO ascensos VALUES("167","2","167","2013-06-30");
INSERT INTO ascensos VALUES("168","2","168","2013-06-30");
INSERT INTO ascensos VALUES("169","2","169","2013-06-30");
INSERT INTO ascensos VALUES("170","2","170","2013-06-30");
INSERT INTO ascensos VALUES("171","2","171","2013-06-30");
INSERT INTO ascensos VALUES("172","2","172","2013-06-30");
INSERT INTO ascensos VALUES("173","2","173","2013-06-30");
INSERT INTO ascensos VALUES("174","2","174","2013-06-30");
INSERT INTO ascensos VALUES("175","2","175","2013-06-30");
INSERT INTO ascensos VALUES("176","2","176","2013-06-30");
INSERT INTO ascensos VALUES("177","2","177","2013-06-30");
INSERT INTO ascensos VALUES("178","2","178","2013-06-30");
INSERT INTO ascensos VALUES("179","2","179","2013-06-30");
INSERT INTO ascensos VALUES("180","2","180","2013-06-30");
INSERT INTO ascensos VALUES("181","2","181","2013-06-30");
INSERT INTO ascensos VALUES("182","2","182","2013-06-30");
INSERT INTO ascensos VALUES("183","2","183","2013-06-30");
INSERT INTO ascensos VALUES("184","2","184","2013-06-30");
INSERT INTO ascensos VALUES("185","2","185","2013-06-30");
INSERT INTO ascensos VALUES("186","2","186","2013-06-30");
INSERT INTO ascensos VALUES("187","2","187","2013-06-30");
INSERT INTO ascensos VALUES("188","2","188","2013-06-30");
INSERT INTO ascensos VALUES("189","2","189","2013-06-30");
INSERT INTO ascensos VALUES("190","2","190","2013-06-30");
INSERT INTO ascensos VALUES("191","2","191","2013-06-30");
INSERT INTO ascensos VALUES("192","2","192","2013-06-30");
INSERT INTO ascensos VALUES("193","2","193","2013-06-30");
INSERT INTO ascensos VALUES("194","2","194","2013-06-30");
INSERT INTO ascensos VALUES("195","2","195","2013-06-30");
INSERT INTO ascensos VALUES("196","2","196","2013-06-30");
INSERT INTO ascensos VALUES("197","2","197","2013-06-30");
INSERT INTO ascensos VALUES("198","2","198","2013-06-30");
INSERT INTO ascensos VALUES("199","2","199","2013-06-30");
INSERT INTO ascensos VALUES("200","2","200","2013-06-30");
INSERT INTO ascensos VALUES("201","2","201","2013-06-30");
INSERT INTO ascensos VALUES("202","2","202","2013-06-30");
INSERT INTO ascensos VALUES("203","2","203","2013-06-30");
INSERT INTO ascensos VALUES("204","2","204","2013-06-30");
INSERT INTO ascensos VALUES("205","2","205","2013-06-30");
INSERT INTO ascensos VALUES("206","2","206","2013-06-30");
INSERT INTO ascensos VALUES("207","2","207","2013-06-30");
INSERT INTO ascensos VALUES("208","2","208","2013-06-30");
INSERT INTO ascensos VALUES("209","2","209","2013-06-30");
INSERT INTO ascensos VALUES("210","2","210","2013-06-30");
INSERT INTO ascensos VALUES("211","2","211","2013-06-30");
INSERT INTO ascensos VALUES("212","2","212","2013-06-30");
INSERT INTO ascensos VALUES("213","2","213","2013-06-30");
INSERT INTO ascensos VALUES("214","2","214","2013-06-30");
INSERT INTO ascensos VALUES("215","2","215","2013-06-30");
INSERT INTO ascensos VALUES("216","2","216","2013-06-30");
INSERT INTO ascensos VALUES("217","2","217","2013-06-30");
INSERT INTO ascensos VALUES("218","2","218","2013-06-30");
INSERT INTO ascensos VALUES("219","2","219","2013-06-30");
INSERT INTO ascensos VALUES("220","2","220","2013-06-30");
INSERT INTO ascensos VALUES("221","2","221","2013-06-30");
INSERT INTO ascensos VALUES("222","2","222","2013-06-30");
INSERT INTO ascensos VALUES("223","2","223","2013-06-30");
INSERT INTO ascensos VALUES("224","2","224","2013-06-30");
INSERT INTO ascensos VALUES("225","2","225","2013-06-30");
INSERT INTO ascensos VALUES("226","2","226","2013-06-30");
INSERT INTO ascensos VALUES("227","2","227","2013-06-30");
INSERT INTO ascensos VALUES("228","2","228","2013-06-30");
INSERT INTO ascensos VALUES("229","9","229","1988-03-12");
INSERT INTO ascensos VALUES("230","13","230","2013-09-09");
INSERT INTO cargo_elemento VALUES("1","2013-10-16","","1","229");
INSERT INTO cargo_elemento VALUES("2","0000-00-00","","8","230");
INSERT INTO cargo_elemento VALUES("8","2015-01-16","2015-01-17","11","1");
INSERT INTO cargo_elemento VALUES("15","2015-01-16","2015-01-17","11","1");
INSERT INTO cargo_elemento VALUES("16","2015-01-17","","11","229");
INSERT INTO cargos VALUES("1","Sección de hacienda");
INSERT INTO cargos VALUES("2","Sección tecnica");
INSERT INTO cargos VALUES("3","Sección militar");
INSERT INTO cargos VALUES("4","Sección deportiva");
INSERT INTO cargos VALUES("5","Sección de investigacion y estadistica");
INSERT INTO cargos VALUES("6","Sección de organizacion y propaganda");
INSERT INTO cargos VALUES("7","Sección de Archivo y detalle");
INSERT INTO cargos VALUES("8","Comandante de zona");
INSERT INTO cargos VALUES("9","Comandante de compañia");
INSERT INTO cargos VALUES("10","Comandante de cuerpos especiales");
INSERT INTO cargos VALUES("11","Instructor");
INSERT INTO companiasysubzonas VALUES("1","Flores Magón","Compañía","Activa");
INSERT INTO companiasysubzonas VALUES("2","Tecnológico","Compañia","Activa");
INSERT INTO companiasysubzonas VALUES("3","Unidad deportiva C.U.","Compañia","Activa");
INSERT INTO companiasysubzonas VALUES("4","pendiente","Compañia","Activa");
INSERT INTO companiasysubzonas VALUES("5","Unidad deportiva Carlos Gracida","Compañia","Activa");
INSERT INTO companiasysubzonas VALUES("6","Cuilapam","Compañia","Activa");
INSERT INTO companiasysubzonas VALUES("7","Canteras","Compañia","Activa");
INSERT INTO companiasysubzonas VALUES("8","Huajupan","Zubzona","Activa");
INSERT INTO companiasysubzonas VALUES("9","Nochixtlan","Zubzona","Activa");
INSERT INTO companiasysubzonas VALUES("10","Tlacolula","Zubzona","Activa");
INSERT INTO companiasysubzonas VALUES("11","Ocotlan","Zubzona","Activa");
INSERT INTO companiasysubzonas VALUES("12","Policia Militar","Compañia","Activa");
INSERT INTO companiasysubzonas VALUES("13","Estado Mayor","Compañia","Activa");
INSERT INTO companiasysubzonas VALUES("14","Ejemplo","Subzona","Activa");
INSERT INTO documentos VALUES("461","1","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("462","2","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("463","3","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("464","4","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("465","5","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("466","6","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("467","7","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("468","8","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("469","9","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("470","10","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("471","11","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("472","12","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("473","13","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("474","14","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("475","15","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("476","16","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("477","17","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("478","18","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("479","19","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("480","20","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("481","21","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("482","22","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("483","23","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("484","24","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("485","25","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("486","26","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("487","27","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("488","28","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("489","29","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("490","30","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("491","31","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("492","32","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("493","33","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("494","34","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("495","35","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("496","36","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("497","37","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("498","38","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("499","39","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("500","40","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("501","41","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("502","42","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("503","43","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("504","44","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("505","45","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("506","46","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("507","47","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("508","48","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("509","49","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("510","50","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("511","51","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("512","52","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("513","53","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("514","54","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("515","55","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("516","56","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("517","57","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("518","58","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("519","59","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("520","60","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("521","61","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("522","62","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("523","63","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("524","64","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("525","65","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("526","66","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("527","67","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("528","68","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("529","69","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("530","70","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("531","71","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("532","72","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("533","73","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("534","74","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("535","75","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("536","76","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("537","77","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("538","78","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("539","79","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("540","80","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("541","81","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("542","82","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("543","83","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("544","84","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("545","85","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("546","86","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("547","87","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("548","88","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("549","89","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("550","90","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("551","91","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("552","92","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("553","93","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("554","94","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("555","95","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("556","96","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("557","97","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("558","98","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("559","99","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("560","100","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("561","101","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("562","102","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("563","103","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("564","104","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("565","105","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("566","106","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("567","107","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("568","108","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("569","109","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("570","110","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("571","111","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("572","112","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("573","113","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("574","114","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("575","115","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("576","116","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("577","117","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("578","118","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("579","119","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("580","120","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("581","121","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("582","122","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("583","123","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("584","124","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("585","125","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("586","126","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("587","127","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("588","128","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("589","129","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("590","130","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("591","131","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("592","132","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("593","133","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("594","134","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("595","135","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("596","136","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("597","137","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("598","138","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("599","139","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("600","140","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("601","141","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("602","142","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("603","143","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("604","144","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("605","145","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("606","146","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("607","147","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("608","148","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("609","149","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("610","150","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("611","151","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("612","152","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("613","153","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("614","154","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("615","155","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("616","156","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("617","157","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("618","158","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("619","159","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("620","160","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("621","161","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("622","162","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("623","163","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("624","164","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("625","165","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("626","166","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("627","167","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("628","168","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("629","169","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("630","170","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("631","171","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("632","172","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("633","173","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("634","174","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("635","175","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("636","176","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("637","177","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("638","178","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("639","179","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("640","180","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("641","181","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("642","182","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("643","183","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("644","184","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("645","185","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("646","186","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("647","187","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("648","188","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("649","189","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("650","190","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("651","191","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("652","192","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("653","193","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("654","194","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("655","195","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("656","196","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("657","197","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("658","198","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("659","199","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("660","200","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("661","201","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("662","202","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("663","203","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("664","204","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("665","205","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("666","206","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("667","207","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("668","208","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("669","209","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("670","210","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("671","211","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("672","212","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("673","213","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("674","214","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("675","215","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("676","216","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("677","217","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("678","218","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("679","219","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("680","220","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("681","221","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("682","222","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("683","223","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("684","224","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("685","225","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("686","226","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("687","227","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("688","228","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("689","229","imgs/fotos/default.png","fotoperfil");
INSERT INTO documentos VALUES("690","230","imgs/fotos/default.png","fotoperfil");
INSERT INTO donativos VALUES("1","Armando Marcelino","Rojas","Cruz","1234","2015-01-16");
INSERT INTO donativos VALUES("2","Armando Marcelino","Rojas","Cruz","123","2015-01-16");
INSERT INTO donativos VALUES("3","Armando Marcelino","Rojas","Cruz","123","2015-01-16");
INSERT INTO donativos VALUES("4","Armando Marcelino","Rojas","Cruz","123","2015-01-16");
INSERT INTO donativos VALUES("5","asdda","asdsad","","112","2015-01-16");
INSERT INTO elementos VALUES("1","1","151","43","","Soltero","2000-01-19","Secundaria","","0000-00-00","Oaxaca de Juárez","BAME0000119HOCTN9RA","","","","","41","","","1","1","1","Oaxaca","Bpositivo");
INSERT INTO elementos VALUES("2","2","164","70","","Soltero","1995-11-05","Técnico","","0000-00-00","Oaxaca de Juárez","GLI951105HOCRZR06","Av. Sabinos 5 Mza H 6a etapa","Fracc. El Retiro","68297","Sta. María el Tule","0","","","1","1","7","Oaxaca","Opositivo");
INSERT INTO elementos VALUES("3","3","155","52","","Soltero","1999-01-14","Secundaria","","0000-00-00","La Paz Obispo San Agustín Loxicha","MARD990105HOCTZN06","Priv. Venustiano Carranza 10","2a Sección","","San Antonio de la Cal","41","","","1","1","5","Oaxaca","");
INSERT INTO elementos VALUES("4","4","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","41","","","1","1","4","Oaxaca","");
INSERT INTO elementos VALUES("5","5","162","55","","Soltero","1997-10-04","Primaria","","0000-00-00","Oaxaca de Juárez","JUMD971004HOCRRMO8","Las flores 104","Azucenas","","Oaxaca de Juárez","41","","","1","1","2","Oaxaca","Opositivo");
INSERT INTO elementos VALUES("6","6","170","65","","Soltero","1997-11-22","Secundaria","","0000-00-00","Oaxaca de Juárez","ROLL981122HOCJPS00","","","","","41","","","1","1","2","Oaxaca","Opositivo");
INSERT INTO elementos VALUES("7","7","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","41","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("8","8","0","0","","Soltero","0000-00-00","","","0000-00-00","","AICE021208HOCVRRA1","","","","","41","","","1","1","6","Oaxaca","");
INSERT INTO elementos VALUES("9","9","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","","41","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("10","10","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","","41","","","1","1","4","Oaxaca","");
INSERT INTO elementos VALUES("11","11","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","","41","","","1","1","4","Oaxaca","");
INSERT INTO elementos VALUES("12","12","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","41","","","1","1","4","Oaxaca","");
INSERT INTO elementos VALUES("13","13","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","41","","","1","1","4","Oaxaca","");
INSERT INTO elementos VALUES("14","14","0","0","","Soltera","1999-03-12","","","2013-06-15","","","And. Azabache Cond. 26 casa 59","Fracccionamiento Esmeralda","","San Pablo Etla","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("15","15","0","0","","Soltero","2004-09-20","","","2013-04-27","Juchitán de Zaragoza","","Independencia 2","Santa María Atzompa","71220","","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("16","16","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("17","17","0","0","","Soltero","2002-01-12","","","2013-06-02","Salina Cruz, Tehuantepec, Oax.","","2a Priv. De Amapolas 218","Reforma","68050","Oaxaca de Juárez","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("18","18","0","0","","Soltera","2000-10-20","","","2013-06-02","San Pedro el Alto Pochutla, Oax.","","José Gorostiza","José Vasconcelos","","Oaxaca de Juárez","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("19","19","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("20","20","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","10","Oaxaca","");
INSERT INTO elementos VALUES("21","21","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("22","22","0","0","","","0000-00-00","","","2013-04-14","","","","","","","0","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("23","23","153","40","","Soltero","0000-00-00","Secundaria","","2013-06-02","","AERC","Diagonal de Benito Juárez 6","El Polvorin","","San Antonio de la Cal","40","","","1","1","5","Oaxaca","Opositivo");
INSERT INTO elementos VALUES("24","24","0","0","","Soltero","2002-05-06","","","2013-06-02","","","Priv. Del Paredón 112","Emiliano Zapata","","San Jacinto Amilpas","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("25","25","0","0","","Soltero","2000-08-08","","","2013-06-02","","","Priv. de Paredón 112","Fracc. Camino Real, Emiliano Zapata","","San Jacinto Amilpas","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("26","26","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("27","27","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","10","Oaxaca","");
INSERT INTO elementos VALUES("28","28","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("29","29","139","49","","Soltero","2001-07-30","Primaria","","2013-05-26","Oaxaca de Juárez","CAGB010730HOCBRRA9","5 de mayo 404","Buenos Aires","","San Antonio de la Cal","40","","","1","1","5","Oaxaca","Opositivo");
INSERT INTO elementos VALUES("30","30","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","4","Oaxaca","");
INSERT INTO elementos VALUES("31","31","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","0","","","1","1","10","Oaxaca","");
INSERT INTO elementos VALUES("32","32","0","0","","Soltero","1996-11-28","","","2013-04-21","Miahuatlán e Porfirio Díaz Oax","","Libertad  506","Nezacubi","","Oaxaca de Juárez","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("33","33","0","0","","Soltero","2013-06-21","","","0000-00-00","","CAGL980612HOCHNS01","","","","","40","","","1","1","5","Oaxaca","");
INSERT INTO elementos VALUES("34","34","158","52","","Soltera","1993-06-04","Licenciatura","","2013-04-28","Oaxaca de Juárez","COMA930604MOCHJB03","2a Priv de Pinos 114","","","San Antonio de la Cal","40","","","1","1","5","Oaxaca","Opositivo");
INSERT INTO elementos VALUES("35","35","151","46","","Soltera","1999-04-12","Secundaria","","2013-04-28","Oaxaca de Juárez","","2a Priv de Pinos 114","3a Sección","","San Antonio de la Cal","40","","","1","1","5","Oaxaca","Opositivo");
INSERT INTO elementos VALUES("36","36","178","69","","Soltero","1997-05-05","Secundaria","","2013-04-28","Oaxaca de Juárez","COMJ970505HBCHJN00","2a priv. Pinos114","","","San Antonio de la Cal","40","","","1","1","5","Oaxaca","Opositivo");
INSERT INTO elementos VALUES("37","37","0","0","","Soltero","2005-03-17","","","2013-05-12","","","2 abril 117","Centro","68000","Oaxaca de Juárez","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("38","38","0","0","","Soltera","2001-04-18","","","2013-01-05","Huajuapan de León","","","","","","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("39","39","0","0","","Soltero","1999-11-08","","","2013-04-14","","","","","","","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("40","40","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("41","41","0","0","","Soltero","2003-05-26","","","2013-06-02","Oaxaca de Juárez, Oax.","","2a priv de Ignacio Zaragoza 108","","","","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("42","42","0","0","","Soltero","2001-11-26","","","2013-06-02","Oaxaca de Juárez, Oax.","","2a priv. Ignacio Zaragoza 108","","","","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("43","43","0","0","","Soltero","2001-09-09","","","2013-06-15","","","Ricardo Flores Magón mz 13 lot 2","Perla de Antequera","","Santa María Atzompa","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("44","44","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("45","45","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("46","46","0","0","","Soltero","1998-10-08","","","2013-06-02","San Agustín Yatareni","","Carretera a San Agustín Yatareni 90","","","San Agustí Yatareni","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("47","47","0","0","","Soltera","1996-10-26","","","2013-06-02","Oaxaca de Juárez, Oax.","","Álvaro Obregón 302","","68020","Oaxaca de Juárez","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("48","48","0","0","","Soltero","2001-08-16","","","2013-06-15","","","San Pedro 214","San Isidro Pueblo Nuevo","","Etla, Oaxaca","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("49","49","0","0","","Soltero","2002-03-17","","","2013-06-15","","","San Pedro 214","San Isidro Pueblo Nuevo","","Etla, Oaxaca","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("50","50","2","50","","Soltero","1997-06-05","Bachillerato","","0000-00-00","Oaxaca de Juárez","GAGL970705HOCRRS00","Nopalera 6","El Polvorín","","San Antonio de la Cal","40","","","1","1","2","Oaxaca","Opositivo");
INSERT INTO elementos VALUES("51","51","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("52","52","0","0","","Soltero","0000-00-00","","","2013-06-02","","","Naranjos 508","Reforma","68050","Oaxaca de Juárez","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("53","53","0","0","","Soltero","1998-10-26","","","2013-05-25","Oaxaca de Juárez","","Tierra  y Libertad esq Lomas de Chepe","Ejido Guadalupe Victoria","","","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("54","54","0","0","","Soltero","0000-00-00","","","2013-04-14","","","","","","","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("55","55","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("56","56","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("57","57","0","0","","Soltero","2000-12-03","","","2013-06-02","Oaxaca de Juárez, Oax.","","Citlaltepetl 207","Volcanes","68020","Oaxaca de Juárez","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("58","58","0","0","","Soltero","2005-05-14","","","2013-06-03","","","21 de marzo 22","Buenos Aires","","San Antonio de la Cal","40","","","1","1","5","Oaxaca","");
INSERT INTO elementos VALUES("59","59","0","0","","Soltero","0000-00-00","","","2013-04-14","","","","","","","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("60","60","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("61","61","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("62","62","0","0","","Soltero","1999-10-14","","","2013-04-27","Oaxaca de Juárez","","Zaachila 104","Monte Alban","68140","Oaxaca de Juárez","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("63","63","158","0","","Soltero","1998-11-14","Secundaria","","2013-06-02","Oaxaca de Juárez, Oax.","JIGY981114HOCM03R","Nopalera 12","El Polvorín","","San Antonio de la Cal","40","","","1","1","5","Oaxaca","");
INSERT INTO elementos VALUES("64","64","130","30","","Soltero","2001-07-22","Primaria","","2013-06-09","Oaxaca de Juárez","JIGJ010722HOCMRRNA9","","","","","0","","","1","1","5","Oaxaca","Opositivo");
INSERT INTO elementos VALUES("65","65","0","0","","Soltero","0000-00-00","","","2013-05-04","","","","","","","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("66","66","0","0","","Soltero","0000-00-00","","","2013-04-14","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("67","67","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("68","68","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("69","69","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("70","70","0","0","","Soltera","2000-11-05","","","2013-04-27","Oaxaca de Juárez","","","","","","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("71","71","0","0","","Soltera","1997-02-15","","","2013-05-25","San Francisco Ocotepec, Sta. María Tonameca","","Laureles sn","Loma Bonita","","","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("72","72","0","0","","Soltero","2003-10-07","","","2013-04-27","Oaxaca de Juárez","","División Oriente 228 int 9","Ex Marquesado","68000","Oaxaca de Juárez, Oax.","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("73","73","0","0","","Soltero","1998-02-02","","","2013-06-02","Oaxaca de Juárez, Oax.","","2a priv. Independencia 9","","","Oaxaca de Juárez","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("74","74","0","0","","Soltero","1998-09-15","","","2013-06-02","San Miguel Tilquiapan, Ocotlán, Oax.","","Camino Nacional 1001","","","Santa Lucía del Camino","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("75","75","0","0","","Soltera","1997-06-09","","","2013-06-02","Teotitlán del Valle, Tlacolula, Oax.","","Agustín de Iturbide 1","","","Tlacolula de Matamoros","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("76","76","0","0","","Soltera","2003-02-01","","","2013-04-14","","","Ignacio Zaragoza 106","Margarita Maza de Juárez","","San Martín Mexicapam","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("77","77","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("78","78","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("79","79","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","10","Oaxaca","");
INSERT INTO elementos VALUES("80","80","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","10","Oaxaca","");
INSERT INTO elementos VALUES("81","81","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("82","82","0","0","","Soltero","1999-12-29","","","2013-03-17","Oaxaca de Juárez","","2a priv. De clza de república 122-5","Artículo 123","","","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("83","83","110","19","","Soltero","2005-08-08","Primaria","","2013-06-02","Oaxaca de Juárez","MAAO050805HOCRBSA7","21 DE  MARZO 22","BUENOS AIRES 4A SECCION","","San Antonio de la Cal","40","","","1","1","5","Oaxaca","Opositivo");
INSERT INTO elementos VALUES("84","84","0","0","","Soltero","2004-06-08","","","2013-04-14","","","5 de mayo 202","Margarita Maza de Juárez","","San Martín Mexicapam","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("85","85","0","0","","Soltero","1998-01-16","","","2013-06-15","","","Riveras del Atoyac 320","Educación","","Oaxaca de Juárez","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("86","86","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","4","Oaxaca","");
INSERT INTO elementos VALUES("87","87","163","53","","Soltero","1999-04-06","Secundaria","","2013-05-26","Oaxaca de Juárez","MEM990406HOCNRS06","6a Priv. De Benito Juárez 408","","","San Agustín de las Juntas","40","","","1","1","5","Oaxaca","Opositivo");
INSERT INTO elementos VALUES("88","88","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("89","89","0","0","","Soltero","2005-09-19","","","2013-02-02","Oaxaca de Juárez, Oax.","","Priv. De Miguel Domínguez s/n","","","Santa Cruz Xoxocotlán","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("90","90","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("91","91","0","0","","Soltero","2000-09-11","","","2013-03-16","Oaxaca de Juárez","","Priv. 7 regiones","Guelaguetza 8","","Santa Maria Atzompa","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("92","92","0","0","","Soltera","1997-04-26","","","2013-06-02","Oaxaca de Juárez, Oax.","","Pirv. 7 Regiones 8","Guelaguetza","","","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("93","93","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("94","94","0","0","","Soltero","2001-06-05","","","2013-04-20","","","Geranios 21","Buenos Aires","","San Antonio de la Cal","40","","","1","1","5","Oaxaca","");
INSERT INTO elementos VALUES("95","95","150","0","","Soltera","2000-01-10","Secundaria","","2013-04-20","Oaxaca de Juárez","","Priv Geranios 21","Buenos Aires","","San Antonio de la Cal","40","","","1","1","5","Oaxaca","Opositivo");
INSERT INTO elementos VALUES("96","96","0","0","","Soltera","2001-10-09","","","2013-04-14","","","Ayocuan 109","Netzahualcóyotl","68140","San Martín Mexicapam","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("97","97","0","0","","Soltero","1999-03-15","","","2013-06-02","","","Lomas","Lomas de Santa Cruz","","Santa Cruz Xoxocotlán","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("98","98","0","0","","Soltero","1999-02-22","","","2013-04-21","Oaxaca de Juárez","","La paz 2","Manantial","","Villa de Etla","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("99","99","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("100","100","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","Tlacolula de Matamoros","40","","","1","1","10","Oaxaca","");
INSERT INTO elementos VALUES("101","101","0","0","","Soltera","1997-10-22","","","2013-04-21","Oaxaca de Juárez","","16 de septiembre 114","Patria Nueva","","Oaxaca de Juárez","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("102","102","0","0","","Soltera","0000-00-00","","","2013-04-14","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("103","103","0","0","","Soltera","0000-00-00","","","2013-04-14","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("104","104","0","0","","Soltero","0000-00-00","","","2013-04-14","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("105","105","140","40","","Soltero","2002-12-26","Primaria","","2013-05-26","Oaxaca de Juárez","RORE021222HOMCBBMA1","Priv. Francisco I.Madero 3","","","Santa Cruz Xoxocotlán","40","","","1","1","5","Oaxaca","Opositivo");
INSERT INTO elementos VALUES("106","106","0","0","","Soltero","1999-08-08","","","2013-04-21","Oaxaca de Juárez","","coatlicue 193","Vistahermosa","","Oaxaca de Juárez","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("107","107","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("108","108","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("109","109","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","2","12","Oaxaca","");
INSERT INTO elementos VALUES("110","110","149","46","","Soltero","2001-10-12","Primaria","","2013-05-26","Oaxaca de Juárez","ROSJ011012HOCJNNA0","4a priv del Estudiante 10","Buenos Aires","","San Antonio de la Cal","40","","","1","1","5","Oaxaca","Opositivo");
INSERT INTO elementos VALUES("111","111","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("112","112","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("113","113","148","48","","Soltera","2001-10-16","Primaria","","2013-05-26","Oaxaca de Juárez","","Loma de Culebra 3a Sección","Casa del Temblor","","San Antonio  de la Cal","40","","","1","1","5","Oaxaca","Opositivo");
INSERT INTO elementos VALUES("114","114","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("115","115","0","0","","Soltero","2004-03-13","","","2013-04-27","","","Porlg. Iturbide 458","","","Oaxaca de Juárez","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("116","116","160","56","","Soltero","1998-05-04","Secundaria","","2013-05-26","Santa Catarina Loxicha Pochutla Oax","","Margarita Maza de Juárez 7","","","San Agustín de las Juntas","40","","","1","1","5","Oaxaca","Opositivo");
INSERT INTO elementos VALUES("117","117","0","0","","Soltera","0000-00-00","","","2013-04-27","","","","","","","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("118","118","0","0","","Soltero","0000-00-00","","","2013-03-17","","","","","","","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("119","119","163","62","","Soltera","1998-12-08","Secundaria","","2013-06-02","Tlacolula de Matamoros","SEJA981208MOCBRL07","5a priv. Allende","El Polvorín","","San Antonio de la Cal","40","","","1","1","5","Oaxaca","Opositivo");
INSERT INTO elementos VALUES("120","120","0","0","","Soltero","0000-00-00","","","2013-04-14","","","","","","","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("121","121","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("122","122","0","0","","Soltera","2001-04-17","","","2013-06-15","","","Rufino Tamayo 31 b MZ 4","Fracc. Ándres Henestrosa","68237","Santiago Etla","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("123","123","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("124","124","0","0","","Soltera","1993-09-12","","","2013-06-02","San Ildefonso Sola, Sola de Vega, Oax.","","Priv. 7 Regiones 8","Guelaguetza","","","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("125","125","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("126","126","162","45","","Soltera","2000-03-29","Secundaria","","2013-06-02","Oaxaca de Juárez, Oax.","VECF000329MOCLJNA2","Hidalgo 2\"A\"","","","San Antonio de la Cal","40","","","1","1","5","Oaxaca","Opositivo");
INSERT INTO elementos VALUES("127","127","136","30","","Soltera","2002-09-20","Primaria","","2013-05-26","San Antonio de la Cal","VEMA020920MOCNRLA6","Libertad 104","La Raya","","Santa Cruz Xoxocotlán","40","","","1","1","5","Oaxaca","");
INSERT INTO elementos VALUES("128","128","0","0","","Soltero","2000-11-01","","","2013-06-02","Mariscala de Juárez, Huajuapam","","Condominio 6 casa 9","Villas Xoxo, Juan Rulfo","","Santa Cruz Xoxocotlán","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("129","129","0","0","","Soltera","2001-04-20","","","2013-06-01","","","Durango 129","República","","","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("130","130","0","0","","Soltero","1998-04-28","","","2013-06-02","Tlalixtac de Cabrera, Oax.","","Miguel Cabrera 612","Barrio San  Miguel","","Tlalixtac de Cabrera","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("131","131","0","0","","Soltera","1998-12-09","","","2013-04-27","Tlalixtac de Cabrera","","Melchor Ocampo 3-A","Barrio Sn Miguel","","Tlalixtac de Cabrera","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("132","132","0","0","","Soltero","0000-00-00","","","2013-04-14","","","","","","","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("133","133","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("134","134","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("135","135","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","Oaxaca de Juárez","40","","","1","1","4","Oaxaca","");
INSERT INTO elementos VALUES("136","136","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","10","Oaxaca","");
INSERT INTO elementos VALUES("137","137","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("138","138","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("139","139","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","10","Oaxaca","");
INSERT INTO elementos VALUES("140","140","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","4","Oaxaca","");
INSERT INTO elementos VALUES("141","141","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("142","142","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("143","143","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","4","Oaxaca","");
INSERT INTO elementos VALUES("144","144","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("145","145","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("146","146","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("147","147","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("148","148","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","5","Oaxaca","");
INSERT INTO elementos VALUES("149","149","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("150","150","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("151","151","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("152","152","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("153","153","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("154","154","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("155","155","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("156","156","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("157","157","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("158","158","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("159","159","138","34","","Soltero","2000-05-06","Primaria","","0000-00-00","Oaxaca de Juárez","RUGK000506HOCZRVA3","Pueblos Unidos 28\"A\"","Experimental","","San Antonio de la Cal","0","","","1","1","5","Oaxaca","Opositivo");
INSERT INTO elementos VALUES("160","160","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","6","Oaxaca","");
INSERT INTO elementos VALUES("161","161","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("162","162","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","6","Oaxaca","");
INSERT INTO elementos VALUES("163","163","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","8","Oaxaca","");
INSERT INTO elementos VALUES("164","164","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","11","Oaxaca","");
INSERT INTO elementos VALUES("165","165","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","Ocotlán de Morelos","40","","","1","1","11","Oaxaca","");
INSERT INTO elementos VALUES("166","166","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","Ocotlán de Morelos","40","","","1","1","11","Oaxaca","");
INSERT INTO elementos VALUES("167","167","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","Ocotlán de Morelos","40","","","1","1","11","Oaxaca","");
INSERT INTO elementos VALUES("168","168","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","Ocotlán de Morelos","40","","","1","1","11","Oaxaca","");
INSERT INTO elementos VALUES("169","169","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","Ocotlán de Morelos","40","","","1","1","11","Oaxaca","");
INSERT INTO elementos VALUES("170","170","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","Ocotlán de Morelos","40","","","1","1","11","Oaxaca","");
INSERT INTO elementos VALUES("171","171","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","Ocotlán de Morelos","40","","","1","1","11","Oaxaca","");
INSERT INTO elementos VALUES("172","172","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","Ocotlán de Morelos","40","","","1","1","11","Oaxaca","");
INSERT INTO elementos VALUES("173","173","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","Ocotlán de Morelos","40","","","1","1","11","Oaxaca","");
INSERT INTO elementos VALUES("174","174","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","Ocotlán de Morelos","40","","","1","1","11","Oaxaca","");
INSERT INTO elementos VALUES("175","175","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","Ocotlán de Morelos","40","","","1","1","11","Oaxaca","");
INSERT INTO elementos VALUES("176","176","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","Ocotlán de Morelos","40","","","1","1","11","Oaxaca","");
INSERT INTO elementos VALUES("177","177","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","Oaxaca de Juárez","40","","","1","1","4","Oaxaca","");
INSERT INTO elementos VALUES("178","178","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","4","Oaxaca","");
INSERT INTO elementos VALUES("179","179","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","Tlacolula de Matamoros","40","","","1","1","10","Oaxaca","");
INSERT INTO elementos VALUES("180","180","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","Tlacolula de Matamoros","40","","","1","1","10","Oaxaca","");
INSERT INTO elementos VALUES("181","181","168","55","","Soltero","1998-07-05","Secundaria","","0000-00-00","Oaxaca de Juárez, Oax.","MOMJ980705HOCRRN06","Carretera Federal Oaxaca-México","Capellania","55030","Guadlupe Etla","0","","","1","1","2","Oaxaca","Opositivo");
INSERT INTO elementos VALUES("182","182","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("183","183","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("184","184","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("185","185","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("186","186","167","56","","Soltero","1997-09-01","Bachillerato","","0000-00-00","Oaxaca de Juárez","VILG970901HOCLSR09","Jamines 122","Azucenas","68140","San Martín Mexicapan","40","","","1","1","2","Oaxaca","Bpositivo");
INSERT INTO elementos VALUES("187","187","160","47","","Soltero","2001-08-23","Secundaria","","0000-00-00","Oaxaca de Juárez","RORA010823HOCBYNA8","Tizoc  S/N","Vista Hermosa","","Santa Rosa Panzacola","40","","","1","1","2","Oaxaca","Opositivo");
INSERT INTO elementos VALUES("188","188","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("189","189","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("190","190","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","6","Oaxaca","");
INSERT INTO elementos VALUES("191","191","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","6","Oaxaca","");
INSERT INTO elementos VALUES("192","192","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","Tlacolula de Matamoros","40","","","1","1","10","Oaxaca","");
INSERT INTO elementos VALUES("193","193","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","Tlacolula de Matamoros","40","","","1","1","10","Oaxaca","");
INSERT INTO elementos VALUES("194","194","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("195","195","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("196","196","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("197","197","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("198","198","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("199","199","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("200","200","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("201","201","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("202","202","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("203","203","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","10","Oaxaca","");
INSERT INTO elementos VALUES("204","204","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("205","205","165","62","","Soltero","1997-09-29","Secundaria","","0000-00-00","Oaxaca de Juárez","LOFM970929HOCPN6O7","Teposcolula 406","Niños Heroes","71220","Santa María Atzompa","40","","","1","1","2","Oaxaca","Opositivo");
INSERT INTO elementos VALUES("206","206","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("207","207","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("208","208","141","49","","Soltero","2004-06-21","Primaria","","0000-00-00","Oaxaca de Juárez","SALJ040621HOCNNRA6","Cerrada de Cuahutemoc 109","Vista Hermosa","","Oaxaca de Juárez","40","","","1","1","2","Oaxaca","Opositivo");
INSERT INTO elementos VALUES("209","209","155","43","","Soltero","2002-05-02","Primaria","","0000-00-00","Oaxaca de Juárez","MARB020523HOCRYRA6","Priv. Agustín Melgar 103","Santa Anita","","Oaxaca de Juárez, Oax.","40","AIRE, LLUVIA, FRIO INTENSO","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("210","210","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("211","211","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("212","212","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("213","213","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","2","Oaxaca","");
INSERT INTO elementos VALUES("214","214","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("215","215","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("216","216","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("217","217","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("218","218","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("219","219","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("220","220","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","1","Oaxaca","");
INSERT INTO elementos VALUES("221","221","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","4","Oaxaca","");
INSERT INTO elementos VALUES("222","222","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","7","Oaxaca","");
INSERT INTO elementos VALUES("223","223","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","6","Oaxaca","");
INSERT INTO elementos VALUES("224","224","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","9","Oaxaca","");
INSERT INTO elementos VALUES("225","225","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","9","Oaxaca","");
INSERT INTO elementos VALUES("226","226","0","0","","Soltero","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","9","Oaxaca","");
INSERT INTO elementos VALUES("227","227","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","4","Oaxaca","");
INSERT INTO elementos VALUES("228","228","0","0","","Soltera","0000-00-00","","","0000-00-00","","","","","","","40","","","1","1","4","Oaxaca","");
INSERT INTO elementos VALUES("229","229","160","67","","Casado","1960-08-26","","","2015-01-16","","ROCA600826HOCJRR09","Priv. Adolfo Lopez Mateos 106","Dolores","68020","Oaxaca de Juárez","33","","","1","1","13","Oaxaca","Opositivo");
INSERT INTO elementos VALUES("230","230","0","0","","Casado","0000-00-00","Licenciatura","","1980-08-01","","","","","","","1","","","1","1","13","Oaxaca","");
INSERT INTO emails VALUES("1","229","a_rojascruz@hotmail.com");
INSERT INTO eventos VALUES("1","Concurso de escoltas","Oaxaca","2015-02-24","Concurso Nacional de escoltas en Oaxaca","100","2");
INSERT INTO examens VALUES("1","examen","11","123");
INSERT INTO grados VALUES("1","Recluta","");
INSERT INTO grados VALUES("2","Cadete de infanteria","");
INSERT INTO grados VALUES("3","Cadete 1a","");
INSERT INTO grados VALUES("4","Cabo","");
INSERT INTO grados VALUES("5","Sargento 2","");
INSERT INTO grados VALUES("6","Sargento 1","");
INSERT INTO grados VALUES("7","Sub Oficial","");
INSERT INTO grados VALUES("8","3 Oficial","");
INSERT INTO grados VALUES("9","2 Oficial","");
INSERT INTO grados VALUES("10","1 Oficial","");
INSERT INTO grados VALUES("11","3 Comandante","");
INSERT INTO grados VALUES("12","2 Comandate","");
INSERT INTO grados VALUES("13","1 Comandante","");
INSERT INTO matriculas VALUES("201330658","1");
INSERT INTO matriculas VALUES("201030093","2");
INSERT INTO matriculas VALUES("201330659","3");
INSERT INTO matriculas VALUES("201330920","4");
INSERT INTO matriculas VALUES("201330859","5");
INSERT INTO matriculas VALUES("201330860","6");
INSERT INTO matriculas VALUES("201330862","7");
INSERT INTO matriculas VALUES("201330875","8");
INSERT INTO matriculas VALUES("201330880","9");
INSERT INTO matriculas VALUES("201330855","10");
INSERT INTO matriculas VALUES("201330850","11");
INSERT INTO matriculas VALUES("201330854","12");
INSERT INTO matriculas VALUES("201330849","13");
INSERT INTO matriculas VALUES("201330744","14");
INSERT INTO matriculas VALUES("201330690","15");
INSERT INTO matriculas VALUES("201330675","16");
INSERT INTO matriculas VALUES("201330805","17");
INSERT INTO matriculas VALUES("201330652","18");
INSERT INTO matriculas VALUES("201330902","19");
INSERT INTO matriculas VALUES("201330721","20");
INSERT INTO matriculas VALUES("201330755","21");
INSERT INTO matriculas VALUES("201330684","22");
INSERT INTO matriculas VALUES("201330705","23");
INSERT INTO matriculas VALUES("201330700","24");
INSERT INTO matriculas VALUES("201330701","25");
INSERT INTO matriculas VALUES("201330751","26");
INSERT INTO matriculas VALUES("201230557","27");
INSERT INTO matriculas VALUES("201330897","28");
INSERT INTO matriculas VALUES("201330657","29");
INSERT INTO matriculas VALUES("201330745","30");
INSERT INTO matriculas VALUES("201030179","31");
INSERT INTO matriculas VALUES("201330699","32");
INSERT INTO matriculas VALUES("201330668","33");
INSERT INTO matriculas VALUES("201330663","34");
INSERT INTO matriculas VALUES("201330664","35");
INSERT INTO matriculas VALUES("201330667","36");
INSERT INTO matriculas VALUES("201330704","37");
INSERT INTO matriculas VALUES("201330732","38");
INSERT INTO matriculas VALUES("201330685","39");
INSERT INTO matriculas VALUES("201330905","40");
INSERT INTO matriculas VALUES("201330801","41");
INSERT INTO matriculas VALUES("201330803","42");
INSERT INTO matriculas VALUES("201330736","43");
INSERT INTO matriculas VALUES("201330693","44");
INSERT INTO matriculas VALUES("201330694","45");
INSERT INTO matriculas VALUES("201330654","46");
INSERT INTO matriculas VALUES("201330802","47");
INSERT INTO matriculas VALUES("201330741","48");
INSERT INTO matriculas VALUES("201330743","49");
INSERT INTO matriculas VALUES("201230571","50");
INSERT INTO matriculas VALUES("201330908","51");
INSERT INTO matriculas VALUES("201330809","52");
INSERT INTO matriculas VALUES("201330733","53");
INSERT INTO matriculas VALUES("201330682","54");
INSERT INTO matriculas VALUES("201330818","55");
INSERT INTO matriculas VALUES("201230572","56");
INSERT INTO matriculas VALUES("201330804","57");
INSERT INTO matriculas VALUES("201330708","58");
INSERT INTO matriculas VALUES("201230458","59");
INSERT INTO matriculas VALUES("201330811","60");
INSERT INTO matriculas VALUES("201330810","61");
INSERT INTO matriculas VALUES("201330673","62");
INSERT INTO matriculas VALUES("201330661","63");
INSERT INTO matriculas VALUES("201330725","64");
INSERT INTO matriculas VALUES("201330689","65");
INSERT INTO matriculas VALUES("201330683","66");
INSERT INTO matriculas VALUES("201330748","67");
INSERT INTO matriculas VALUES("201330691","68");
INSERT INTO matriculas VALUES("201330752","69");
INSERT INTO matriculas VALUES("201330728","70");
INSERT INTO matriculas VALUES("201330687","71");
INSERT INTO matriculas VALUES("201330670","72");
INSERT INTO matriculas VALUES("201330800","73");
INSERT INTO matriculas VALUES("201330913","74");
INSERT INTO matriculas VALUES("201330731","75");
INSERT INTO matriculas VALUES("201330680","76");
INSERT INTO matriculas VALUES("201330808","77");
INSERT INTO matriculas VALUES("201330806","78");
INSERT INTO matriculas VALUES("201330722","79");
INSERT INTO matriculas VALUES("201230510","80");
INSERT INTO matriculas VALUES("201230468","81");
INSERT INTO matriculas VALUES("201330799","82");
INSERT INTO matriculas VALUES("201330709","83");
INSERT INTO matriculas VALUES("201330679","84");
INSERT INTO matriculas VALUES("201330814","85");
INSERT INTO matriculas VALUES("201330707","86");
INSERT INTO matriculas VALUES("201330660","87");
INSERT INTO matriculas VALUES("201330697","88");
INSERT INTO matriculas VALUES("201330895","89");
INSERT INTO matriculas VALUES("201330865","90");
INSERT INTO matriculas VALUES("201330796","91");
INSERT INTO matriculas VALUES("201330797","92");
INSERT INTO matriculas VALUES("201330904","93");
INSERT INTO matriculas VALUES("201330726","94");
INSERT INTO matriculas VALUES("201330727","95");
INSERT INTO matriculas VALUES("201330698","96");
INSERT INTO matriculas VALUES("201330734","97");
INSERT INTO matriculas VALUES("201330696","98");
INSERT INTO matriculas VALUES("201330749","99");
INSERT INTO matriculas VALUES("201330879","100");
INSERT INTO matriculas VALUES("201330729","101");
INSERT INTO matriculas VALUES("201230564","102");
INSERT INTO matriculas VALUES("201230565","103");
INSERT INTO matriculas VALUES("201230567","104");
INSERT INTO matriculas VALUES("201330662","105");
INSERT INTO matriculas VALUES("201330678","106");
INSERT INTO matriculas VALUES("201330758","107");
INSERT INTO matriculas VALUES("201330757","108");
INSERT INTO matriculas VALUES("201330846","109");
INSERT INTO matriculas VALUES("201330574","110");
INSERT INTO matriculas VALUES("201330900","111");
INSERT INTO matriculas VALUES("201330901","112");
INSERT INTO matriculas VALUES("201330762","113");
INSERT INTO matriculas VALUES("201230428","114");
INSERT INTO matriculas VALUES("201330686","115");
INSERT INTO matriculas VALUES("201330666","116");
INSERT INTO matriculas VALUES("201330688","117");
INSERT INTO matriculas VALUES("201230509","118");
INSERT INTO matriculas VALUES("201330665","119");
INSERT INTO matriculas VALUES("201330815","120");
INSERT INTO matriculas VALUES("201330892","121");
INSERT INTO matriculas VALUES("201330742","122");
INSERT INTO matriculas VALUES("201330909","123");
INSERT INTO matriculas VALUES("201330703","124");
INSERT INTO matriculas VALUES("201330672","125");
INSERT INTO matriculas VALUES("201330764","126");
INSERT INTO matriculas VALUES("201330669","127");
INSERT INTO matriculas VALUES("201330798","128");
INSERT INTO matriculas VALUES("201330674","129");
INSERT INTO matriculas VALUES("201330655","130");
INSERT INTO matriculas VALUES("201330735","131");
INSERT INTO matriculas VALUES("201330681","132");
INSERT INTO matriculas VALUES("201330677","133");
INSERT INTO matriculas VALUES("201330750","134");
INSERT INTO matriculas VALUES("201330848","135");
INSERT INTO matriculas VALUES("201330723","136");
INSERT INTO matriculas VALUES("201330676","137");
INSERT INTO matriculas VALUES("201330671","138");
INSERT INTO matriculas VALUES("201330724","139");
INSERT INTO matriculas VALUES("201330706","140");
INSERT INTO matriculas VALUES("201230578","141");
INSERT INTO matriculas VALUES("201330702","142");
INSERT INTO matriculas VALUES("201330746","143");
INSERT INTO matriculas VALUES("201330906","144");
INSERT INTO matriculas VALUES("201330695","145");
INSERT INTO matriculas VALUES("201330753","146");
INSERT INTO matriculas VALUES("201330754","147");
INSERT INTO matriculas VALUES("20080510007","148");
INSERT INTO matriculas VALUES("201330817","149");
INSERT INTO matriculas VALUES("201330692","150");
INSERT INTO matriculas VALUES("201330730","151");
INSERT INTO matriculas VALUES("201330737","152");
INSERT INTO matriculas VALUES("201330738","153");
INSERT INTO matriculas VALUES("201330739","154");
INSERT INTO matriculas VALUES("201330740","155");
INSERT INTO matriculas VALUES("201330747","156");
INSERT INTO matriculas VALUES("201330756","157");
INSERT INTO matriculas VALUES("201330759","158");
INSERT INTO matriculas VALUES("201330763","159");
INSERT INTO matriculas VALUES("201330795","160");
INSERT INTO matriculas VALUES("201330812","161");
INSERT INTO matriculas VALUES("201330813","162");
INSERT INTO matriculas VALUES("201330820","163");
INSERT INTO matriculas VALUES("201330822","164");
INSERT INTO matriculas VALUES("201330823","165");
INSERT INTO matriculas VALUES("201330824","166");
INSERT INTO matriculas VALUES("201330825","167");
INSERT INTO matriculas VALUES("201330826","168");
INSERT INTO matriculas VALUES("201330827","169");
INSERT INTO matriculas VALUES("201330828","170");
INSERT INTO matriculas VALUES("201330829","171");
INSERT INTO matriculas VALUES("201330830","172");
INSERT INTO matriculas VALUES("201330831","173");
INSERT INTO matriculas VALUES("201330832","174");
INSERT INTO matriculas VALUES("201330833","175");
INSERT INTO matriculas VALUES("201330834","176");
INSERT INTO matriculas VALUES("201330847","177");
INSERT INTO matriculas VALUES("201330851","178");
INSERT INTO matriculas VALUES("201330856","179");
INSERT INTO matriculas VALUES("201330857","180");
INSERT INTO matriculas VALUES("201330858","181");
INSERT INTO matriculas VALUES("201330863","182");
INSERT INTO matriculas VALUES("201330864","183");
INSERT INTO matriculas VALUES("201330866","184");
INSERT INTO matriculas VALUES("201330868","185");
INSERT INTO matriculas VALUES("201330869","186");
INSERT INTO matriculas VALUES("201330870","187");
INSERT INTO matriculas VALUES("201330872","188");
INSERT INTO matriculas VALUES("201330871","189");
INSERT INTO matriculas VALUES("201330874","190");
INSERT INTO matriculas VALUES("201330876","191");
INSERT INTO matriculas VALUES("201330877","192");
INSERT INTO matriculas VALUES("201330878","193");
INSERT INTO matriculas VALUES("201330881","194");
INSERT INTO matriculas VALUES("201330882","195");
INSERT INTO matriculas VALUES("201330883","196");
INSERT INTO matriculas VALUES("201230584","197");
INSERT INTO matriculas VALUES("201230420","198");
INSERT INTO matriculas VALUES("201230421","199");
INSERT INTO matriculas VALUES("201330816","200");
INSERT INTO matriculas VALUES("201330867","201");
INSERT INTO matriculas VALUES("201330861","202");
INSERT INTO matriculas VALUES("201230375","203");
INSERT INTO matriculas VALUES("201330884","204");
INSERT INTO matriculas VALUES("201330885","205");
INSERT INTO matriculas VALUES("201330886","206");
INSERT INTO matriculas VALUES("201330887","207");
INSERT INTO matriculas VALUES("201330888","208");
INSERT INTO matriculas VALUES("201330889","209");
INSERT INTO matriculas VALUES("201330890","210");
INSERT INTO matriculas VALUES("201330891","211");
INSERT INTO matriculas VALUES("201330893","212");
INSERT INTO matriculas VALUES("201330896","213");
INSERT INTO matriculas VALUES("201330898","214");
INSERT INTO matriculas VALUES("201330899","215");
INSERT INTO matriculas VALUES("201330903","216");
INSERT INTO matriculas VALUES("201330907","217");
INSERT INTO matriculas VALUES("201330910","218");
INSERT INTO matriculas VALUES("201330911","219");
INSERT INTO matriculas VALUES("201330912","220");
INSERT INTO matriculas VALUES("201330914","221");
INSERT INTO matriculas VALUES("201330915","222");
INSERT INTO matriculas VALUES("201330873","223");
INSERT INTO matriculas VALUES("201330916","224");
INSERT INTO matriculas VALUES("201330917","225");
INSERT INTO matriculas VALUES("201330918","226");
INSERT INTO matriculas VALUES("201330853","227");
INSERT INTO matriculas VALUES("201330852","228");
INSERT INTO matriculas VALUES("201330650","229");
INSERT INTO matriculas VALUES("20801063078","230");
INSERT INTO pagos VALUES("1","1","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("2","2","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("3","3","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("4","4","Membresia 2013","0000-00-00","300");
INSERT INTO pagos VALUES("5","5","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("6","6","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("7","7","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("8","8","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("9","9","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("10","10","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("11","11","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("12","12","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("13","13","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("14","14","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("15","15","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("16","16","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("17","17","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("18","18","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("19","19","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("20","20","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("21","21","Membresia 2013","0000-00-00","300");
INSERT INTO pagos VALUES("22","22","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("23","23","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("24","24","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("25","25","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("26","26","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("27","27","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("28","28","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("29","29","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("30","30","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("31","31","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("32","32","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("33","33","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("34","34","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("35","35","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("36","36","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("37","37","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("38","38","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("39","39","Membresia 2013","0000-00-00","300");
INSERT INTO pagos VALUES("40","40","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("41","41","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("42","42","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("43","43","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("44","44","Membresia 2013","0000-00-00","300");
INSERT INTO pagos VALUES("45","45","Membresia 2013","0000-00-00","300");
INSERT INTO pagos VALUES("46","46","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("47","47","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("48","48","Membresia 2013","0000-00-00","300");
INSERT INTO pagos VALUES("49","49","Membresia 2013","0000-00-00","300");
INSERT INTO pagos VALUES("50","50","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("51","51","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("52","52","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("53","53","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("54","54","Membresia 2013","0000-00-00","300");
INSERT INTO pagos VALUES("55","55","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("56","56","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("57","57","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("58","58","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("59","59","Membresia 2013","0000-00-00","300");
INSERT INTO pagos VALUES("60","60","Membresia 2013","0000-00-00","300");
INSERT INTO pagos VALUES("61","61","Membresia 2013","0000-00-00","300");
INSERT INTO pagos VALUES("62","62","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("63","63","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("64","64","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("65","65","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("66","66","Membresia 2013","0000-00-00","300");
INSERT INTO pagos VALUES("67","67","Membresia 2013","0000-00-00","300");
INSERT INTO pagos VALUES("68","68","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("69","69","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("70","70","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("71","71","Membresia 2013","0000-00-00","300");
INSERT INTO pagos VALUES("72","72","Membresia 2013","0000-00-00","300");
INSERT INTO pagos VALUES("73","73","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("74","74","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("75","75","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("76","76","Membresia 2013","0000-00-00","300");
INSERT INTO pagos VALUES("77","77","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("78","78","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("79","79","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("80","80","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("81","81","Membresia 2013","0000-00-00","300");
INSERT INTO pagos VALUES("82","82","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("83","83","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("84","84","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("85","85","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("86","86","Membresia 2013","0000-00-00","300");
INSERT INTO pagos VALUES("87","87","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("88","88","Membresia 2013","0000-00-00","300");
INSERT INTO pagos VALUES("89","89","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("90","90","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("91","91","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("92","92","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("93","93","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("94","94","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("95","95","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("96","96","Membresia 2013","0000-00-00","300");
INSERT INTO pagos VALUES("97","97","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("98","98","Membresia 2013","0000-00-00","300");
INSERT INTO pagos VALUES("99","99","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("100","100","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("101","101","Membresia 2013","0000-00-00","300");
INSERT INTO pagos VALUES("102","102","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("103","103","Membresia 2013","0000-00-00","300");
INSERT INTO pagos VALUES("104","104","Membresia 2013","0000-00-00","300");
INSERT INTO pagos VALUES("105","105","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("106","106","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("107","107","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("108","108","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("109","109","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("110","110","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("111","111","Membresia 2013","0000-00-00","300");
INSERT INTO pagos VALUES("112","112","Membresia 2013","0000-00-00","300");
INSERT INTO pagos VALUES("113","113","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("114","114","Membresia 2013","0000-00-00","300");
INSERT INTO pagos VALUES("115","115","Membresia 2013","0000-00-00","300");
INSERT INTO pagos VALUES("116","116","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("117","117","Membresia 2013","0000-00-00","300");
INSERT INTO pagos VALUES("118","118","Membresia 2013","0000-00-00","300");
INSERT INTO pagos VALUES("119","119","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("120","120","Membresia 2013","0000-00-00","300");
INSERT INTO pagos VALUES("121","121","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("122","122","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("123","123","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("124","124","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("125","125","Membresia 2013","0000-00-00","300");
INSERT INTO pagos VALUES("126","126","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("127","127","Membresia 2013","0000-00-00","300");
INSERT INTO pagos VALUES("128","128","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("129","129","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("130","130","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("131","131","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("132","132","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("133","133","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("134","134","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("135","135","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("136","136","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("137","137","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("138","138","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("139","139","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("140","140","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("141","141","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("142","142","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("143","143","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("144","144","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("145","145","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("146","146","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("147","147","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("148","148","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("149","149","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("150","150","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("151","151","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("152","152","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("153","153","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("154","154","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("155","155","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("156","156","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("157","157","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("158","158","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("159","159","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("160","160","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("161","161","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("162","162","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("163","163","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("164","164","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("165","165","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("166","166","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("167","167","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("168","168","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("169","169","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("170","170","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("171","171","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("172","172","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("173","173","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("174","174","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("175","175","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("176","176","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("177","177","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("178","178","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("179","179","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("180","180","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("181","181","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("182","182","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("183","183","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("184","184","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("185","185","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("186","186","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("187","187","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("188","188","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("189","189","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("190","190","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("191","191","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("192","192","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("193","193","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("194","194","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("195","195","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("196","196","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("197","197","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("198","198","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("199","199","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("200","200","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("201","201","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("202","202","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("203","203","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("204","204","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("205","205","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("206","206","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("207","207","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("208","208","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("209","209","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("210","210","Membresia 2013","0000-00-00","300");
INSERT INTO pagos VALUES("211","211","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("212","212","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("213","213","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("214","214","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("215","215","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("216","216","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("217","217","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("218","218","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("219","219","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("220","220","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("221","221","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("222","222","Membresia 2014","0000-00-00","300");
INSERT INTO pagos VALUES("223","223","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("224","224","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("225","225","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("226","226","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("227","227","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("228","228","Membresia","0000-00-00","300");
INSERT INTO pagos VALUES("229","229","Membresia 2013","0000-00-00","300");
INSERT INTO pagos VALUES("230","230","Membresia 2013","0000-00-00","300");
INSERT INTO pagos VALUES("231","229","Donativo","2015-01-16","1234");
INSERT INTO pagos VALUES("232","229","Donativo","2015-01-16","123");
INSERT INTO pagos VALUES("233","229","Donativo","2015-01-16","123");
INSERT INTO pagos VALUES("234","229","Donativo","2015-01-16","123");
INSERT INTO personas VALUES("1","Erick","Bautista","Méndez","Masculino");
INSERT INTO personas VALUES("2","Irving Arturo ","García","Lázaro","Masculino");
INSERT INTO personas VALUES("3","Daniel","Matus","Ruíz","Masculino");
INSERT INTO personas VALUES("4","Isaac","Morales","Maldonado","Masculino");
INSERT INTO personas VALUES("5","Domingo","Juárez","Martínez","Masculino");
INSERT INTO personas VALUES("6","Luis Iván","Rojas","López","Masculino");
INSERT INTO personas VALUES("7","Erik Humberto","Zurita","Vargas","Masculino");
INSERT INTO personas VALUES("8","Erick Hussein","Ávila","Carmona","Masculino");
INSERT INTO personas VALUES("9","Marbella","Díaz","Díaz","Femenino");
INSERT INTO personas VALUES("10","Sayuri","Contreras","Juárez","Femenino");
INSERT INTO personas VALUES("11","Andrea","García","Hernández","Femenino");
INSERT INTO personas VALUES("12","Hugo Gabriel","Martínez","Morales","Masculino");
INSERT INTO personas VALUES("13","Francisco Jali","Contreras","Juárez","Masculino");
INSERT INTO personas VALUES("14","Karen Itzel","Aguilar","Hernández","Femenino");
INSERT INTO personas VALUES("15","Brayan Farid","Aguilar","Sierra","Masculino");
INSERT INTO personas VALUES("16","Karla Arely ","Aldaz","Emeterio","Femenino");
INSERT INTO personas VALUES("17","Esher Armando","Alemán","Martínez","Masculino");
INSERT INTO personas VALUES("18","Martha Abigail","Antonio","Cruz","Femenino");
INSERT INTO personas VALUES("19","Itzel Soledad ","Aquino","Cabrera","Femenino");
INSERT INTO personas VALUES("20","Rigoberto","Aragón","Martínez","Masculino");
INSERT INTO personas VALUES("21","Yahuitl Antonia ","Arce","Jacobo","Femenino");
INSERT INTO personas VALUES("22","Andrea","Arrazola","Díaz","Femenino");
INSERT INTO personas VALUES("23","Carlos Omar","Avendaño","Ríos","Masculino");
INSERT INTO personas VALUES("24","Denzel Gerardo","Ayala","Velasco","Masculino");
INSERT INTO personas VALUES("25","Edzen Eduardo","Ayala","Velasco","Masculino");
INSERT INTO personas VALUES("26","Jorge ","Bautista","León","Masculino");
INSERT INTO personas VALUES("27","Brenda Karina ","Bautista","Méndez","Femenino");
INSERT INTO personas VALUES("28","Jesús Izamar","Blanco","Ordoñez","Masculino");
INSERT INTO personas VALUES("29","Bryan Samuel","Caballero","García","Masculino");
INSERT INTO personas VALUES("30","Sofía","Cabero","Zárate","Femenino");
INSERT INTO personas VALUES("31","Miguel Ángel ","Canseco","Marcial","Masculino");
INSERT INTO personas VALUES("32","Javier Alberto","Carrillo","Reyes","Masculino");
INSERT INTO personas VALUES("33","Luis Edgar","Chanona","González","Masculino");
INSERT INTO personas VALUES("34","Abril Eugenia","Cholula","Mijangos","Femenino");
INSERT INTO personas VALUES("35","Arinelly Elizabeth","Cholula","Mijangos","Femenino");
INSERT INTO personas VALUES("36","Juan Abisai","Cholula","Mijangos","Masculino");
INSERT INTO personas VALUES("37","José Alejandro","Cortés","López","Masculino");
INSERT INTO personas VALUES("38","Daniela Jimena","Cortés","Saumano","Femenino");
INSERT INTO personas VALUES("39","Dave Daniel","Cruz","Cruz","Masculino");
INSERT INTO personas VALUES("40","Moisés Elías ","Cruz","García","Masculino");
INSERT INTO personas VALUES("41","Eduardo","Cruz","González","Masculino");
INSERT INTO personas VALUES("42","Camila Itai","Cruz","González","Masculino");
INSERT INTO personas VALUES("43","Francisco Humberto","Cruz","Hernández","Masculino");
INSERT INTO personas VALUES("44","Ricardo Altaír","Escobar","Santiago","Masculino");
INSERT INTO personas VALUES("45","Karim Patricio ","Escobar","Santiago","Masculino");
INSERT INTO personas VALUES("46","Sergio Yael","Francisco","Vásquez","Masculino");
INSERT INTO personas VALUES("47","Luisa Lizbeth","Galán","Pérez","Femenino");
INSERT INTO personas VALUES("48","Job Agustín","García","Bautista","Masculino");
INSERT INTO personas VALUES("49","Uriel","García","Bautista","Masculino");
INSERT INTO personas VALUES("50","Luis Alberto","García","García","Masculino");
INSERT INTO personas VALUES("51","Néstor Gabino","García","Martínez","Masculino");
INSERT INTO personas VALUES("52","Alex Uriel","García","Mendoza","Masculino");
INSERT INTO personas VALUES("53","Pedro Iván","García","Pérez","Masculino");
INSERT INTO personas VALUES("54","Daniel","García","Trujillo","Masculino");
INSERT INTO personas VALUES("55","Julián David","Gómez","Hernández","Masculino");
INSERT INTO personas VALUES("56","Samuel Jesús ","Gutiérrez","Guzmán","Masculino");
INSERT INTO personas VALUES("57","Ángel de Jesús","Guzmán","Villegas","Masculino");
INSERT INTO personas VALUES("58","Cristhoper Lenin","Hernández","Hernández","Masculino");
INSERT INTO personas VALUES("59","Alejandro","Hernández","Hidalgo","Masculino");
INSERT INTO personas VALUES("60","Gabriela","Hernández","Ríos","Femenino");
INSERT INTO personas VALUES("61","David","Hernández","Ríos","Masculino");
INSERT INTO personas VALUES("62","Josmar Josué","Inés","López","Masculino");
INSERT INTO personas VALUES("63","Yair Armando","Jiménez","García","Masculino");
INSERT INTO personas VALUES("64","Jonathan Abisai","Jiménez","García","Masculino");
INSERT INTO personas VALUES("65","Edel Ángel","Jiménez","González","Masculino");
INSERT INTO personas VALUES("66","Daniel","Jiménez","Morales","Masculino");
INSERT INTO personas VALUES("67","Enrique ","Jiménez","Morales","Masculino");
INSERT INTO personas VALUES("68","Omar ","Juárez","Valencia","Masculino");
INSERT INTO personas VALUES("69","Alexis Andrés ","León","Méndez","Masculino");
INSERT INTO personas VALUES("70","Itzel","Leyva","Bautista","Femenino");
INSERT INTO personas VALUES("71","Karla Itzel","Leyva","García","Femenino");
INSERT INTO personas VALUES("72","Daniel","López","Cuevas","Masculino");
INSERT INTO personas VALUES("73","Oscar Ulises","López","Hernández","Masculino");
INSERT INTO personas VALUES("74","Miguel","López","Jiménez","Masculino");
INSERT INTO personas VALUES("75","Ana María","López","Olivares","Femenino");
INSERT INTO personas VALUES("76","Adriana Vianney","López","Pérez","Femenino");
INSERT INTO personas VALUES("77","Marcos Daniel ","López","Santiago","Masculino");
INSERT INTO personas VALUES("78","Irving Yair ","López","Santiago","Masculino");
INSERT INTO personas VALUES("79","Uriel ","López","Santiago","Masculino");
INSERT INTO personas VALUES("80","Eric Omar ","López","Vásquez","Masculino");
INSERT INTO personas VALUES("81","Carlos Eduardo","Luis","Ávila","Masculino");
INSERT INTO personas VALUES("82","Nick","Luis","García","Masculino");
INSERT INTO personas VALUES("83","Oscar Kevin","Martínez","Abella","Masculino");
INSERT INTO personas VALUES("84","Frank Anthony","Martínez","Hernández","Masculino");
INSERT INTO personas VALUES("85","Alberto Fernando","Méndez","Julián","Masculino");
INSERT INTO personas VALUES("86","Carlos Daniel ","Mendoza","Martínez","Masculino");
INSERT INTO personas VALUES("87","José Gustavo","Mendoza","Merino","Masculino");
INSERT INTO personas VALUES("88","Mario Alberto ","Mendoza","Olivas","Masculino");
INSERT INTO personas VALUES("89","Martin Issait","Miguel","Cruz","Masculino");
INSERT INTO personas VALUES("90","Josafat Ricardo","Morales","Cruz","Masculino");
INSERT INTO personas VALUES("91","Luis Ángel","Morales","García","Masculino");
INSERT INTO personas VALUES("92","Berenice","Morales","García","Femenino");
INSERT INTO personas VALUES("93","Dolores Guadalupe ","Muñoz","Pérez","Femenino");
INSERT INTO personas VALUES("94","Aarón","Nolasco","Flores","Masculino");
INSERT INTO personas VALUES("95","Yaneli","Nolasco","Flores","Femenino");
INSERT INTO personas VALUES("96","Inti Allen","Núñez","Martínez","Femenino");
INSERT INTO personas VALUES("97","Luis Abraham","Ramírez","Hernández","Masculino");
INSERT INTO personas VALUES("98","Moisés Abisai","Ramírez","Matus","Masculino");
INSERT INTO personas VALUES("99","José Briant","Reyes","Cruz","Masculino");
INSERT INTO personas VALUES("100","Jonathan","Reyes","García","Masculino");
INSERT INTO personas VALUES("101","Itzel","Robles","Cortés","Femenino");
INSERT INTO personas VALUES("102","Teresa Carolina","Robles","Ríos","Femenino");
INSERT INTO personas VALUES("103","Sahara Donají","Robles","Ríos","Femenino");
INSERT INTO personas VALUES("104","Henri Ulises","Robles","Ríos","Masculino");
INSERT INTO personas VALUES("105","Emmanuel Guadalupe","Robles","Robles","Masculino");
INSERT INTO personas VALUES("106","Samuel Armando","Rodríguez","Benítez","Masculino");
INSERT INTO personas VALUES("107","Sergio José ","Rodríguez","Valencia","Masculino");
INSERT INTO personas VALUES("108","Víctor Eduardo","Rodríguez","Valencia","Masculino");
INSERT INTO personas VALUES("109","Isaí ","Rojas","Cruz","Masculino");
INSERT INTO personas VALUES("110","Juan Daniel","Rojas","Sánchez","Masculino");
INSERT INTO personas VALUES("111","Josué David ","Rosado","López","Masculino");
INSERT INTO personas VALUES("112","Ederuy Raquel","Rosado","López","Femenino");
INSERT INTO personas VALUES("113","Mitzi Jaquelin","Ruiz","Gallardo","Femenino");
INSERT INTO personas VALUES("114","Raúl Moisés ","Ruíz","García","Masculino");
INSERT INTO personas VALUES("115","Porfirio","Salas","Cruz","Masculino");
INSERT INTO personas VALUES("116","Abel Marino","Sánchez","Ruiz","Masculino");
INSERT INTO personas VALUES("117","Karina Isabel","Santiago","Montes","Femenino");
INSERT INTO personas VALUES("118","Kevin Iván","Santiago","Montes","Masculino");
INSERT INTO personas VALUES("119","Albina Concepción","Sebastián","Juárez","Femenino");
INSERT INTO personas VALUES("120","Ariel","Sigüenza","Moreno","Masculino");
INSERT INTO personas VALUES("121","Juliana","Ramos","Solís","Femenino");
INSERT INTO personas VALUES("122","Niza Mariel","Tamayo","Armengol","Femenino");
INSERT INTO personas VALUES("123","Xunaschi","Vargas","Gutiérrez","Femenino");
INSERT INTO personas VALUES("124","María Magdalena","Vásquez","Rodríguez","Femenino");
INSERT INTO personas VALUES("125","Saúl Franky ","Vásquez","Martínez","Masculino");
INSERT INTO personas VALUES("126","Fanny Jocelin","Velasco","Cajero","Femenino");
INSERT INTO personas VALUES("127","Alejandra Monserrat","Venegas","Morales","Femenino");
INSERT INTO personas VALUES("128","Eduardo Enrique","Villavicencio","Martínez","Masculino");
INSERT INTO personas VALUES("129","Frida Carolina","Vivanco","López","Femenino");
INSERT INTO personas VALUES("130","Pedro","Zárate","Martínez","Masculino");
INSERT INTO personas VALUES("131","Concepción","Zárate","Santiago","Femenino");
INSERT INTO personas VALUES("132","Cesar  Antonio","Zavaleta","Gómez","Masculino");
INSERT INTO personas VALUES("133","Carlos Alberto","Cortes","Pérez","Masculino");
INSERT INTO personas VALUES("134","Alexis Benjamín","Gallardo","Martínez","Masculino");
INSERT INTO personas VALUES("135","Isis Andrea","Jarquín","Vásquez","Femenino");
INSERT INTO personas VALUES("136","Irving Emanuel","Jiménez","Bautista","Masculino");
INSERT INTO personas VALUES("137","Luis Enrique","Juárez","Saavedra","Masculino");
INSERT INTO personas VALUES("138","Xóchitl Inés","López","","Femenino");
INSERT INTO personas VALUES("139","Diodoró Miguel","López","","Masculino");
INSERT INTO personas VALUES("140","Andrei Lomercy","López","Hernández","Masculino");
INSERT INTO personas VALUES("141","Mayte Jesusita","López","Silverio","Femenino");
INSERT INTO personas VALUES("142","Omar José","Mecott","","Masculino");
INSERT INTO personas VALUES("143","Kevin Samuel","Moreno","González","Masculino");
INSERT INTO personas VALUES("144","Epifanía","Reyes","Aguilar","Femenino");
INSERT INTO personas VALUES("145","Ángel Alfredo","Ortega","López","Masculino");
INSERT INTO personas VALUES("146","María Fernanda","Ortiz","Canalizo","Femenino");
INSERT INTO personas VALUES("147","Esteban Dunai","Ortiz","Canalizo","Masculino");
INSERT INTO personas VALUES("148","Jeffrey Daniel","Ríos","González","Femenino");
INSERT INTO personas VALUES("149","Mónica Karina","Prieto","Crespo","Femenino");
INSERT INTO personas VALUES("150","Jafet","Martínez","Jiménez","Masculino");
INSERT INTO personas VALUES("151","Selyna Sagrario","Martínez","García","Femenino");
INSERT INTO personas VALUES("152","Carlos Ariel","Aguilar","Hernández","Masculino");
INSERT INTO personas VALUES("153","Hugo Manuel","Naranjo","Barragán","Masculino");
INSERT INTO personas VALUES("154","Yoselina Karina","Cruz","Hernández","Femenino");
INSERT INTO personas VALUES("155","Azucena del Carmen","Cruz","Castellanos","Femenino");
INSERT INTO personas VALUES("156","Silvia Yamile","Barragán","Pérez","Femenino");
INSERT INTO personas VALUES("157","José Raúl","Aquino","Carrasco","Masculino");
INSERT INTO personas VALUES("158","Carlos Marcell","Jácome","Gordillo","Masculino");
INSERT INTO personas VALUES("159","Kevin Jair","Ruíz","García","Masculino");
INSERT INTO personas VALUES("160","Bethsua","Castillo","Mesina","Femenino");
INSERT INTO personas VALUES("161","Fernando","Castellanos","García","Masculino");
INSERT INTO personas VALUES("162","Zuleima","López","Procopio","Femenino");
INSERT INTO personas VALUES("163","Itahi","Muñoz","Poxtan","Femenino");
INSERT INTO personas VALUES("164","Omar","Méndez","Luis","Masculino");
INSERT INTO personas VALUES("165","Gilberto Víctor","Aragón","Pérez","Masculino");
INSERT INTO personas VALUES("166","Felipe","Vásquez","Chávez","Masculino");
INSERT INTO personas VALUES("167","Luz María","López","Luis","Femenino");
INSERT INTO personas VALUES("168","Valentín","Ruíz","Cortes","Masculino");
INSERT INTO personas VALUES("169","Josué Yael","Guendulain","Pérez","Masculino");
INSERT INTO personas VALUES("170","Edgar Daniel","Azamar","Juárez","Masculino");
INSERT INTO personas VALUES("171","Gudencio","López","Hernández","Masculino");
INSERT INTO personas VALUES("172","Noemí Nicol","Aguilar","Gómez","Femenino");
INSERT INTO personas VALUES("173","Ricardo","Santiago","Cortes","Masculino");
INSERT INTO personas VALUES("174","Ángel Josué","Ramírez","Alonso","Masculino");
INSERT INTO personas VALUES("175","Axel Adrián","Mateos","Santos","Masculino");
INSERT INTO personas VALUES("176","Erick Jorge","Ramírez","López","Masculino");
INSERT INTO personas VALUES("177","Karime Arlette","Rojas","Cruz","Femenino");
INSERT INTO personas VALUES("178","Lilly Yael","Pérez","Chiu","Femenino");
INSERT INTO personas VALUES("179","Adrián Vicente","Martínez","García","Masculino");
INSERT INTO personas VALUES("180","Elvis Israel","Aquino","García","Masculino");
INSERT INTO personas VALUES("181","Juan Carlos","Morales","Morales","Masculino");
INSERT INTO personas VALUES("182","Kotati","Urbina","Rojas","Femenino");
INSERT INTO personas VALUES("183","José Dakiro","Urbina","Rojas","Masculino");
INSERT INTO personas VALUES("184","Eduardo","Méndez","Jiménez","Masculino");
INSERT INTO personas VALUES("185","Omar","Zárate","Zárate","Masculino");
INSERT INTO personas VALUES("186","Gerardo","Villanueva","Luis","Masculino");
INSERT INTO personas VALUES("187","Anderson Jervin","Robles","Reyes","Masculino");
INSERT INTO personas VALUES("188","Jorge Jafet","Félix","Cruz","Masculino");
INSERT INTO personas VALUES("189","Ciclo Nizi","Sánchez","Luis","Femenino");
INSERT INTO personas VALUES("190","Ignacio Alejandro","Hernández","Ramírez","Masculino");
INSERT INTO personas VALUES("191","Edgar","García","Pineda","Masculino");
INSERT INTO personas VALUES("192","Ebert Iván","Hernández","Jiménez","Masculino");
INSERT INTO personas VALUES("193","Luis Eduardo","Santiago","López","Masculino");
INSERT INTO personas VALUES("194","Carlos Yael","García","Olivera","Masculino");
INSERT INTO personas VALUES("195","Cristina Octavio","Cruz","Vega","Femenino");
INSERT INTO personas VALUES("196","Raúl","Doran","Osorio","Masculino");
INSERT INTO personas VALUES("197","Alexis","Martínez","López","Masculino");
INSERT INTO personas VALUES("198","Jorge Alberto","Pinto","López","Masculino");
INSERT INTO personas VALUES("199","José Daniel","Pinto","López","Masculino");
INSERT INTO personas VALUES("200","Elmer Mario","Oliva","Essesarte","Masculino");
INSERT INTO personas VALUES("201","Carlos René","Duarte","","Masculino");
INSERT INTO personas VALUES("202","Fabián","Rodríguez","Martínez","Masculino");
INSERT INTO personas VALUES("203","Félix Vladimir","Sánchez","Rodríguez","Masculino");
INSERT INTO personas VALUES("204","Fernando José","Aguilar","Lázaro","Masculino");
INSERT INTO personas VALUES("205","Miguel Ángel","López","Fonseca","Masculino");
INSERT INTO personas VALUES("206","Dafne Roque","López","Fonseca","Femenino");
INSERT INTO personas VALUES("207","Felipe de Jesús","Vargas","González","Masculino");
INSERT INTO personas VALUES("208","Jorge Arturo","Santiago","León","Masculino");
INSERT INTO personas VALUES("209","Bryant Cris","Martínez","Reyes","Masculino");
INSERT INTO personas VALUES("210","Lisbeth","Alducin","Lavarriega","Femenino");
INSERT INTO personas VALUES("211","Mirella Elizabeth","Zárate","Martínez","Femenino");
INSERT INTO personas VALUES("212","Claudia Edith","Zárate","Castellanos","Femenino");
INSERT INTO personas VALUES("213","Yael Said","Garduño","González","Masculino");
INSERT INTO personas VALUES("214","Christopher Joseph","Domínguez","Aguilar","Masculino");
INSERT INTO personas VALUES("215","Alex Alessandrs","Gross","Zárate","Masculino");
INSERT INTO personas VALUES("216","Maritza Carolina","Zárate","López","Femenino");
INSERT INTO personas VALUES("217","Roberto","Fructuoso","López","Masculino");
INSERT INTO personas VALUES("218","Esmeralda","Ramos","Laureano","Femenino");
INSERT INTO personas VALUES("219","Eduardo","Escalante","Pérez","Masculino");
INSERT INTO personas VALUES("220","Liliana Mosserrat","Valencia","Martínez","Femenino");
INSERT INTO personas VALUES("221","Ángel de Jesús","Martínez","Rodríguez","Masculino");
INSERT INTO personas VALUES("222","Arlen Yareli","Cruz","Antonio","Femenino");
INSERT INTO personas VALUES("223","Francisco Javier","Ibera","Martínez","Masculino");
INSERT INTO personas VALUES("224","Marco Antonio","Ortíz","Osorno","Masculino");
INSERT INTO personas VALUES("225","Wendy Lizeth","Gómez","López","Femenino");
INSERT INTO personas VALUES("226","José David","López","Jacinto","Masculino");
INSERT INTO personas VALUES("227","Ángela Cristina","Vásquez","","Femenino");
INSERT INTO personas VALUES("228","Daylin Belem","Olivera","Pérez","Femenino");
INSERT INTO personas VALUES("229","Armando Marcelino","Rojas","Cruz","Masculino");
INSERT INTO personas VALUES("230","Juan Francisco","Pichardo","Tinoco","Masculino");
INSERT INTO personas VALUES("231","","","","");
INSERT INTO personas VALUES("232","","","","");
INSERT INTO personas VALUES("233","","","","");
INSERT INTO personas VALUES("234","","","","");
INSERT INTO personas VALUES("235","","","","");
INSERT INTO personas VALUES("236","","","","");
INSERT INTO personas VALUES("237","","","","");
INSERT INTO personas VALUES("238","","","","");
INSERT INTO personas VALUES("239","","","","");
INSERT INTO personas VALUES("240","","","","");
INSERT INTO personas VALUES("241","","","","");
INSERT INTO personas VALUES("242","","","","");
INSERT INTO personas VALUES("243","","","","");
INSERT INTO personas VALUES("244","","","","");
INSERT INTO personas VALUES("245","","","","");
INSERT INTO personas VALUES("246","","","","");
INSERT INTO personas VALUES("247","","","","");
INSERT INTO personas VALUES("248","","","","");
INSERT INTO personas VALUES("249","","","","");
INSERT INTO personas VALUES("250","","","","");
INSERT INTO personas VALUES("251","","","","");
INSERT INTO personas VALUES("252","","","","");
INSERT INTO personas VALUES("253","","","","");
INSERT INTO personas VALUES("254","","","","");
INSERT INTO personas VALUES("255","","","","");
INSERT INTO personas VALUES("256","","","","");
INSERT INTO personas VALUES("257","","","","");
INSERT INTO personas VALUES("258","","","","");
INSERT INTO personas VALUES("259","","","","");
INSERT INTO personas VALUES("260","","","","");
INSERT INTO personas VALUES("261","","","","");
INSERT INTO personas VALUES("262","","","","");
INSERT INTO personas VALUES("263","","","","");
INSERT INTO personas VALUES("264","","","","");
INSERT INTO personas VALUES("265","","","","");
INSERT INTO personas VALUES("266","","","","");
INSERT INTO personas VALUES("267","","","","");
INSERT INTO personas VALUES("268","","","","");
INSERT INTO personas VALUES("269","","","","");
INSERT INTO personas VALUES("270","","","","");
INSERT INTO personas VALUES("271","","","","");
INSERT INTO personas VALUES("272","","","","");
INSERT INTO personas VALUES("273","","","","");
INSERT INTO personas VALUES("274","","","","");
INSERT INTO personas VALUES("275","","","","");
INSERT INTO personas VALUES("276","","","","");
INSERT INTO personas VALUES("277","","","","");
INSERT INTO personas VALUES("278","","","","");
INSERT INTO personas VALUES("279","","","","");
INSERT INTO personas VALUES("280","","","","");
INSERT INTO personas VALUES("281","","","","");
INSERT INTO personas VALUES("282","","","","");
INSERT INTO personas VALUES("283","","","","");
INSERT INTO personas VALUES("284","","","","");
INSERT INTO personas VALUES("285","","","","");
INSERT INTO personas VALUES("286","","","","");
INSERT INTO personas VALUES("287","","","","");
INSERT INTO personas VALUES("288","","","","");
INSERT INTO personas VALUES("289","","","","");
INSERT INTO personas VALUES("290","","","","");
INSERT INTO personas VALUES("291","","","","");
INSERT INTO personas VALUES("292","","","","");
INSERT INTO personas VALUES("293","","","","");
INSERT INTO personas VALUES("294","","","","");
INSERT INTO personas VALUES("295","","","","");
INSERT INTO personas VALUES("296","","","","");
INSERT INTO personas VALUES("297","","","","");
INSERT INTO personas VALUES("298","","","","");
INSERT INTO personas VALUES("299","","","","");
INSERT INTO personas VALUES("300","","","","");
INSERT INTO personas VALUES("301","","","","");
INSERT INTO personas VALUES("302","","","","");
INSERT INTO personas VALUES("303","","","","");
INSERT INTO personas VALUES("304","","","","");
INSERT INTO personas VALUES("305","","","","");
INSERT INTO personas VALUES("306","","","","");
INSERT INTO personas VALUES("307","","","","");
INSERT INTO personas VALUES("308","","","","");
INSERT INTO personas VALUES("309","","","","");
INSERT INTO personas VALUES("310","","","","");
INSERT INTO personas VALUES("311","","","","");
INSERT INTO personas VALUES("312","","","","");
INSERT INTO personas VALUES("313","","","","");
INSERT INTO personas VALUES("314","","","","");
INSERT INTO personas VALUES("315","","","","");
INSERT INTO personas VALUES("316","","","","");
INSERT INTO personas VALUES("317","","","","");
INSERT INTO personas VALUES("318","","","","");
INSERT INTO personas VALUES("319","","","","");
INSERT INTO personas VALUES("320","","","","");
INSERT INTO personas VALUES("321","","","","");
INSERT INTO personas VALUES("322","","","","");
INSERT INTO personas VALUES("323","","","","");
INSERT INTO personas VALUES("324","","","","");
INSERT INTO personas VALUES("325","","","","");
INSERT INTO personas VALUES("326","","","","");
INSERT INTO personas VALUES("327","","","","");
INSERT INTO personas VALUES("328","","","","");
INSERT INTO personas VALUES("329","","","","");
INSERT INTO personas VALUES("330","","","","");
INSERT INTO personas VALUES("331","","","","");
INSERT INTO personas VALUES("332","","","","");
INSERT INTO personas VALUES("333","","","","");
INSERT INTO personas VALUES("334","","","","");
INSERT INTO personas VALUES("335","","","","");
INSERT INTO personas VALUES("336","","","","");
INSERT INTO personas VALUES("337","","","","");
INSERT INTO personas VALUES("338","","","","");
INSERT INTO personas VALUES("339","","","","");
INSERT INTO personas VALUES("340","","","","");
INSERT INTO personas VALUES("341","","","","");
INSERT INTO personas VALUES("342","","","","");
INSERT INTO personas VALUES("343","","","","");
INSERT INTO personas VALUES("344","","","","");
INSERT INTO personas VALUES("345","","","","");
INSERT INTO personas VALUES("346","","","","");
INSERT INTO personas VALUES("347","","","","");
INSERT INTO personas VALUES("348","","","","");
INSERT INTO personas VALUES("349","","","","");
INSERT INTO personas VALUES("350","","","","");
INSERT INTO personas VALUES("351","","","","");
INSERT INTO personas VALUES("352","","","","");
INSERT INTO personas VALUES("353","","","","");
INSERT INTO personas VALUES("354","","","","");
INSERT INTO personas VALUES("355","","","","");
INSERT INTO personas VALUES("356","","","","");
INSERT INTO personas VALUES("357","","","","");
INSERT INTO personas VALUES("358","","","","");
INSERT INTO personas VALUES("359","","","","");
INSERT INTO personas VALUES("360","","","","");
INSERT INTO personas VALUES("361","","","","");
INSERT INTO personas VALUES("362","","","","");
INSERT INTO personas VALUES("363","","","","");
INSERT INTO personas VALUES("364","","","","");
INSERT INTO personas VALUES("365","","","","");
INSERT INTO personas VALUES("366","","","","");
INSERT INTO personas VALUES("367","","","","");
INSERT INTO personas VALUES("368","","","","");
INSERT INTO personas VALUES("369","","","","");
INSERT INTO personas VALUES("370","","","","");
INSERT INTO personas VALUES("371","","","","");
INSERT INTO personas VALUES("372","","","","");
INSERT INTO personas VALUES("373","","","","");
INSERT INTO personas VALUES("374","","","","");
INSERT INTO personas VALUES("375","","","","");
INSERT INTO personas VALUES("376","","","","");
INSERT INTO personas VALUES("377","","","","");
INSERT INTO personas VALUES("378","","","","");
INSERT INTO personas VALUES("379","","","","");
INSERT INTO personas VALUES("380","","","","");
INSERT INTO personas VALUES("381","","","","");
INSERT INTO personas VALUES("382","","","","");
INSERT INTO personas VALUES("383","","","","");
INSERT INTO personas VALUES("384","","","","");
INSERT INTO personas VALUES("385","","","","");
INSERT INTO personas VALUES("386","","","","");
INSERT INTO personas VALUES("387","","","","");
INSERT INTO personas VALUES("388","","","","");
INSERT INTO personas VALUES("389","","","","");
INSERT INTO personas VALUES("390","","","","");
INSERT INTO personas VALUES("391","","","","");
INSERT INTO personas VALUES("392","","","","");
INSERT INTO personas VALUES("393","","","","");
INSERT INTO personas VALUES("394","","","","");
INSERT INTO personas VALUES("395","","","","");
INSERT INTO personas VALUES("396","","","","");
INSERT INTO personas VALUES("397","","","","");
INSERT INTO personas VALUES("398","","","","");
INSERT INTO personas VALUES("399","","","","");
INSERT INTO personas VALUES("400","","","","");
INSERT INTO personas VALUES("401","","","","");
INSERT INTO personas VALUES("402","","","","");
INSERT INTO personas VALUES("403","","","","");
INSERT INTO personas VALUES("404","","","","");
INSERT INTO personas VALUES("405","","","","");
INSERT INTO personas VALUES("406","","","","");
INSERT INTO personas VALUES("407","","","","");
INSERT INTO personas VALUES("408","","","","");
INSERT INTO personas VALUES("409","","","","");
INSERT INTO personas VALUES("410","","","","");
INSERT INTO personas VALUES("411","","","","");
INSERT INTO personas VALUES("412","","","","");
INSERT INTO personas VALUES("413","","","","");
INSERT INTO personas VALUES("414","","","","");
INSERT INTO personas VALUES("415","","","","");
INSERT INTO personas VALUES("416","","","","");
INSERT INTO personas VALUES("417","","","","");
INSERT INTO personas VALUES("418","","","","");
INSERT INTO personas VALUES("419","","","","");
INSERT INTO personas VALUES("420","","","","");
INSERT INTO personas VALUES("421","","","","");
INSERT INTO personas VALUES("422","","","","");
INSERT INTO personas VALUES("423","","","","");
INSERT INTO personas VALUES("424","","","","");
INSERT INTO personas VALUES("425","","","","");
INSERT INTO personas VALUES("426","","","","");
INSERT INTO personas VALUES("427","","","","");
INSERT INTO personas VALUES("428","","","","");
INSERT INTO personas VALUES("429","","","","");
INSERT INTO personas VALUES("430","","","","");
INSERT INTO personas VALUES("431","","","","");
INSERT INTO personas VALUES("432","","","","");
INSERT INTO personas VALUES("433","","","","");
INSERT INTO personas VALUES("434","","","","");
INSERT INTO personas VALUES("435","","","","");
INSERT INTO personas VALUES("436","","","","");
INSERT INTO personas VALUES("437","","","","");
INSERT INTO personas VALUES("438","","","","");
INSERT INTO personas VALUES("439","","","","");
INSERT INTO personas VALUES("440","","","","");
INSERT INTO personas VALUES("441","","","","");
INSERT INTO personas VALUES("442","","","","");
INSERT INTO personas VALUES("443","","","","");
INSERT INTO personas VALUES("444","","","","");
INSERT INTO personas VALUES("445","","","","");
INSERT INTO personas VALUES("446","","","","");
INSERT INTO personas VALUES("447","","","","");
INSERT INTO personas VALUES("448","","","","");
INSERT INTO personas VALUES("449","","","","");
INSERT INTO personas VALUES("450","","","","");
INSERT INTO personas VALUES("451","","","","");
INSERT INTO personas VALUES("452","","","","");
INSERT INTO personas VALUES("453","","","","");
INSERT INTO personas VALUES("454","","","","");
INSERT INTO personas VALUES("455","","","","");
INSERT INTO personas VALUES("456","","","","");
INSERT INTO personas VALUES("457","","","","");
INSERT INTO personas VALUES("458","","","","");
INSERT INTO personas VALUES("459","","","","");
INSERT INTO personas VALUES("460","","","","");
INSERT INTO reconocimientos VALUES("1","229","Condecoracion por 10 años","2015-01-16","","");
INSERT INTO reconocimientos VALUES("2","229","Condecoracion por 5 años","2015-01-16","","");
INSERT INTO reconocimientos VALUES("3","230","Condecoracion por 5 años","2015-01-16","","");
INSERT INTO reconocimientos VALUES("4","230","Condecoración por 10 años","2015-01-16","","");
INSERT INTO role_user VALUES("8","1");
INSERT INTO role_user VALUES("8","2");
INSERT INTO role_user VALUES("8","3");
INSERT INTO role_user VALUES("8","4");
INSERT INTO role_user VALUES("8","5");
INSERT INTO role_user VALUES("8","6");
INSERT INTO role_user VALUES("8","7");
INSERT INTO role_user VALUES("8","8");
INSERT INTO role_user VALUES("8","9");
INSERT INTO role_user VALUES("8","10");
INSERT INTO role_user VALUES("8","11");
INSERT INTO role_user VALUES("8","12");
INSERT INTO role_user VALUES("8","13");
INSERT INTO role_user VALUES("8","14");
INSERT INTO role_user VALUES("8","15");
INSERT INTO role_user VALUES("8","16");
INSERT INTO role_user VALUES("8","17");
INSERT INTO role_user VALUES("8","18");
INSERT INTO role_user VALUES("8","19");
INSERT INTO role_user VALUES("8","20");
INSERT INTO role_user VALUES("8","21");
INSERT INTO role_user VALUES("8","22");
INSERT INTO role_user VALUES("8","23");
INSERT INTO role_user VALUES("8","24");
INSERT INTO role_user VALUES("8","25");
INSERT INTO role_user VALUES("8","26");
INSERT INTO role_user VALUES("8","27");
INSERT INTO role_user VALUES("8","28");
INSERT INTO role_user VALUES("8","29");
INSERT INTO role_user VALUES("8","30");
INSERT INTO role_user VALUES("8","31");
INSERT INTO role_user VALUES("8","32");
INSERT INTO role_user VALUES("8","33");
INSERT INTO role_user VALUES("8","34");
INSERT INTO role_user VALUES("8","35");
INSERT INTO role_user VALUES("8","36");
INSERT INTO role_user VALUES("8","37");
INSERT INTO role_user VALUES("8","38");
INSERT INTO role_user VALUES("8","39");
INSERT INTO role_user VALUES("8","40");
INSERT INTO role_user VALUES("8","41");
INSERT INTO role_user VALUES("8","42");
INSERT INTO role_user VALUES("8","43");
INSERT INTO role_user VALUES("8","44");
INSERT INTO role_user VALUES("8","45");
INSERT INTO role_user VALUES("8","46");
INSERT INTO role_user VALUES("8","47");
INSERT INTO role_user VALUES("8","48");
INSERT INTO role_user VALUES("8","49");
INSERT INTO role_user VALUES("8","50");
INSERT INTO role_user VALUES("8","51");
INSERT INTO role_user VALUES("8","52");
INSERT INTO role_user VALUES("8","53");
INSERT INTO role_user VALUES("8","54");
INSERT INTO role_user VALUES("8","55");
INSERT INTO role_user VALUES("8","56");
INSERT INTO role_user VALUES("8","57");
INSERT INTO role_user VALUES("8","58");
INSERT INTO role_user VALUES("8","59");
INSERT INTO role_user VALUES("8","60");
INSERT INTO role_user VALUES("8","61");
INSERT INTO role_user VALUES("8","62");
INSERT INTO role_user VALUES("8","63");
INSERT INTO role_user VALUES("8","64");
INSERT INTO role_user VALUES("8","65");
INSERT INTO role_user VALUES("8","66");
INSERT INTO role_user VALUES("8","67");
INSERT INTO role_user VALUES("8","68");
INSERT INTO role_user VALUES("8","69");
INSERT INTO role_user VALUES("8","70");
INSERT INTO role_user VALUES("8","71");
INSERT INTO role_user VALUES("8","72");
INSERT INTO role_user VALUES("8","73");
INSERT INTO role_user VALUES("8","74");
INSERT INTO role_user VALUES("8","75");
INSERT INTO role_user VALUES("8","76");
INSERT INTO role_user VALUES("8","77");
INSERT INTO role_user VALUES("8","78");
INSERT INTO role_user VALUES("8","79");
INSERT INTO role_user VALUES("8","80");
INSERT INTO role_user VALUES("8","81");
INSERT INTO role_user VALUES("8","82");
INSERT INTO role_user VALUES("8","83");
INSERT INTO role_user VALUES("8","84");
INSERT INTO role_user VALUES("8","85");
INSERT INTO role_user VALUES("8","86");
INSERT INTO role_user VALUES("8","87");
INSERT INTO role_user VALUES("8","88");
INSERT INTO role_user VALUES("8","89");
INSERT INTO role_user VALUES("8","90");
INSERT INTO role_user VALUES("8","91");
INSERT INTO role_user VALUES("8","92");
INSERT INTO role_user VALUES("8","93");
INSERT INTO role_user VALUES("8","94");
INSERT INTO role_user VALUES("8","95");
INSERT INTO role_user VALUES("8","96");
INSERT INTO role_user VALUES("8","97");
INSERT INTO role_user VALUES("8","98");
INSERT INTO role_user VALUES("8","99");
INSERT INTO role_user VALUES("8","100");
INSERT INTO role_user VALUES("8","101");
INSERT INTO role_user VALUES("8","102");
INSERT INTO role_user VALUES("8","103");
INSERT INTO role_user VALUES("8","104");
INSERT INTO role_user VALUES("8","105");
INSERT INTO role_user VALUES("8","106");
INSERT INTO role_user VALUES("8","107");
INSERT INTO role_user VALUES("8","108");
INSERT INTO role_user VALUES("8","109");
INSERT INTO role_user VALUES("8","110");
INSERT INTO role_user VALUES("8","111");
INSERT INTO role_user VALUES("8","112");
INSERT INTO role_user VALUES("8","113");
INSERT INTO role_user VALUES("8","114");
INSERT INTO role_user VALUES("8","115");
INSERT INTO role_user VALUES("8","116");
INSERT INTO role_user VALUES("8","117");
INSERT INTO role_user VALUES("8","118");
INSERT INTO role_user VALUES("8","119");
INSERT INTO role_user VALUES("8","120");
INSERT INTO role_user VALUES("8","121");
INSERT INTO role_user VALUES("8","122");
INSERT INTO role_user VALUES("8","123");
INSERT INTO role_user VALUES("8","124");
INSERT INTO role_user VALUES("8","125");
INSERT INTO role_user VALUES("8","126");
INSERT INTO role_user VALUES("8","127");
INSERT INTO role_user VALUES("8","128");
INSERT INTO role_user VALUES("8","129");
INSERT INTO role_user VALUES("8","130");
INSERT INTO role_user VALUES("8","131");
INSERT INTO role_user VALUES("8","132");
INSERT INTO role_user VALUES("8","133");
INSERT INTO role_user VALUES("8","134");
INSERT INTO role_user VALUES("8","135");
INSERT INTO role_user VALUES("8","136");
INSERT INTO role_user VALUES("8","137");
INSERT INTO role_user VALUES("8","138");
INSERT INTO role_user VALUES("8","139");
INSERT INTO role_user VALUES("8","140");
INSERT INTO role_user VALUES("8","141");
INSERT INTO role_user VALUES("8","142");
INSERT INTO role_user VALUES("8","143");
INSERT INTO role_user VALUES("8","144");
INSERT INTO role_user VALUES("8","145");
INSERT INTO role_user VALUES("8","146");
INSERT INTO role_user VALUES("8","147");
INSERT INTO role_user VALUES("8","148");
INSERT INTO role_user VALUES("8","149");
INSERT INTO role_user VALUES("8","150");
INSERT INTO role_user VALUES("8","151");
INSERT INTO role_user VALUES("8","152");
INSERT INTO role_user VALUES("8","153");
INSERT INTO role_user VALUES("8","154");
INSERT INTO role_user VALUES("8","155");
INSERT INTO role_user VALUES("8","156");
INSERT INTO role_user VALUES("8","157");
INSERT INTO role_user VALUES("8","158");
INSERT INTO role_user VALUES("8","159");
INSERT INTO role_user VALUES("8","160");
INSERT INTO role_user VALUES("8","161");
INSERT INTO role_user VALUES("8","162");
INSERT INTO role_user VALUES("8","163");
INSERT INTO role_user VALUES("8","164");
INSERT INTO role_user VALUES("8","165");
INSERT INTO role_user VALUES("8","166");
INSERT INTO role_user VALUES("8","167");
INSERT INTO role_user VALUES("8","168");
INSERT INTO role_user VALUES("8","169");
INSERT INTO role_user VALUES("8","170");
INSERT INTO role_user VALUES("8","171");
INSERT INTO role_user VALUES("8","172");
INSERT INTO role_user VALUES("8","173");
INSERT INTO role_user VALUES("8","174");
INSERT INTO role_user VALUES("8","175");
INSERT INTO role_user VALUES("8","176");
INSERT INTO role_user VALUES("8","177");
INSERT INTO role_user VALUES("8","178");
INSERT INTO role_user VALUES("8","179");
INSERT INTO role_user VALUES("8","180");
INSERT INTO role_user VALUES("8","181");
INSERT INTO role_user VALUES("8","182");
INSERT INTO role_user VALUES("8","183");
INSERT INTO role_user VALUES("8","184");
INSERT INTO role_user VALUES("8","185");
INSERT INTO role_user VALUES("8","186");
INSERT INTO role_user VALUES("8","187");
INSERT INTO role_user VALUES("8","188");
INSERT INTO role_user VALUES("8","189");
INSERT INTO role_user VALUES("8","190");
INSERT INTO role_user VALUES("8","191");
INSERT INTO role_user VALUES("8","192");
INSERT INTO role_user VALUES("8","193");
INSERT INTO role_user VALUES("8","194");
INSERT INTO role_user VALUES("8","195");
INSERT INTO role_user VALUES("8","196");
INSERT INTO role_user VALUES("8","197");
INSERT INTO role_user VALUES("8","198");
INSERT INTO role_user VALUES("8","199");
INSERT INTO role_user VALUES("8","200");
INSERT INTO role_user VALUES("8","201");
INSERT INTO role_user VALUES("8","202");
INSERT INTO role_user VALUES("8","203");
INSERT INTO role_user VALUES("8","204");
INSERT INTO role_user VALUES("8","205");
INSERT INTO role_user VALUES("8","206");
INSERT INTO role_user VALUES("8","207");
INSERT INTO role_user VALUES("8","208");
INSERT INTO role_user VALUES("8","209");
INSERT INTO role_user VALUES("8","210");
INSERT INTO role_user VALUES("8","211");
INSERT INTO role_user VALUES("8","212");
INSERT INTO role_user VALUES("8","213");
INSERT INTO role_user VALUES("8","214");
INSERT INTO role_user VALUES("8","215");
INSERT INTO role_user VALUES("8","216");
INSERT INTO role_user VALUES("8","217");
INSERT INTO role_user VALUES("8","218");
INSERT INTO role_user VALUES("8","219");
INSERT INTO role_user VALUES("8","220");
INSERT INTO role_user VALUES("8","221");
INSERT INTO role_user VALUES("8","222");
INSERT INTO role_user VALUES("8","223");
INSERT INTO role_user VALUES("8","224");
INSERT INTO role_user VALUES("8","225");
INSERT INTO role_user VALUES("8","226");
INSERT INTO role_user VALUES("8","227");
INSERT INTO role_user VALUES("8","228");
INSERT INTO role_user VALUES("7","229");
INSERT INTO role_user VALUES("8","229");
INSERT INTO role_user VALUES("1","230");
INSERT INTO role_user VALUES("2","230");
INSERT INTO role_user VALUES("3","230");
INSERT INTO role_user VALUES("4","230");
INSERT INTO role_user VALUES("5","230");
INSERT INTO role_user VALUES("6","230");
INSERT INTO role_user VALUES("7","230");
INSERT INTO role_user VALUES("8","230");
INSERT INTO roles VALUES("1","root");
INSERT INTO roles VALUES("2","hacieda");
INSERT INTO roles VALUES("3","tecnica");
INSERT INTO roles VALUES("4","militar");
INSERT INTO roles VALUES("5","deportiva");
INSERT INTO roles VALUES("6","organizacion");
INSERT INTO roles VALUES("7","instructor");
INSERT INTO roles VALUES("8","elemento");
INSERT INTO status VALUES("1","1","Activo","2013-12-15","Jura de bandera");
INSERT INTO status VALUES("2","2","Activo","2013-12-15","Jura de bandera");
INSERT INTO status VALUES("3","3","Activo","2013-12-15","Jura de bandera");
INSERT INTO status VALUES("4","4","Activo","2013-12-15","Jura de bandera");
INSERT INTO status VALUES("5","5","Activo","2013-12-15","Jura de bandera");
INSERT INTO status VALUES("6","6","Activo","2013-12-15","Jura de bandera");
INSERT INTO status VALUES("7","7","Activo","2013-12-15","Jura de bandera");
INSERT INTO status VALUES("8","8","Activo","2013-12-15","Jura de bandera");
INSERT INTO status VALUES("9","9","Activo","2013-12-15","Jura de bandera");
INSERT INTO status VALUES("10","10","Activo","2013-12-15","Jura de bandera");
INSERT INTO status VALUES("11","11","Activo","2013-12-15","Jura de bandera");
INSERT INTO status VALUES("12","12","Activo","2013-12-15","Jura de bandera");
INSERT INTO status VALUES("13","13","Activo","2013-12-15","Jura de bandera");
INSERT INTO status VALUES("14","14","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("15","15","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("16","16","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("17","17","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("18","18","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("19","19","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("20","20","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("21","21","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("22","22","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("23","23","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("24","24","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("25","25","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("26","26","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("27","27","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("28","28","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("29","29","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("30","30","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("31","31","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("32","32","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("33","33","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("34","34","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("35","35","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("36","36","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("37","37","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("38","38","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("39","39","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("40","40","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("41","41","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("42","42","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("43","43","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("44","44","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("45","45","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("46","46","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("47","47","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("48","48","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("49","49","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("50","50","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("51","51","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("52","52","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("53","53","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("54","54","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("55","55","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("56","56","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("57","57","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("58","58","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("59","59","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("60","60","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("61","61","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("62","62","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("63","63","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("64","64","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("65","65","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("66","66","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("67","67","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("68","68","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("69","69","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("70","70","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("71","71","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("72","72","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("73","73","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("74","74","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("75","75","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("76","76","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("77","77","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("78","78","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("79","79","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("80","80","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("81","81","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("82","82","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("83","83","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("84","84","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("85","85","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("86","86","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("87","87","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("88","88","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("89","89","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("90","90","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("91","91","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("92","92","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("93","93","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("94","94","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("95","95","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("96","96","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("97","97","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("98","98","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("99","99","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("100","100","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("101","101","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("102","102","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("103","103","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("104","104","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("105","105","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("106","106","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("107","107","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("108","108","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("109","109","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("110","110","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("111","111","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("112","112","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("113","113","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("114","114","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("115","115","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("116","116","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("117","117","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("118","118","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("119","119","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("120","120","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("121","121","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("122","122","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("123","123","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("124","124","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("125","125","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("126","126","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("127","127","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("128","128","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("129","129","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("130","130","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("131","131","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("132","132","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("133","133","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("134","134","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("135","135","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("136","136","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("137","137","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("138","138","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("139","139","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("140","140","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("141","141","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("142","142","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("143","143","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("144","144","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("145","145","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("146","146","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("147","147","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("148","148","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("149","149","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("150","150","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("151","151","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("152","152","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("153","153","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("154","154","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("155","155","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("156","156","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("157","157","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("158","158","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("159","159","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("160","160","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("161","161","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("162","162","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("163","163","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("164","164","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("165","165","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("166","166","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("167","167","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("168","168","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("169","169","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("170","170","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("171","171","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("172","172","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("173","173","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("174","174","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("175","175","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("176","176","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("177","177","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("178","178","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("179","179","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("180","180","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("181","181","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("182","182","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("183","183","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("184","184","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("185","185","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("186","186","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("187","187","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("188","188","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("189","189","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("190","190","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("191","191","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("192","192","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("193","193","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("194","194","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("195","195","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("196","196","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("197","197","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("198","198","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("199","199","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("200","200","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("201","201","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("202","202","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("203","203","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("204","204","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("205","205","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("206","206","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("207","207","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("208","208","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("209","209","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("210","210","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("211","211","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("212","212","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("213","213","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("214","214","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("215","215","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("216","216","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("217","217","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("218","218","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("219","219","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("220","220","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("221","221","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("222","222","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("223","223","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("224","224","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("225","225","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("226","226","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("227","227","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("228","228","Activo","2013-06-30","Jura de bandera");
INSERT INTO status VALUES("229","229","Activo","2001-08-18","Jura de bandera");
INSERT INTO status VALUES("230","230","Activo","1981-08-17","Jura de bandera");
INSERT INTO telefonos VALUES("1","28","1447733","fijo");
INSERT INTO telefonos VALUES("2","34","5027153","fijo");
INSERT INTO telefonos VALUES("3","50","9511278395","fijo");
INSERT INTO telefonos VALUES("4","54","5200577","fijo");
INSERT INTO telefonos VALUES("5","72","5120732","fijo");
INSERT INTO telefonos VALUES("6","99","5169745","fijo");
INSERT INTO telefonos VALUES("7","123","9512298440","fijo");
INSERT INTO telefonos VALUES("8","127","9512054300","fijo");
INSERT INTO telefonos VALUES("9","186","9512711362","fijo");
INSERT INTO telefonos VALUES("10","229","9512058676","fijo");
INSERT INTO telefonos VALUES("11","28","9511076056","movil");
INSERT INTO telefonos VALUES("12","34","9511258718","movil");
INSERT INTO telefonos VALUES("13","39","9511219237","movil");
INSERT INTO telefonos VALUES("14","44","9511259252","movil");
INSERT INTO telefonos VALUES("15","50","9511840072","movil");
INSERT INTO telefonos VALUES("16","62","9512392957","movil");
INSERT INTO telefonos VALUES("17","72","9511364352","movil");
INSERT INTO telefonos VALUES("18","99","9511854526","movil");
INSERT INTO telefonos VALUES("19","107","9511752087","movil");
INSERT INTO telefonos VALUES("20","119","9512144253","movil");
INSERT INTO telefonos VALUES("21","122","9511168118","movil");
INSERT INTO telefonos VALUES("22","127","9511793999","movil");
INSERT INTO telefonos VALUES("23","229","9511164069","movil");
INSERT INTO tipoarmas VALUES("1","Infanteria");
INSERT INTO tipocuerpos VALUES("1","Ninguno");
INSERT INTO tipocuerpos VALUES("2","Policia Militar");
INSERT INTO tipocuerpos VALUES("3","Banda de guerra");
INSERT INTO tipoeventos VALUES("1","Curso");
INSERT INTO tipoeventos VALUES("2","Concurso");
INSERT INTO tipoeventos VALUES("3","Convención");
INSERT INTO tipoeventos VALUES("4","otro");
INSERT INTO tutores VALUES("1","231","1","");
INSERT INTO tutores VALUES("2","232","2","");
INSERT INTO tutores VALUES("3","233","3","");
INSERT INTO tutores VALUES("4","234","4","");
INSERT INTO tutores VALUES("5","235","5","");
INSERT INTO tutores VALUES("6","236","6","");
INSERT INTO tutores VALUES("7","237","7","");
INSERT INTO tutores VALUES("8","238","8","");
INSERT INTO tutores VALUES("9","239","9","");
INSERT INTO tutores VALUES("10","240","10","");
INSERT INTO tutores VALUES("11","241","11","");
INSERT INTO tutores VALUES("12","242","12","");
INSERT INTO tutores VALUES("13","243","13","");
INSERT INTO tutores VALUES("14","244","14","");
INSERT INTO tutores VALUES("15","245","15","");
INSERT INTO tutores VALUES("16","246","16","");
INSERT INTO tutores VALUES("17","247","17","");
INSERT INTO tutores VALUES("18","248","18","");
INSERT INTO tutores VALUES("19","249","19","");
INSERT INTO tutores VALUES("20","250","20","");
INSERT INTO tutores VALUES("21","251","21","");
INSERT INTO tutores VALUES("22","252","22","");
INSERT INTO tutores VALUES("23","253","23","");
INSERT INTO tutores VALUES("24","254","24","");
INSERT INTO tutores VALUES("25","255","25","");
INSERT INTO tutores VALUES("26","256","26","");
INSERT INTO tutores VALUES("27","257","27","");
INSERT INTO tutores VALUES("28","258","28","");
INSERT INTO tutores VALUES("29","259","29","");
INSERT INTO tutores VALUES("30","260","30","");
INSERT INTO tutores VALUES("31","261","31","");
INSERT INTO tutores VALUES("32","262","32","");
INSERT INTO tutores VALUES("33","263","33","");
INSERT INTO tutores VALUES("34","264","34","");
INSERT INTO tutores VALUES("35","265","35","");
INSERT INTO tutores VALUES("36","266","36","");
INSERT INTO tutores VALUES("37","267","37","");
INSERT INTO tutores VALUES("38","268","38","");
INSERT INTO tutores VALUES("39","269","39","");
INSERT INTO tutores VALUES("40","270","40","");
INSERT INTO tutores VALUES("41","271","41","");
INSERT INTO tutores VALUES("42","272","42","");
INSERT INTO tutores VALUES("43","273","43","");
INSERT INTO tutores VALUES("44","274","44","");
INSERT INTO tutores VALUES("45","275","45","");
INSERT INTO tutores VALUES("46","276","46","");
INSERT INTO tutores VALUES("47","277","47","");
INSERT INTO tutores VALUES("48","278","48","");
INSERT INTO tutores VALUES("49","279","49","");
INSERT INTO tutores VALUES("50","280","50","");
INSERT INTO tutores VALUES("51","281","51","");
INSERT INTO tutores VALUES("52","282","52","");
INSERT INTO tutores VALUES("53","283","53","");
INSERT INTO tutores VALUES("54","284","54","");
INSERT INTO tutores VALUES("55","285","55","");
INSERT INTO tutores VALUES("56","286","56","");
INSERT INTO tutores VALUES("57","287","57","");
INSERT INTO tutores VALUES("58","288","58","");
INSERT INTO tutores VALUES("59","289","59","");
INSERT INTO tutores VALUES("60","290","60","");
INSERT INTO tutores VALUES("61","291","61","");
INSERT INTO tutores VALUES("62","292","62","");
INSERT INTO tutores VALUES("63","293","63","");
INSERT INTO tutores VALUES("64","294","64","");
INSERT INTO tutores VALUES("65","295","65","");
INSERT INTO tutores VALUES("66","296","66","");
INSERT INTO tutores VALUES("67","297","67","");
INSERT INTO tutores VALUES("68","298","68","");
INSERT INTO tutores VALUES("69","299","69","");
INSERT INTO tutores VALUES("70","300","70","");
INSERT INTO tutores VALUES("71","301","71","");
INSERT INTO tutores VALUES("72","302","72","");
INSERT INTO tutores VALUES("73","303","73","");
INSERT INTO tutores VALUES("74","304","74","");
INSERT INTO tutores VALUES("75","305","75","");
INSERT INTO tutores VALUES("76","306","76","");
INSERT INTO tutores VALUES("77","307","77","");
INSERT INTO tutores VALUES("78","308","78","");
INSERT INTO tutores VALUES("79","309","79","");
INSERT INTO tutores VALUES("80","310","80","");
INSERT INTO tutores VALUES("81","311","81","");
INSERT INTO tutores VALUES("82","312","82","");
INSERT INTO tutores VALUES("83","313","83","");
INSERT INTO tutores VALUES("84","314","84","");
INSERT INTO tutores VALUES("85","315","85","");
INSERT INTO tutores VALUES("86","316","86","");
INSERT INTO tutores VALUES("87","317","87","");
INSERT INTO tutores VALUES("88","318","88","");
INSERT INTO tutores VALUES("89","319","89","");
INSERT INTO tutores VALUES("90","320","90","");
INSERT INTO tutores VALUES("91","321","91","");
INSERT INTO tutores VALUES("92","322","92","");
INSERT INTO tutores VALUES("93","323","93","");
INSERT INTO tutores VALUES("94","324","94","");
INSERT INTO tutores VALUES("95","325","95","");
INSERT INTO tutores VALUES("96","326","96","");
INSERT INTO tutores VALUES("97","327","97","");
INSERT INTO tutores VALUES("98","328","98","");
INSERT INTO tutores VALUES("99","329","99","");
INSERT INTO tutores VALUES("100","330","100","");
INSERT INTO tutores VALUES("101","331","101","");
INSERT INTO tutores VALUES("102","332","102","");
INSERT INTO tutores VALUES("103","333","103","");
INSERT INTO tutores VALUES("104","334","104","");
INSERT INTO tutores VALUES("105","335","105","");
INSERT INTO tutores VALUES("106","336","106","");
INSERT INTO tutores VALUES("107","337","107","");
INSERT INTO tutores VALUES("108","338","108","");
INSERT INTO tutores VALUES("109","339","109","");
INSERT INTO tutores VALUES("110","340","110","");
INSERT INTO tutores VALUES("111","341","111","");
INSERT INTO tutores VALUES("112","342","112","");
INSERT INTO tutores VALUES("113","343","113","");
INSERT INTO tutores VALUES("114","344","114","");
INSERT INTO tutores VALUES("115","345","115","");
INSERT INTO tutores VALUES("116","346","116","");
INSERT INTO tutores VALUES("117","347","117","");
INSERT INTO tutores VALUES("118","348","118","");
INSERT INTO tutores VALUES("119","349","119","");
INSERT INTO tutores VALUES("120","350","120","");
INSERT INTO tutores VALUES("121","351","121","");
INSERT INTO tutores VALUES("122","352","122","");
INSERT INTO tutores VALUES("123","353","123","");
INSERT INTO tutores VALUES("124","354","124","");
INSERT INTO tutores VALUES("125","355","125","");
INSERT INTO tutores VALUES("126","356","126","");
INSERT INTO tutores VALUES("127","357","127","");
INSERT INTO tutores VALUES("128","358","128","");
INSERT INTO tutores VALUES("129","359","129","");
INSERT INTO tutores VALUES("130","360","130","");
INSERT INTO tutores VALUES("131","361","131","");
INSERT INTO tutores VALUES("132","362","132","");
INSERT INTO tutores VALUES("133","363","133","");
INSERT INTO tutores VALUES("134","364","134","");
INSERT INTO tutores VALUES("135","365","135","");
INSERT INTO tutores VALUES("136","366","136","");
INSERT INTO tutores VALUES("137","367","137","");
INSERT INTO tutores VALUES("138","368","138","");
INSERT INTO tutores VALUES("139","369","139","");
INSERT INTO tutores VALUES("140","370","140","");
INSERT INTO tutores VALUES("141","371","141","");
INSERT INTO tutores VALUES("142","372","142","");
INSERT INTO tutores VALUES("143","373","143","");
INSERT INTO tutores VALUES("144","374","144","");
INSERT INTO tutores VALUES("145","375","145","");
INSERT INTO tutores VALUES("146","376","146","");
INSERT INTO tutores VALUES("147","377","147","");
INSERT INTO tutores VALUES("148","378","148","");
INSERT INTO tutores VALUES("149","379","149","");
INSERT INTO tutores VALUES("150","380","150","");
INSERT INTO tutores VALUES("151","381","151","");
INSERT INTO tutores VALUES("152","382","152","");
INSERT INTO tutores VALUES("153","383","153","");
INSERT INTO tutores VALUES("154","384","154","");
INSERT INTO tutores VALUES("155","385","155","");
INSERT INTO tutores VALUES("156","386","156","");
INSERT INTO tutores VALUES("157","387","157","");
INSERT INTO tutores VALUES("158","388","158","");
INSERT INTO tutores VALUES("159","389","159","");
INSERT INTO tutores VALUES("160","390","160","");
INSERT INTO tutores VALUES("161","391","161","");
INSERT INTO tutores VALUES("162","392","162","");
INSERT INTO tutores VALUES("163","393","163","");
INSERT INTO tutores VALUES("164","394","164","");
INSERT INTO tutores VALUES("165","395","165","");
INSERT INTO tutores VALUES("166","396","166","");
INSERT INTO tutores VALUES("167","397","167","");
INSERT INTO tutores VALUES("168","398","168","");
INSERT INTO tutores VALUES("169","399","169","");
INSERT INTO tutores VALUES("170","400","170","");
INSERT INTO tutores VALUES("171","401","171","");
INSERT INTO tutores VALUES("172","402","172","");
INSERT INTO tutores VALUES("173","403","173","");
INSERT INTO tutores VALUES("174","404","174","");
INSERT INTO tutores VALUES("175","405","175","");
INSERT INTO tutores VALUES("176","406","176","");
INSERT INTO tutores VALUES("177","407","177","");
INSERT INTO tutores VALUES("178","408","178","");
INSERT INTO tutores VALUES("179","409","179","");
INSERT INTO tutores VALUES("180","410","180","");
INSERT INTO tutores VALUES("181","411","181","");
INSERT INTO tutores VALUES("182","412","182","");
INSERT INTO tutores VALUES("183","413","183","");
INSERT INTO tutores VALUES("184","414","184","");
INSERT INTO tutores VALUES("185","415","185","");
INSERT INTO tutores VALUES("186","416","186","");
INSERT INTO tutores VALUES("187","417","187","");
INSERT INTO tutores VALUES("188","418","188","");
INSERT INTO tutores VALUES("189","419","189","");
INSERT INTO tutores VALUES("190","420","190","");
INSERT INTO tutores VALUES("191","421","191","");
INSERT INTO tutores VALUES("192","422","192","");
INSERT INTO tutores VALUES("193","423","193","");
INSERT INTO tutores VALUES("194","424","194","");
INSERT INTO tutores VALUES("195","425","195","");
INSERT INTO tutores VALUES("196","426","196","");
INSERT INTO tutores VALUES("197","427","197","");
INSERT INTO tutores VALUES("198","428","198","");
INSERT INTO tutores VALUES("199","429","199","");
INSERT INTO tutores VALUES("200","430","200","");
INSERT INTO tutores VALUES("201","431","201","");
INSERT INTO tutores VALUES("202","432","202","");
INSERT INTO tutores VALUES("203","433","203","");
INSERT INTO tutores VALUES("204","434","204","");
INSERT INTO tutores VALUES("205","435","205","");
INSERT INTO tutores VALUES("206","436","206","");
INSERT INTO tutores VALUES("207","437","207","");
INSERT INTO tutores VALUES("208","438","208","");
INSERT INTO tutores VALUES("209","439","209","");
INSERT INTO tutores VALUES("210","440","210","");
INSERT INTO tutores VALUES("211","441","211","");
INSERT INTO tutores VALUES("212","442","212","");
INSERT INTO tutores VALUES("213","443","213","");
INSERT INTO tutores VALUES("214","444","214","");
INSERT INTO tutores VALUES("215","445","215","");
INSERT INTO tutores VALUES("216","446","216","");
INSERT INTO tutores VALUES("217","447","217","");
INSERT INTO tutores VALUES("218","448","218","");
INSERT INTO tutores VALUES("219","449","219","");
INSERT INTO tutores VALUES("220","450","220","");
INSERT INTO tutores VALUES("221","451","221","");
INSERT INTO tutores VALUES("222","452","222","");
INSERT INTO tutores VALUES("223","453","223","");
INSERT INTO tutores VALUES("224","454","224","");
INSERT INTO tutores VALUES("225","455","225","");
INSERT INTO tutores VALUES("226","456","226","");
INSERT INTO tutores VALUES("227","457","227","");
INSERT INTO tutores VALUES("228","458","228","");
INSERT INTO tutores VALUES("229","459","229","");
INSERT INTO tutores VALUES("230","460","230","");
INSERT INTO users VALUES("1","1","201330658","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","m3vMHzJXU21y1krrTkSrdxzxf39jGXT2uRymjxUxIYW1DwzI7NSYtjl5tZXC");
INSERT INTO users VALUES("2","2","201030093","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("3","3","201330659","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("4","4","201330920","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("5","5","201330859","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("6","6","201330860","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("7","7","201330862","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("8","8","201330875","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("9","9","201330880","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("10","10","201330855","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("11","11","201330850","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("12","12","201330854","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("13","13","201330849","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("14","14","201330744","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("15","15","201330690","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("16","16","201330675","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("17","17","201330805","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("18","18","201330652","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("19","19","201330902","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("20","20","201330721","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","T8sNrtlpUvlQZabwKLS9FYnkYvOHIjc8oT6GWMsJ3DWd8FSi9ZvyN0uwOgRf");
INSERT INTO users VALUES("21","21","201330755","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("22","22","201330684","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("23","23","201330705","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("24","24","201330700","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("25","25","201330701","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("26","26","201330751","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("27","27","201230557","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("28","28","201330897","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("29","29","201330657","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("30","30","201330745","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("31","31","201030179","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("32","32","201330699","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("33","33","201330668","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("34","34","201330663","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("35","35","201330664","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("36","36","201330667","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("37","37","201330704","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("38","38","201330732","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("39","39","201330685","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("40","40","201330905","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("41","41","201330801","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("42","42","201330803","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("43","43","201330736","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("44","44","201330693","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("45","45","201330694","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("46","46","201330654","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("47","47","201330802","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("48","48","201330741","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("49","49","201330743","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("50","50","201230571","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("51","51","201330908","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("52","52","201330809","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("53","53","201330733","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("54","54","201330682","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("55","55","201330818","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("56","56","201230572","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("57","57","201330804","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("58","58","201330708","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("59","59","201230458","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("60","60","201330811","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("61","61","201330810","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("62","62","201330673","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("63","63","201330661","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("64","64","201330725","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("65","65","201330689","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("66","66","201330683","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("67","67","201330748","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("68","68","201330691","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("69","69","201330752","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("70","70","201330728","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("71","71","201330687","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("72","72","201330670","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("73","73","201330800","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("74","74","201330913","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("75","75","201330731","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("76","76","201330680","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("77","77","201330808","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("78","78","201330806","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("79","79","201330722","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("80","80","201230510","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("81","81","201230468","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("82","82","201330799","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("83","83","201330709","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("84","84","201330679","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("85","85","201330814","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("86","86","201330707","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("87","87","201330660","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("88","88","201330697","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("89","89","201330895","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("90","90","201330865","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("91","91","201330796","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("92","92","201330797","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("93","93","201330904","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("94","94","201330726","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("95","95","201330727","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("96","96","201330698","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("97","97","201330734","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("98","98","201330696","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("99","99","201330749","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("100","100","201330879","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("101","101","201330729","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("102","102","201230564","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("103","103","201230565","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("104","104","201230567","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("105","105","201330662","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("106","106","201330678","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("107","107","201330758","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("108","108","201330757","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("109","109","201330846","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("110","110","201330574","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("111","111","201330900","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("112","112","201330901","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("113","113","201330762","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("114","114","201230428","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("115","115","201330686","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("116","116","201330666","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("117","117","201330688","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("118","118","201230509","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("119","119","201330665","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("120","120","201330815","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("121","121","201330892","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("122","122","201330742","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("123","123","201330909","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("124","124","201330703","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("125","125","201330672","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("126","126","201330764","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("127","127","201330669","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("128","128","201330798","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("129","129","201330674","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("130","130","201330655","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("131","131","201330735","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("132","132","201330681","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("133","133","201330677","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("134","134","201330750","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("135","135","201330848","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("136","136","201330723","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("137","137","201330676","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("138","138","201330671","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("139","139","201330724","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("140","140","201330706","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("141","141","201230578","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("142","142","201330702","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("143","143","201330746","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("144","144","201330906","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("145","145","201330695","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("146","146","201330753","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("147","147","201330754","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("148","148","20080510007","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("149","149","201330817","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("150","150","201330692","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("151","151","201330730","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("152","152","201330737","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("153","153","201330738","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("154","154","201330739","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("155","155","201330740","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("156","156","201330747","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("157","157","201330756","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("158","158","201330759","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("159","159","201330763","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("160","160","201330795","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("161","161","201330812","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("162","162","201330813","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("163","163","201330820","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("164","164","201330822","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("165","165","201330823","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("166","166","201330824","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("167","167","201330825","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("168","168","201330826","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("169","169","201330827","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("170","170","201330828","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("171","171","201330829","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("172","172","201330830","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("173","173","201330831","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("174","174","201330832","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("175","175","201330833","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("176","176","201330834","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("177","177","201330847","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("178","178","201330851","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("179","179","201330856","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("180","180","201330857","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("181","181","201330858","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("182","182","201330863","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("183","183","201330864","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("184","184","201330866","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("185","185","201330868","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("186","186","201330869","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("187","187","201330870","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("188","188","201330872","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("189","189","201330871","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("190","190","201330874","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("191","191","201330876","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("192","192","201330877","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("193","193","201330878","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("194","194","201330881","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("195","195","201330882","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("196","196","201330883","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("197","197","201230584","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("198","198","201230420","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("199","199","201230421","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("200","200","201330816","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("201","201","201330867","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("202","202","201330861","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("203","203","201230375","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("204","204","201330884","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("205","205","201330885","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("206","206","201330886","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("207","207","201330887","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("208","208","201330888","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("209","209","201330889","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("210","210","201330890","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("211","211","201330891","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("212","212","201330893","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("213","213","201330896","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("214","214","201330898","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("215","215","201330899","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("216","216","201330903","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("217","217","201330907","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("218","218","201330910","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("219","219","201330911","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("220","220","201330912","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("221","221","201330914","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("222","222","201330915","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("223","223","201330873","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("224","224","201330916","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("225","225","201330917","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("226","226","201330918","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("227","227","201330853","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("228","228","201330852","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","");
INSERT INTO users VALUES("229","229","201330650","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","ELh898Wce9QwcPYhRXTDegbmC4iJUWyQa3jpEWbzOeFaCGplhu26c9jdlLMd");
INSERT INTO users VALUES("230","230","20801063078","$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6","ql5F3kMlmJqDjmK191Bai4XcAotrZZ95zeWM9p4dUzyQfTKY0mcI2RrRQouk");
DELIMITER $$


DROP TRIGGER IF EXISTS userupdate;

CREATE DEFINER=root@localhost TRIGGER `userupdate` AFTER INSERT ON `cargo_elemento`
 FOR EACH ROW BEGIN
if new.cargo_id = 1 THEN 
insert into role_user (user_id,role_id) VALUES((select id from users where elemento_id=NEW.elemento_id),2);
end if;
if new.cargo_id = 2 THEN 
insert into role_user (user_id,role_id) VALUES((select id from users where elemento_id=NEW.elemento_id),3);
end if;
if new.cargo_id = 3 THEN 
insert into role_user (user_id,role_id) VALUES((select id from users where elemento_id=NEW.elemento_id),4);
end if;
if new.cargo_id = 4 THEN 
insert into role_user (user_id,role_id) VALUES((select id from users where elemento_id=NEW.elemento_id),5);
end if;
if new.cargo_id = 6 THEN 
insert into role_user (user_id,role_id) VALUES((select id from users where elemento_id=NEW.elemento_id),6);
end if;
if new.cargo_id = 11 THEN 
insert into role_user (user_id,role_id) VALUES((select id from users where elemento_id=NEW.elemento_id),7);
end if;
END;

DROP TRIGGER IF EXISTS cargoupdate;

CREATE DEFINER=root@localhost TRIGGER `cargoupdate` AFTER UPDATE ON `cargo_elemento`
 FOR EACH ROW BEGIN
if OLD.cargo_id = 1 THEN 
DELETE FROM role_user WHERE user_id = (select id from users where elemento_id=old.elemento_id) and role_id = 2;
end if;
if OLD.cargo_id = 2 THEN 
DELETE FROM role_user WHERE user_id = (select id from users where elemento_id=old.elemento_id) and role_id =3;
end if;
if OLD.cargo_id = 3 THEN 
DELETE FROM role_user WHERE user_id = (select id from users where elemento_id=old.elemento_id) and role_id =4;
end if;
if new.cargo_id = 4 THEN 
DELETE FROM role_user WHERE user_id = (select id from users where elemento_id=old.elemento_id) and role_id =5;
end if;
if OLD.cargo_id = 6 THEN 
DELETE FROM role_user WHERE user_id = (select id from users where elemento_id=old.elemento_id) and role_id =6;
end if;
if old.cargo_id = 11 THEN 
DELETE FROM role_user WHERE user_id = (select id from users where elemento_id=old.elemento_id) and role_id =7;
end if;
END;

DROP TRIGGER IF EXISTS eliminar;

CREATE DEFINER=root@localhost TRIGGER `eliminar` AFTER INSERT ON `status`
 FOR EACH ROW BEGIN
if new.tipo = 'Baja' || new.tipo = 'Inactivo' then
DELETE FROM users WHERE elemento_id = NEW.elemento_id;
end if;
if new.tipo = 'Activo' then
INSERT INTO users (elemento_id,username,password) VALUES(NEW.elemento_id,(select id from matriculas where elemento_id =NEW.elemento_id),'$2y$10$ufFmzJ4W3MAVN2AH7UB/IuKk5sk0kgjj5DczJXtTpKHquG5UNG5T6');
end if;
END;

DROP TRIGGER IF EXISTS users_AINS;

CREATE DEFINER=root@localhost TRIGGER `users_AINS` AFTER INSERT ON `users`
 FOR EACH ROW INSERT INTO role_user (user_id,role_id) VALUES(new.id,8);

DELIMITER ;


