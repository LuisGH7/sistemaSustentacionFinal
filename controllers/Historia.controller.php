<?php
session_start();
require_once '../models/HistoriaClinica.php';
require_once '../models/Serverside.php';

if (isset($_GET['op'])){

    $idusuario = $_SESSION['idusuario'];
    $historia = new HistoriaClinica();
    
    if ($_GET['op'] == 'registrarHistoriaClinica'){
        $historia->registrarHistoriaClinica([
            "idpaciente"      => $_GET["idpaciente"],
            "idusuario"     => $idusuario
        ]);
    }

    if($_GET['op'] == 'listarHistorias'){
        $datosObtenidos = $historia->listarHistorias();

        if(count($datosObtenidos) != 0){
            $i = 1;
            foreach($datosObtenidos as $tabla){
                echo "
                    <tr>
                        <td class='text-center'> $i </td>
                        <td class='text-center'> $tabla->apellidos</td>
                        <td class='text-center'> $tabla->nombres</td>
                        <td class='text-center'> $tabla->nrohistoria</td>
                        <td class='text-center'> $tabla->fechacreacion</td>
                        <td class='text-center'>
                            <a href='#' data-idhistoria='$tabla->idhistoria' class='btn btn-sm btn-outline-secondary modificar'>
                            <i class='fas fa-file-pdf'></i></a>
                        </td>
                    </tr>
                ";
                $i++;
            }
        }
    }

    if($_GET['op'] == 'buscarHistoria'){
        $serverSide->get('vista_buscar_historia', 'idhistoria', array('idhistoria', 'apellidos', 'nombres', 'nrohistoria', 'fechacreacion', 'idpaciente'));
    }

    if($_GET['op'] == 'historiaYaExiste'){
        $datosObtenidos = $historia->historiaYaExiste(["tipodoc"=> $_GET["tipodoc"],"nrodocumento"=> $_GET['nrodocumento']]);

        if(count($datosObtenidos) == 0){
            echo 1;
            return false;
        }
        else{
            echo 2;
            return true;
        }
    }

}
?>