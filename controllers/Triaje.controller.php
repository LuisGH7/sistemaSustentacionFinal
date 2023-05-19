<?php
session_start();

require_once '../models/Triaje.php';

if (isset($_GET['op'])){

    $triaje = new Triaje();
    $operacion = $_GET['op'];

    if($operacion == 'registroTriaje'){
        $triaje->registroTriaje([
            'iddetatencion' => $_GET['iddetatencion'],
            'idenfermera' => $_SESSION['idusuario'],
            'presionarterial' => $_GET['presionarterial'],
            'pulso' => $_GET['pulso'],
            'temperatura' => $_GET['temperatura'],
            'frecuenciarespiratoria' => $_GET['frecuenciarespiratoria'],
            'talla' => $_GET['talla'],
            'peso' => $_GET['peso'],
        ]);
    }

    if($operacion == 'triajelisto'){
        $triaje->triajelisto(['iddetatencion' => $_GET['iddetatencion']]);
    }
    
}
?>