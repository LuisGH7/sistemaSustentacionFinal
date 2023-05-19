<?php
require_once '../core/model.master.php';

class Precio extends ModelMaster{

    public function registrarPrecio(array $data){
        try{
            parent::execProcedure($data,"spu_precios_registro", false);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function listarPrecios(){
        try{
            return parent::getRows("spu_precios_listar");
        }catch(Exception $error){
            die($error->getMessage());
        }

    }

    public function eliminarPrecio(array $data){
        try{
            parent::execProcedure($data, "spu_precio_eliminar", false);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function listarPreciosInactivos(){
        try{
            return parent::getRows("spu_precios_listarInactivos");
        }catch(Exception $error){
            die($error->getMessage());
        }

    }

    public function restaurarPrecio(array $data){
        try{
            parent::execProcedure($data, "spu_precio_restaurar", false);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function getPrecio(array $data){
        try{
            return parent::execProcedure($data, "spu_get_precios", true);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function actualizarPrecio(array $data){
        try{
            parent::execProcedure($data, "spu_precio_modificar", false);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function yaExistePrecio(array $data){
        try{
            return parent::execProcedure($data, "spu_precio_yaexiste", true);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

}
?>