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
                        <p class="card-title mt-2" style="font-size: 22px">Lista de Especialidades</p>
                    </div>
                    <div class="col-md-6">
                        <a href="main.php?view=especialidadesprocesos#step-2">
                            <button style="background-color: white; font-size: 18px" type="button" class="btn botones-card float-right"><i class="fas fa-arrow-circle-left"></i> &nbsp;Volver</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table" id="tablaEspecialidades">
                    <thead>
                        <tr>
                            <th class="text-center">N°</th>
                            <th class="text-center">Área</th>
                            <th class="text-center">Especialidad</th>
                            <th class="text-center">Operación</th>
                        </tr>
                    </thead>
                    <tbody  id="datosEspecialidades">
                        <!-- Se carga de manera dinamica -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="js/especialidades.js"></script>