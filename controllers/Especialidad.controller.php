<?php
require_once '../models/Especialidad.php';

if (isset($_GET['op'])){

  $especialidad = new Especialidad();

    if($_GET['op'] == 'listarEspecialidad'){
        $datosObtenidos = $especialidad->listarEspecialidad(["idarea" => $_GET['idarea']]);

        if(count($datosObtenidos) == 0){
            echo "<option>No encontramos registros disponibles</option>";
        }
        else{
            // Mostrar un registro, por cada iteración
            foreach($datosObtenidos as $fila){
                if($fila->especialidad == ""){
                    echo "
                        <option value='$fila->idespecialidad'>Esta área no tiene especialidades</option>
                    ";
                }else{
                    echo "
                        <option value='$fila->idespecialidad'>$fila->especialidad</option>
                    ";
                }
            }
        }
    }

    if ($_GET['op'] == 'especialidadExiste'){
        // Condicionamos el metodo para verificar si existe un proveedor sin usuario
        $datosObtenidos = $especialidad->especialidadExiste(["idarea" => $_GET['idarea']]);

        if(count($datosObtenidos) == 0){
          echo 2;
            return true;
        }
        else{
            echo 1;
            return false;
        }
    }

      if ($_GET['op'] == 'especialidadYaRegistrado'){
        // Condicionamos el metodo para verificar si existe un proveedor sin usuario
        $datosObtenidos = $especialidad->especialidadYaRegistrado(["idarea" => $_GET['idarea'], "especialidad" => $_GET['especialidad']]);

        if(count($datosObtenidos) == 0){
            echo 4;
            return true;
        }
        else{
            echo 3;
            return false;
        }
    }

    if($_GET['op'] == 'listarEspecialidadTabla'){
        $datosObtenidos = $especialidad->listarEspecialidadTabla();

        if(count($datosObtenidos) != 0){
            $i = 1;
            $n = 1;
            foreach($datosObtenidos as $tabla){
                $estado="";
                if($tabla->estado=="A"){
                    $estado="<label class='switch '><input id='on'data-idespecialidad2='$tabla->idespecialidad' data-numero='$n' type='checkbox' checked><div class='slider round'></div></label>";
                    $texto="<p id='info$n'>Activo</p>";
                }else{
                    $estado="<label class='switch'><input id='on'data-idespecialidad2='$tabla->idespecialidad' data-numero='$n' type='checkbox'><div class='slider round'></div></label>";
                    $texto="<p id='info$n'>Inactivo</p>";
                }
                echo "
                    <tr>
                        <td class='text-center'> $i </td>
                        <td class='text-center'> $tabla->nombrerol</td>
                        <td class='text-center'> $tabla->especialidad</td>
                        <td class='text-center'>
                            <div class='row col-md-12 justify-content-center'>
                                {$estado}
                                <div class='col-md-1'>
                                </div>
                                <b>{$texto}</b>
                            </div>
                        </td>
                    </tr>
                ";
                $i++;
                $n++;
            }
        }
    } 

    if($_GET['op'] == 'listarEspecialidadTablaInactivo'){
        $datosObtenidos = $especialidad->listarEspecialidadTablaInactivo();

        if(count($datosObtenidos) != 0){
            $i = 1;
            foreach($datosObtenidos as $tabla){
                echo "
                    <tr>
                        <td class='text-center'> $i </td>
                        <td class='text-center'> $tabla->nombrerol</td>
                        <td class='text-center'> $tabla->especialidad</td>
                        <td class='text-center'>
                            <a href='#' data-idespecialidad='$tabla->idespecialidad' class='btn btn-sm btn-outline-secondary reactivar'>
                            <i class='fas fa-undo-alt'></i></a>
                        </td>
                    </tr>
                ";
                $i++;
            }
        }
    } 

    if($_GET['op'] == 'eliminarEspecialidad'){
        $especialidad->eliminarEspecialidad([
            "idespecialidad" => $_GET['idespecialidad']
        ]);
    }

    if($_GET['op'] == 'reactivarEspecialidad'){
        $especialidad->reactivarEspecialidad([
          "idespecialidad" => $_GET['idespecialidad']
        ]);
    }

    if ($_GET['op'] == 'registrarEspecialidad'){
        $especialidad->registrarEspecialidad([
          "idarea"          => $_GET["idarea"],
          "especialidad"    => $_GET["especialidad"]
        ]);
    }

    if($_GET['op'] == 'listarEspecialidadesCargar'){
        $datosObtenidos = $especialidad->listarEspecialidadesCargar();

        if(count($datosObtenidos) == 0){
            echo "<option>No encontramos registros disponibles</option>";
        }
        else{
            echo"<option value=''>Seleccione</option>";

            foreach($datosObtenidos as $fila){
                if($fila->especialidad == ""){
                    echo "
                        <option value='$fila->idespecialidad'>Esta área no tiene especialidades</option>
                    ";
                }else{
                    echo "
                        <option value='$fila->idespecialidad'>$fila->especialidad</option>
                    ";
                }
            }
        }
    }

}
?>