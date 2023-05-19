<?php

require_once '../core/model.master.php';

class Area extends ModelMaster{
    
    public function listarArea(){
        try{
            return parent::getRows("spu_areas_listar");
        } 
        catch (Exception $error){
            die($error->getMessage());
        }
    }

    public function registrarArea(array $data){
        try{
            parent::execProcedure($data, "spu_areas_registro", false);

        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function listarAreaActiva(){
        try{
            return parent::getRows("spu_areas_listarActivo");
        } 
        catch (Exception $error){
            die($error->getMessage());
        }
    }

    public function eliminarArea(array $data){
        try{
            parent::execProcedure($data, "spu_areas_eliminar", false);

        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function restaurarArea(array $data){
        try{
            parent::execProcedure($data, "spu_areas_restaurar", false);

        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function comprobarArea(array $data){
        try{
            return parent::execProcedureLogin($data, "spu_area_comprobar", true);

        } 
        catch (Exception $error){
            die($error->getMessage());
        }
    }

    public function areaYaRegistrado(array $data){
        try{
            return parent::execProcedureLogin($data, "spu_area_registrado", true);
        }
        catch (Exception $error){
            die($error->getMessage());
        }
    }
    
}
?>