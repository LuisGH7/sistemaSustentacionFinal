<?php
    require_once 'datatable.php';
    require_once 'acceso-seguro.php';
?>

<div class="row justify-content-center">
    <!-- DataTable -->
    <div class="col-md-12">
        <div  class=" card card-outline card-info">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <p class="card-title" style="font-size: 22px">Lista de Precios Inactivos</p>
                    </div>
                    <div class="col-md-6">
                        <a href="main.php?view=precioslista">
                            <button style="background-color: white; font-size: 18px" type="button" class="btn botones-card float-right"><i class="fas fa-arrow-circle-left"></i> &nbsp;Volver</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table" id="tablaPrecioInactivo">
                    <thead>
                        <tr>
                            <th class="text-center">N°</th>
                            <th class="text-center">Motivo</th>
                            <th class="text-center">Nombre de eps</th>
                            <th class="text-center">Especialidad</th>
                            <th class="text-center">Precio</th>
                            <th class="text-center">Fecha</th>
                        </tr>
                    </thead>
                    <tbody class="table" id="datosPrecioInactivos">
                        <!-- Se carga de manera dinamica -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.DataTable -->
</div>

<script src="js/precios.js"></script>