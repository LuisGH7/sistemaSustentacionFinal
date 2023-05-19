<?php

require_once '../core/model.master.php';

class Ubigeo extends ModelMaster{

    public function getUbigeo($valorBuscado){
        try{
            return parent::execProcedure($valorBuscado, "spu_ubigeos_buscar", true);

        }catch(Exception $error){
            die($error->getMessage());
        }
    }
}
?>