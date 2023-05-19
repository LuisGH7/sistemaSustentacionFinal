<?php

    require_once '../models/Ubigeo.php';

    if(isset($_GET['operacion'])){
        $ubigeo = new Ubigeo();

        $operacion = $_GET['operacion'];

        if($operacion == 'getUbigeo'){

            $valor = $ubigeo->getUbigeo(['valorBuscado' => $_GET['valorBuscado']]);
            echo json_encode($valor);
        }
    }

?>



