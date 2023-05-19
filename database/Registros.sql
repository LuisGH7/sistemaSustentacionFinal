CALL spu_personas_registro("FRANCIA", "MINAYA", "BRENDA ANDREA", "D", "74720939", "969808768", "brendaandreafranciaminaya@gmail.com");

CALL spu_areas_registro("Medicina"); 
CALL spu_areas_registro("Admisión"); 
CALL spu_areas_registro("Admisión General"); 
CALL spu_areas_registro("Triaje"); 
CALL spu_areas_registro("Gerencia");
CALL spu_areas_registro("Administrador"); 

CALL spu_especialidades_registro(1, "Cardiología");
CALL spu_especialidades_registro(1, "Cirugía General");
CALL spu_especialidades_registro(1, "Cirugía Plástica");
CALL spu_especialidades_registro(1, "Dermatología");
CALL spu_especialidades_registro(1, "Endocrinología");
CALL spu_especialidades_registro(1, "Gastroenterología");
CALL spu_especialidades_registro(1, "Geriatría");
CALL spu_especialidades_registro(1, "Ginecología");
CALL spu_especialidades_registro(1, "Medicina Física y Rehabilitación");
CALL spu_especialidades_registro(1, "Medicina General");
CALL spu_especialidades_registro(1, "Medicina Interna");
CALL spu_especialidades_registro(1, "Neurología");
CALL spu_especialidades_registro(1, "Otorrinolaringología");
CALL spu_especialidades_registro(1, "Pediatría");
CALL spu_especialidades_registro(1, "Traumatología");
CALL spu_especialidades_registro(1, "Urología");

CALL spu_especialidades_registro(2, "No requiere especialidad");
CALL spu_especialidades_registro(3, "No requiere especialidad");
CALL spu_especialidades_registro(4, "No requiere especialidad");
CALL spu_especialidades_registro(5, "No requiere especialidad");
CALL spu_especialidades_registro(6, "No requiere especialidad");

CALL spu_usuarios_registro(1, "Brenda", 6, "12345");

ALTER TABLE historiasclinicas AUTO_INCREMENT = 4730;

SELECT * FROM usuarios;

