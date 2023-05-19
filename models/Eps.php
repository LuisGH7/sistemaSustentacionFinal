<?php

require_once '../core/model.master.php';

class Eps extends ModelMaster{
    
    public function registrarEps(array $data){
        try{
            parent::execProcedure($data, "spu_eps_registro", false);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function eliminarEps(array $data){
        try{
            parent::execProcedure($data, "spu_eps_eliminar");
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function reactivarEps(array $data){
        try{
            parent::execProcedure($data, "spu_eps_restaurar", false);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function listarEpsActivo(){
        try{
            return parent::getRows("spu_eps_listarActivos");
        } 
        catch (Exception $error){
            die($error->getMessage());
        }
    }

    public function cargarEps(){
        try{
            return parent::getRows("spu_eps_cargar");
        } 
        catch (Exception $error){
            die($error->getMessage());
        }
    }

    public function listarEpsInactivo(){
        try{
            return parent::getRows("spu_eps_listarInactivos");
        } 
        catch (Exception $error){
            die($error->getMessage());
        }
    }

    public function epsYaRegistrado(array $data){
        try{
            return parent::execProcedureLogin($data, "spu_eps_registrado", true);
        }
        catch (Exception $error){
            die($error->getMessage());
        }
    }


}

?>