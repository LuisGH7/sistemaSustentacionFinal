<?php
require_once '../models/Eps.php';

if (isset($_GET['op'])){
    
  $eps = new Eps();

    if ($_GET['op'] == 'registrarEps'){
        $eps->registrarEps([
        "nombreeps"       =>    $_GET["nombreeps"]
        ]);
    }

    if ($_GET['op'] == 'eliminarEps'){
        $eps->eliminarEps([
          "ideps"       => $_GET["ideps"]
        ]);
    }

    if ($_GET['op'] == 'reactivarEps'){
        $eps->reactivarEps([
          "ideps"       => $_GET["ideps"]
        ]);
    }

    if ($_GET['op'] == 'listarEpsActiva') {
        $datosObtenidos = $eps->listarEpsActivo();

        if(count($datosObtenidos) != 0){
            $n = 1;
            $i = 1;
            foreach($datosObtenidos as $fila){
                $estado="";
                if($fila->estado=="A"){
                    $estado="<label class='switch '><input id='on' data-ideps2='$fila->ideps' data-numero='$n' type='checkbox' checked><div class='slider round'></div></label>";
                    $texto="<p id='info$n'>Activo</p>";
                }else{
                    $estado="<label class='switch'><input id='on' data-ideps2='$fila->ideps' data-numero='$n' type='checkbox'><div class='slider round'></div></label>";
                    $texto="<p id='info$n'>Inactivo</p>";
                }
                echo "
                    <tr>
                        <td class='text-center'>$i</td>
                        <td class='text-center'>$fila->nombreeps</td>
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

    if ($_GET['op'] == 'listarEpsInactiva') {
        $datosObtenidos = $eps->listarEpsInactivo();

        if(count($datosObtenidos) != 0){
            $i = 1;
            foreach($datosObtenidos as $fila){
                echo "
                    <tr>
                        <td class='text-center'>$i</td>
                        <td class='text-center'>$fila->nombreeps</td>
                        <td class='text-center'>
                            <a href='#' data-ideps='$fila->ideps' class='btn btn-sm btn-outline-secondary restaurar'>
                            <i class='fas fa-undo'></i></a>
                        </td>
                    </tr>
                    ";
                    $i++;       
            }
        }
    }

    if ($_GET['op'] == 'epsYaRegistrado'){
        $datosObtenidos = $eps->epsYaRegistrado(["nombreeps" => $_GET['nombreeps']]);

        if(count($datosObtenidos) == 0){
          echo 2;
          return true;
        }
        else{
          echo 1;
          return false;
        }
    }

    if ($_GET['op'] == 'cargarEpsActiva') {
        $datosObtenidos = $eps->cargarEps();

        if(count($datosObtenidos) == 0){
            echo "<option>No encontramos registros disponibles</option>";
        }
        else{
            echo "<option value=''>Seleccione</option>";
            foreach($datosObtenidos as $fila){
                echo "
                        <option value='$fila->ideps'>$fila->nombreeps</option>

                    ";

                
            }
        }
    }
    
}
?>