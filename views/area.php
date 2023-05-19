<?php
    require_once 'datatable.php';
    require_once 'acceso-seguro.php';
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class=" card card-outline card-info">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <p class="card-title" style="font-size: 22px">Registro de Áreas</p>
                    </div>
                    <div class="col-md-6">
                        <a href="main.php?view=arealista">
                            <button style="background-color: white;font-size: 16px" type="button" class="btn botones-card float-right"><i class="fas fa-folder-open"></i> &nbsp;Lista de Áreas</button>
                        </a>
                    </div>
                </div>
            </div>            
            <div class="card-body">
                <form action="" id="formularioAreaActiva">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="nombrerolAreaActiva">Escriba una nueva área</label>
                                <input id="nombrerolAreaActiva" class="form-control form-control-border"></input>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer text-right bg-white">
                <button type="button" class="btn bg-gradient-secondary " id="cancelarAreaActiva">Cancelar</button>
                <button type="button" class="btn bg-gradient-info" id="registrarAreaActiva">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script src="js/area.js"></script>