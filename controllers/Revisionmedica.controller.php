<?php

require_once '../models/Revisionmedica.php';

if (isset($_GET['op'])){

  $revisionmedica = new Revisionmedica();

  $operacion = $_GET['op'];

  if($operacion == 'registrarRevisionMedica'){
        $revisionmedica->registrarRevisionMedica([
            'iddetatencion' => $_GET['iddetatencion'],
            'examenclinico' => $_GET['examenclinico'],
            'diagnostico' => $_GET['diagnostico'],
            'tratamiento' => $_GET['tratamiento'],
            'tipodiagnostico' => $_GET['tipodiagnostico'],
            'derivacionlaboratorio' => $_GET['derivacionlaboratorio']
        ]);
  }

  if($operacion == 'buscarRevisionesMedicas'){
    $clave = $revisionmedica->buscarRevisionesMedicas(['tipodoc' => $_GET['tipodoc'], 'nrodocumento' => $_GET['nrodocumento']]);
    echo json_encode($clave);
  }

  if($operacion == 'listRevisionmedica'){
    $clave = $revisionmedica->buscarRevisionesMedicas(['tipodoc' => $_GET['tipodoc'], 'nrodocumento' => $_GET['nrodocumento']]);
    
    foreach($clave as $valor){
        echo "
            <tr>
                <td class='text-center'>{$valor->especialidad}</td>
                <td class='text-center'>2022/04/12</td>
                <td class='text-center'>{$valor->codservicio}</td>
                <td class='text-center'>
                    <a href='#' class='btn btn-sm btn-outline-warning reporte' data-revision='{$valor->idrevision}' >
                    VER
                    </a>
                </td>
            </tr>
        ";
    }
  }

  if($operacion == 'reporteCompleto'){
    $clave = $revisionmedica->reporteCompleto(['idrevision' => $_GET['idrevision']]);

    echo json_encode($clave);
  }

  if($operacion == 'revmedicalisto'){
    $revisionmedica->revmedicalisto(['iddetatencion' => $_GET['iddetatencion']]);
  }

}
?>