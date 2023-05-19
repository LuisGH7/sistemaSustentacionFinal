CREATE DATABASE FAMISALUDSISTEMA;
USE FAMISALUDSISTEMA;

CREATE TABLE personas (
	idpersona	 	INT 		AUTO_INCREMENT PRIMARY KEY,
	primerapellido		VARCHAR(50)	NOT NULL,
	segundoapellido		VARCHAR(50)	NULL,
	nombres			VARCHAR(70)	NOT NULL,
	tipodoc			CHAR(1)		NOT NULL,
	nrodocumento		VARCHAR(9)	NOT NULL,
	fecharegistro 		DATE 		NOT NULL,
	telefono		CHAR(9)		NULL,
	email			VARCHAR(50)	NULL,
	logeado			CHAR(1)		NOT NULL,
	CONSTRAINT uk_numdocumento_per UNIQUE (nrodocumento, tipodoc),
	CONSTRAINT uk_email_per UNIQUE (email)
)ENGINE=INNODB;

CREATE TABLE pacientes (
	idpaciente	 	INT 		AUTO_INCREMENT PRIMARY KEY,
	idpersona		INT 		NOT NULL,
	ubigeo			CHAR(6)		NOT NULL,
	direccion		VARCHAR(60)	NOT NULL,
	fechanacimiento		DATE 		NOT NULL,
	sexo			CHAR(1)		NOT NULL,
	estadocivil		CHAR(1)		NOT NULL,
	esalergico		CHAR(2)		NOT NULL,
	alergias		TEXT		NOT NULL,
	fecharegistro 		DATE 		NOT NULL,
	historiacreada 		CHAR(1) 	NOT NULL DEFAULT "N",
	CONSTRAINT fk_ubigeo_paciente FOREIGN KEY (ubigeo) REFERENCES ubigeos(ubigeo),
	CONSTRAINT fk_idpersona_paciente FOREIGN KEY (idpersona) REFERENCES personas(idpersona)
)ENGINE=INNODB;

CREATE TABLE areas (
	idarea	 	INT 		AUTO_INCREMENT PRIMARY KEY,
	nombrerol	VARCHAR(50)	NOT NULL,
	estado    CHAR(1)		NOT NULL,
	CONSTRAINT uk_nombrerol_area UNIQUE(nombrerol)
)ENGINE=INNODB;

CREATE TABLE especialidades(
	idespecialidad		INT 		AUTO_INCREMENT PRIMARY KEY,
	idarea			INT 		NOT NULL,
	especialidad		VARCHAR(50) 	NULL,
	fecharegistro		DATE 		NOT NULL,
	fechabaja 		DATE 		NULL,
	estado			CHAR(1) 	NOT NULL,
	CONSTRAINT fk_idarea_esp FOREIGN KEY (idarea) REFERENCES areas(idarea),
	CONSTRAINT uk_especialidad_esp UNIQUE (especialidad, idarea)
)ENGINE = INNODB;

CREATE TABLE eps(
	ideps				INT 				AUTO_INCREMENT PRIMARY KEY,
	nombreeps			VARCHAR(50)	NOT NULL,
	estado				CHAR(1)		NOT NULL,
	CONSTRAINT uk_nombreeps_esq UNIQUE (nombreeps)
)ENGINE = INNODB;

CREATE TABLE esquemaprecios(
	idesquema		INT 		AUTO_INCREMENT PRIMARY KEY,
	motivo			VARCHAR(50)	NOT NULL,
	ideps			INT 			NULL,
	CONSTRAINT fk_ideps_esq FOREIGN KEY (ideps) REFERENCES eps (ideps)
)ENGINE = INNODB;

CREATE TABLE precios(
	idprecio			INT 		AUTO_INCREMENT PRIMARY KEY,
	idespecialidad 			INT 		NOT NULL,
	idesquema 			INT 		NOT NULL,
	descripcion			TEXT 		NOT NULL,
	precio				DECIMAL(7,2) 	NOT NULL,
	fecharegistro 			DATE 		NOT NULL,
	fechainicio 			DATE 		NULL,
	fechafin 			DATE 		NULL,
	estado				CHAR(1)		NOT NULL,
	CONSTRAINT fk_idespecialidad_pr FOREIGN KEY (idespecialidad) REFERENCES especialidades (idespecialidad),
	CONSTRAINT fk_idesquema_pr FOREIGN KEY (idesquema) REFERENCES esquemaprecios (idesquema)
)ENGINE = INNODB;

CREATE TABLE usuarios(
	idusuario		INT 		AUTO_INCREMENT PRIMARY KEY,
	idpersona		INT 		NOT NULL,
	nombreusuario		VARCHAR(25)	NOT NULL,
	clave			VARCHAR(100)	NOT NULL,
	idespecialidad 		INT 		NOT NULL,
	fechacreacion 		DATE 		NOT NULL,
	fechabaja		DATE 		NOT NULL,
	codigoespecialista 	VARCHAR(50)	NOT NULL, -- por cambiar
	estado			CHAR(1)		NOT NULL,
	codverificacion 	CHAR(6)		NULL,
	CONSTRAINT fk_idpersona_user FOREIGN KEY (idpersona) REFERENCES personas (idpersona),
	CONSTRAINT uk_nombreusuario_user UNIQUE (nombreusuario),
	CONSTRAINT fk_idespecialidad FOREIGN KEY (idespecialidad) REFERENCES especialidades (idespecialidad)
)ENGINE = INNODB;

CREATE TABLE historiasclinicas(
	idhistoria		INT 		AUTO_INCREMENT PRIMARY KEY,
	nrohistoria		VARCHAR(50)	NOT NULL, -- por cambiar
	idpaciente 		INT 		NOT NULL,
	fechacreacion 		DATE 		NOT NULL,
	horacreacion		TIME 		NOT NULL,
	idusuario		INT 		NOT NULL,
	CONSTRAINT fk_idusuario_hist FOREIGN KEY (idusuario) REFERENCES usuarios (idusuario),
	CONSTRAINT uk_nrohistoria_hist UNIQUE (nrohistoria)
)ENGINE = INNODB;

CREATE TABLE atenciones(
	idatencion 			INT 		AUTO_INCREMENT PRIMARY KEY,
	idpaciente     			INT 		NOT NULL,
	idusuarioregistro		INT 		NOT NULL,
	fechacodigo 			DATE 		NOT NULL,
	fechaatencion				DATE	NOT NULL,
	fecharegistro 			DATETIME 	NOT NULL,
	codservicio			VARCHAR(50)	NOT NULL, -- por cambiar
	estadoatencion			CHAR(1)		NOT NULL,
	CONSTRAINT fk_paciente_ate FOREIGN KEY (idpaciente) REFERENCES pacientes(idpaciente),
	CONSTRAINT fk_idusuarioregistro_ate FOREIGN KEY (idusuarioregistro) REFERENCES usuarios(idusuario),
	CONSTRAINT uk_codservicio_ate UNIQUE (codservicio)
)ENGINE = INNODB;

CREATE TABLE detatencion(
	iddetatencion 			INT 		AUTO_INCREMENT PRIMARY KEY,
	idatencion 					INT 		NOT NULL,
	idprecioesp					INT 		NOT NULL,
	idmedico						INT 		NOT NULL,
	triajelisto					CHAR(1)		NOT NULL,
	revmedicalisto			CHAR(1)	NOT NULL,
	estado 							CHAR(1) 	NOT NULL,
	CONSTRAINT fk_idatencion_detatencion FOREIGN KEY (idatencion) REFERENCES atenciones (idatencion),
	CONSTRAINT fk_idprecioesp_detatencion FOREIGN KEY (idprecioesp) REFERENCES precios (idprecio),
	CONSTRAINT fk_idmedico_detatencion FOREIGN KEY (idmedico) REFERENCES usuarios (idusuario)
)ENGINE = INNODB;

CREATE TABLE triajes(
	idtriaje			INT 		AUTO_INCREMENT PRIMARY KEY,
	iddetatencion			INT 		NOT NULL,
	idenfermera			INT 		NOT NULL,
	presionarterial			VARCHAR(20)	NOT NULL,	
	pulso				INT 		NOT NULL,
	temperatura			DECIMAL(7,2)	NOT NULL,
	frecuenciarespiratoria		INT 		NOT NULL,
	peso				DECIMAL(7,3)	NOT NULL,
	talla				DECIMAL(7,2)	NOT NULL,
	fechatriaje	DATE		NOT NULL,
	CONSTRAINT fk_iddetatencion_triaje FOREIGN KEY (iddetatencion) REFERENCES detatencion(iddetatencion),
	CONSTRAINT fk_idenfermera_triaje FOREIGN KEY (idenfermera) REFERENCES usuarios (idusuario)
)ENGINE = INNODB;

CREATE TABLE revisionmedica(
	idrevision			INT 		AUTO_INCREMENT PRIMARY KEY,
	iddetatencion			INT 		NOT NULL,
	examenclinico			TEXT 		NOT NULL,
	diagnostico 			TEXT 		NOT NULL,
	tratamiento 			TEXT 		NOT NULL,
	tipodiagnostico 		VARCHAR(50)	NOT NULL, -- por confirmar
	derivacionlaboratorio 		CHAR(1)		NOT NULL,
	fechahoraregistro 		DATETIME 	NOT NULL,
	CONSTRAINT fk_iddetatencion_rev FOREIGN KEY (iddetatencion) REFERENCES detatencion (iddetatencion)
)ENGINE = INNODB;

CREATE TABLE tipoegresos(
	idtipoegreso			INT 		AUTO_INCREMENT PRIMARY KEY,
	tipoegreso			VARCHAR(30)	NOT NULL,
	estado					CHAR(1)	NOT NULL,
	CONSTRAINT uk_tipoegreso_tipoe UNIQUE (tipoegreso)
)ENGINE = INNODB;

CREATE TABLE egresos(
	idegreso			INT 		AUTO_INCREMENT PRIMARY KEY,
	idtipoegreso 			INT 		NOT NULL,
	ruc				CHAR(11)	NOT NULL,
	nombreempresa			VARCHAR(100)	NOT NULL,
	motivo	 			TEXT 		NOT NULL,
	tipocomprobante 		VARCHAR(30)	NOT NULL,
	seriecomprobante 		VARCHAR(30)	NOT NULL, -- por confirmar
	numcomprobante 			VARCHAR(30)	NOT NULL,
	idusuarioregistro 		INT 		NOT NULL,
	idusuarioautoriza 		INT 		NOT NULL,
	fecharegistro			DATETIME 	NOT NULL,
	fechaegreso 			DATE 		NOT NULL,
	CONSTRAINT fk_idtipoegreso_egre FOREIGN KEY (idtipoegreso) REFERENCES tipoegresos (idtipoegreso),
	CONSTRAINT uk_numcomprobante_egre UNIQUE (numcomprobante)
)ENGINE = INNODB;

CREATE TABLE detegresos(
	iddetegreso			INT 		AUTO_INCREMENT PRIMARY KEY,
	idegreso 			INT 		NOT NULL,
	producto 			TEXT 		NOT NULL,
	cantidad 			INT 		NOT NULL,
	precio 				DECIMAL(7,2)	NOT NULL,
	CONSTRAINT fk_idegreso_detegreso FOREIGN KEY (idegreso) REFERENCES egresos (idegreso)
)ENGINE = INNODB;

CREATE TABLE configuraciones (
	idconfiguracion			INT 		AUTO_INCREMENT PRIMARY KEY,
	clave 				VARCHAR(50)	NOT NULL,
	valor 				TEXT 		NOT NULL
)ENGINE = INNODB;

