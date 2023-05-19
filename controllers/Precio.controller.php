<?php
require_once '../models/Precio.php';

if(isset($_GET['op'])){
    $precio = new Precio();

    if($_GET['op'] == 'registrarPrecio'){
        $precio->registrarPrecio([
            "idespecialidad"        => $_GET["idespecialidad"],
            "idesquema"             => $_GET["idesquema"],
            "descripcion"           =>$_GET["descripcion"],
            "precio"                =>$_GET["precio"],
            "fechainicio"           =>$_GET["fechainicio"],
            "fechafin"              =>$_GET["fechafin"]
        ]);
    }

    if($_GET['op'] == 'listarPrecios'){
        $datosObtenidos = $precio->listarPrecios();

        if(count($datosObtenidos)!= 0){
            $i = 1;
            $n = 1;
            foreach($datosObtenidos as $tabla){
                if($tabla->fechainicio == "" && $tabla->fechafin == ""){
                    $fechascompletas = "<td class='text-center'>No requiere</td>";
                }else{
                    $fechascompletas = "<td class='text-center'>$tabla->fechainicio a $tabla->fechafin</td>";
                }

                echo"
                    <tr>
                        <td class='text-center'>$i</td>
                        <td class='text-center'>$tabla->motivo</td>
                        <td class='text-center'>$tabla->nombreeps</td>
                        <td class='text-center'>$tabla->especialidad</td>
                        <td class='text-center'>$tabla->precio</td>
                        {$fechascompletas}
                        <td class='text-center'>
                            <a href='#' data-idprecio2='$tabla->idprecio' class='btn btn-sm btn-outline-danger eliminar'>
                                <i class='fas fa-trash-alt'></i>
                            </a>
                        </td>
                    </tr>
                ";
                $i++;
                $n++;
            }
        }
    }

    if($_GET['op'] == 'listarPreciosInactivos'){
        $datosObtenidos = $precio->listarPreciosInactivos();
        if(count($datosObtenidos)!= 0){
            $n = 1;
            foreach($datosObtenidos as $tabla){
                echo"
                    <tr>
                        <td class='text-center'>$n</td>
                        <td class='text-center'>$tabla->motivo</td>
                        <td class='text-center'>$tabla->nombreeps</td>
                        <td class='text-center'>$tabla->especialidad</td>
                        <td class='text-center'>$tabla->precio</td>
                        <td class='text-center'>$tabla->fechafin</td>
                    </tr>
                ";
                $n++;
            }
        }
    }


    if($_GET['op']== 'eliminarPrecio'){
        $precio->eliminarPrecio(["idprecio" => $_GET["idprecio"]]);
    }

    if($_GET['op']== 'restaurarPrecio'){
        $precio->restaurarPrecio(["idprecio" => $_GET["idprecio"]]);
    }

    if ($_GET['op'] == 'yaExistePrecio'){
        $datosObtenidos = $precio->yaExistePrecio(["idespecialidad"=> $_GET["idespecialidad"],"idesquema"=>$_GET["idesquema"]]);

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