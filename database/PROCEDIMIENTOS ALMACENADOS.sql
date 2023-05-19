USE famisaludsistema
-- ----------------------------------------------------------------------------------
-- ----------------------------------------------------------------------------------
-- UBIGEO
-- ----------------------------------------------------------------------------------
-- ----------------------------------------------------------------------------------
DELIMITER $$
CREATE PROCEDURE spu_ubigeos_buscar(IN _valorbuscado VARCHAR(30))
BEGIN
	SELECT * FROM vs_ubigeo_full
	WHERE vs_ubigeo_full.text LIKE CONCAT('%', _valorbuscado, '%');
END $$
-- ----------------------------------------------------------------------------------
-- ----------------------------------------------------------------------------------
-- PERSONAS
-- ----------------------------------------------------------------------------------
-- ----------------------------------------------------------------------------------
DELIMITER $$
CREATE PROCEDURE spu_datos_persona_registrada
(
IN _primerapellido 	VARCHAR(50),
IN _segundoapellido 	VARCHAR(50),
IN _nombres 		VARCHAR(50),
IN _nrodocumento	VARCHAR(9),
IN _tipodoc		CHAR(1)
)
BEGIN
	SELECT * FROM personas 
	WHERE primerapellido = _primerapellido AND segundoapellido = _segundoapellido AND nombres = _nombres AND nrodocumento = _nrodocumento AND tipodoc = _tipodoc;
END $$

DELIMITER $$
CREATE PROCEDURE spu_emailnoexiste_registrado(
	IN _email VARCHAR(50)
)
BEGIN
	SELECT * FROM personas
	WHERE email = _email;
END$$

DELIMITER $$
CREATE PROCEDURE spu_personas_registro
(
	IN _primerapellido 	VARCHAR(50),
	IN _segundoapellido 	VARCHAR(50),
	IN _nombres		VARCHAR(70),
	IN _tipodoc		CHAR(1),
	IN _nrodocumento	CHAR(8),
	IN _telefono		CHAR(9),
	IN _email 		VARCHAR(50)
)
BEGIN
	IF _telefono = "" THEN SET _telefono = NULL; END IF;
	IF _email = "" THEN SET _email = NULL; END IF;
	INSERT INTO personas(primerapellido, segundoapellido, nombres, tipodoc, nrodocumento, fecharegistro,telefono, email, logeado)VALUES
			(_primerapellido, _segundoapellido, _nombres, _tipodoc, _nrodocumento, CURDATE(), _telefono, _email, "N");
END $$
 
DELIMITER $$
CREATE PROCEDURE spu_personaspaciente_registro
(
	IN _primerapellido 	VARCHAR(50),
	IN _segundoapellido 	VARCHAR(50),
	IN _nombres		VARCHAR(70),
	IN _tipodoc		CHAR(1),
	IN _nrodocumento	CHAR(8),
	IN _telefono		CHAR(9),
	IN _email 		VARCHAR(50)
)
BEGIN
	IF _telefono = "" THEN SET _telefono = NULL; END IF;
	IF _email = "" THEN SET _email = NULL; END IF;
	INSERT INTO personas(primerapellido, segundoapellido, nombres, tipodoc, nrodocumento, fecharegistro,telefono, email, logeado)VALUES
			(_primerapellido, _segundoapellido, _nombres, _tipodoc, _nrodocumento, CURDATE(), _telefono, _email, "N");
	SELECT LAST_INSERT_ID() AS 'idretorno';			
END $$

DELIMITER $$
CREATE PROCEDURE spu_detatencion_listarATE(IN _idatencion INT)
BEGIN
	SELECT DET.iddetatencion, ESP.especialidad, DET.idmedico,PRE.precio FROM detatencion DET
	INNER JOIN precios PRE ON PRE.idprecio = DET.idprecioesp
	INNER JOIN especialidades ESP ON ESP.idespecialidad = PRE.idespecialidad
	WHERE idatencion = _idatencion;
END $$

DELIMITER $$
CREATE PROCEDURE spu_detatencion_totalpagar(IN _idatencion INT)
BEGIN
	SELECT SUM(PRE.precio) AS 'total' FROM detatencion DET
	INNER JOIN precios PRE ON PRE.idprecio = DET.idprecioesp
	WHERE idatencion = _idatencion;
END $$

DELIMITER $$
CREATE PROCEDURE spu_detatencion_eliminar(IN _iddetatencion INT)
BEGIN 
	DELETE FROM detatencion WHERE iddetatencion = _iddetatencion;
END $$

DELIMITER $$
CREATE PROCEDURE spu_listaratenciones_dia
(
	IN _fechabuscar DATE
)
BEGIN
IF _fechabuscar = "" THEN SET _fechabuscar = CURDATE(); END IF;

	SELECT idatencion, ATE.idpaciente, CONCAT(PER.primerapellido,' ', PER.segundoapellido,', ', PER.nombres) AS datospersonales, 
	ATE.codservicio, ATE.fecharegistro, ATE.fechaatencion, TIMESTAMPDIFF(YEAR, PC.fechanacimiento, CURTIME()) AS edad, ATE.estadoatencion	
	FROM atenciones ATE
	INNER JOIN pacientes PC ON PC.idpaciente = ATE.idpaciente
	INNER JOIN personas PER ON PER.idpersona = PC.idpersona
	WHERE ATE.estadoatencion = "R" AND ATE.fechaatencion = _fechabuscar;
END $$

DELIMITER $$
CREATE PROCEDURE spu_personas_listar()
BEGIN
	SELECT idpersona, CONCAT(primerapellido, " ", segundoapellido) AS apellidos, nombres, nrodocumento, telefono
	 FROM personas ORDER BY idpersona DESC;
END $$

DELIMITER $$
CREATE PROCEDURE spu_personas_cargar()
BEGIN
	SELECT * FROM personas WHERE logeado = "N";
END $$

DELIMITER $$
CREATE PROCEDURE spu_personas_modificar
(
	IN _idpersona INT,
	IN _telefono		CHAR(9),
	IN _email 		VARCHAR(50)
)
BEGIN
	IF _telefono = "" THEN SET _telefono = NULL; END IF;
	IF _email = "" THEN SET _email = NULL; END IF;
	UPDATE personas SET
		telefono = _telefono,
		email = _email
	WHERE idpersona = _idpersona;
END $$

DELIMITER $$
CREATE PROCEDURE spu_persona_getdata(IN _idpersona INT)
BEGIN
	SELECT * FROM personas 
	WHERE idpersona = _idpersona;
END $$

DELIMITER $$
CREATE PROCEDURE spu_buscar_persona
(
	IN _tipodoc CHAR(1), 
	IN _nrodocumento VARCHAR(9)
)
BEGIN
	SELECT idpersona, CONCAT(primerapellido, " " ,segundoapellido, " ", nombres) AS persona 
	FROM personas 
	WHERE tipodoc = _tipodoc AND nrodocumento = _nrodocumento;
END $$

DELIMITER $$
CREATE PROCEDURE spu_persona_buscar
(
	IN _tipodoc 	CHAR(1),
	IN _nrodocumento	 	VARCHAR(9)
)
BEGIN
	SELECT * FROM vista_buscar_persona WHERE tipodoc = _tipodoc AND nrodocumento = _nrodocumento;
END $$


DELIMITER $$
CREATE PROCEDURE spu_persona_registrado
(
IN _tipodoc CHAR(1),
IN _nrodocumento VARCHAR(9)
)
BEGIN
	SELECT * FROM personas 
	WHERE tipodoc = _tipodoc AND nrodocumento = _nrodocumento;
END $$

DELIMITER $$
CREATE PROCEDURE spu_persona_verificarcorreo(IN _email VARCHAR(50))
BEGIN
	SELECT USU.idusuario, PER.email, CONCAT(PER.primerapellido, ' ', PER.segundoapellido, ', ', PER.nombres) AS 'datospersona', USU.codverificacion, PER.email
		FROM usuarios USU
		INNER JOIN personas PER ON PER.idpersona = USU.idpersona
	WHERE PER.email = _email AND USU.estado = "A";
END $$

-- ----------------------------------------------------------------------------------
-- ----------------------------------------------------------------------------------
-- PACIENTES
-- ----------------------------------------------------------------------------------
-- ----------------------------------------------------------------------------------
DELIMITER $$
CREATE PROCEDURE spu_buscar_paciente
(
	IN _tipodoc CHAR(1), 
	IN _nrodocumento VARCHAR(9)
)
BEGIN
	SELECT pacientes.idpaciente, pacientes.idpersona, CONCAT(primerapellido, " " ,segundoapellido) AS apellidos, 
	nombres, pacientes.fecharegistro, personas.tipodoc, personas.nrodocumento 
	FROM pacientes
	INNER JOIN personas ON personas.idpersona = pacientes.idpersona 
	WHERE tipodoc = _tipodoc AND nrodocumento = _nrodocumento;
END $$

DELIMITER $$
CREATE PROCEDURE spu_paciente_registrado
(
IN _idpersona INT
)
BEGIN
	SELECT * FROM pacientes 
	WHERE idpersona = _idpersona;
END $$

DELIMITER $$
CREATE PROCEDURE spu_paciente_registro
(
	IN _idpersona 		INT,
	IN _ubigeo 		VARCHAR(6),
	IN _direccion 		VARCHAR(60),
	IN _fechanacimiento	DATE,
	IN _sexo		CHAR(1),
	IN _estadocivil		CHAR(1),
	IN _esalergico		CHAR(2),
	IN _alergias		TEXT
)
BEGIN
	INSERT INTO pacientes(idpersona, ubigeo, direccion, fechanacimiento, sexo, estadocivil, esalergico, alergias, fecharegistro)VALUES
			(_idpersona, _ubigeo, _direccion, _fechanacimiento, _sexo, _estadocivil, _esalergico, _alergias, CURDATE());
	SELECT LAST_INSERT_ID() AS 'idretorno';	
END $$

DELIMITER $$
CREATE PROCEDURE spu_pacientes_listar250()
BEGIN
	SELECT idpaciente, CONCAT(primerapellido, " " , segundoapellido) AS apellidos, nombres, pacientes.fecharegistro 
	FROM pacientes
	INNER JOIN personas ON personas.idpersona = pacientes.idpersona 
	ORDER BY idpaciente DESC LIMIT 250; 
END $$

DELIMITER $$
CREATE PROCEDURE spu_pacientes_historiano()
BEGIN

	SELECT pacientes.idpaciente, CONCAT(personas.primerapellido, " ", personas.segundoapellido) AS apellidos ,personas.nombres, personas.fecharegistro FROM pacientes
	INNER JOIN personas ON personas.idpersona = pacientes.idpersona
	WHERE historiacreada = "N" ORDER BY idpaciente DESC;
END $$

DELIMITER $$
CREATE PROCEDURE spu_pacientes_modificar
(
	IN _idpaciente INT,
	IN _estadocivil CHAR(1),
	IN _esalergico CHAR(2),
	IN _alergias TEXT,
	IN _ubigeo CHAR(6),
	IN _direccion VARCHAR(60)
)
BEGIN
	UPDATE pacientes SET
		estadocivil = _estadocivil,
		esalergico = _esalergico,
		alergias = _alergias,
		ubigeo = _ubigeo,
		direccion = _direccion
	WHERE idpaciente = _idpaciente;
END $$

DELIMITER $$
CREATE PROCEDURE spu_pacientes_getdata(IN _idpaciente INT)
BEGIN
	SELECT idpaciente, personas.idpersona, nrodocumento, tipodoc, ubigeo, direccion, fechanacimiento, sexo, estadocivil, esalergico, alergias,  CONCAT(primerapellido, " " ,segundoapellido, " ", nombres) AS persona 
	FROM pacientes 
	INNER JOIN personas ON personas.idpersona = pacientes.idpersona
	WHERE idpaciente = _idpaciente;
END $$

-- ----------------------------------------------------------------------------------
-- ----------------------------------------------------------------------------------
-- AREAS
-- ----------------------------------------------------------------------------------
-- ----------------------------------------------------------------------------------
DELIMITER $$
CREATE PROCEDURE spu_areas_registro
(
	IN _nombrerol 	VARCHAR(50)
)
BEGIN
	INSERT INTO areas(nombrerol, estado)VALUES
			(_nombrerol, "A");
END $$

DELIMITER $$
CREATE PROCEDURE spu_areas_listar()
BEGIN
	SELECT * FROM areas WHERE estado = "A";
END $$

DELIMITER $$
CREATE PROCEDURE spu_areas_listarActivo()
BEGIN
	SELECT * FROM areas;
END $$

DELIMITER $$
CREATE PROCEDURE spu_areas_listarInactivo()
BEGIN
	SELECT * FROM areas WHERE estado = "I";
END $$

DELIMITER $$
CREATE PROCEDURE spu_areas_eliminar
(
IN _idarea INT
)
BEGIN
	UPDATE areas SET
		estado = "I"
	WHERE idarea = _idarea;
END $$

DELIMITER $$
CREATE PROCEDURE spu_areas_restaurar
(
IN _idarea INT
)
BEGIN
	UPDATE areas SET
		estado = "A"
	WHERE idarea = _idarea;
END $$

DELIMITER $$
CREATE PROCEDURE spu_area_comprobar( IN _idarea INT)
BEGIN
	SELECT * FROM areas WHERE idarea = _idarea AND nombrerol = "Medicina";
END $$

DELIMITER $$
CREATE PROCEDURE spu_area_registrado
(
	IN _nombrerol VARCHAR(50)
)
BEGIN
	SELECT * FROM areas 
	WHERE nombrerol = _nombrerol;
END $$

-- ----------------------------------------------------------------------------------
-- ----------------------------------------------------------------------------------
-- ESPECIALIDADES
-- ----------------------------------------------------------------------------------
-- ----------------------------------------------------------------------------------
DELIMITER $$
CREATE PROCEDURE spu_especialidades_registro
(
	IN _idarea 	INT,
	IN _especialidad VARCHAR(50)
)
BEGIN
	INSERT INTO especialidades(idarea, especialidad, fecharegistro, fechabaja, estado)VALUES
			(_idarea, _especialidad, CURDATE(), NULL, "A");
END $$

DELIMITER $$
CREATE PROCEDURE spu_especialidades_listar(
	IN _idarea INT 
)
BEGIN
	SELECT * FROM especialidades WHERE idarea = _idarea AND estado = "A";
END $$

DELIMITER $$
CREATE PROCEDURE spu_especialidades_listarTabla()
BEGIN
		SELECT idespecialidad, especialidades.idarea, especialidad, especialidades.estado, areas.nombrerol
		FROM especialidades
	INNER JOIN areas ON areas.idarea = especialidades.idarea ORDER BY nombrerol, especialidad;
END $$

DELIMITER $$
CREATE PROCEDURE spu_especialidades_listarInactivo()
BEGIN
	SELECT * FROM especialidades
	INNER JOIN areas ON areas.idarea = especialidades.idarea 
	WHERE especialidades.estado = "I";
END $$

DELIMITER $$
CREATE PROCEDURE spu_especialidades_eliminar
(
	IN _idespecialidad INT
)
BEGIN
	UPDATE especialidades SET
		fechabaja = CURDATE(),
		estado = "I"
	WHERE idespecialidad = _idespecialidad;
END $$

DELIMITER $$
CREATE PROCEDURE spu_especialidades_reactivar
(
	IN _idespecialidad INT
)
BEGIN
	UPDATE especialidades SET
		fecharegistro = CURDATE(),
		fechabaja = NULL,
		estado = "A"
	WHERE idespecialidad = _idespecialidad;
END $$

DELIMITER $$
CREATE PROCEDURE spu_especialidades_existe(IN _idarea INT)
BEGIN
	SELECT * FROM especialidades 
      WHERE especialidad = 'No requiere especialidad' AND idarea = _idarea; 
END $$

DELIMITER $$
CREATE PROCEDURE spu_especialidades_yaregistrado
(
IN _idarea INT, 
IN _especialidad VARCHAR(50)
)
BEGIN
	SELECT * FROM especialidades 
      WHERE especialidad = _especialidad AND idarea = _idarea; 
END $$

DELIMITER $$
CREATE PROCEDURE spu_especialidades_cargar()
BEGIN
	SELECT * FROM especialidades WHERE especialidad != "No requiere especialidad";
END $$
-- ----------------------------------------------------------------------------------
-- ----------------------------------------------------------------------------------
-- EPS
-- ----------------------------------------------------------------------------------
-- ----------------------------------------------------------------------------------

DELIMITER $$
CREATE PROCEDURE spu_eps_registro
(
	IN _nombreeps 			VARCHAR(50)
)
BEGIN
	INSERT INTO eps(nombreeps, estado)VALUES
			(_nombreeps,"A");
END $$

DELIMITER $$
CREATE PROCEDURE spu_eps_eliminar
(
IN _ideps INT
)
BEGIN
	UPDATE eps SET
		estado = "I"
	WHERE ideps = _ideps;
END $$

DELIMITER $$
CREATE PROCEDURE spu_eps_restaurar
(
IN _ideps INT
)
BEGIN
	UPDATE eps SET
		estado = "A"
	WHERE ideps = _ideps;
END $$

DELIMITER $$
CREATE PROCEDURE spu_eps_listarActivos()
BEGIN
	SELECT * FROM eps;
END $$

DELIMITER $$
CREATE PROCEDURE spu_eps_listarInactivos()
BEGIN
	SELECT * FROM eps WHERE estado="I";
END $$

DELIMITER $$
CREATE PROCEDURE spu_eps_cargar()
BEGIN
		SELECT * FROM eps WHERE estado="A" AND nombreeps != "No requiere eps";
END $$

DELIMITER $$
CREATE PROCEDURE spu_eps_registrado
(
IN _nombreeps VARCHAR(50)
)
BEGIN
	SELECT * FROM eps 
	WHERE nombreeps = _nombreeps;
END $$
-- ----------------------------------------------------------------------------------
-- ----------------------------------------------------------------------------------
-- ESQUEMA PRECIOS
-- ----------------------------------------------------------------------------------
-- ----------------------------------------------------------------------------------
DELIMITER $$
CREATE PROCEDURE spu_esquemaprecios_registro
(
		IN _motivo			VARCHAR(50),
		IN _ideps 			INT
	)
BEGIN

	IF _ideps = "" THEN SET _ideps = NULL; END IF;

	INSERT INTO esquemaprecios(motivo, ideps)VALUES
			(_motivo, _ideps);
END $$

DELIMITER $$
CREATE PROCEDURE spu_esquemaprecios_eliminar
(
	IN _idesquema		INT
)
BEGIN
	DELETE FROM esquemaprecios
	WHERE idesquema = _idesquema;
END $$

DELIMITER $$
CREATE PROCEDURE spu_esquemaprecios_listar()
BEGIN
	SELECT idesquema, motivo, esquemaprecios.ideps, nombreeps, estado FROM esquemaprecios
	INNER JOIN eps  ON eps.ideps = esquemaprecios.ideps
	WHERE eps.estado = "A";
END $$

DELIMITER $$
CREATE PROCEDURE spu_esquemas_existe
(
IN _motivo VARCHAR(50)
)
BEGIN
	SELECT * FROM esquemaprecios 
	WHERE motivo = _motivo;
END $$

DELIMITER $$
CREATE PROCEDURE spu_esquemas_eps_existe
(
IN _motivo VARCHAR(50),
IN _ideps	INT
)
BEGIN
	SELECT * FROM esquemaprecios 
	WHERE motivo = _motivo AND ideps = _ideps;
END $$

DELIMITER $$
CREATE PROCEDURE spu_motivos_cargar()
BEGIN
SELECT idesquema, motivo, esquemaprecios.ideps, nombreeps, estado FROM esquemaprecios
	LEFT JOIN eps  ON eps.ideps = esquemaprecios.ideps
	WHERE eps.estado = "A" OR motivo = "No requiere eps";
END $$

DELIMITER $$
CREATE PROCEDURE spu_esquemaprecio_norequiere()
BEGIN
	SELECT * FROM eps WHERE nombreeps = "No requiere EPS";
END $$
-- ----------------------------------------------------------------------------------
-- ----------------------------------------------------------------------------------
-- PRECIOS
-- ----------------------------------------------------------------------------------
-- ----------------------------------------------------------------------------------
DELIMITER $$
CREATE PROCEDURE spu_precios_registro
(
	IN _idespecialidad			INT,
	IN _idesquema				INT,
	IN _descripcion				TEXT,
	IN _precio				DECIMAL(7,2),
	IN _fechainicio				DATE,
	IN _fechafin				DATE

)
BEGIN
	IF _fechainicio = "" THEN SET _fechainicio = NULL; END IF;
	IF _fechafin = "" THEN SET _fechafin = NULL; END IF;

	INSERT INTO precios(idespecialidad, idesquema, descripcion, precio, fecharegistro, fechainicio, fechafin, estado)VALUES
			(_idespecialidad, _idesquema, _descripcion, _precio, CURDATE(), _fechainicio, _fechafin, "A");
END $$

DELIMITER $$
CREATE PROCEDURE spu_precios_listar()
BEGIN
	SELECT idprecio,esquemaprecios.motivo, eps.nombreeps, especialidades.especialidad, precios.precio,fechainicio, fechafin, precios.estado
	FROM precios
		INNER JOIN especialidades ON especialidades.idespecialidad = precios.idespecialidad
		INNER JOIN esquemaprecios ON esquemaprecios.idesquema = precios.idesquema
		INNER JOIN eps ON eps.ideps = esquemaprecios.ideps
		WHERE precios.estado = "A";
END $$


DELIMITER $$
CREATE PROCEDURE spu_precio_eliminar
(
	IN _idprecio INT
)
BEGIN
	UPDATE precios SET
		estado = "I",
		fechafin = CURDATE()
	WHERE idprecio = _idprecio;
END $$


DELIMITER $$
CREATE PROCEDURE spu_precios_listarInactivos()
BEGIN
	SELECT idprecio,esquemaprecios.motivo, eps.nombreeps, especialidades.especialidad, precios.precio, fechafin FROM precios
		INNER JOIN especialidades ON especialidades.idespecialidad = precios.idespecialidad
		INNER JOIN esquemaprecios ON esquemaprecios.idesquema = precios.idesquema
		INNER JOIN eps ON eps.ideps = esquemaprecios.ideps
		WHERE precios.estado = "I";
END $$

DELIMITER $$
CREATE PROCEDURE spu_precio_restaurar
(
	IN _idprecio INT
)
BEGIN
	UPDATE precios SET
		estado = "A"
	WHERE idprecio = _idprecio;
END $$

DELIMITER $$
CREATE PROCEDURE spu_get_precios
(
IN _idprecio INT
)
BEGIN
	SELECT idprecio, especialidades.especialidad, esquemaprecios.motivo, precios.descripcion, precios.precio, precios.fechainicio, precios.fechafin FROM precios
		INNER JOIN especialidades ON especialidades.idespecialidad = precios.idespecialidad
		INNER JOIN esquemaprecios ON esquemaprecios.idesquema = precios.idesquema
	WHERE precios.estado = "A" AND  precios.idprecio = _idprecio;
END $$

DELIMITER $$
CREATE PROCEDURE spu_precio_modificar
(
	IN _descripcion TEXT,
	IN _precio DECIMAL(7,2),
	IN _fechainicio DATE,
	IN _fechafin DATE,
	IN _idprecio INT
)
BEGIN
	IF _fechainicio = "" THEN SET _fechainicio = NULL; END IF;
	IF _fechafin = "" THEN SET _fechafin = NULL; END IF;
	
	UPDATE precios SET
		descripcion = _descripcion,
		precio = _precio,
		fechainicio = _fechainicio,
		fechafin = _fechafin
	WHERE idprecio = _idprecio;
END $$

DELIMITER $$	
CREATE PROCEDURE spu_precio_yaexiste
(
	IN _idespecialidad INT,
	IN _idesquema INT
)
BEGIN
	SELECT * FROM precios
	WHERE idespecialidad = _idespecialidad AND idesquema = _idesquema;
END $$

DELIMITER $$
CREATE PROCEDURE spu_precios_especialidad(IN _idespecialidad INT)
BEGIN
	SELECT PR.idprecio, PR.precio, ESQ.motivo, EPS.nombreeps FROM precios PR
	INNER JOIN esquemaprecios ESQ ON ESQ.idesquema = PR.idesquema
	INNER JOIN eps EPS ON EPS.ideps = ESQ.ideps
	WHERE idespecialidad = _idespecialidad;
END $$

-- ----------------------------------------------------------------------------------
-- ----------------------------------------------------------------------------------
-- USUARIOS
-- ----------------------------------------------------------------------------------
-- ----------------------------------------------------------------------------------
DELIMITER $$
CREATE PROCEDURE spu_usuarios_registro
(
	IN _idpersona 					INT,
	IN _nombreusuario 			VARCHAR(50),
	IN _idespecialidad			INT,
	IN _codigoespecialista	VARCHAR(50)
)
BEGIN
	INSERT INTO usuarios(idpersona, nombreusuario, clave, idespecialidad, fechacreacion, codigoespecialista, estado)VALUES
			(_idpersona, _nombreusuario, "$2y$10$dvgzm2Jmh0u98DerZSGkX.QH5rVqqD/ctSC3UCgYNj4jFh0CgR5mi", _idespecialidad, CURDATE(), _codigoespecialista, "A");
	UPDATE personas SET
		logeado = "S"
	WHERE idpersona = _idpersona;
END $$

DELIMITER $$
CREATE PROCEDURE spu_usuarios_listarActivo()
BEGIN
	SELECT 	idusuario, CONCAT(personas.primerapellido," " ,personas.segundoapellido) AS "apellidos", personas.nombres, nombreusuario, nombrerol, usuarios.estado
	FROM usuarios 
	INNER JOIN personas ON personas.idpersona = usuarios.idpersona
	INNER JOIN especialidades ON especialidades.idespecialidad = usuarios.idespecialidad
	INNER JOIN areas ON areas.idarea = especialidades.idarea;
END $$



DELIMITER $$
CREATE PROCEDURE spu_usuarios_login
(
	IN _nombreusuario 	VARCHAR(25)
)
BEGIN
	SELECT idusuario, primerapellido, segundoapellido, nombres, nombreusuario, clave, nombrerol
		FROM usuarios
		INNER JOIN personas ON personas.idpersona = usuarios.idpersona
		INNER JOIN especialidades ON especialidades.idespecialidad = usuarios.idespecialidad
		INNER JOIN areas ON areas.idarea = especialidades.idarea
	WHERE nombreusuario = _nombreusuario AND usuarios.estado = "A";
END $$

DELIMITER $$
CREATE PROCEDURE spu_usuarios_actualizarclave
(
	IN _idusuario INT,
	IN _clave	VARCHAR(100)
)
BEGIN
	UPDATE usuarios SET clave = _clave WHERE idusuario = _idusuario;
END $$

DELIMITER $$
CREATE PROCEDURE spu_usuarios_eliminar
(
	IN _idusuario INT
)
BEGIN
	UPDATE usuarios SET
		fechabaja = CURDATE(),
		estado = "I"
	WHERE idusuario = _idusuario;
END $$

DELIMITER $$
CREATE PROCEDURE spu_usuarios_reactivar
(
	IN _idusuario INT
)
BEGIN
	UPDATE usuarios SET
		fechacreacion = CURDATE(),
		fechabaja = NULL,
		estado = "A"
	WHERE idusuario = _idusuario;
END $$

DELIMITER $$
CREATE PROCEDURE spu_usuarios_modificar
(
	IN _idusuario INT,
	IN _nombreusuario VARCHAR(15),
	IN _idespecialidad INT
)
BEGIN
	UPDATE usuarios SET
		nombreusuario = _nombreusuario,
		idespecialidad = _idespecialidad
	WHERE idusuario = _idusuario;
END $$

DELIMITER $$
CREATE PROCEDURE spu_usuarios_getdata(IN _idusuario INT)
BEGIN
	SELECT  CONCAT(PER.primerapellido, ' ', PER.segundoapellido, ', ', PER.nombres) AS nombrecompleto, USU.idusuario, USU.nombreusuario, ES.idespecialidad, USU.codigoespecialista, ES.especialidad, ES.idarea, AR.nombrerol
	FROM usuarios USU
	INNER JOIN especialidades ES ON ES.idespecialidad = USU.idespecialidad 
	INNER JOIN areas AR ON AR.idarea = ES.idarea
	INNER JOIN personas PER ON PER.idpersona = USU.idpersona
	WHERE idusuario = _idusuario;
END $$

DELIMITER $$
CREATE PROCEDURE spu_especialidadusuario_cargar()
BEGIN
	SELECT DISTINCT ESP.idespecialidad, ESP.especialidad 
	FROM usuarios USU
	INNER JOIN especialidades ESP ON ESP.idespecialidad = USU.idespecialidad
	WHERE especialidad != 'No requiere especialidad';
END $$

SELECT * FROM usuarios 
INNER JOIN especialidades ON especialidades.`idespecialidad` = usuarios.`idespecialidad`

DELIMITER $$
CREATE PROCEDURE spu_medicos_especialidad(IN _idespecialidad INT)
BEGIN
	SELECT CONCAT(PER.primerapellido,' ', PER.segundoapellido,', ', PER.nombres) AS datospersonales, USU.idespecialidad
	FROM usuarios USU
	INNER JOIN personas PER ON PER.idpersona = USU.idpersona
	WHERE idespecialidad = _idespecialidad;
END $$

DELIMITER $$
CREATE PROCEDURE spu_nombreusuario_registrado
(
	IN _nombreusuario VARCHAR(25)
)
BEGIN
	SELECT * FROM usuarios 
	WHERE nombreusuario = _nombreusuario;
END $$

DELIMITER $$
CREATE PROCEDURE spu_codespecialista_registrado
(
	IN _codigoespecialista VARCHAR(50)
)
BEGIN
	SELECT * FROM usuarios
	WHERE codigoespecialista = _codigoespecialista;
END $$

DELIMITER $$
CREATE PROCEDURE spu_usuario_codverificacion(
	IN _idusuario INT,
	IN _codverificacion CHAR(6)
)
BEGIN 
	UPDATE usuarios SET
		codverificacion = _codverificacion
	WHERE idusuario = _idusuario;
END $$

DELIMITER $$
CREATE PROCEDURE spu_usuario_eliminarcodverificacion(IN _idusuario INT)
BEGIN 
	UPDATE usuarios SET
		codverificacion = NULL
	WHERE idusuario = _idusuario;
END $$
-- ----------------------------------------------------------------------------------
-- ----------------------------------------------------------------------------------
-- HISTORIA CLÍNICA
-- ----------------------------------------------------------------------------------
-- ----------------------------------------------------------------------------------
DELIMITER $$
CREATE PROCEDURE spu_historia_yaregistrado
(
IN _idarea INT, 
IN _especialidad VARCHAR(50)
)
BEGIN
	SELECT * FROM especialidades 
      WHERE especialidad = _especialidad AND idarea = _idarea; 
END $$

DELIMITER $$
CREATE PROCEDURE spu_historiaclinica_registro
(
	IN _idpaciente 		INT,
	IN _idusuario		INT
)
BEGIN
	DECLARE ultimoid INT;
	
	SET ultimoid = (SELECT idhistoria FROM historiasclinicas ORDER BY idhistoria DESC LIMIT 1) + 1;
	INSERT INTO historiasclinicas(nrohistoria,idpaciente, fechacreacion, horacreacion, idusuario)VALUES
			(ultimoid,_idpaciente, CURDATE(), CURTIME(), _idusuario);
			
	UPDATE pacientes SET
		historiacreada = "S"
	WHERE idpaciente = _idpaciente;
END $$

DELIMITER $$
CREATE PROCEDURE spu_listar_historias()
BEGIN
	SELECT PER.idpersona,CONCAT(PER.primerapellido,' ',PER.segundoapellido) AS apellidos,  PER.nombres, HIST.nrohistoria, HIST.fechacreacion, HIST.idhistoria,
		CONCAT(PER2.primerapellido, ' ' , PER2.segundoapellido, ' ' , PER2.nombres) AS usuarionombre
		FROM historiasclinicas HIST
		INNER JOIN pacientes PAC ON HIST.idpaciente = PAC.idpaciente
		INNER JOIN personas PER ON PER.idpersona = PAC.idpersona
		INNER JOIN usuarios USU ON HIST.idusuario = USU.idusuario
		INNER JOIN personas PER2 ON PER2.idpersona = USU.idpersona
		ORDER BY idhistoria DESC LIMIT 250;
END$$

DELIMITER $$
CREATE PROCEDURE spu_buscar_historia
(
	IN _tipodoc 	CHAR(1),
	IN _nrodocumento	 	INT
)
BEGIN
		SELECT PER.idpersona,CONCAT(PER.primerapellido,' ',PER.segundoapellido) AS apellidos, 
		PAC.idpaciente, PER.nombres, HIST.nrohistoria, HIST.fechacreacion, HIST.idhistoria, 
			CONCAT(PER2.primerapellido, ' ' , PER2.segundoapellido, ' ' , PER2.nombres) AS usuarionombre
			FROM historiasclinicas HIST
			INNER JOIN pacientes PAC ON HIST.idpaciente = PAC.idpaciente
			INNER JOIN personas PER ON PER.idpersona = PAC.idpersona
			INNER JOIN usuarios USU ON HIST.idusuario = USU.idusuario
			INNER JOIN personas PER2 ON PER2.idpersona = USU.idpersona
			WHERE PER.tipodoc = _tipodoc AND PER.nrodocumento = _nrodocumento;
END $$

-- ----------------------------------------------------------------------------------
-- ----------------------------------------------------------------------------------
-- ATENCIONES
-- ----------------------------------------------------------------------------------
-- ----------------------------------------------------------------------------------
DELIMITER $$ 
CREATE PROCEDURE spu_atenciones_registrar
(
	IN _idpaciente INT,
	IN _idusuarioregistro INT,
	IN _fechaatencion DATE
)
BEGIN
	DECLARE getAICount INT ;
	DECLARE fecha DATE;
	DECLARE idcodservicio VARCHAR(20);
	
	SET getAICount = (SELECT COUNT(*) FROM atenciones WHERE fechacodigo = CURDATE());
	SET fecha = CURDATE();
	SET idcodservicio = CONCAT(fecha, '-', getAICount);

	INSERT INTO atenciones(idpaciente, idusuarioregistro, fechacodigo, fechaatencion, fecharegistro, codservicio, estadoatencion)
			VALUES(_idpaciente,_idusuarioregistro, CURDATE(),_fechaatencion ,NOW(), idcodservicio, "P"); -- Hecha -- Pendiente
END $$

DELIMITER $$
CREATE PROCEDURE spu_atenciones_listarconsultas()
BEGIN
	SELECT idatencion, ATE.idpaciente, CONCAT(PER.primerapellido,' ', PER.segundoapellido,', ', PER.nombres) AS datospersonales, 
	ATE.codservicio, ATE.fecharegistro, ATE.fechaatencion, TIMESTAMPDIFF(YEAR, PC.fechanacimiento, CURTIME()) AS edad
	FROM atenciones ATE
	INNER JOIN pacientes PC ON PC.idpaciente = ATE.idpaciente
	INNER JOIN personas PER ON PER.idpersona = PC.idpersona
	WHERE estadoatencion = "P";
END $$

DELIMITER $$
CREATE PROCEDURE spu_atenciones_getData(IN _idatencion INT)
BEGIN
	SELECT ATE.idatencion, ATE.idpaciente, CONCAT(PER.primerapellido,' ', PER.segundoapellido,', ', PER.nombres) AS datospersonales, 
	ATE.idusuarioregistro,ATE.codservicio, ATE.fecharegistro, TIMESTAMPDIFF(YEAR, PC.fechanacimiento, CURTIME()) AS edad
	FROM atenciones ATE
	INNER JOIN pacientes PC ON PC.idpaciente = ATE.idpaciente
	INNER JOIN personas PER ON PER.idpersona = PC.idpersona
	WHERE idatencion =  _idatencion;
END $$

DELIMITER $$
CREATE PROCEDURE spu_atenciones_atencionrealizada(IN _idatencion INT)
BEGIN
	UPDATE atenciones SET
		estadoatencion = "R" -- R: Realizado, P: por ver
	WHERE idatencion = _idatencion;
END $$

DELIMITER $$
CREATE PROCEDURE spu_idatencion_detatencion(IN _idatencion INT)
BEGIN
	SELECT DET.iddetatencion,PAC.idpaciente, ATE.idatencion, CONCAT(PER.primerapellido,' ', PER.segundoapellido,', ', PER.nombres) AS datospersonales, ESP.especialidad,
			CASE
				WHEN PER.tipodoc = 'D' THEN 'DNI'
				WHEN PER.tipodoc = 'C' THEN 'Carnet extranjería'
			END 'tipodoc'
			, PER.nrodocumento, HC.nrohistoria, 
			CASE
				WHEN DET.triajelisto = 'N' THEN 'Por iniciar'
				WHEN DET.triajelisto = 'P' THEN 'En Proceso'
				WHEN DET.triajelisto = 'S' THEN 'Finalizado'
			END 'triajelisto',
			CASE
				WHEN DET.revmedicalisto = 'N' THEN 'Por iniciar'
				WHEN DET.revmedicalisto = 'P' THEN 'En Proceso'
				WHEN DET.revmedicalisto = 'S' THEN 'Finalizado'
			END 'revmedicalisto'
		FROM detatencion DET
		INNER JOIN precios PRE ON PRE.idprecio = DET.idprecioesp
		INNER JOIN especialidades ESP ON ESP.idespecialidad = PRE.idespecialidad
		INNER JOIN atenciones ATE ON ATE.idatencion = DET.idatencion
		INNER JOIN pacientes PAC ON PAC.idpaciente = ATE.idpaciente
		INNER JOIN personas PER ON PER.idpersona = PAC.idpersona
		LEFT JOIN historiasclinicas HC ON HC.idpaciente = PAC.idpaciente
		WHERE ATE.idatencion = _idatencion;
END $$

DELIMITER $$
CREATE PROCEDURE spu_verificaratencion
(
	IN _idpaciente INT,
	IN _codservicio VARCHAR(50)
)
BEGIN
	SELECT * FROM detatencion
		INNER JOIN atenciones ON atenciones.idatencion = detatencion.idatencion
		WHERE idpaciente = _idpaciente AND codservicio = _codservicio;
END $$

DELIMITER $$
CREATE PROCEDURE spu_validar_atencion_repetida
(
 IN _idespecialidad INT,
 IN _idantencion INT
)
BEGIN
	SELECT * FROM detatencion
	INNER JOIN precios ON precios.idprecio = detatencion.idprecioesp
	WHERE idespecialidad = _idespecialidad AND idatencion = _idantencion;
END $$

DELIMITER $$
CREATE PROCEDURE spu_listaratenciones_boton
(
	IN _codservicio VARCHAR(50),
	IN _fechabuscar DATE
)
BEGIN
	IF _fechabuscar = "" THEN SET _fechabuscar = CURDATE(); END IF;

	SELECT  DISTINCT(triajelisto), codservicio, revmedicalisto, atenciones.idatencion FROM atenciones
		LEFT JOIN detatencion ON detatencion.idatencion = atenciones.idatencion
		INNER JOIN pacientes ON pacientes.idpaciente = atenciones.idpaciente
		INNER JOIN personas ON personas.idpersona = pacientes.idpersona
	WHERE atenciones.codservicio = _codservicio AND fechaatencion = _fechabuscar AND atenciones.estadoatencion = "R";
END $$
-- ----------------------------------------------------------------------------------
-- ----------------------------------------------------------------------------------
-- TRIAJES
-- ----------------------------------------------------------------------------------
-- ----------------------------------------------------------------------------------

DELIMITER $$
CREATE PROCEDURE spu_triaje_registro
(
	IN _iddetatencion INT,
	IN _idenfermera INT,
	IN _presionarterial VARCHAR(20),
	IN _pulso INT,
	IN _temperatura DECIMAL(7,2),
	IN _frecuenciarespiratoria INT,
	IN _talla DECIMAL(7,2),
	IN _peso DECIMAL(7,2)
)
BEGIN
	INSERT INTO triajes(iddetatencion, idenfermera, presionarterial, pulso, temperatura, frecuenciarespiratoria, talla, peso, fechatriaje) VALUES
			(_iddetatencion, _idenfermera, _presionarterial, _pulso, _temperatura, _frecuenciarespiratoria, _talla, _peso, CURDATE());
END $$

DELIMITER $$
CREATE PROCEDURE spu_triaje_listo(IN _iddetatencion INT)
BEGIN
	UPDATE detatencion SET
		triajelisto = 'S'
	WHERE iddetatencion = _iddetatencion;
END $$

DELIMITER $$
CREATE PROCEDURE spu_detatencion_getDataPaciente(IN _iddetatencion INT)
BEGIN
	SELECT DET.iddetatencion, PAC.idpaciente, CONCAT(PER.primerapellido,' ', PER.segundoapellido,', ', PER.nombres) AS datospersonales, 
	HC.nrohistoria, TIMESTAMPDIFF(YEAR, PAC.fechanacimiento, CURTIME()) AS edad
	FROM detatencion DET
	INNER JOIN atenciones ATE ON ATE.idatencion = DET.idatencion
	INNER JOIN pacientes PAC ON PAC.idpaciente = ATE.idpaciente
	INNER JOIN personas PER ON PER.idpersona = PAC.idpersona
	LEFT JOIN historiasclinicas HC ON HC.idpaciente = PAC.idpaciente
	WHERE DET.iddetatencion = _iddetatencion;
END $$
-- ----------------------------------------------------------------------------------
-- ----------------------------------------------------------------------------------
-- DETALLE DE ATENCIÓN
-- ----------------------------------------------------------------------------------
-- ----------------------------------------------------------------------------------
DELIMITER $$
CREATE PROCEDURE spu_detatencion_por_fechas(IN _fechaatencion DATE) 
BEGIN
		SELECT DET.iddetatencion,PAC.idpaciente, CONCAT(PER.primerapellido,' ', PER.segundoapellido,', ', PER.nombres) AS datospersonales,
		CASE
			WHEN PER.tipodoc = 'D' THEN 'DNI'
			WHEN PER.tipodoc = 'C' THEN 'Carnet extranjería'
		END 'tipodoc'
		, PER.nrodocumento, HC.nrohistoria, DET.fechaatencion, 
		CASE
			WHEN DET.triajelisto = 'N' THEN 'Por iniciar'
			WHEN DET.triajelisto = 'P' THEN 'En Proceso'
			WHEN DET.triajelisto = 'S' THEN 'Finalizado'
		END 'triajelisto',
		CASE
			WHEN DET.revmedicalisto = 'N' THEN 'Por iniciar'
			WHEN DET.revmedicalisto = 'P' THEN 'En Proceso'
			WHEN DET.revmedicalisto = 'S' THEN 'Finalizado'
		END 'revmedicalisto'
	FROM detatencion DET
	INNER JOIN atenciones ATE ON ATE.idatencion = DET.idatencion
	INNER JOIN pacientes PAC ON PAC.idpaciente = ATE.idpaciente
	INNER JOIN personas PER ON PER.idpersona = PAC.idpersona
	LEFT JOIN historiasclinicas HC ON HC.idpaciente = PAC.idpaciente
	WHERE DET.fechaatencion = _fechaatencion ORDER BY triajelisto DESC;
END $$

DELIMITER $$
CREATE PROCEDURE spu_detatencion_registrar
(
	IN _idatencion INT,
	IN _idprecioesp INT,
	IN _idmedico INT
)
BEGIN
	INSERT INTO detatencion (idatencion, idprecioesp, idmedico, triajelisto, revmedicalisto ,estado) 
		VALUES (_idatencion, _idprecioesp, _idmedico,"N","N", "I"); -- I = iniciado
END $$

DELIMITER $$
CREATE PROCEDURE spu_cargar_anios()
BEGIN
	SELECT DISTINCT(YEAR(fechaatencion))AS anio FROM detatencion WHERE revmedicalisto="S";
END$$
-- ----------------------------------------------------------------------------------
-- ----------------------------------------------------------------------------------
-- REVICIÓN MÉDICA
-- ----------------------------------------------------------------------------------
-- ----------------------------------------------------------------------------------
DELIMITER $$
CREATE PROCEDURE spu_revisionmedica_registrar
(
	IN _iddetatencion INT,
	IN _examenclinico TEXT,
	IN _diagnostico TEXT,
	IN _tratamiento TEXT,
	IN _tipodiagnostico CHAR(50),
	IN _derivacionlaboratorio CHAR(1)
)
BEGIN 
	INSERT INTO revisionmedica (iddetatencion, examenclinico, diagnostico, tratamiento, tipodiagnostico, derivacionlaboratorio, fechahoraregistro) VALUES (_iddetatencion,_examenclinico, _diagnostico, _tratamiento, _tipodiagnostico, _derivacionlaboratorio, NOW());
END $$

DELIMITER $$
CREATE PROCEDURE spu_buscar_revisiones(IN _tipodoc CHAR(1), IN _nrodocumento VARCHAR(9))
BEGIN
	SELECT RV.idrevision, DET.iddetatencion, HC.nrohistoria, ATE.codservicio, CONCAT(PER.primerapellido,' ', PER.segundoapellido,', ', PER.nombres) AS datospersonales, 
	PER.tipodoc, PER.nrodocumento, ESP.especialidad, TIMESTAMPDIFF(YEAR, PC.fechanacimiento, CURTIME()) AS edad
	FROM revisionmedica RV
	INNER JOIN detatencion DET ON DET.iddetatencion = RV.iddetatencion
	INNER JOIN atenciones ATE ON ATE.idatencion = DET.idatencion
	INNER JOIN pacientes PC ON PC.idpaciente = ATE.idpaciente
	INNER JOIN personas PER ON PER.idpersona =  PC.idpersona
	LEFT JOIN historiasclinicas HC ON HC.idpaciente =  PC.idpaciente
	INNER JOIN precios PRE ON PRE.idprecio = DET.idprecioesp
	INNER JOIN especialidades ESP ON ESP.idespecialidad = PRE.idespecialidad
	WHERE tipodoc = _tipodoc AND nrodocumento = _nrodocumento;
END $$

DELIMITER $$
CREATE PROCEDURE spu_revisionmedica_reportepdf(IN _idrevision INT)
BEGIN 
	SELECT RV.idrevision, DET.iddetatencion, HC.nrohistoria, RV.tipodiagnostico, PER.primerapellido, PER.segundoapellido, PER.nombres, PC.direccion, UB.dpto, UB.prov, UB.distrito, 
	DATE(fechahoraregistro) AS fecha, TIME_FORMAT(fechahoraregistro, "%r") AS hora,
		TIMESTAMPDIFF(YEAR, PC.fechanacimiento, CURTIME()) AS edad,
		CASE
			WHEN PC.sexo = 'F' THEN 'Femenino'
			WHEN PC.sexo = 'M' THEN 'Masculino'
		END 'sexo',
		CASE
			WHEN PC.estadocivil = 'S' THEN 'Soltero'
			WHEN PC.estadocivil = 'C' THEN 'Casado'
			WHEN PC.estadocivil = 'V' THEN 'Viudo'
			WHEN PC.estadocivil = 'D' THEN 'Divorciado'
		END 'estadocivil', PC.ubigeo, 
		CASE
			WHEN PER.tipodoc = 'D' THEN 'DNI'
			WHEN PER.tipodoc = 'C' THEN 'Carnet Extranjería'
		END 'tipodoc', 
		PER.nrodocumento,EQP.motivo ,PC.alergias, PER.telefono,
		TR.presionarterial,TR.pulso, TR.temperatura, TR.frecuenciarespiratoria, TR.peso, TR.talla, RV.examenclinico, RV.diagnostico, RV.tratamiento
	FROM revisionmedica RV
	INNER JOIN detatencion DET ON DET.iddetatencion = RV.iddetatencion
	INNER JOIN precios PRE ON PRE.idprecio = DET.idprecioesp
	INNER JOIN esquemaprecios EQP ON EQP.idesquema = PRE.idesquema
	LEFT JOIN triajes TR ON TR.iddetatencion =  DET.iddetatencion
	INNER JOIN atenciones ATE ON ATE.idatencion = DET.idatencion
	INNER JOIN pacientes PC ON PC.idpaciente = ATE.idpaciente
	INNER JOIN ubigeos UB ON UB.ubigeo = PC.ubigeo
	INNER JOIN personas PER ON PER.idpersona =  PC.idpersona
	LEFT JOIN historiasclinicas HC ON HC.idpaciente =  PC.idpaciente
	WHERE idrevision = _idrevision;
END $$

DELIMITER $$
CREATE PROCEDURE spu_revmedicalisto_listo(IN _iddetatencion INT)
BEGIN
	UPDATE detatencion SET
		revmedicalisto = 'S'
	WHERE iddetatencion = _iddetatencion;
END $$


-- ----------------------------------------------------------------------------------
-- ----------------------------------------------------------------------------------
-- TIPO DE EGRESO
-- ----------------------------------------------------------------------------------
-- ----------------------------------------------------------------------------------

DELIMITER $$
CREATE PROCEDURE spu_tipoegreso_registrar
(
	IN _tipoegreso VARCHAR(50)
)
BEGIN
	INSERT INTO tipoegresos (tipoegreso, estado) 
		VALUES (_tipoegreso, "A"); -- I = iniciado
END $$

DELIMITER $$
CREATE PROCEDURE spu_tipoegreso_listarActivo()
BEGIN
	SELECT * FROM tipoegresos;
END $$

DELIMITER $$
CREATE PROCEDURE spu_tipoegresos_eliminar
(
	IN _idtipoegreso INT
)
BEGIN
	UPDATE tipoegresos SET
		estado = "I"
	WHERE idtipoegreso = _idtipoegreso;
END $$

DELIMITER $$
CREATE PROCEDURE spu_tipoegresos_restaurar
(
	IN _idtipoegreso INT
)
BEGIN
	UPDATE tipoegresos SET
		estado = "A"
	WHERE idtipoegreso = _idtipoegreso;
END $$

DELIMITER$$
CREATE PROCEDURE spu_tipoegreso_registrado
(
	IN _tipoegreso VARCHAR(50)
)
BEGIN
	SELECT * FROM tipoegresos 
	WHERE tipoegreso = _tipoegreso;
END $$

-- ----------------------------------------------------------------------------------
-- ----------------------------------------------------------------------------------
-- EGRESOS
-- ----------------------------------------------------------------------------------
-- ----------------------------------------------------------------------------------
DELIMITER $$
CREATE PROCEDURE spu_egreso_registrar
(
	IN _idtipoegreso 	INT,
	IN _ruc			CHAR(11),
	IN _nombreempresa	VARCHAR(60),
	IN _motivo		TEXT,
	IN _tipocomprobante	VARCHAR(30),
	IN _seriecomprobante	VARCHAR(30),
	IN _numcomprobante	VARCHAR(30),
	IN _idusuarioregistro 	INT,
	IN _idusuarioautoriza	INT,
	IN _fechaegreso		DATE
)
BEGIN
	INSERT INTO egresos (idtipoegreso, ruc, nombreempresa, motivo, tipocomprobante, seriecomprobante, numcomprobante, idusuarioregistro, idusuarioautoriza, fechaegreso, fecharegistro) 
		VALUES (_idtipoegreso,_ruc, _nombreempresa, _motivo, _tipocomprobante, _seriecomprobante, _numcomprobante, _idusuarioregistro, _idusuarioautoriza, _fechaegreso, NOW());
END $$

DELIMITER $$
CREATE PROCEDURE spu_egreso_listar()
BEGIN
	SELECT idegreso, tipoegreso, CONCAT(PERSON1.primerapellido, ' ', PERSON1.segundoapellido, ' ', PERSON1.nombres) AS 'usuarioregistro', 
	CONCAT(PERSON2.primerapellido, ' ', PERSON2.segundoapellido, ' ', PERSON2.nombres) AS 'usuarioautoriza', fechaegreso, motivo
	FROM egresos
	INNER JOIN tipoegresos ON tipoegresos.idtipoegreso = egresos.idtipoegreso
	INNER JOIN usuarios USER1 ON USER1.idusuario = egresos.idusuarioregistro
	INNER JOIN usuarios USER2 ON USER2.idusuario = egresos.idusuarioautoriza
	INNER JOIN personas PERSON1 ON PERSON1.idpersona = USER1.idpersona
	INNER JOIN personas PERSON2 ON PERSON2.idpersona = USER2.idpersona;
END $$

-- ---------------------------------------------------------------------------------------
-- DETALLE DE EGRESO
-- ---------------------------------------------------------------------------------------

DELIMITER $$
CREATE PROCEDURE spu_detegreso_eliminar(IN _iddetegreso INT)
BEGIN
	DELETE FROM detegresos
	WHERE iddetegreso = _iddetegreso;
END $$

DELIMITER $$
CREATE PROCEDURE spu_detegreso_registro(
IN _idegreso INT,
IN _producto TEXT,
IN _cantidad INT,
IN _precio DECIMAL(7,2)
)
BEGIN
	INSERT INTO detegresos (idegreso, producto, cantidad, precio) VALUES
	(_idegreso, _producto, _cantidad, _precio);
END $$

DELIMITER $$
CREATE PROCEDURE spu_detegreso_listar(IN _idegreso INT)
BEGIN
	SELECT * FROM detegresos WHERE idegreso = _idegreso;
END $$

DELIMITER $$
CREATE PROCEDURE spu_detegreso_suma(IN _idegreso INT)
BEGIN
	SELECT ROUND(SUM(precio),2) AS preciototal FROM detegresos WHERE idegreso = _idegreso;
END $$

-- ---------------------------------------------------------------------------------------
-- GRÁFICOS
-- ---------------------------------------------------------------------------------------

DELIMITER $$
CREATE PROCEDURE spu_egresos_anios_cargar()
BEGIN
	SELECT DISTINCT(YEAR(fecharegistro)) AS 'anios' FROM egresos;
END $$

DELIMITER $$
CREATE PROCEDURE spu_atenciones_anios_cargar()
BEGIN
	SELECT DISTINCT(YEAR(fechaatencion)) AS 'anios' FROM detatencion
	INNER JOIN atenciones ON atenciones.idatencion = detatencion.idatencion;
END $$

DELIMITER $$
CREATE PROCEDURE spu_atenciones_medicos_anio_buscar_nombres(
	IN _fechabuscar DATE
)
BEGIN
IF _fechabuscar = "" THEN SET _fechabuscar = CURDATE(); END IF;
	SELECT DISTINCT(especialidades.especialidad) 
		FROM detatencion
		INNER JOIN usuarios ON usuarios.idusuario = detatencion.idmedico
		INNER JOIN atenciones ON atenciones.idatencion = detatencion.idatencion
		INNER JOIN personas ON personas.idpersona = usuarios.idpersona
		INNER JOIN precios ON precios.idprecio = detatencion.idprecioesp
		INNER JOIN especialidades ON especialidades.idespecialidad = precios.idespecialidad
			WHERE revmedicalisto="S" AND YEAR(fechaatencion) = YEAR(_fechabuscar)
			GROUP BY especialidades.especialidad, MONTH(fechaatencion);
END $$

DELIMITER $$
CREATE PROCEDURE spu_atenciones_medicos_anio_buscar_datos(
	IN _fechabuscar DATE
)
BEGIN
IF _fechabuscar = "" THEN SET _fechabuscar = CURDATE(); END IF;
SELECT especialidades.especialidad, MONTH(fechaatencion) AS "fechaatencion", COUNT(*) AS cantidadatenciones FROM detatencion
	INNER JOIN usuarios ON usuarios.idusuario = detatencion.idmedico
	INNER JOIN atenciones ON atenciones.idatencion = detatencion.idatencion
	INNER JOIN personas ON personas.idpersona = usuarios.idpersona
	INNER JOIN precios ON precios.idprecio = detatencion.idprecioesp
	INNER JOIN especialidades ON especialidades.idespecialidad = precios.idespecialidad
		WHERE revmedicalisto="S" AND YEAR(fechaatencion) = YEAR(_fechabuscar)
		GROUP BY especialidades.especialidad, MONTH(fechaatencion);
END $$

DELIMITER $$
CREATE PROCEDURE spu_detegresos_buscar_nombres
(
	IN _fechabuscar DATE
)
BEGIN
IF _fechabuscar = "" THEN SET _fechabuscar = CURDATE(); END IF;
	SELECT DISTINCT(tipoegreso)
	FROM detegresos
		INNER JOIN egresos ON egresos.idegreso=detegresos.idegreso
		INNER JOIN tipoegresos ON tipoegresos.idtipoegreso=egresos.idtipoegreso
		WHERE YEAR(fecharegistro) = YEAR(_fechabuscar)
			GROUP BY tipoegreso, MONTH(fecharegistro);
END $$

DELIMITER $$
CREATE PROCEDURE spu_detegresos_buscar_datos
(
	IN _fechabuscar DATE
)
BEGIN
IF _fechabuscar = "" THEN SET _fechabuscar = CURDATE(); END IF;
	SELECT SUM(precio) AS 'egresototal', tipoegreso,  MONTH(fechaegreso) AS "fechaegreso"
	FROM detegresos
		INNER JOIN egresos ON egresos.idegreso=detegresos.idegreso
		INNER JOIN tipoegresos ON tipoegresos.idtipoegreso=egresos.idtipoegreso
		WHERE YEAR(fecharegistro) = YEAR(_fechabuscar)
			GROUP BY tipoegreso, MONTH(fecharegistro);
END $$

DELIMITER $$
CREATE PROCEDURE spu_grafico_tabladetalleatenciones
(
	IN _fechabuscar DATE, 
	IN _especialidad VARCHAR(50)
)
BEGIN
IF _fechabuscar = "" THEN SET _fechabuscar = CURDATE(); END IF;

	SELECT especialidades.especialidad, CASE
			WHEN MONTH(fechaatencion) = '1' THEN 'Enero'
			WHEN MONTH(fechaatencion) = '2' THEN 'Febrero'
			WHEN MONTH(fechaatencion) = '3' THEN 'Marzo'
			WHEN MONTH(fechaatencion) = '4' THEN 'Abril'
			WHEN MONTH(fechaatencion) = '5' THEN 'Mayo'
			WHEN MONTH(fechaatencion) = '6' THEN 'Junio'
			WHEN MONTH(fechaatencion) = '7' THEN 'Julio'
			WHEN MONTH(fechaatencion) = '8' THEN 'Agosto'
			WHEN MONTH(fechaatencion) = '9' THEN 'Septiembre'
			WHEN MONTH(fechaatencion) = '10' THEN 'Octubre'
			WHEN MONTH(fechaatencion) = '11' THEN 'Noviembre'
			WHEN MONTH(fechaatencion) = '12' THEN 'Diciembre'
			END 'Mes', COUNT(*) AS cantidadatenciones FROM detatencion
    INNER JOIN atenciones ON atenciones.idatencion = detatencion.idatencion
		INNER JOIN precios ON detatencion.idprecioesp = precios.idprecio
		INNER JOIN especialidades ON precios.idespecialidad = especialidades.idespecialidad
		WHERE especialidades.especialidad = _especialidad AND YEAR(atenciones.fechaatencion)= YEAR(_fechabuscar)
	GROUP BY MONTH(atenciones.fechaatencion);
END $$

DELIMITER $$
CREATE PROCEDURE spu_grafico_tabladetalleaegresos
(
	IN _fechabuscar DATE, 
	IN _tipoegreso VARCHAR(50)
)
BEGIN
IF _fechabuscar = "" THEN SET _fechabuscar = CURDATE(); END IF;
	SELECT SUM(precio) AS 'egresototal', tipoegreso,CASE
			WHEN MONTH(fechaegreso) = '1' THEN 'Enero'
			WHEN MONTH(fechaegreso) = '2' THEN 'Febrero'
			WHEN MONTH(fechaegreso) = '3' THEN 'Marzo'
			WHEN MONTH(fechaegreso) = '4' THEN 'Abril'
			WHEN MONTH(fechaegreso) = '5' THEN 'Mayo'
			WHEN MONTH(fechaegreso) = '6' THEN 'Junio'
			WHEN MONTH(fechaegreso) = '7' THEN 'Julio'
			WHEN MONTH(fechaegreso) = '8' THEN 'Agosto'
			WHEN MONTH(fechaegreso) = '9' THEN 'Septiembre'
			WHEN MONTH(fechaegreso) = '10' THEN 'Octubre'
			WHEN MONTH(fechaegreso) = '11' THEN 'Noviembre'
			WHEN MONTH(fechaegreso) = '12' THEN 'Diciembre'
			END 'Mes'
		FROM detegresos
		INNER JOIN egresos ON egresos.idegreso=detegresos.idegreso
		INNER JOIN tipoegresos ON tipoegresos.idtipoegreso=egresos.idtipoegreso
		WHERE YEAR(fecharegistro) = YEAR(_fechabuscar) AND tipoegreso = _tipoegreso
			GROUP BY tipoegreso, MONTH(fecharegistro);
END $$

DELIMITER $$
CREATE PROCEDURE spu_grafico_selecttabladetalleaegresos
(
	IN _fechabuscar DATE
)
BEGIN
IF _fechabuscar = "" THEN SET _fechabuscar = CURDATE(); END IF;
	SELECT DISTINCT(tipoegreso) FROM detegresos
		INNER JOIN egresos ON egresos.idegreso=detegresos.idegreso
		INNER JOIN tipoegresos ON tipoegresos.idtipoegreso=egresos.idtipoegreso
				WHERE YEAR(fecharegistro) = YEAR(_fechabuscar);
END $$

DELIMITER $$
CREATE PROCEDURE spu_productividad_medicos()
BEGIN
	SELECT DISTINCT(CONCAT(personas.primerapellido," ",personas.segundoapellido," ", personas.nombres)) AS "doctor", especialidades.especialidad, 
	CASE
		WHEN MONTH(fechaatencion) = '1' THEN 'Enero'
		WHEN MONTH(fechaatencion) = '2' THEN 'Febrero'
		WHEN MONTH(fechaatencion) = '3' THEN 'Marzo'
		WHEN MONTH(fechaatencion) = '4' THEN 'Abril'
		WHEN MONTH(fechaatencion) = '5' THEN 'Mayo'
		WHEN MONTH(fechaatencion) = '6' THEN 'Junio'
		WHEN MONTH(fechaatencion) = '7' THEN 'Julio'
		WHEN MONTH(fechaatencion) = '8' THEN 'Agostro'
		WHEN MONTH(fechaatencion) = '9' THEN 'Septiembre'
		WHEN MONTH(fechaatencion) = '10' THEN 'Octubre'
		WHEN MONTH(fechaatencion) = '11' THEN 'Noviembre'
		WHEN MONTH(fechaatencion) = '12' THEN 'Diciembre'
	END 'mesatencion', COUNT(*) AS cantidadatenciones FROM detatencion
		INNER JOIN atenciones ON atenciones.idatencion = detatencion.idatencion
		INNER JOIN usuarios ON usuarios.idusuario = detatencion.idmedico
		INNER JOIN personas ON personas.idpersona = usuarios.idpersona
		INNER JOIN precios ON precios.idprecio = detatencion.idprecioesp
		INNER JOIN especialidades ON especialidades.idespecialidad = precios.idespecialidad
			WHERE YEAR(fechaatencion) = YEAR(CURDATE())
			GROUP BY personas.primerapellido, personas.segundoapellido, personas.nombres, MONTH(fechaatencion)
			ORDER BY especialidades.especialidad, fechaatencion;
END $$

DELIMITER $$
CREATE PROCEDURE spu_filtrar_productividad
(
	IN _fechaatencion INT,
	IN _especialidad VARCHAR(50)
)
BEGIN
		SELECT DISTINCT(CONCAT(personas.primerapellido," ",personas.segundoapellido," ", personas.nombres)) AS "doctor", especialidades.especialidad, 
	CASE
		WHEN MONTH(fechaatencion) = '1' THEN 'Enero'
		WHEN MONTH(fechaatencion) = '2' THEN 'Febrero'
		WHEN MONTH(fechaatencion) = '3' THEN 'Marzo'
		WHEN MONTH(fechaatencion) = '4' THEN 'Abril'
		WHEN MONTH(fechaatencion) = '5' THEN 'Mayo'
		WHEN MONTH(fechaatencion) = '6' THEN 'Junio'
		WHEN MONTH(fechaatencion) = '7' THEN 'Julio'
		WHEN MONTH(fechaatencion) = '8' THEN 'Agostro'
		WHEN MONTH(fechaatencion) = '9' THEN 'Septiembre'
		WHEN MONTH(fechaatencion) = '10' THEN 'Octubre'
		WHEN MONTH(fechaatencion) = '11' THEN 'Noviembre'
		WHEN MONTH(fechaatencion) = '12' THEN 'Diciembre'
	END 'mesatencion', COUNT(*) AS cantidadatenciones FROM detatencion
	INNER JOIN atenciones ON atenciones.idatencion = detatencion.idatencion
	INNER JOIN usuarios ON usuarios.idusuario = detatencion.idmedico
	INNER JOIN personas ON personas.idpersona = usuarios.idpersona
	INNER JOIN precios ON precios.idprecio = detatencion.idprecioesp
	INNER JOIN especialidades ON especialidades.idespecialidad = precios.idespecialidad
	WHERE YEAR(fechaatencion) = _fechaatencion AND especialidades.especialidad = _especialidad 
	GROUP BY personas.primerapellido, personas.segundoapellido, personas.nombres, MONTH(fechaatencion)
	ORDER BY especialidad, fechaatencion;
END $$

DELIMITER $$
CREATE PROCEDURE spu_cargar_especialidades_poranio(IN _fechaatencion INT)
BEGIN
	SELECT DISTINCT(especialidad)AS especialidad FROM detatencion
		INNER JOIN atenciones ON atenciones.idatencion = detatencion.idatencion
		INNER JOIN precios ON precios.idprecio = detatencion.idprecioesp
		INNER JOIN especialidades ON especialidades.idespecialidad = precios.idespecialidad
	 WHERE revmedicalisto="S" AND YEAR(fechaatencion) =_fechaatencion;
END $$

