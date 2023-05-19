<?php

require_once '../core/model.master.php';

class Esquema extends ModelMaster{
    
    public function registrarEsquema(array $data){
        try{
            parent::execProcedure($data, "spu_esquemaprecios_registro", false);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function eliminarEsquema(array $data){
        try{
            parent::deleteRows($data, "spu_esquemaprecios_eliminar");
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function listarEsquema(){
        try{
            return parent::getRows("spu_esquemaprecios_listar");
        } 
        catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function historiaYaExiste(array $data){
        try{
            return parent::execProcedure($data, "spu_esquemas_eps_existe", true);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function cargarEsquema(){
        try{
            return parent::getRows("spu_motivos_cargar");
        } 
        catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function norequiereEps(){
        try{
            return parent::getRows("spu_esquemaprecio_norequiere");
        }catch(Exception $error){
            die($error->getMessage());
        }
    }
}

?>