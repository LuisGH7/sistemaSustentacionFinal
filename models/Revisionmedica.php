<?php

require_once '../core/model.master.php';

class Revisionmedica extends ModelMaster{
    
    public function registrarRevisionMedica(array $data){
        try{
            parent::execProcedure($data, "spu_revisionmedica_registrar", false);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function buscarRevisionesMedicas(array $data){
        try{
            return parent::execProcedure($data, "spu_buscar_revisiones", true);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function reporteCompleto(array $data){
        try{
            return parent::execProcedure($data, "spu_revisionmedica_reportepdf", true);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function revmedicalisto(array $data){
        try{   
            parent::execProcedure($data, "spu_revmedicalisto_listo", false);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

}

?>