<?php
require_once '../models/Persona.php';
require_once '../models/Paciente.php';
require_once '../models/HistoriaClinica.php';
require_once '../models/Serverside.php';
require_once '../controllers/Usuario.controller.php';

if (isset($_GET['op'])){

    $persona = new Persona();
    $paciente = new Paciente();
    $historia = new HistoriaClinica();


    if ($_GET['op'] == 'cargarPersona') {
        $datosObtenidos = $persona->listarPersonaSinLogear();

        if(count($datosObtenidos) == 0){
            echo "<option>No encontramos registros disponibles</option>";
        }
        else{
            echo "<option value=''>Seleccione</option>";
            foreach($datosObtenidos as $fila){
                echo "
                    <option value='$fila->idpersona'>$fila->primerapellido $fila->segundoapellido, $fila->nombres</option>
                ";
                       
            }
        }
    }
    
    if ($_GET['op'] == 'ListarPersona'){
        $serverSide->get('vista_listar_personas', 'idpersona', array('idpersona', 'apellidos', 'nombres', 'tipodoc', 'nrodocumento', 'telefono', 'idpaciente'));
    }
    
    if ($_GET['op'] == 'registrarPersona'){
        $persona->registrarPersona([
          "primerapellido"      => $_GET["primerapellido"],
          "segundoapellido"     => $_GET["segundoapellido"],
          "nombres"             => $_GET["nombres"],
          "tipodoc"             => $_GET["tipodoc"],
          "nrodocumento"        => $_GET["nrodocumento"],
          "telefono"            => $_GET["telefono"],
          "email"               => $_GET["email"]
        ]);
    }

    // Agregado por Anderson

    if ($_GET['op'] == 'registrarPersonaPaciente'){

        // Registramos a la persona y obtenemos el idretorno
        $retorno = $persona->registrarPersonaPaciente([
          "primerapellido"      => $_GET["primerapellido"],
          "segundoapellido"     => $_GET["segundoapellido"],
          "nombres"             => $_GET["nombres"],
          "tipodoc"             => $_GET["tipodoc"],
          "nrodocumento"        => $_GET["nrodocumento"],
          "telefono"            => $_GET["telefono"],
          "email"               => $_GET["email"]
        ]);

        if(count($retorno) > 0){
            foreach($retorno as $data){
                // Registramos al paciente y obtenemos el idretorno
                $var = $paciente->registrarPaciente([
                    "idpersona"          => $data->idretorno,
                    "ubigeo"             => $_GET["ubigeo"],
                    "direccion"          => $_GET["direccion"],
                    "fechanacimiento"    => $_GET["fechanacimiento"],
                    "sexo"               => $_GET["sexo"],
                    "estadocivil"        => $_GET["estadocivil"],
                    "esalergico"         => $_GET["esalergico"],
                    "alergias"           => $_GET["alergias"]
                ]);
            }
        }

        if(count($var) > 0){
            foreach($var as $datos){
                $historia->registrarHistoriaClinica([
                    "idpaciente"      => $datos->idretorno,
                    "idusuario"     => $_SESSION["idusuario"]
                ]);
            };
        }
    }

    // Fin

    if($_GET['op']== 'buscarPersona'){

        $valor = $persona->buscarPersona([
            'tipodoc' => $_GET['tipodoc'],
            'nrodocumento' => $_GET['nrodocumento'],

        ]);
        if($valor){
            echo json_encode($valor);
        }
    }


    if ($_GET['op'] == 'buscarPersonaHC') {
        $datosObtenidos = $persona->buscarPersonaHC(["tipodoc" => $_GET['tipodoc'], "nrodocumento" => $_GET['nrodocumento']]);
        echo json_encode($datosObtenidos[0]);
    }

    if ($_GET['op'] == 'personaYaRegistrado'){
        $datosObtenidos = $persona->personaYaRegistrado([
            "tipodoc"           => $_GET['tipodoc'],
            "nrodocumento"      => $_GET['nrodocumento']
        ]);

        if(count($datosObtenidos) == 0){
            echo 2;
            return true;
        }
        else{
            echo 1;
            return false;
        }
    }

    if ($_GET['op'] == 'modificarPersona'){
        $persona->modificarPersona([
            "idpersona"       => $_GET["idpersona"],
            "telefono"   => $_GET["telefono"],
            "email"     => $_GET["email"]
        ]);
    }
    
    if ($_GET['op'] == 'getPersona'){
        $tabla = $persona->getPersona(["idpersona" => $_GET['idpersona']]);
        if (count($tabla) > 0){
            echo json_encode($tabla);
        }
    }

    if($_GET['op'] == 'consultaDNI'){
        // Datos
        $token = 'apis-token-2947.deXbJQdXSqW84R7Yzu115SChksjWeeoI';
        $dni = $_GET['nrodocumento'];
  
        // Iniciar llamada a API
        $curl = curl_init();
  
        // Buscar dni
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.apis.net.pe/v1/dni?numero=' . $dni,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 2,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Referer: https://apis.net.pe/consulta-dni-api',
                'Authorization: Bearer ' . $token
            ),
        ));
  
        $response = curl_exec($curl);
        curl_close($curl);
  
        // Datos listos para usar
        echo $response;
    }

    if($_GET['op'] == 'validarCorreoContraseña'){
        $clave = $persona->validarCorreoContraseña(["email" => $_GET["email"]]);
    
        echo json_encode($clave);
    }

    if ($_GET['op'] == 'emailNoRegistrado'){
        $datosObtenidos = $persona->emailNoRegistrado([
            "email"           => $_GET['email']
        ]);

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