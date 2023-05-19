<?php
require_once '../models/TipoEgreso.php';

if (isset($_GET['op'])){

  $tipoegreso = new TipoEgreso();

    if($_GET['op'] == 'listarTipoEgresoTabla'){
        $datosObtenidos = $tipoegreso->listarTipoEgreso();

        if(count($datosObtenidos) != 0){
            $n = 1;
            $i = 1;
            foreach($datosObtenidos as $tabla){
                if($tabla->estado=="A"){
                    $estado = "<label class='switch'><input id='on'  data-numero='$n' data-idtipoegreso2='$tabla->idtipoegreso' type='checkbox' checked><div class='slider round'></div></label>";
                    $texto = "<p id='info$n'>Activo</p>";
                }else{
                    $estado = "<label class='switch'><input id='on'  data-numero='$n' data-idtipoegreso2='$tabla->idtipoegreso' type='checkbox'><div class='slider round'></div></label>";
                    $texto = "<p id='info$n'>Inactivo</p>";
                }
                echo "
                    <tr>
                        <td class='text-center'> $i </td>
                        <td class='text-center'> $tabla->tipoegreso</td>
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

    if($_GET['op'] == 'listarTipoEgresoTablaInactivo'){
        $datosObtenidos = $tipoegreso->listarTipoEgresoInactivo();

        if(count($datosObtenidos) != 0){
            $i = 1;
            foreach($datosObtenidos as $tabla){
                echo "
                    <tr>
                        <td class='text-center'> $i </td>
                        <td class='text-center'> $tabla->tipoegreso</td>
                        <td class='text-center'>
                            <a href='#' data-idtipoegreso='$tabla->idtipoegreso' class='btn btn-sm btn-outline-secondary reactivar'>
                            <i class='fas fa-undo-alt'></i></a>
                        </td>
                    </tr>
                ";
                $i++;
            }
        }
    } 

    if($_GET['op'] == 'eliminarTipoEgreso'){
        $tipoegreso->eliminarTipoEgreso([
            "idtipoegreso" => $_GET['idtipoegreso']
        ]);
    }

    if($_GET['op'] == 'reactivarTipoEgreso'){
        $tipoegreso->reactivarTipoEgreso([
          "idtipoegreso" => $_GET['idtipoegreso']
        ]);
    }

    if ($_GET['op'] == 'registrarTipoEgreso'){
        $tipoegreso->registrarTipoEgreso([
          "tipoegreso"          => $_GET["tipoegreso"]
        ]);
    }

    if ($_GET['op'] == 'cargarTipoEgreso') {
        $datosObtenidos = $tipoegreso->listarTipoEgreso();

        if(count($datosObtenidos) == 0){
            echo "<option >No encontramos registros disponibles</option>";
        }
        else{
            echo "<option value=''>Seleccione</option>";
            foreach($datosObtenidos as $fila){
                echo "
                    <option value='$fila->idtipoegreso'>$fila->tipoegreso</option>
                    ";
                        
            }
        }
    }

    if ($_GET['op'] == 'tipoegresoYaRegistrado'){
        $datosObtenidos = $tipoegreso->tipoegresoYaRegistrado(["tipoegreso" => $_GET['tipoegreso']]);

        if(count($datosObtenidos) == 0){
          echo 2;
          return true;
        }
        else{
          echo 1;
          return false;
        }
    }

}
?>