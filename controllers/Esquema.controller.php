<?php
require_once '../models/Esquema.php';

if (isset($_GET['op'])){
    
  $esquema = new Esquema();

    if ($_GET['op'] == 'registrarEsquema'){
        $esquema->registrarEsquema([
            "motivo"       =>    $_GET["motivo"],
            "ideps"       =>    $_GET["ideps"]
        ]);
    }

    if ($_GET['op'] == 'listarEsquema') {
        $datosObtenidos = $esquema->listarEsquema();

        if(count($datosObtenidos) != 0){
            $i = 1;
            foreach($datosObtenidos as $fila){
                echo "
                    <tr>
                        <td class='text-center'>$i</td>
                        <td class='text-center'>$fila->motivo</td>
                        <td class='text-center'>$fila->nombreeps</td>
                    </tr>
                ";
                $i++;       
            }
        }
    }

    if($_GET['op'] == 'historiaYaExiste'){
        $datosObtenidos = $esquema->historiaYaExiste(["motivo"=> $_GET["motivo"],"ideps"=> $_GET['ideps']]);

        if(count($datosObtenidos) == 0){
            echo 1;
            return false;
        }
        else{
            echo 2;
            return true;
        }
    }

    if($_GET['op'] == 'cargarEsquema'){
        $datosObtenidos = $esquema->cargarEsquema();

        if(count($datosObtenidos) == 0){
            echo "<option>No encontramos registros disponibles</option>";
        }
        else{
            echo"<option value=''>Seleccione</option>";

            foreach($datosObtenidos as $fila){
                if($fila->nombreeps == "No requiere eps"){
                    echo "
                        <option value='$fila->idesquema'>$fila->motivo</option>
                    ";
                }else{
                    echo "
                        <option  value='$fila->idesquema'>$fila->motivo - $fila->nombreeps</option>
                    ";
                }
            }
        }
    }

    if($_GET['op'] == 'norequiereEps'){
        $datosObtenidos = $esquema->norequiereEps();
        echo json_encode($datosObtenidos);
    }

}
?>