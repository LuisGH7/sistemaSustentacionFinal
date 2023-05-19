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
                        <p class="card-title" style="font-size: 22px">Registrar Especialidades</p>
                    </div>
                    <div class="col-md-6">
                        <a href="main.php?view=especialidadeslista">
                            <button style="background-color: white;font-size: 16px" type="button" class="btn botones-card float-right"><i class="fas fa-folder-open"></i> &nbsp;Lista de Especialidades</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="" id="formularioEspecialidades">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <label for="idarea">Selecciona una área</label>
                                <select id="idarea" class="form-control form-control-border">
                                </select>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-md-12 mt-3" id="cajaEspecialidad">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer text-right bg-white">
                <button type="reset" class="btn bg-gradient-secondary " id="cancelar">Cancelar</button>
                <button type="button" class="btn bg-gradient-info" id="registrar">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script src="js/especialidades.js"></script>