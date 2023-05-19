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
                        <p class="card-title" style="font-size: 22px">Lista de Eps</p>
                    </div>
                    <div class="col-md-6">
                        <a href="main.php?view=preciosprocesos#step-1">
                            <button style="background-color: white; font-size: 18px" type="button" class="btn botones-card float-right"><i class="fas fa-arrow-circle-left"></i> &nbsp;Volver</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table" id="tablaEps">
                    <thead>
                        <tr>
                            <th class="text-center">N°</th>
                            <th class="text-center">Eps</th>
                            <th class="text-center">Operación</th>
                        </tr>
                    </thead>
                    <tbody class="table" id="datosEps">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="js/eps.js"></script>