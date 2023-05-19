<?php

require_once '../core/model.master.php';

class Atencion extends ModelMaster{
    
    public function registrarAtencion(array $data){
        try{
            parent::execProcedure($data, "spu_atenciones_registrar", false);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function listarAtencion(){
        try{
            return parent::getRows("spu_atenciones_listarconsultas");
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function getAtencion(array $data){
        try{
            return parent::execProcedure($data, "spu_atenciones_getData", true);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function cargarEspecialidad(){
        try{
            return parent::getRows("spu_especialidadusuario_cargar");
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function cargarMedicos(array $data){
        try{
            return parent::execProcedure($data, "spu_medicos_especialidad", true);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function cargarPrecios(array $data){
        try{
            return parent::execProcedure($data, "spu_precios_especialidad", true);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function atencionRealizada(array $data){
        try{
            parent::execProcedure($data, "spu_atenciones_atencionrealizada", false);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }
    
    public function listarAtencionesPorRealizar(array $data){
        try{
            return parent::execProcedure($data, "spu_listaratenciones_dia", true);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function atencionPorRevisar(array $data){
        try{
            return parent::execProcedure($data, "spu_idatencion_detatencion", true);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function listarAtencionesBoton(array $data){
        try{
            return parent::execProcedure($data, "spu_listaratenciones_boton", true);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

}
?>