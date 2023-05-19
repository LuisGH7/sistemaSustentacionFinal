<?php
session_start();
require_once '../models/Detegreso.php';

if (isset($_GET['op'])){
    
  $detegreso = new Detegreso();

    if($_GET['op'] == 'listarDetEgreso'){
        $clave = $detegreso->listarDetegreso(['idegreso' => $_GET['idegreso']]);
        
        if(count($clave) == 0){
            echo "
                <tr >
                    <td colspan='4' class='text-center'>No encontramos registros disponibles</td>
                </tr>
            ";
        }
        else{
            foreach($clave as $valor){
                if($_SESSION['nombrerol'] == 'Admisión General' || $_SESSION['nombrerol'] == 'Gerencia'){
                    echo "
                    <tr>
                        <td>$valor->producto</td>
                        <td>$valor->cantidad</td>
                        <td>$valor->precio</td>
                        <td>
                            <a href='#' data-iddetegreso='$valor->iddetegreso' data-idegreso='$valor->idegreso' class='btn btn-sm btn-outline-danger eliminar'>
                                <i class='fas fa-trash-alt'></i>
                            </a>
                        </td>
                    </tr>
                ";
                }else{
                    echo "
                    <tr>
                        <td>$valor->producto</td>
                        <td>$valor->cantidad</td>
                        <td>$valor->precio</td>
                    </tr>
                ";
                }
                
            }
        }
    }

    if($_GET['op'] == 'detegresosuma'){
        $clave = $detegreso->detegresosuma(['idegreso' => $_GET['idegreso']]);
        
        if(count($clave) == 0){
            echo "
                <tr >
                    <td colspan='4' class='text-center'>No encontramos registros disponibles</td>
                </tr>
            ";
        }
        else{
            foreach($clave as $valor){
                echo "
                <input type='text' value='Total: S/.$valor->preciototal' class='mb-2 col-sm-3 text-center' style='border: solid 2px #548CBE' disabled='true' >

                ";
            }
        }
    }

    if ($_GET['op'] == 'eliminarDetegreso'){
        $detegreso->eliminarDetEgreso([
          "iddetegreso"       => $_GET["iddetegreso"]
        ]);
    }

    if($_GET['op'] == 'registrarDetegreso'){
        $detegreso->registrarDetegreso([
            'idegreso' => $_GET['idegreso'],
            'producto' => $_GET['producto'],
            'cantidad' => $_GET['cantidad'],
            'precio' => $_GET['precio']
        ]);
    }
}

?>