<?php

require_once '../core/model.master.php';

class Egreso extends ModelMaster{
    
    public function listarEgreso(){
        try{
            return parent::getRows("spu_egreso_listar");
        } 
        catch (Exception $error){
            die($error->getMessage());
        }
    }

    public function registrarEgreso(array $data){
        try{
            parent::execProcedure($data, "spu_egreso_registrar", false);

        }catch(Exception $error){
            die($error->getMessage());
        }
    }
    
}
?>