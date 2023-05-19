USE famisaludsistema;
-- ----------------------------------------------------------------------------------
-- ----------------------------------------------------------------------------------
-- UBIGEO
-- ----------------------------------------------------------------------------------
-- ----------------------------------------------------------------------------------
CREATE VIEW vs_ubigeo_full
AS
	SELECT ubigeo,
		CONCAT(dpto, ' - ', prov, ' - ', distrito) AS 'text'
	FROM ubigeos
	ORDER BY 2;
-- ----------------------------------------------------------------------------------
-- ----------------------------------------------------------------------------------
-- PERSONAS
-- ----------------------------------------------------------------------------------
-- ----------------------------------------------------------------------------------
CREATE VIEW vista_buscar_persona
AS
	SELECT personas.idpersona, CONCAT(personas.primerapellido, ' ' , personas.segundoapellido, ' ' , personas.nombres) AS nombrecompleto, 
	personas.tipodoc, personas.nrodocumento, pacientes.idpaciente
		FROM pacientes
		INNER JOIN personas ON personas.idpersona = pacientes.idpersona ORDER BY idpersona DESC;
		
-- nueva vista creada
CREATE VIEW vista_listar_personas
AS
SELECT personas.idpersona, CONCAT(primerapellido, " ", segundoapellido) AS apellidos, nombres, idpaciente,
	CASE 
		WHEN tipodoc = "D" THEN "DNI"
		WHEN tipodoc = "C" THEN "Carnet extrangería"
	END "tipodoc", nrodocumento, telefono
	 FROM pacientes
	 RIGHT JOIN personas ON personas.idpersona = pacientes.idpersona 
	 ORDER BY personas.idpersona DESC;
	
-- --------------------------------------------------------------------
CREATE VIEW vista_buscar_historia
AS 
		SELECT PER.idpersona,CONCAT(PER.primerapellido,' ',PER.segundoapellido) AS apellidos,  PER.nombres, HIST.nrohistoria, HIST.fechacreacion, HIST.idhistoria,
		CONCAT(PER2.primerapellido, ' ' , PER2.segundoapellido, ' ' , PER2.nombres) AS usuarionombre,PAC.idpaciente
		FROM historiasclinicas HIST
		INNER JOIN pacientes PAC ON HIST.idpaciente = PAC.idpaciente
		INNER JOIN personas PER ON PER.idpersona = PAC.idpersona
		INNER JOIN usuarios USU ON HIST.idusuario = USU.idusuario
		INNER JOIN personas PER2 ON PER2.idpersona = USU.idpersona
		ORDER BY idhistoria DESC; 
		
	

	 
	 