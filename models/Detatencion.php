<?php

require_once '../core/model.master.php';

class Detatencion extends ModelMaster{
    
    public function registrarDetatencion(array $data){
        try{
            parent::execProcedure($data, "spu_detatencion_registrar", false);
        } 
        catch (Exception $error){
            die($error->getMessage());
        }
    }

    public function getDetatencionPaciente(array $data){
        try{
            return parent::execProcedure($data, "spu_detatencion_getDataPaciente", true);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }


    public function listarDetatencionPorAtencion(array $data){
        try{
            return parent::execProcedure($data, "spu_detatencion_listarATE", true);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function totalpagardetacion(array $data){
        try{
            return parent::execProcedure($data, "spu_detatencion_totalpagar", true);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function eliminarDetatencion(array $data){
        try{
            parent::execProcedure($data, "spu_detatencion_eliminar", false);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function validarDetatencion(array $data){
        try{
            return parent::execProcedure($data, "spu_verificaratencion", true);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function validarAtencionRepetida(array $data){
        try{
            return parent::execProcedure($data, "spu_validar_atencion_repetida", true);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

}
?>