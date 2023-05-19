<?php
    require_once 'datatable.php';
    require_once 'acceso-seguro.php';
?>

<div class="row">

    <!-- DataTable -->
    <div class="col-md-12">
        <div  class=" card card-outline card-info">
            <div class="card-header">
                <p class="card-title" style="font-size: 22px">Crear Hístoria Clínica</p>
                <div class ="float-right">
                    <button type="button" class="btn bg-gradient-secondary" id="recargar">Recargar</button>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table" id="tablahistoriacrear">
                    <thead>
                        <tr>
                            <th class="text-center">N°</th>
                            <th class="text-center">Apellidos</th>
                            <th class="text-center">Nombres</th>
                            <th class="text-center">Fecha de Registro</th>
                            <th class="text-center">Operaciones</th>
                        </tr>
                    </thead>
                    <tbody class="table" id="datoshistoriacrear">
                        <!-- Se carga de manera dinamica -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.DataTable -->
</div>
<br>

<script src="js/historia.js"></script>