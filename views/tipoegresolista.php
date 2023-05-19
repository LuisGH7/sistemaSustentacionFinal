<?php
    require_once 'datatable.php';
    require_once 'acceso-seguro.php';
?>

<div class="row justify-content-center">
    <div class="col-md-12">
        <div  class=" card card-outline card-info">
            <div class="card-header">
                <p class="card-title" style="font-size: 22px">Lista de Tipos de Egreso</p>
                <a href="main.php?view=egresosproceso#step-1">
                    <button style="background-color: white; font-size: 18px" type="button" class="btn btn-lg float-right"><i class="fas fa-arrow-circle-left"></i> &nbsp;Volver</button>
                </a>
            </div>
            <div class="card-body table-responsive">
                <table class="table" id="tablaTipoEgresoActivo">
                    <thead>
                        <tr>
                            <th class="text-center">N°</th>
                            <th class="text-center">Tipo de Egreso</th>
                            <th class="text-center">Operación</th>
                        </tr>
                    </thead>
                    <tbody class="table" id="datosTipoEgresoActivo">
                        <!-- Se carga de manera dinamica -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="js/egresos.js"></script>