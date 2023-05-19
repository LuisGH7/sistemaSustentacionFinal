<?php
session_start();

require_once '../models/Usuario.php';

if (isset($_GET['op'])){

  $usuario = new Usuario();

  if ($_GET['op'] == 'login'){

    //Array asociativo
    $datos = ["nombreusuario" => $_GET['nombreusuario']];
    $resultado = $usuario->login($datos);
    
    if ($resultado){
      //Acceso al sistema
      //var_dump($resultado);

      $registro = $resultado[0];
      //var_dump($registro);

      //Sabemos que el usuario existe, entonces verificamos que su clave es CORRECTA
      $claveValidar = $_GET['clave'];

      //Validando la contraseña
      if (password_verify($claveValidar, $registro['clave'])){

        $_SESSION['acceso'] = true;

        //La clave es correcta...
        $_SESSION['idusuario'] = $registro['idusuario'];
        $_SESSION['apellidos'] = $registro['primerapellido'] . " " . $registro['segundoapellido'];
        $_SESSION['nombres'] = $registro['nombres'];
        $_SESSION['nombreusuario'] = $registro['nombreusuario'];
        $_SESSION['clave'] = $registro['clave'];
        $_SESSION['nombrerol'] = $registro['nombrerol'];

        if($_SESSION['nombrerol'] == 'Gerencia'){
          echo "1";
        }else if($_SESSION['nombrerol'] == 'Admisión' || $_SESSION['nombrerol'] == 'Admisión General' ){
          echo "2";
        }else if($_SESSION['nombrerol'] == 'Administrador'){
          echo "3";
        }else{
          echo "4";
        }
        
      }else{

        $_SESSION['acceso'] = false;
        $_SESSION['idusuario'] = '';
        $_SESSION['apellidos'] = '';
        $_SESSION['nombres'] = '';
        $_SESSION['nombreusuario'] = '';
        $_SESSION['clave'] = '';
        $_SESSION['nombrerol'] = '';

        // echo "La clave es incorrecta";
        echo "10";

      }

    }else{
      
      //No se puede acceder, usuario NO existe
      $_SESSION['acceso'] = false;
      $_SESSION['idusuario'] = '';
      $_SESSION['apellidos'] = '';
      $_SESSION['nombres'] = '';
      $_SESSION['nombreusuario'] = '';
      $_SESSION['clave'] = '';
      $_SESSION['nombrerol'] = '';

      echo"9";
      // echo "El usuario no existe";
    }
  }

  if ($_GET['op'] == 'cerrar-sesion'){
    session_destroy();
    session_unset();
    header('Location:../');
  }

  if ($_GET['op'] == 'registrarUsuario'){
    $usuario->registrarUsuario([
      "idpersona"       => $_GET["idpersona"],
      "nombreusuario"          => $_GET["nombreusuario"],
      "idespecialidad"   => $_GET["idespecialidad"],
      "codigoespecialista"     => $_GET["codigoespecialista"]
    ]);
  }

  if($_GET['op']  == 'listarUsuariosActivos'){
    $clave = $usuario->listarUsuariosActivos();

    if(count($clave) == 0){
      echo "
        <tr>
          <td>No se encontraron datos</td>
        </tr>
      ";
    }else{
      $i = 1;
      foreach($clave as $valor){
        $estado="";
        if($valor->estado=="A"){
          $estado="<label class='switch'><input id='on'data-idusuario2='$valor->idusuario' type='checkbox' checked><div class='slider round'></label>";
        }else{
          $estado="<label class='switch'><input id='on'data-idusuario2='$valor->idusuario' type='checkbox'><div class='slider round'></label>";
        }
        echo "
          <tr>
            <td class='text-center'>$i</td>
            <td class='text-center'>$valor->apellidos</td>
            <td class='text-center'>$valor->nombres</td>
            <td class='text-center'>$valor->nombreusuario</td>
            <td class='text-center'>$valor->nombrerol</td>
            <td class='text-center'>
              <a href='#' style='color:#ffffff' class='btn btn-sm btn-warning modificar mr-2 'data-idusuariomod='{$valor->idusuario}' data-toggle='modal' data-target='#modelId'>
              <i class='fas fa-edit'></i></a>
              {$estado}
            </td>
          </tr>
        ";
        $i++;
      }
    }
  }

  if ($_GET['op'] == 'actualizarClave'){

    $claveActual = $_GET['claveActual'];
    $claveNueva = $_GET['claveNueva'];

    if(password_verify($claveActual, $_SESSION['clave'])){
      $datos = [
        "idusuario" => $_SESSION['idusuario'],
        "clave"     => password_hash($claveNueva, PASSWORD_BCRYPT)
      ];

      $usuario->actualizarClave($datos);

      echo "OK";
    }else{
      echo "La clave actual no es correcta";
    }
  }

  if($_GET['op'] == 'eliminarUsuario'){
    $usuario->eliminarUsuario(["idusuario" => $_GET['idusuario']]);
  }

  if($_GET['op'] == 'reactivarUsuario'){
    $usuario->reactivarUsuario([
      "idusuario" => $_GET['idusuario']
    ]);
  }

  if($_GET['op'] == 'modificarUsuario'){
    $usuario->modificarUsuario([
      "idusuario" => $_GET['idusuario'],
      "nombreusuario" => $_GET['nombreusuario'],
      "idespecialidad" => $_GET['idespecialidad']
    ]);
  }

  if($_GET['op'] == 'getUsuario'){
    $data = $usuario->getUsuario(["idusuario" => $_GET['idusuario']]);

    echo json_encode($data);
  }

  if ($_GET['op'] == 'cargarUsuario') {
    $datosObtenidos = $usuario->listarUsuariosActivos();

    if(count($datosObtenidos) == 0){
        echo "<option >No encontramos registros disponibles</option>";
    }
    else{
        echo "<option value=''>Seleccione</option>";
        foreach($datosObtenidos as $fila){
            echo "
                <option value='$fila->idusuario'>$fila->apellidos , $fila->nombres</option>
                ";
                    
        }
    }
  }

  if ($_GET['op'] == 'nombreusuarioYaRegistrado'){
    $datosObtenidos = $usuario->nombreusuarioYaRegistrado(["nombreusuario" => $_GET['nombreusuario']]);

    if(count($datosObtenidos) == 0){
      echo 2;
      return true;
    }
    else{
      echo 1;
      return false;
    }
  }
  
  if($_GET['op']=='codigoespecialistaYaRegistrado'){
    $datosObtenidos = $usuario->codigoespecialistaYaRegistrado(["codigoespecialista" => $_GET['codigoespecialista']]);
    if(count($datosObtenidos) == 0){
      echo 2;
      return true;
    }else{
      echo 1;
      return false;
    }
  }
  
  if($_GET['op'] == 'codverificacion'){
    $usuario->codverificacion([
      "idusuario" => $_GET['idusuario'], 
      "codverificacion" => $_GET['codverificacion']
    ]);
  }

  if($_GET['op'] == 'eliminarCodverificacion'){
    $usuario->eliminarCodverificacion(["idusuario" => $_GET['idusuario']]);
  }

  if ($_GET['op'] == 'recuperarClave'){

      $clavenueva = $_GET['clave'];

      $datos = [
        "idusuario" => $_GET['idusuario'],
        "clave"     => password_hash($clavenueva, PASSWORD_BCRYPT)
      ];

      $usuario->actualizarClave($datos);
  }



}
?>