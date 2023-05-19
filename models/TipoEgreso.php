<?php

require_once '../core/model.master.php';

class TipoEgreso extends ModelMaster{
    
    public function listarTipoEgreso(){
        try{
            return parent::getRows("spu_tipoegreso_listarActivo");
        } 
        catch (Exception $error){
            die($error->getMessage());
        }
    }

    public function registrarTipoEgreso(array $data){
        try{
            parent::execProcedure($data, "spu_tipoegreso_registrar", false);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function listarTipoEgresoInactivo(){
        try{
            return parent::getRows("spu_tipoegreso_listarInactivo");
        } 
        catch (Exception $error){
            die($error->getMessage());
        }
    }


    public function eliminarTipoEgreso(array $data){
        try{
            parent::deleteRows($data, "spu_tipoegresos_eliminar");
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function reactivarTipoEgreso(array $data){
        try{
            parent::execProcedure($data, "spu_tipoegresos_restaurar", false);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }  

    public function tipoegresoYaRegistrado(array $data){
        try{
            return parent::execProcedureLogin($data, "spu_tipoegreso_registrado", true);
        }
        catch (Exception $error){
            die($error->getMessage());
        }
    }

}

?>