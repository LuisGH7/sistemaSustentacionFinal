<?php

require_once '../core/model.master.php';

class Triaje extends ModelMaster{

    public function registroTriaje(array $data){
        try{   
            parent::execProcedure($data, "spu_triaje_registro", false);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function triajelisto(array $data){
        try{   
            parent::execProcedure($data, "spu_triaje_listo", false);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }
}
?>