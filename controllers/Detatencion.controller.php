<?php
session_start();

require_once '../models/Detatencion.php';

if (isset($_GET['op'])){

  $detatencion = new Detatencion();

  $operacion = $_GET['op'];

    if($operacion == 'registrarDetatencion'){
        $detatencion->registrarDetatencion([
            'idatencion'        => $_GET['idatencion'],
            'idprecioesp'       => $_GET['idprecioesp'],
            'idmedico'          => $_GET['idmedico']
        ]);
    }

    if($operacion == 'getDetatencionPaciente'){
        $clave = $detatencion->getDetatencionPaciente(['iddetatencion' => $_GET['iddetatencion']]);
        echo json_encode($clave);
    }  

    if($operacion == 'listarDetatencionPorAtencion'){
        $clave = $detatencion->listarDetatencionPorAtencion(['idatencion' => $_GET['idatencion']]);
        $total = $detatencion->totalpagardetacion(['idatencion' => $_GET['idatencion']]);

        $rowtotal = 0;
        
        foreach($total as $valor){
            $rowtotal = $valor->total;
        }

        foreach($clave as $valor){
            $botoneliminar = "<a href='#' class='btn btn-sm bg-red eliminardetalle' data-iddetalle='{$valor->iddetatencion}' >BORRAR</a>";
            echo "
                <tr>
                    <td>{$valor->especialidad}</td>
                    <td>{$valor->idmedico}</td>
                    <td>S/ {$valor->precio}</td>
                    <td>{$botoneliminar}</td>
                </tr>
            ";
        }

        // Total
        echo "
                <tr>
                    <td></td>
                    <td></td>
                    <td> <b> Total : S/ {$rowtotal} </b> </td>
                    <td></td>
                </tr>
            ";
    }

    if($operacion == 'eliminarDetatencion'){
        $detatencion->eliminarDetatencion(['iddetatencion' => $_GET['iddetatencion']]);
    }

    if($operacion == 'validarDetatencion'){
        $datosObtenidos  = $detatencion->validarDetatencion([
            'idpaciente'        => $_GET['idpaciente'],
            'codservicio'       => $_GET['codservicio']
        ]);
        
        if(count($datosObtenidos) == 0){
            echo 1;
        }else{
            echo 2;
        }
    }

    if($operacion == 'validarAtencionRepetida'){
        $datosObtenidos = $detatencion->validarAtencionRepetida([
            'idespecialidad'    =>  $_GET['idespecialidad'],
            'idatencion'        =>  $_GET['idatencion']
        ]);

        if(count($datosObtenidos) == 0){
            echo 1;
        }else{
            echo 2;
        }
    }
}
?>