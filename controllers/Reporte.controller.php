<?php
require_once '../models/Reporte.php';

if(isset($_GET['op'])){
    $reporte = new Reporte();

    if($_GET['op'] == 'atencionMedicosAnioBuscar'){
        $datosObtenidosNombres = $reporte->atencionMedicosAnioBuscarNombre(["fechabuscar" => $_GET["fechabuscar"]]);
        $datosObtenidosDatos = $reporte->atencionMedicosAnioBuscarDatos(["fechabuscar" => $_GET["fechabuscar"]]);
        $basemeses = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        $datosAtencion = array();
        $arrayfinal = array();

        $clavevalor;
        foreach($datosObtenidosNombres as $valor){

            $especialidad = $valor->especialidad;
            foreach($datosObtenidosDatos as $valor2){
                if($valor2->especialidad==$valor->especialidad){

                    $cantidades = $valor2->cantidadatenciones;
                    $mes = --$valor2->fechaatencion;
                    $posicion = [$mes => $cantidades];
                    if($datosAtencion){
                        $datosAtencion = array_replace($datosAtencion, $posicion);
                    }else{
                        $datosAtencion = array_replace($basemeses, $posicion);
                    }
                    $clavevalor = ["especialidad" => $especialidad, "mes" => $datosAtencion];
                }
            }

            array_push($arrayfinal, $clavevalor);
            $datosAtencion = array_replace($basemeses, $basemeses);
        }
        echo json_encode($arrayfinal);
    }

    if($_GET['op'] == 'cargarAniosEgresos'){
        $datosObtenidos = $reporte->cargarAniosEgresos(); 
        if(count($datosObtenidos) == 0){
          echo "<option>No encontramos registros disponibles</option>";
        }else{
            echo "<option value=''>Seleccione</option>";
            foreach($datosObtenidos as $valor){
                echo "
                <option value='{$valor->anios}-01-01'>{$valor->anios}</option>
                ";
            }
        }
    }

    if($_GET['op'] == 'DetEgresosAnioActual'){
        $datosObtenidosNombres = $reporte->DetEgresosAnioBuscarNombre(["fechabuscar" => $_GET["fechabuscar"]]);
        $datosObtenidosDatos = $reporte->DetEgresosAnioBuscarlDatos(["fechabuscar" => $_GET["fechabuscar"]]);//comprovar controller y terminar js
        $arrayfinal = array();
        $datosEgresos = array();
        $basemeses = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

        $clavevalor;
        foreach($datosObtenidosNombres as $valor){

            $tipoegreso = $valor->tipoegreso;
            foreach($datosObtenidosDatos as $valor2){
                if($valor2->tipoegreso==$valor->tipoegreso){

                    $cantidades = $valor2->egresototal;
                    $mes = --$valor2->fechaegreso;
                    $posicion = [$mes => $cantidades];
                    if($datosEgresos){
                        $datosEgresos = array_replace($datosEgresos, $posicion);
                    }else{
                        $datosEgresos = array_replace($basemeses, $posicion);
                    }
                    $clavevalor = ["tipoegreso" => $tipoegreso, "egresototal" => $datosEgresos];
                    
                }
            }

            array_push($arrayfinal, $clavevalor);
            $datosEgresos = array_replace($basemeses, $basemeses);
        }
        echo json_encode($arrayfinal);
    }

    if ($_GET['op'] == 'listarProductividadMedicos') {
        $datosObtenidos = $reporte->ProductividadMedicos();

        if(count($datosObtenidos) != 0){
            $i= 1;
            foreach($datosObtenidos as $fila){
                echo "
                    <tr>
                        <td class='text-center'>$i</td>
                        <td class='text-center'>$fila->doctor</td>
                        <td class='text-center'>$fila->especialidad</td>
                        <td class='text-center'>$fila->mesatencion</td>
                        <td class='text-center'>$fila->cantidadatenciones</td>
                    </tr>
                ";
                $i++;
            }
        }
    }

    if($_GET['op'] == 'cargarAnios'){
        $datosObtenidos = $reporte->cargarAnios(); 
        if(count($datosObtenidos) == 0){
          echo "<option>No encontramos registros disponibles</option>";
        }else{
            echo "<option value=''>Seleccione</option>";
            foreach($datosObtenidos as $valor){
                echo "
                <option value='{$valor->anios}-01-01'>{$valor->anios}</option>
                ";
            }
        }
    }
    

    if($_GET['op'] == 'filtrarEspecialidad'){
        $clave = $reporte->filtrarEspecialidad(['anio' => $_GET['anio']]); 
        echo "<option>Seleccione</option>";
        foreach($clave as $valor){
          echo "
            <option value='{$valor->especialidad}'>{$valor->especialidad}</option>
          ";
        }
    }
    
    if($_GET['op'] == 'listarProductividad'){
        $clave = $reporte->DetalleProductividad([
            'anio' => $_GET['anio'], 
            'especialidad' => $_GET['especialidad'] 
        ]);
        
        if(count($clave) != 0){
            $i=1;
            foreach($clave as $fila){
                echo "
                    <tr>
                        <td class='text-center'>$i</td>
                        <td class='text-center'>$fila->doctor</td>
                        <td class='text-center'>$fila->especialidad</td>
                        <td class='text-center'>$fila->mesatencion</td>
                        <td class='text-center'>$fila->cantidadatenciones</td>
                    </tr>
                ";
                $i++;
            }
        }
    }

    if($_GET['op'] == 'atencionesTablaDetalle'){
        $datosObtenidos = $reporte->atencionesTablaDetalle([
            'anio' => $_GET['anio'], 
            'especialidad' => $_GET['especialidad'] 
        ]);
        
        if(count($datosObtenidos) != 0){
            foreach($datosObtenidos as $fila){
                echo "
                    <tr>
                        <td scope='row' class='text-center'>$fila->Mes</td>
                        <td class='text-center'>$fila->cantidadatenciones</td>
                    </tr>
                ";
            }
        }
    }

    if($_GET['op'] == 'EgresosTablaDetalle'){
        $datosObtenidos = $reporte->EgresosTablaDetalle([
            'anio' => $_GET['anio'], 
            'tipoegreso' => $_GET['tipoegreso'] 
        ]);
        
        if(count($datosObtenidos) != 0){
            foreach($datosObtenidos as $fila){
                echo "
                    <tr>
                        <td scope='row' class='text-center'>$fila->Mes</td>
                        <td class='text-center'>$fila->egresototal</td>
                    </tr>
                ";
            }
        }
    }

    if($_GET['op'] == 'SelectEgresosTablaDetalle'){
        $clave = $reporte->SelectEgresosTablaDetalle(['anio' => $_GET['anio']]); 
        echo "<option>Seleccione</option>";
        foreach($clave as $valor){
          echo "
            <option value='{$valor->tipoegreso}'>{$valor->tipoegreso}</option>
          ";
        }
    }
}
?>