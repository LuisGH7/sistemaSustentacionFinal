<?php

require_once '../core/model.master.php';

class HistoriaClinica extends ModelMaster{

    public function registrarHistoriaClinica(array $data){
        try{
            parent::execProcedure($data, "spu_historiaclinica_registro", false);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function listarHistorias(){
        try{
            return parent::getRows("spu_listar_historias");
        } 
        catch (Exception $error){
            die($error->getMessage());
        }
    }

    public function buscarHistoria(array $data){
        try{
            return parent::execProcedure($data, "spu_buscar_historia", true);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function historiaYaExiste(array $data){
        try{
            return parent::execProcedure($data, "spu_buscar_historia", true);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

}

?>