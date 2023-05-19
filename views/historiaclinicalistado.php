<?php
    require_once 'datatable.php';
    require_once 'acceso-seguro.php';
?>

<div class="container">
    <p class="h2 m-2" style="text-align:center">Buscar historia clínica</p>
    <div class="row">
        <!-- DataTable -->
        <div class="col-md-12">
            <div  class=" card card-outline card-info">
                <div class="card-header">
                    <p class="card-title" style="font-size: 22px">Historia Clínica</p>
                </div>
                <div class="card-body table-responsive">
                    <table class="table" id="tablaHistoria">
                        <thead>
                            <tr>
                                <!-- por eliminar -->
                                <th class="text-center">N°</th>
                                <th class="text-center">Apellidos</th>
                                <th class="text-center">Nombres</th>
                                <th class="text-center">N° Historia Clínica</th>
                                <th class="text-center">Fecha de Registro</th>
                                <th class="text-center">Operaciones</th>
                            </tr>
                        </thead>
                        <tbody class="table" id="datosHistoria">
                            <!-- Se carga de manera dinamica -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.DataTable -->
    </div>
</div>

<script src="js/historia.js"></script>