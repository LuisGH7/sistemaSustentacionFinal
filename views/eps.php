<?php
    require_once 'datatable.php';
    require_once 'acceso-seguro.php';
?>

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class=" card card-outline card-info">
            <div class="card-header">
                <p class="card-title" style="font-size: 22px">Registro de Eps</p>
                <a href="main.php?view=epslista">
                    <button style="background-color: white; font-size: 18px" type="button" class="btn btn-lg float-right"><i class="fas fa-folder-open"></i> &nbsp;Lista de EPS</button>
                </a>
            </div>            
            <div class="card-body">
                <form action="" id="formularioEps">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="nombreeps">Coloque una nueva EPS</label>
                                <input id="nombreeps" class="form-control form-control-border"></input>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer text-right bg-white">
                <button type="reset" class="btn bg-gradient-secondary " id="cancelarEPS">Cancelar</button>
                <button type="button" class="btn bg-gradient-info" id="registrarEPS">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script src="js/eps.js"></script>