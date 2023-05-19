<?php
session_start();

require_once '../models/Atencion.php';

if (isset($_GET['op'])){

  $atencion = new Atencion();

  $operacion = $_GET['op'];

  if($operacion == 'registrarAtencion'){
    $atencion->registrarAtencion([
        'idpaciente' => $_GET['idpaciente'],
        'idusuarioregistro' => $_SESSION['idusuario'],
        'fechaatencion' => $_GET['fechaatencion']
    ]);
  }

  if($operacion == 'listarAtencion'){
    $clave = $atencion->listarAtencion();
    if(count($clave) == 0){
      echo "<tr><td colspan='7' class='text-center'>No encontramos registros disponibles</td></tr>";
    }else{
      foreach($clave as $valor){
        echo "
          <tr>
            <td>{$valor->datospersonales}</td>
            <td>{$valor->codservicio}</td>
            <td>{$valor->edad}</td>
            <td>{$valor->fecharegistro}</td>
            <td>
              <a id='prueba' data-atencion='{$valor->idatencion}' class='btn btn-sm  bg-lightblue prueba' data-toggle='modal' data-target='#modelId'>
                <i class='fas fa-plus'></i>
              </a>
            </td>
          </tr>
        ";
      }
    }
  }

  // Agregado por Anderson
  if($operacion == 'listarAtencionesPorRealizar'){
    $clave = $atencion->listarAtencionesPorRealizar(['fechabuscar' => $_GET['fechabuscar']]);
    if(count($clave) == 0){
      echo "<tr><td colspan='7' class='text-center'>No encontramos registros disponibles</td></tr>";
    }else{
      foreach($clave as $valor){
        $codservicioNC = $valor->codservicio;
        $filtrar = $atencion->listarAtencionesBoton(['codservicio' => $codservicioNC ,'fechabuscar' => $_GET['fechabuscar']]);
        if(count($filtrar) > 1){
          echo "
            <tr>
              <td>{$valor->datospersonales}</td>
              <td>{$valor->codservicio}</td>
              <td>{$valor->edad}</td>
              <td>{$valor->fecharegistro}</td>
              <td>
                <a id='' class='btn btn-sm getID' data-idatencion='{$valor->idatencion}' style='background-color:#F6C500; color:#ffffff' data-toggle='modal' data-target='#modelId' > VER </a>
              </td>
            </tr>
          ";
        }else{
          foreach($filtrar as $data){
            if($data->triajelisto == "S" && $data->revmedicalisto == "S"){
              echo "
                <tr>
                  <td>{$valor->datospersonales}</td>
                  <td>{$valor->codservicio}</td>
                  <td>{$valor->edad}</td>
                  <td>{$valor->fecharegistro}</td>
                  <td>
                    <a id='' class='btn btn-sm getID' data-idatencion='{$valor->idatencion}' style='background-color:#C1C1C1; color:#ffffff' data-toggle='modal' data-target='#modelId' > LISTO </a>
                  </td>
                </tr>
              ";
            }else{
              echo "
              <tr>
                <td>{$valor->datospersonales}</td>
                <td>{$valor->codservicio}</td>
                <td>{$valor->edad}</td>
                <td>{$valor->fecharegistro}</td>
                <td>
                  <a id='' class='btn btn-sm getID' data-idatencion='{$valor->idatencion}' style='background-color:#F6C500; color:#ffffff' data-toggle='modal' data-target='#modelId' > VER </a>
                </td>
              </tr>
            ";
            }

          }
        }
      }
    }
  }

  if($operacion == 'atencionPorRevisar'){
    $clave = $atencion->atencionPorRevisar(['idatencion' => $_GET['idatencion']]);
      
      if(count($clave) == 0){
        echo "<tr><td colspan='7' class='text-center'>No encontramos registros disponibles</td></tr>";
      }else{
        $i = 1;
        foreach($clave as $valor){
          $triajelisto = "";
          $revmedicalisto = "";
    
          if($_SESSION['nombrerol'] == 'Triaje' || $_SESSION['nombrerol'] == 'Gerencia'){
              if($valor->triajelisto == "Por iniciar"){
                  $triajelisto = "<a id='' href='#' class='btn btn-sm getDetIdLocalTR' data-iddetatencion='{$valor->iddetatencion}' style='background-color:#0056B4; color:#ffffff' data-toggle='modal' data-target='#modelId'>TRIAJE</a>";
              }else{
                  $triajelisto = "<b><i class='fas fa-check'></i></b>";
              }
          }
          
          if($_SESSION['nombrerol'] == 'Medicina' || $_SESSION['nombrerol'] == 'Gerencia'){
              if($valor->revmedicalisto == "Por iniciar"){
                  $revmedicalisto = "<a id='' href='#' class='btn btn-sm getDetIdLocalRV' data-iddetatencion='{$valor->iddetatencion}' style='background-color:#F6C500; color:#ffffff' data-toggle='modal' data-target='#modelId'>REVISION</a>";
              }else{
                  $revmedicalisto = "<b><i class='fas fa-check'></i></b>";
              }
          }
        
          echo "
            <tr>
              <td>{$i}</td>
              <td>{$valor->especialidad}</td>
              <td>
                {$triajelisto}
                {$revmedicalisto}
              </td>
            </tr>
          ";
          $i++;
        }
      }
  }

  if($operacion == 'getAtencion'){
    $clave = $atencion->getAtencion(['idatencion' => $_GET['idatencion']]); 

    echo json_encode($clave);
  }

  if($operacion == 'cargarEspecialidad'){
    $clave = $atencion->cargarEspecialidad(); 

    if(count($clave) == 0){
      echo "<option>No encontramos registros disponibles</option>";
    }else{
      echo "<option value=''>Seleccione</option>";
      foreach($clave as $valor){
        echo "
          <option value='{$valor->idespecialidad}'>{$valor->especialidad}</option>
        ";
      }
    }
  }

  if($operacion == 'cargarMedicos'){
    $clave = $atencion->cargarMedicos(['idespecialidad' => $_GET['idespecialidad']]); 

    foreach($clave as $valor){
      echo "
        <option value='{$valor->idespecialidad}'>{$valor->datospersonales}</option>
      ";
    }
  }

  if($operacion == 'cargarPrecios'){
    $clave = $atencion->cargarPrecios(['idespecialidad' => $_GET['idespecialidad']]);

    foreach($clave as $valor){
      $nombreeps = "";
      
      if($valor->nombreeps == "No requiere EPS"){
        $nombreeps =  "";
      }else{
        $nombreeps = "- {$valor->nombreeps}"; 
      }

      echo "
        <option value='{$valor->idprecio}'>{$valor->precio} - {$valor->motivo}  {$nombreeps}</option>
      ";
    }
  }
  

  //Actualizar que la atencion ya está actualizada
  if($operacion == 'atencionRealizada'){
    $atencion->atencionRealizada(['idatencion' => $_GET['idatencion']]);
  }



}
?>