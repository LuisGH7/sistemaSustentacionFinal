<?php

require_once '../core/model.master.php';

class Persona extends ModelMaster{
    
    public function listarPersonaSinLogear(){
        try{
            return parent::getRows("spu_personas_cargar");
        } 
        catch (Exception $error){
            die($error->getMessage());
        }
    }

    public function registrarPersona(array $data){
        try{
            parent::execProcedure($data, "spu_personas_registro", false);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function listarPersonas(){
        try{
            return parent::getRows("spu_personas_listar");
        } 
        catch (Exception $error){
            die($error->getMessage());
        }
    }

    public function buscarPersona($valorBuscado){
        try{
            return parent::execProcedureLogin($valorBuscado, "spu_buscar_persona", true);

        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function buscarPersonaHC(array $data){
        try{
            return parent::execProcedure($data, "spu_persona_buscar", true);
        } 
        catch (Exception $error){
            die($error->getMessage());
        }
    }

    public function personaYaRegistrado(array $data){
        try{
            return parent::execProcedureLogin($data, "spu_persona_registrado", true);
        }
        catch (Exception $error){
            die($error->getMessage());
        }
    }

    public function getPersona(array $data){
        try{
            return parent::execProcedure($data, "spu_persona_getdata", true);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }
    
    public function modificarPersona(array $data){
        try{
            parent::execProcedure($data, "spu_personas_modificar", false);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function registrarPersonaPaciente(array $data){
        try{
            return parent::execProcedure($data, "spu_personaspaciente_registro", true);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }


    // validacion de contraseña

    public function validarCorreoContraseña(array $data){
        try{
            return parent::execProcedure($data, "spu_persona_verificarcorreo", true);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function emailNoRegistrado(array $data){
        try{
            return parent::execProcedureLogin($data, "spu_emailnoexiste_registrado", true);
        }
        catch (Exception $error){
            die($error->getMessage());
        }
    }
}

?>