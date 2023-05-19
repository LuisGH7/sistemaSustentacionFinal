<?php
require_once '../models/Area.php';

if (isset($_GET['op'])){
    
  $area = new Area();

    if ($_GET['op'] == 'listarArea') {
        $datosObtenidos = $area->listarArea();

        if(count($datosObtenidos) == 0){
            echo "<option >No encontramos registros disponibles</option>";
        }
        else{
            echo "<option value=''>Seleccione</option>";
            foreach($datosObtenidos as $fila){
                echo "
                    <option value='$fila->idarea'>$fila->nombrerol</option>
                    ";
                        
            }
        }
    }

    if ($_GET['op'] == 'validadArea') {
        $datosObtenidos = $area->comprobarArea(["idarea" => $_GET['idarea']]);
        if(count($datosObtenidos) == 0){
            echo "
                <fieldset disabled='disabled'>
                    <label for='especialidad'>Especialidad</label>
                    <input class='form-control form-control-border' id='especialidad' maxlength='70' value='No requiere especialidad'>
                </fieldset>
            ";
        }else{
            echo "
                <label for='especialidad'>Especialidad</label>
                <input class='form-control form-control-border' id='especialidad' maxlength='70'>
            ";

        }
    }

    if ($_GET['op'] == 'registrarArea'){
        $area->registrarArea([
          "nombrerol"       => $_GET["nombrerol"]
        ]);
    }

    if ($_GET['op'] == 'eliminarArea'){
        $area->eliminarArea([
          "idarea"       => $_GET["idarea"]
        ]);
    }

    if ($_GET['op'] == 'restaurarArea'){
        $area->restaurarArea([
          "idarea"       => $_GET["idarea"]
        ]);
    }

    if ($_GET['op'] == 'listarAreaActiva') {
        $datosObtenidos = $area->listarAreaActiva();

        if(count($datosObtenidos) != 0){
            $i = 1;
            $n = 1;
            foreach($datosObtenidos as $fila){
                $estado="";
                if($fila->estado=="A"){
                    $estado="<label class='switch '><input id='on'data-idarea2='$fila->idarea' data-numero='$n' type='checkbox' checked><div class='slider round'></div></label>";
                    $texto="<p id='info$n'>Activo</p>";
                }else{
                    $estado="<label class='switch'><input id='on'data-idarea2='$fila->idarea' data-numero='$n' type='checkbox'><div class='slider round'></div></label>";
                    $texto="<p id='info$n'>Inactivo</p>";
                }
                echo "
                    <tr>
                        <td class='text-center'>$i</td>
                        <td class='text-center'>$fila->nombrerol</td>
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

    if ($_GET['op'] == 'areaYaRegistrado'){
        $datosObtenidos = $area->areaYaRegistrado(["nombrerol" => $_GET['nombrerol']]);

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