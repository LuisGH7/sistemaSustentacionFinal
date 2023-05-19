<?php

require_once '../core/model.master.php';

class Detegreso extends ModelMaster{

    public function listarDetegreso(array $data){
        try{
            return parent::execProcedure($data, "spu_detegreso_listar", true);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function detegresosuma(array $data){
        try{
            return parent::execProcedure($data, "spu_detegreso_suma", true);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function eliminarDetEgreso(array $data){
        try{
            parent::execProcedure($data, "spu_detegreso_eliminar", false);

        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function registrarDetegreso(array $data){
        try{
            parent::execProcedure($data, "spu_detegreso_registro", false);
        } 
        catch (Exception $error){
            die($error->getMessage());
        }
    }

    
}
?>