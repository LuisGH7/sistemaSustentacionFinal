<?php

require_once '../core/model.master.php';

class Paciente extends ModelMaster{

    public function pacienteYaRegistrado(array $data){
        try{
            return parent::execProcedureLogin($data, "spu_paciente_registrado", true);
        }
        catch (Exception $error){
            die($error->getMessage());
        }
    }

    public function registrarPaciente(array $data){
        try{
            return parent::execProcedure($data, "spu_paciente_registro", true);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function listarPacientes250(){
        try{
            return parent::getRows("spu_pacientes_listar250");
        } 
        catch (Exception $error){
            die($error->getMessage());
        }
    }

    public function FiltrarPaciente(array $data){
        try{
        //Si el metodo retorna datos (true), NO OLVIDAR agregar el RETURN
        return parent::execProcedure($data, "spu_buscar_paciente", true);
        }
        catch(Exception $error){
        die($error->getMessage());
        }
    }

    public function modificarPaciente(array $data){
        try{
            parent::execProcedure($data, "spu_pacientes_modificar", false);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function getPaciente(array $data){
        try{
            return parent::execProcedure($data, "spu_pacientes_getdata", true);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function pacienteSinHistoria(){
        try{
            return parent::getRows("spu_pacientes_historiano");
        }catch(Exception $error){
            die($error->getMessage());
        }
    }
}
?>