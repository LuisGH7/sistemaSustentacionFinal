<?php
session_start();
require_once '../models/Egreso.php';

if (isset($_GET['op'])){
    
  $egreso = new Egreso();

    if ($_GET['op'] == 'listarEgreso') {
        $datosObtenidos = $egreso->listarEgreso();

        
        if(count($datosObtenidos) == 0){
            echo "";
        }
        else{
            $i = 1;
            foreach($datosObtenidos as $fila){
                echo "
                    <tr>
                        <td class='text-center'>$i</td>
                        <td class='text-center'>{$fila->tipoegreso}</td>
                        <td class='text-center'>{$fila->motivo}</td>
                        <td class='text-center'>{$fila->usuarioregistro}</td>
                        <td class='text-center'>{$fila->usuarioautoriza}</td>
                        <td class='text-center'>{$fila->fechaegreso}</td>
                        <td class='text-center'>
                            <a href='#' id='idegreso' data-idegreso='{$fila->idegreso}'  class='btn btn-sm btn-warning getIDEgreso' style='color:#ffffff' data-toggle='modal' data-target='#modelId'>
                            <i class='fas fa-file-invoice'></i>
                        </td>
                    </tr>
                    ";
                    $i++;
                        
            }
        }
    }

    if($_GET['op'] == 'registrarEgreso'){
        $egreso->registrarEgreso([
            'idtipoegreso'      => $_GET['idtipoegreso'],
            'ruc'               => $_GET['ruc'],
            'nombreempresa'     => $_GET['nombreempresa'],
            'motivo'            => $_GET['motivo'],
            'tipocomprobante'   => $_GET['tipocomprobante'],
            'seriecomprobante'  => $_GET['seriecomprobante'],
            'numcomprobante'    => $_GET['numcomprobante'],
            'idusuarioregistro' => $_SESSION['idusuario'],
            'idusuarioautoriza' => $_GET['idusuarioautoriza'],
            'fechaegreso'       => $_GET['fechaegreso']
        ]);
    }

    if($_GET['op'] == 'consultaRUC'){
        $token = 'apis-token-2947.deXbJQdXSqW84R7Yzu115SChksjWeeoI';
        $ruc = $_GET['nroruc'];

        // Iniciar llamada a API
        $curl = curl_init();

        // Buscar ruc sunat
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.apis.net.pe/v1/ruc?numero=' . $ruc,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Referer: http://apis.net.pe/api-ruc',
            'Authorization: Bearer ' . $token
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
}
?>