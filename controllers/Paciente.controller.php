<?php

require_once '../models/Paciente.php';
require_once '../models/HistoriaClinica.php';
require_once '../controllers/Usuario.controller.php';


if (isset($_GET['op'])){

    $paciente = new Paciente();
    $historia = new HistoriaClinica();

    if ($_GET['op'] == 'pacienteYaRegistrado'){
        $datosObtenidos = $paciente->pacienteYaRegistrado(["idpersona" => $_GET['idpersona']]);

        if(count($datosObtenidos) == 0){
            echo 2;
            return true;
        }
        else{
            echo 1;
            return false;
        }
    }

    if ($_GET['op'] == 'registrarPaciente'){
        $var = $paciente->registrarPaciente([
            "idpersona"          => $_GET["idpersona"],
            "ubigeo"             => $_GET["ubigeo"],
            "direccion"          => $_GET["direccion"],
            "fechanacimiento"    => $_GET["fechanacimiento"],
            "sexo"               => $_GET["sexo"],
            "estadocivil"        => $_GET["estadocivil"],
            "esalergico"         => $_GET["esalergico"],
            "alergias"           => $_GET["alergias"]
        ]);

        if(count($var) > 0){
            foreach($var as $datos){
                $historia->registrarHistoriaClinica([
                    "idpaciente"      => $datos->idretorno,
                    "idusuario"     => $_SESSION["idusuario"]
                ]);
            };
        }
    }

    if($_GET['op'] == 'listarPacientes250'){
      $datosObtenidos = $paciente->listarPacientes250();

      if(count($datosObtenidos) != 0){
            $i = 1;
            foreach($datosObtenidos as $tabla){
                echo "
                    <tr>
                        <td class='text-center'> $i </td>
                        <td class='text-center'> $tabla->apellidos</td>
                        <td class='text-center'> $tabla->nombres</td>
                        <td class='text-center'> $tabla->fecharegistro</td>
                        <td class='text-center'>
                            <a href='#' data-idpaciente='$tabla->idpaciente' class='btn btn-sm btn-outline-secondary modificar mr-1'>
                            <i class='fas fa-edit'></i></a>
                        </td>
                    </tr>
                ";
                $i++;
            }
        }
    } 

    if ($_GET['op'] == 'FiltrarPaciente') {

        $datosObtenidos = $paciente->FiltrarPaciente([
            "tipodoc"       => $_GET['tipodoc'],
            "nrodocumento"  => $_GET['nrodocumento']
        ]);

        if(count($datosObtenidos) != 0){
            $i = 1;
            foreach($datosObtenidos as $tabla){
                echo "
                    <tr>
                        <td class='text-center'> $i </td>
                        <td class='text-center'> $tabla->apellidos</td>
                        <td class='text-center'> $tabla->nombres</td>
                        <td class='text-center'> $tabla->fecharegistro</td>
                        <td class='text-center'>
                            <a href='#' data-idpaciente='$tabla->idpaciente' style='color:#ffffff;' class='btn btn-sm btn-warning modificar eliminar mr-1' data-toggle='modal' data-target='#modelId'>
                            <i class='fas fa-edit'></i></a>
                        </td>
                    </tr>
                ";
                $i++;
            }
        }
    }

    if($_GET['op']== 'pacienteSinHistoria'){
        $datosObtenidos = $paciente->pacienteSinHistoria();
        if(count($datosObtenidos)!= 0){
            $i = 1;
            foreach($datosObtenidos as $fila){
                echo "
                    <tr>
                        <td class='text-center'>$i</td>
                        <td class='text-center'>$fila->apellidos</td>
                        <td class='text-center'>$fila->nombres</td>
                        <td class='text-center'>$fila->fecharegistro</td>
                        <td class='text-center'>
                            <a href='#' data-idpaciente='$fila->idpaciente' class='btn btn-sm btn-outline-secondary registrar'>
                                <i class='fas fa-plus'></i>
                            </a>
                        </td>
                    </tr>
                ";
                $i++;
            }
        }
    }

    if ($_GET['op'] == 'modificarPaciente'){
        $paciente->modificarPaciente([
            "idpaciente"    => $_GET["idpaciente"],
            "estadocivil"   => $_GET["estadocivil"],
            "esalergico"   => $_GET["esalergico"],
            "alergias"   => $_GET["alergias"],
            "ubigeo"   => $_GET["ubigeo"],
            "direccion"   => $_GET["direccion"]
        ]);
    }

    if ($_GET['op'] == 'getPaciente'){
        $tabla = $paciente->getPaciente(["idpaciente" => $_GET['idpaciente']]);
        if (count($tabla) > 0){
            echo json_encode($tabla);
        }
    }

}
?>