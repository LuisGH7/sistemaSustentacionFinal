<?php

require_once '../core/model.master.php';

class Reporte extends ModelMaster{
    
    public function atencionMedicosAnioBuscarNombre(array $data){
        try{
            return parent::execProcedure($data, "spu_atenciones_medicos_anio_buscar_nombres", true);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }
    public function atencionMedicosAnioBuscarDatos(array $data){
        try{
            return parent::execProcedure($data, "spu_atenciones_medicos_anio_buscar_datos", true);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function DetEgresosAnioBuscarNombre(array $data){
        try{
            return parent::execProcedure($data, "spu_detegresos_buscar_nombres", true);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function DetEgresosAnioBuscarlDatos(array $data){
        try{
            return parent::execProcedure($data, "spu_detegresos_buscar_datos", true);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function ProductividadMedicos(){
        try{
            return parent::getRows("spu_productividad_medicos");
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function cargarAnios(){
        try{
            return parent::getRows("spu_atenciones_anios_cargar");
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function cargarAniosEgresos(){
        try{
            return parent::getRows("spu_egresos_anios_cargar");
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function filtrarEspecialidad(array $data){
        try{
            return parent::execProcedure($data, "spu_cargar_especialidades_poranio", true);
        } 
        catch (Exception $error){
            die($error->getMessage());
        }
    }

    public function DetalleProductividad(array $data){
        try{
            return parent::execProcedure($data, "spu_filtrar_productividad", true);
        } 
        catch (Exception $error){
            die($error->getMessage());
        }
    }

    public function atencionesTablaDetalle(array $data){
        try{
            return parent::execProcedure($data, "spu_grafico_tabladetalleatenciones", true);
        } 
        catch (Exception $error){
            die($error->getMessage());
        }
    }

    public function EgresosTablaDetalle(array $data){
        try{
            return parent::execProcedure($data, "spu_grafico_tabladetalleaegresos", true);
        } 
        catch (Exception $error){
            die($error->getMessage());
        }
    }

    public function SelectEgresosTablaDetalle(array $data){
        try{
            return parent::execProcedure($data, "spu_grafico_selecttabladetalleaegresos", true);
        } 
        catch (Exception $error){
            die($error->getMessage());
        }
    }

}

?>