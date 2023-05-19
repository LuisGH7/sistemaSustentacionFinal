<?php
    require_once 'datatable.php';
    require_once 'acceso-seguro.php';
?>

<div class="row justify-content-center">
    <div class="col-md-12">
        <div  class=" card card-outline card-info">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <p class="card-title" style="font-size: 22px">Lista de Áreas</p>
                    </div>
                    <div class="col-md-6">
                        <a href="main.php?view=especialidadesprocesos#step-1">
                            <button style="background-color: white; font-size: 18px" type="button" class="btn botones-card float-right"><i class="fas fa-arrow-circle-left"></i> &nbsp;Volver</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table" id="tablaAreaActiva">
                    <thead>
                        <tr>
                            <th class="text-center">N°</th>
                            <th class="text-center">Área</th>
                            <th class="text-center">Estado</th>
                        </tr>
                    </thead>
                    <tbody class="table" id="datosAreaActiva">
                        <!-- Se carga de manera dinamica -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script src="js/area.js"></script>