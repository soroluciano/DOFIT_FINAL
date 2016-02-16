--
DROP DATABASE IF EXISTS `DoFit`;
--

CREATE DATABASE IF NOT EXISTS `DoFit`;
--
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "-03:00";

DROP TABLE IF EXISTS DoFit.`Admin`;
DROP TABLE IF EXISTS DoFit.`Respuesta`;
DROP TABLE IF EXISTS DoFit.`Perfil_Muro_Profesor`;
DROP TABLE IF EXISTS DoFit.`Perfil_Social`;
DROP TABLE IF EXISTS DoFit.`Pago`;
DROP TABLE IF EXISTS DoFit.`Actividad_Alumno`;
DROP TABLE IF EXISTS DoFit.`Actividad_Horario`;
DROP TABLE IF EXISTS DoFit.`Actividad`;
DROP TABLE IF EXISTS DoFit.`Profesor_Institucion`;
DROP TABLE IF EXISTS DoFit.`Ficha_Institucion`;
DROP TABLE IF EXISTS DoFit.`Ficha_Usuario`;
DROP TABLE IF EXISTS DoFit.`Deporte`;
DROP TABLE IF EXISTS DoFit.`Localidad`;
DROP TABLE IF EXISTS DoFit.`Provincia`;
DROP TABLE IF EXISTS DoFit.`Institucion`;
DROP TABLE IF EXISTS DoFit.`Usuario`;
DROP TABLE IF EXISTS DoFit.`Perfil`;
DROP TABLE IF EXISTS DoFit.`Estado`;
--
CREATE TABLE IF NOT EXISTS DoFit.`Estado` (
  `id_estado`       INT(11)     NOT NULL,
  `estado`          VARCHAR(60) NOT NULL,
  `fhcreacion`      TIMESTAMP   NOT NULL,
  `fhultmod`        TIMESTAMP   NOT NULL,
  `cusuario`        VARCHAR(60) NOT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS DoFit.`Perfil` (
  `id_perfil`   INT(11)     NOT NULL AUTO_INCREMENT,
  `perfil`      VARCHAR(60) NOT NULL,
  `fhcreacion`  TIMESTAMP   NOT NULL,
  `fhultmod`    TIMESTAMP   NOT NULL,
  `cusuario`    varchar(60) NOT NULL,
  PRIMARY KEY (`id_perfil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS DoFit.`Usuario` (
  `id_usuario`     INT(11)     NOT NULL AUTO_INCREMENT,
  `email`          VARCHAR(60) NOT NULL,
  `password`       VARCHAR(60) NOT NULL,
  `id_perfil`      INT(11)     NOT NULL,
  `id_estado`      INT(1)      NOT NULL,
  `fhcreacion`     TIMESTAMP   NOT NULL,
  `fhultmod`       TIMESTAMP   NOT NULL,
  `cusuario`       VARCHAR(60) NOT NULL,
  UNIQUE(`email`),
  PRIMARY KEY (`id_usuario`),
  CONSTRAINT `usuario_perfil_fk` FOREIGN KEY (`id_perfil`)  REFERENCES `Perfil`  (`id_perfil`),
  CONSTRAINT `usuario_estado_fk` FOREIGN KEY (`id_estado`)  REFERENCES `Estado`  (`id_estado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS DoFit.`Institucion` (
  `id_institucion` INT(11)     NOT NULL AUTO_INCREMENT,
  `email`          VARCHAR(60) NOT NULL,
  `password`       VARCHAR(60) NOT NULL,
  `fhcreacion`     TIMESTAMP   NOT NULL,
  `fhultmod`       TIMESTAMP   NOT NULL,
  `cusuario`       VARCHAR(60) NOT NULL,
  UNIQUE(`email`),
  PRIMARY KEY (`id_institucion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS DoFit.`Provincia` (
  `id_provincia`    INT(11)     NOT NULL AUTO_INCREMENT,
  `provincia`       VARCHAR(60) NOT NULL,
  `fhcreacion`      TIMESTAMP   NOT NULL,
  `fhultmod`        TIMESTAMP   NOT NULL,
  `cusuario`        VARCHAR(60) NOT NULL,
  PRIMARY KEY (`id_provincia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE IF NOT EXISTS DoFit.`Localidad` (
  `id_localidad`    INT(11)     NOT NULL AUTO_INCREMENT,
  `localidad`       VARCHAR(60) NOT NULL,
  `id_provincia`    INT(11)     NOT NULL,
  `fhcreacion`      TIMESTAMP   NOT NULL,
  `fhultmod`        TIMESTAMP   NOT NULL,
  `cusuario`        VARCHAR(60) NOT NULL,
  PRIMARY KEY (`id_localidad`),
  CONSTRAINT `localidad_provincia_fk` FOREIGN KEY (`id_provincia`)  REFERENCES `Provincia`  (`id_provincia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS DoFit.`Deporte` (
  `id_deporte`     INT(11)     NOT NULL AUTO_INCREMENT,
  `deporte`        VARCHAR(60) NOT NULL,
  `fhcreacion`     TIMESTAMP   NOT NULL,
  `fhultmod`       TIMESTAMP   NOT NULL,
  `cusuario`       VARCHAR(60) NOT NULL,
  PRIMARY KEY (`id_deporte`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS DoFit.`Ficha_Usuario` (
  `id_ficha`        INT(11)     NOT NULL AUTO_INCREMENT,
  `id_usuario`      INT(11)     NOT NULL,
  `nombre`          VARCHAR(200)NOT NULL,
  `apellido`        VARCHAR(200)NOT NULL,
  `dni`             VARCHAR(60) NOT NULL,
  `sexo`            VARCHAR(1)  NOT NULL,
  `fechanac`        DATE        NOT NULL,
  `telfijo`         VARCHAR(30)         ,
  `celular`         VARCHAR(30)         ,
  `conemer`         VARCHAR(60)         ,  /* CONTACTO POR EMERGENCIA!! */
  `telemer`         VARCHAR(30)         ,  /* TELEFONO CONTACTO POR EMERGENCIA */
  `id_localidad`    INT(11)     NOT NULL,
  `direccion`       VARCHAR(60) NOT NULL,
  `piso`            VARCHAR(10)         ,
  `depto`           VARCHAR(10)         ,
  `fhcreacion`      TIMESTAMP   NOT NULL,
  `fhultmod`        TIMESTAMP   NOT NULL,
  `cusuario`        VARCHAR(60) NOT NULL,
  UNIQUE(`dni`),
  UNIQUE(`id_usuario`),
  PRIMARY KEY (`id_ficha`),
  CONSTRAINT `ficha_localidad_fk` FOREIGN KEY (`id_localidad`)  REFERENCES `Localidad`  (`id_localidad`),
  CONSTRAINT `ficha_usuario_fk`   FOREIGN KEY (`id_usuario`)    REFERENCES `Usuario`    (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS DoFit.`Ficha_Institucion` (
  `id_ficha`         INT(11)     NOT NULL AUTO_INCREMENT,
  `id_institucion`   INT(11)     NOT NULL,
  `nombre`           VARCHAR(200)NOT NULL,
  `cuit`             BIGINT(30)     NOT NULL,
  `telfijo`          VARCHAR(30)         ,
  `celular`          VARCHAR(30)         ,
  `id_localidad`     INT(11)     NOT NULL,
  `direccion`        VARCHAR(60) NOT NULL,
  `piso`             VARCHAR(10)         ,
  `depto`            VARCHAR(10)         ,
  `coordenada_x`     VARCHAR(50)         ,
  `coordenada_y`     VARCHAR(50)         ,
  `acepta_mp`        VARCHAR(1)          ,
  `fhcreacion`       TIMESTAMP   NOT NULL,
  `fhultmod`         TIMESTAMP   NOT NULL,
  `cusuario`         VARCHAR(60) NOT NULL,
  UNIQUE(`cuit`),
  UNIQUE(`id_institucion`),
  PRIMARY KEY (`id_ficha`),
  CONSTRAINT `ficha_institucion_localidad_fk`     FOREIGN KEY (`id_localidad`)   REFERENCES `Localidad`   (`id_localidad`),
  CONSTRAINT `ficha_institucion_institucion_fk`   FOREIGN KEY (`id_institucion`) REFERENCES `Institucion` (`id_institucion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE IF NOT EXISTS DoFit.`Profesor_Institucion` (
  `id_usuario`        INT(11)     NOT NULL,
  `id_institucion`    INT(11)     NOT NULL,
  `id_estado`         INT(1)      NOT NULL,
  `fhcreacion`        TIMESTAMP   NOT NULL,
  `fhultmod`          TIMESTAMP   NOT NULL,
  `cusuario`          VARCHAR(60) NOT NULL,
  PRIMARY KEY (`id_usuario`,`id_institucion`),
  CONSTRAINT  `profesor_institucion_usuario_fk`     FOREIGN KEY (`id_usuario`)        REFERENCES `Usuario`       (`id_usuario`),
  CONSTRAINT  `profesor_institucion_institucion_fk` FOREIGN KEY (`id_institucion`)    REFERENCES `Institucion`   (`id_institucion`),
  CONSTRAINT  `profesor_institucion_estado_fk`      FOREIGN KEY (`id_estado`)         REFERENCES `Estado`        (`id_estado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE IF NOT EXISTS DoFit.`Actividad` (
  `id_actividad`    INT(11)       NOT NULL AUTO_INCREMENT,
  `id_deporte`      INT(11)       NOT NULL,
  `id_institucion`  INT(11)       NOT NULL,
  `id_usuario`      INT(11)       NOT NULL,
  `valor_actividad` NUMERIC(15,2) NOT NULL,
  `fhcreacion`      TIMESTAMP     NOT NULL,
  `fhultmod`        TIMESTAMP     NOT NULL,
  `cusuario`        VARCHAR(60)   NOT NULL,
  PRIMARY KEY (`id_actividad`),
  CONSTRAINT `actividad_profesor_institucion_fk` FOREIGN KEY (`id_usuario`,`id_institucion`)  REFERENCES `Profesor_Institucion`  (`id_usuario`,`id_institucion`),
  CONSTRAINT `actividad_deporte_fk`              FOREIGN KEY (`id_deporte`)                   REFERENCES `Deporte`  (`id_deporte`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS DoFit.`Actividad_Horario` (
  `id_actividad`   INT(11)     NOT NULL,
  `id_dia`         INT(11)     NOT NULL,
  `hora`           INT(11)     NOT NULL,
  `minutos`        INT(11)     NOT NULL,
  `fhcreacion` TIMESTAMP   NOT NULL,
  `fhultmod`   TIMESTAMP   NOT NULL,
  `cusuario`   VARCHAR(60) NOT NULL,
  PRIMARY KEY (`id_actividad`,`id_dia`),
  CONSTRAINT `actividad_horario_actividad_fk` FOREIGN KEY (`id_actividad`)  REFERENCES `Actividad`  (`id_actividad`)
  /* CONSTRAINT `actividad_horario_dia_fk`       FOREIGN KEY (`id_dia`)        REFERENCES `Dia`        (`id_dia`) */
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
  

CREATE TABLE IF NOT EXISTS DoFit.`Actividad_Alumno` (
  `id_actividad`   INT(11)     NOT NULL,
  `id_usuario`     INT(11)     NOT NULL,
  `id_estado`      INT(1)      NOT NULL,
  `fhcreacion`     TIMESTAMP   NOT NULL,
  `fhultmod`       TIMESTAMP   NOT NULL,
  `cusuario`       VARCHAR(60) NOT NULL,
  PRIMARY KEY (`id_actividad`,`id_usuario`),
  CONSTRAINT `actividad_alumno_actividad_fk`  FOREIGN KEY (`id_actividad`)  REFERENCES `Actividad`  (`id_actividad`),
  CONSTRAINT `actividad_alumno_usuario_fk`    FOREIGN KEY (`id_usuario`)    REFERENCES `Usuario`    (`id_usuario`),
  CONSTRAINT `actividad_ac_estado_fk`         FOREIGN KEY (`id_estado`)     REFERENCES `Estado`     (`id_estado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE IF NOT EXISTS DoFit.`Pago` (
  `id_actividad`   INT(11)       NOT NULL,
  `id_usuario`     INT(11)       NOT NULL,
  `mes`            INT(11)       NOT NULL,
  `anio`           INT(11)       NOT NULL,
  `monto`          NUMERIC(15,2) NOT NULL,
  `fhcreacion` TIMESTAMP     NOT NULL,
  `fhultmod`   TIMESTAMP     NOT NULL,
  `cusuario`   VARCHAR(60)   NOT NULL,
  PRIMARY KEY (`id_actividad`,`id_usuario`,`mes`,`anio`),
  CONSTRAINT `pago_actividad_alumno_fk` FOREIGN KEY (`id_actividad`,`id_usuario`) REFERENCES `Actividad_Alumno`  (`id_actividad`,`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS DoFit.`Perfil_Social` (
  `id_usuario`     INT(11)       NOT NULL,
  `fotoperfil`     VARCHAR(60)           ,
  `foto1`          VARCHAR(60)           ,
  `foto2`          VARCHAR(60)           ,
  `foto3`          VARCHAR(60)           ,
  `foto4`          VARCHAR(60)           ,
  `foto5`          VARCHAR(60)           ,
  `foto6`          VARCHAR(60)           ,
  `descripcion`    VARCHAR(3000)         ,
  `fhcreacion`     TIMESTAMP     NOT NULL,
  `fhultmod`       TIMESTAMP     NOT NULL,
  `cusuario`       VARCHAR(60)   NOT NULL,
  PRIMARY KEY (`id_usuario`),
  CONSTRAINT `perfil_social_usuario_fk`  FOREIGN KEY (`id_usuario`) REFERENCES `Usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS DoFit.`Perfil_Muro_Profesor` (
  `id_posteo`       INT(11)       NOT NULL AUTO_INCREMENT,
  `posteo`          VARCHAR(2000) NOT NULL,
  `id_actividad`    INT(11)       NOT NULL,
  `fhcreacion`      TIMESTAMP     NOT NULL,
  `fhultmod`        TIMESTAMP     NOT NULL,
  `cusuario`        VARCHAR(60)   NOT NULL,
  PRIMARY KEY (`id_posteo`),
  CONSTRAINT `perfil_muro_profesor_actividad_fk`  FOREIGN KEY (`id_actividad`) REFERENCES `Actividad` (`id_actividad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS DoFit.`Respuesta` (
  `id_posteo`       INT(11)       NOT NULL,
  `id_respuesta`    INT(11)       NOT NULL,
  `respuesta`       VARCHAR(2000) NOT NULL,
  `id_usuario`      INT(11)       NOT NULL,
  `fhcreacion`      TIMESTAMP     NOT NULL,
  `fhultmod`        TIMESTAMP     NOT NULL,
  `cusuario`        VARCHAR(60)   NOT NULL,
  PRIMARY KEY (`id_posteo`,`id_respuesta`),
  CONSTRAINT `respuesta_perfil_muro_profesor_fk`  FOREIGN KEY (`id_posteo`)    REFERENCES `Perfil_Muro_Profesor` (`id_posteo`),
  CONSTRAINT `respuesta_usuario_fk`               FOREIGN KEY (`id_usuario`)   REFERENCES `Usuario`              (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS DoFit.`Admin` (
  `id_usuario`     INT(11)     NOT NULL AUTO_INCREMENT,
  `usuario`        VARCHAR(60) NOT NULL,
  `password`       VARCHAR(60) NOT NULL,
  `fhcreacion`     TIMESTAMP   NOT NULL,
  UNIQUE(`usuario`),
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Creación de la tabla Conversación ----- 
DROP TABLE IF EXISTS DoFit.`Conversacion`;
CREATE TABLE DoFit.`Conversacion` (
  `id_conversacion` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(45) DEFAULT NULL,
  `mensaje` varchar(45) DEFAULT NULL,
  `id_usuarioori` INT NOT NULL,
  `id_usuariodes` INT NOT NULL, 
  `id_usuario` INT NOT NULL,
  PRIMARY KEY (`id_conversacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

 
 /* INSERTS */ 
 
DELETE FROM DoFit.`Provincia`;

INSERT INTO DoFit.`Provincia`
(provincia     , fhcreacion, fhultmod, cusuario) 
VALUES 
('Buenos Aires', now()     , now()   , 'sysadmin'),
('Catamarca'   , now()     , now()   , 'sysadmin'),
('Chaco'       , now()     , now()   , 'sysadmin'), 					   
('Chubut'      , now()     , now()   , 'sysadmin'), 
('Córdoba'     , now()     , now()   , 'sysadmin'),
('Corrientes'  , now()     , now()   , 'sysadmin'),
('Entre Ríos'  , now()     , now()   , 'sysadmin'),
('Formosa'     , now()     , now()   , 'sysadmin'),
('Jujuy'       , now()     , now()   , 'sysadmin'),
('La Pampa'    , now()     , now()   , 'sysadmin'),
('La Rioja'    , now()     , now()   , 'sysadmin'),
('Mendoza'     , now()     , now()   , 'sysadmin'),
('Misiones'    , now()     , now()   , 'sysadmin'),
('Neuquén'     , now()     , now()   , 'sysadmin'),
('Rio Negro'   , now()     , now()   , 'sysadmin'),
('Salta'       , now()     , now()   , 'sysadmin'),
('San Juan'    , now()     , now()   , 'sysadmin'),
('San Luis'    , now()     , now()   , 'sysadmin'),
('Santa Cruz'  , now()     , now()   , 'sysadmin'),
('Santa Fé'    , now()    , now()    , 'sysadmin'),
('Santiago del Estero',  now()    , now()  , 'sysadmin'),
('Tierra del Fuego'   ,  now()    , now()  , 'sysadmin'),
('Tucumán'            ,  now()    , now()  , 'sysadmin');
					  
DELETE FROM DoFit.`Localidad`;
					 
INSERT INTO DoFit.`Localidad`(localidad, id_provincia, fhcreacion, fhultmod, cusuario)
VALUES
('Morón'                                , 1, now() , now(), 'sysadmin'),
('San Martin'                           , 1, now() , now(), 'sysadmin'),				 
('Avellaneda'                           , 1, now() , now(), 'sysadmin'),
('Ramos Mejía'                          , 1, now() , now(), 'sysadmin'),
('San Justo'                            , 1, now() , now(), 'sysadmin'),
('Banfield'                             , 1, now() , now(), 'sysadmin'),
('Capital Federal'                      , 1, now() , now(), 'sysadmin'),
('Heado'                                , 1, now() , now(), 'sysadmin'),
('Quilmes'                              , 1, now() , now(), 'sysadmin'),
('Lanus'                                , 1, now() , now(), 'sysadmin'),
('Mar del Plata'                        , 1, now() , now(), 'sysadmin'),
('Navarro'                              , 1, now() , now(), 'sysadmin'),
('San Fernando del valle de Catamarca'  , 2, now() , now(), 'sysadmin'),
('Fiambala'                             , 2, now() , now(), 'sysadmin'),
('Resistencia'                          , 3, now() , now(), 'sysadmin'),
('Rawson'                               , 4, now() , now(), 'sysadmin'),
('Córdoba'                              , 5, now() , now(), 'sysadmin'),
('Corrientes'                           , 6, now() , now(), 'sysadmin'),
('Paraná'                               , 7, now() , now(), 'sysadmin'),
('Gualeguaychú'                         , 7, now() , now(), 'sysadmin'),
('Gualeguay'                            , 7, now() , now(), 'sysadmin'),
('Formosa'                              , 8, now() , now(), 'sysadmin'),
('San Salvador de Jujuy'                , 9, now() , now(), 'sysadmin'),
('Santa Rosa'                          , 10, now() , now(), 'sysadmin'),					   
('La Rioja'                            , 11, now() , now(), 'sysadmin'), 
('Mendoza'                             , 12, now() , now(), 'sysadmin'),
('Posadas'                             , 13, now() , now(), 'sysadmin'),
('Neuquén'                             , 14, now() , now(), 'sysadmin'),
('Viedma'                              , 15, now() , now(), 'sysadmin'),
('Las grutas'                          , 15, now() , now(), 'sysadmin'),
('Salta'                               , 16, now() , now(), 'sysadmin'),  					   
('San Juan'                            , 17, now() , now(), 'sysadmin'),
('San Luis'                            , 18, now() , now(), 'sysadmin'),
('Río Gallegos'                        , 19, now() , now(), 'sysadmin'),
('Santa Fe'                            , 20, now() , now(), 'sysadmin'),
('Santiago del Estero'                 , 21, now() , now(), 'sysadmin'), 
('Ushuaia'                             , 22, now() , now(), 'sysadmin'), 
('San Miguel de Tucumán'               , 23, now() , now(), 'sysadmin');

DELETE FROM DoFit.`Perfil`;

INSERT INTO DoFit.`Perfil`
(perfil, fhcreacion, fhultmod, cusuario )
VALUES 
('Alumno'  , now()     , now()   , 'sysadmin'),
('Profesor', now()     , now()   , 'sysadmin');
 			 
DELETE FROM DoFit.`Estado`;
			 
INSERT INTO DoFit.`Estado`
(id_estado, estado      , fhcreacion, fhultmod, cusuario)
VALUES 
(0,'En espera' , now()     , now()   , 'sysadmin'),
(1,'Confirmado', now()     , now()   , 'sysadmin');

DELETE FROM DoFit.`Deporte`;

INSERT INTO DoFit.`Deporte`
(deporte, fhcreacion, fhultmod, cusuario)
VALUES
('Fútbol'           , now()    ,  now()   , 'sysadmin'),
('Basquet'          , now()    ,  now()   , 'sysadmin'),
('Natación'         , now()    ,  now()   , 'sysadmin'),
('Fútsal'           , now()    ,  now()   , 'sysadmin'),
('Hockey'           , now()    ,  now()   , 'sysadmin'),
('Handball'         , now()    ,  now()   , 'sysadmin'),
('Judo'             , now()    ,  now()   , 'sysadmin'),
('Atletismo'        , now()    ,  now()   , 'sysadmin'),
('Kung-Fu'          , now()    ,  now()   , 'sysadmin'),
('Teakwondo'        , now()    ,  now()   , 'sysadmin'),
('Tenis'            , now()    ,  now()   , 'sysadmin'),
('Voley'            , now()    ,  now()   , 'sysadmin'),
('Rugby'            , now()    ,  now()   , 'sysadmin'),
('Esgrima'          , now()    ,  now()   , 'sysadmin'),
('Boxeo'            , now()    ,  now()   , 'sysadmin'),  
('Karate'           , now()    ,  now()   , 'sysadmin'),   
('Cross-Fit'        , now()    ,  now()   , 'sysadmin'),	 
('Pesas-Musculación', now()    ,  now()   , 'sysadmin'),
('Spinning'         , now()    ,  now()   , 'sysadmin'),
('Polo'             , now()    ,  now()   , 'sysadmin'),
('Kempo'            , now()    ,  now()   , 'sysadmin'),
('Ping-pong'        , now()    ,  now()   , 'sysadmin'),
('Acqua GYM'        , now()    ,  now()   , 'sysadmin'),
('Waterpolo'        , now()    ,  now()   , 'sysadmin');

DELETE FROM DoFit.`Usuario`;

INSERT INTO DoFit.`Usuario`(email                   , password       , id_perfil  , id_estado, fhcreacion, fhultmod, cusuario)
                   VALUES('monti.rober9@gmail.com', MD5('Monto123'), 1          , 1       , now()    , now()   , 'sysadmin'),
                         ('programacionweb3@gmail.com', MD5('Lorena23'), 1          , 1       , now()    , now()   , 'sysadmin'),
                         ('dcastellini89@gmail.com'   , MD5('Castellini123'),1      , 1       , now()    , now()   , 'sysadmin'),
                         ('romina@gmail.com'          , MD5('Romina123')    ,1      , 1       , now()    , now()   , 'sysadmin'),  
                         ('vernacci_elizabeth@gmail.com', MD5('Oberto345'), 2     , 1       , now()    , now()   , 'sysadmin'),
                         ('monto_rober@yahoo.com.ar'    , MD5('Bautista12') , 2      , 1     , now()    , now()   , 'sysadmin'),
                         ('soro.luciano@gmail.com', MD5('Luciano34')       , 2       , 1      , now()    , now()  , 'sysadmin'),
                         ('barbifranco23@gmail.com'  , MD5('Monto1987')   ,  1      , 0    , now()      , now()  , 'sysadmin'),
                         ('jrodriguez@gmail.com'     , MD5('Jrodriguez12'), 1       , 1    , now()      , now()  , 'sysadmin'),
                         ('laspinetta@gmail.com'       , MD5('Spinetta345'), 1        , 1    , now()      , now()  , 'sysadmin'),
                         ('kperez@yahoo.com.ar'      , MD5('Karina123')  , 1        , 1    , now()      , now()  , 'sysadmin'),
                         ('yjuarez@gmail.com'		 , MD5('Yazmin123')  , 1        , 1    , now()      , now()  , 'sysadmin'),      				 
                         ('urodriguez@gmail.com'     , MD5('Urodriguez123'),1       , 1    , now()      , now()  , 'sysadmin');
DELETE FROM DoFit.`ficha_usuario`;						 

INSERT INTO DoFit.`ficha_usuario`(id_usuario, nombre    , apellido, dni, sexo, fechanac, telfijo, celular, conemer, telemer, id_localidad, direccion, piso, depto, fhcreacion, fhultmod, cusuario)
                         VALUES(1         , 'Roberto' , 'Montoto', '32823932', 'M', '1987-01-10', '54374616', '1558204125', 'Mercedes Alderte', '46971769',  1, 'Coronel Arenas 1151', '', '', now(), now(), 'sysadmin'),
                               (2         , 'Rodolfo' , 'Lopez'  , '28067980', 'M', '1980-02-26', '469692030', '1567803450', 'Lorena Paola'   , '45678909',  4, 'Alsina 360', '', '', now(), now(), 'sysadmin'),
                               (3         , 'Damian', 'Castellini','33405780', 'M', '1989-03-17', '56709809', '1545670980', 'Micaela Lopez'  , NULL      ,  4, 'Conesa 289', '2', 'B', now(), now(), 'sysadmin'),
                               (4         , 'Romina'   , 'Gaetani','25098670', 'F', '1983-09-21', '56708900', '1567003410', 'Nicolas Gaetani' , '54309087', 5, 'Florencio Varela 1300', '', '', now(), now(), 'sysadmin'),
                               (5         , 'Elizabeth'  , 'Vernacci', '27089780', 'F' , '1975-07-07', '54360986', '156700978', 'Luciano Vernacci', '54609007', 7, 'Pellegrini 1350' , '1' , 'A', now(), now(), 'sysadmin'),
                               (6         , 'Martin'  , 'Palermo', '22340678', 'M' , '1973-11-07', '54260967','151890078', 'Yamila Tevez', '67004500', 13, 'Parejas 340' , '' , '', now(), now(), 'sysadmin'),
                               (7         , 'Luciano'         , 'Soro','30560781', 'M' , '1982-10-02','54260111','151456890', 'Lorena Soro', '678004500',5, 'Camino de cintura 340' , '' , '', now(), now(), 'sysadmin'),
                               (8         , 'Barbara'         , 'Franco', '23109567', 'F' , '1986-09-21','54568991','156789077', 'Tamara Franco', '45603201', 7, 'Av. Cordoba 430'     , '' , '', now(), now(), 'sysadmin'), 
                               (9         , 'José'            , 'Rodriguez', '23450987', 'M', '1990-03-20','46978097','1567905600', 'Jose Peréz', '45670987', 1, 'Lanus 340'           , '','',now(), now(), 'sysadmin'), 
                               (10        , 'Luis Alberto'    , 'Spinetta', '14506780', 'M', '1950-01-23','46780466','1567801230', 'Catalina Spinetta', '45671230', 7 , 'Av. Libertador 5600' , '5','C',now(), now(), 'sysadmin'),
                               (11        , 'Karina'          , 'Perez'   , '23056709', 'F', '1980-03-24','43201240','1567803401', 'Lorena Perez', '45601230', 17 , 'Av. Rivadavia 340' , '','',now(), now(), 'sysadmin'), 
                               (12        , 'Yazmin'          , 'Juarez'  , '29560340', 'F', '1988-09-21','43102300','1556903200', 'Jose Juarez', '44201200', 30 ,'Bariloche y catriel ' , '','',now(), now(), 'sysadmin'),							   							   
                               (13        , 'Ulises'          , 'Gonzalez', '19708340', 'M', '1990-10-23', '41085600', '1546002300', 'Ulises Gonzalez', '42011600', 27, 'Colon 1764', '', '', now(), now(), 'sysadmin');                
DELETE FROM DoFit.`institucion`;	
						   
INSERT INTO DoFit.`institucion`(email               , password          , fhcreacion, fhultmod, cusuario)
                       VALUES('megatlon@gmail.com', md5('Megatlon123'), now()     , now()   , 'sysadmin'),
                             ('unlam@yahoo.com.ar'  , md5('Unlam678')   , now()     , now()   , 'sysadmin'),
                             ('bocajuniors@gmail.com', md5('Boca345'), now()   , now()   , 'sysadmin'),
                             ('losamigos@gmail.com', md5('Agatha123')  , now()   , now()   , 'sysadmin'),
                             ('programacionweb3@gmail.com', md5('Lorena23'), now() , now() , 'sysadmin');

DELETE FROM DoFit.`ficha_institucion`;

INSERT INTO DoFit.`ficha_institucion`(id_institucion, nombre         , cuit, telfijo , celular      , id_localidad, direccion, piso, depto, coordenada_x, coordenada_y, acepta_mp, fhcreacion, fhultmod, cusuario)
                               VALUES(1             , 'Megatlon S.A.'                     , 30210009941, '0810-666-6496','1560203456', 7 , 'Reconquista 335', 'PB', ''  , '-34.603930', '-58.372369', 'S'     , now(), now(), 'sysadmin'),
                                     (2             , 'Universidad Nacional de La Matanza',  31345066691, '4480-8900', '1123905890', 5 , 'Florencio Varela 1903', NULL, NULL, '-34.670580', '-58.562751', 'N', now(), now(), 'sysadmin'),
                                     (3             , 'Club Atletico Boca Juniors '       , 30780910107, ' 5777-1200', '1543041212', 7 , 'Del Valle Iberlucea'  , ''  , ''  ,'-34.633399', '-58.365223',  'S', now(), now(), 'sysadmin'),
                                     (4             , 'Thaler S.A.'                , 20899909901, '4697-6008' , '1567803400', 1, 'Avenida Rivadavia 18037'       , ''  , ''  ,'-34.649347', '-58.617812', 'S', now(), now(), 'sysadmin'),
                                     (5             , 'Tu Gimansio'                , 30670890121, '5400-9008'	, '1567803200', 37, 'Gobernador Pedro Godoy 257'   , ''  , ''  , '-54.804559', '-68.303432', 'N', now(), now(), 'sysadmin');  

DELETE FROM DoFit.`profesor_institucion`;
								   
INSERT INTO DoFit.profesor_institucion(id_usuario, id_institucion, id_estado, fhcreacion, fhultmod, cusuario)
                                VALUES(5         , 1             , 1        , now()     ,  now()  , 'sysadmin'),
                                      (5         , 4             , 1        , now()     ,  now()  , 'sysadmin'),
                                      (6         , 3             , 1        , now()     ,  now()  , 'sysadmin'),
                                      (5         , 2             , 1        , now()     ,  now()  , 'sysadmin'),
                                      (6         , 4             , 0        , now()     ,  now()  , 'sysadmin'),
                                      (7         , 1             , 0        , now()     ,  now()  , 'sysadmin'),
                                      (7         , 5             , 1        , now()     ,  now()  , 'sysadmin'),
                                      (6         , 1             , 1        , now()     ,  now()  , 'sysadmin');

DELETE FROM DoFit.`actividad`;									  

INSERT INTO DoFit.`actividad`(id_deporte, id_institucion, id_usuario, valor_actividad, fhcreacion, fhultmod, cusuario)
                       VALUES(1         ,   3           ,   6       ,  300.00        , now()     ,  now()  , 'sysadmin'),
                             (1         ,   1           ,   6 	    ,  400.00        , now()     ,  now()  , 'sysadmin'),
                      	     (3         ,   2           ,   5 	    ,  390.00        , now()     ,  now()  , 'sysadmin'),
                             (12        ,   2           ,   5 	    ,  450.00        , now()     ,  now()  , 'sysadmin'),	
                             (2         ,   5           ,   7       ,  550.00        , now()     ,  now()  , 'sysadmin'),
                             (16        ,   1           ,   7       ,  400.00        , now()     ,  now()  , 'sysadmin'),
                             (17        ,   4           ,   6       ,  450.00        , now()     ,  now()  , 'sysadmin'),
                             (21        ,   5           ,   7       ,  250.00        , now()     ,  now()  , 'sysadmin');

DELETE FROM DoFit.`actividad_horario`;
							 
INSERT INTO DoFit.`actividad_horario`(id_actividad, id_dia, hora, minutos, fhcreacion, fhultmod, cusuario)
                               VALUES(1          , 1      , 20 , 30     , now()      , now()   , 'sysadmin'),
                                     (1          , 4      , 19 , 00     , now()      , now()   , 'sysadmin'),
                                     (2          , 5      , 20 , 00     , now()      , now()   , 'sysadmin'),
                                     (2          , 6      , 15 , 30     , now()      , now()   , 'sysadmin'),   
                                     (3          , 2      , 18 , 00     , now()      , now()   , 'sysadmin'),
                                     (3          , 5      , 19 , 00     , now()      , now()   , 'sysadmin'),
                                     (4          , 1      , 16 , 30     , now()      , now()   , 'sysadmin'),
                                     (4          , 2      , 17 , 45     , now()      , now()   , 'sysadmin'),
                                     (5          , 4      , 18 , 00     , now()      , now()   , 'sysadmin'),
                                     (6          , 3      , 21 , 00     , now()      , now()   , 'sysadmin'),
                                     (7          , 5      , 10 , 15     , now()      , now()   , 'sysadmin'),
                                     (8          , 6      , 20 , 45     , now()      , now()   , 'sysadmin'),
                                     (8          , 1      , 22 , 00     , now()      , now()   , 'sysadmin');

DELETE FROM DoFit.`actividad_alumno`;
									 
INSERT INTO DoFit.`actividad_alumno`(id_actividad, id_usuario, id_estado, fhcreacion, fhultmod, cusuario)
                             VALUES(1           , 1         , 1        ,  now()    , now()   , 'sysadmin'),
                                   (1           , 2         , 1        ,  now()	  , now()   , 'sysadmin'),	
                                   (1           , 3         , 1        ,  now()    , now()   , 'sysadmin'),
                                   (2           , 2         , 1        ,  now()	  , now()   , 'sysadmin'),
                                   (2           , 1         , 1        ,  now()	  , now()   , 'sysadmin'),
                                   (3           , 1         , 1        ,  now()	  , now()   , 'sysadmin'),
                                   (3           , 2         , 1        ,  now()	  , now()   , 'sysadmin'),
                                   (3           , 3         , 1        ,  now()	  , now()   , 'sysadmin'),	
                                   (3           , 4         , 1        ,  now()	  , now()   , 'sysadmin'),	
                                   (3           , 5         , 1        ,  now()	  , now()   , 'sysadmin'),
                                   (3           , 6         , 1        ,  now()	  , now()   , 'sysadmin'),
                                   (3           , 7         , 1        ,  now()	  , now()   , 'sysadmin'),
                                   (3           , 9         , 1        ,  now()	  , now()   , 'sysadmin'),
                                   (3           , 10        , 1        ,  now()	  , now()   , 'sysadmin'),
                                   (3           , 11        , 1        ,  now()	  , now()   , 'sysadmin'),
                                   (3           , 12        , 1        ,  now()	  , now()   , 'sysadmin'),
                                   (3           , 13        , 1        ,  now()   , now()   , 'sysadmin'), 
                                   (4           , 2         , 1        ,  now()	  , now()   , 'sysadmin'),
                                   (4           , 4         , 1        ,  now()	  , now()   , 'sysadmin'),
                                   (5           , 1         , 1        ,  now()	  , now()   , 'sysadmin'),
                                   (5           , 2         , 1        ,  now()	  , now()   , 'sysadmin'),
                                   (6           , 3         , 1        ,  now()	  , now()   , 'sysadmin'),
                                   (6           , 2         , 1        ,  now()	  , now()   , 'sysadmin'),
                                   (7           , 1         , 1        ,  now()	  , now()   , 'sysadmin'),
                                   (7           , 4         , 1        ,  now()	  , now()   , 'sysadmin'),
                                   (8           , 3         , 1        ,  now()	  , now()   , 'sysadmin'),
                                   (7           , 2         , 1        ,  now()    , now()   , 'sysadmin');

DELETE FROM DoFit.`Admin`;

INSERT INTO DoFit.`Admin`
(usuario, password, fhcreacion)
VALUES
('admin',md5('1234'),now());
							  
INSERT INTO DoFit.`Perfil_Social`
(id_usuario, foto1, foto2, foto3, foto4, foto5, descripcion, fhcreacion, fhultmod, cusuario, fotoPerfil, foto6)
VALUES
(1, 'images.jpg', NULL, NULL, NULL, NULL, 'Futbolista argentino. Delantero en el F. C. Barcelona, de la Primera División de España, y en la Selección Argentina.', now(), now(), 'usuprueba', NULL, NULL);

DELETE FROM DoFit.`Pago`;

INSERT INTO DoFit.`Pago`(id_actividad, id_usuario, mes, anio, monto, fhcreacion, fhultmod, cusuario)
                  VALUES(1           , 1         , 2  , 2015, 300.00, now()   , now()   , 'sysadmin'),
                        (1           , 2         , 2  , 2015, 300.00, now()   , now()   , 'sysadmin'),  						
                        (2           , 2         , 1  , 2015, 400.00, now()   , now()   , 'sysadmin'),
                        (3           , 4         , 1  , 2015, 300.00, now()   , now()   , 'sysadmin');  

DELETE FROM DoFit.`Perfil_muro_profesor`;						

INSERT INTO DoFit.`Perfil_muro_profesor`(posteo, id_actividad, fhcreacion, fhultmod, cusuario)
                                  VALUES('¿Hay clases de Natacion este martes?', 3, now(), now(), 'sysadmin'),
                                        ('¿Cuanto sale para practicar futbol los lunes por la noche?', 1, now(), now(), 'sysadmin');
 										 
DELETE FROM DoFit.`Respuesta`;
 
INSERT INTO DoFit.`Respuesta`(id_posteo, id_respuesta, respuesta, id_usuario, fhcreacion, fhultmod, cusuario)
                       VALUES(1        , 1          , 'Si en todos los horarios', 5 , now() , now() , 'sysadmin'),
                             (2        , 2          , '$300'                    , 6 , now() , now() , 'sysadmin');
                     