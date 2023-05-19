<?php

require_once '../core/model.master.php';

class Especialidad extends ModelMaster{
    
    public function listarEspecialidad(array $data){
        try{
            return parent::execProcedure($data, "spu_especialidades_listar", true);
        } 
        catch (Exception $error){
            die($error->getMessage());
        }
    }

    public function listarEspecialidadTabla(){
        try{
            return parent::getRows("spu_especialidades_listarTabla");
        } 
        catch (Exception $error){
            die($error->getMessage());
        }
    }

    public function registrarEspecialidad(array $data){
        try{
            parent::execProcedure($data, "spu_especialidades_registro", false);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function listarEspecialidadTablaInactivo(){
        try{
            return parent::getRows("spu_especialidades_listarInactivo");
        } 
        catch (Exception $error){
            die($error->getMessage());
        }
    }


    public function eliminarEspecialidad(array $data){
        try{
            parent::deleteRows($data, "spu_especialidades_eliminar");
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function reactivarEspecialidad(array $data){
        try{
            parent::execProcedure($data, "spu_especialidades_reactivar", false);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }

    public function especialidadExiste(array $data){
        try{
            return parent::execProcedureLogin($data, "spu_especialidades_existe", true);
        }
        catch (Exception $error){
            die($error->getMessage());
        }
    }

    public function especialidadYaRegistrado(array $data){
        try{
            return parent::execProcedureLogin($data, "spu_especialidades_yaregistrado", true);
        }
        catch (Exception $error){
            die($error->getMessage());
        }
    }

    public function listarEspecialidadesCargar(){
        try{
            return parent::getRows("spu_especialidades_cargar");
        } 
        catch (Exception $error){
            die($error->getMessage());
        }
    }




    public function especialidadRegistrada(array $data){
        try{
          
          // Hacemos una consulta al sql y la almacenamos en la variable SQL.
          $sql ="SELECT * FROM especialidades 
          WHERE especialidad = 'No requiere especialidad' AND idarea = '$idarea';";
    
          //Almacenamos el resultado en la variable RESULT
          $result = $this->pdo->query($sql);
    
          // Condicionamos la variable result, asimismo usamos (RowCount()) para contar las lineas obtenidas de la variable result.
          if(($result->rowCount()) > 0){
            return 1;
          }else{
            return 0;
          }
    
        }catch(Exception $e){
          die($e->getMessage());
        }
    }
    

}

// $especialidad = new Especialidad();

// $valor = $especialidad->especialidadExiste([5]);

// var_dump($valor);

?>