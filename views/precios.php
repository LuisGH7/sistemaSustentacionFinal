<?php
    require_once 'datatable.php';
    require_once 'acceso-seguro.php';
?>

<style>
    .estadoBoton{
        display: none;
    }
</style>

<div class="row justify-content-center">
    <div class="col-md-10">
        <div class=" card card-outline card-info">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <p class="card-title mt-1" style="font-size: 22px" id="Titulo">Registro de Precios</p>
                    </div>
                    <div class="col-md-6">
                        <a href="main.php?view=precioslista">
                            <button style="background-color: white; font-size: 18px" type="button" class="btn botones-card float-right"><i class="fas fa-folder-open"></i> &nbsp;Lista de Precios</button>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="" id="formularioPrecios">
                    <div class="form-group">
                        <div class="row">
                            <div id="selectespecialidad" class="col-md-6">
                                <label for="idespecialidad">Especialidad</label>
                                <select id="idespecialidad" class="form-control form-control-border">
                                </select>
                            </div>
                            <div id="selectesquema" class="col-md-6">
                                <label for="idesquema">Motivo</label>
                                <select id="idesquema" class="form-control form-control-border">
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-3 mb-3">
                                <label for="descripcion">Descripción</label>
                                <input id="descripcion"  class="form-control form-control-border" data-idprecio="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-3 mb-3">
                                <label for="precio">Precio</label>
                                <input id="precio" class="form-control form-control-border">
                            </div>
                        </div>
                        <div class="row" id="cajasfechas">
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-right bg-white">
                <button type="reset" class="btn bg-gradient-secondary " id="cancelar">Cancelar</button>
                <button type="button" class="btn bg-gradient-info" id="registrar">Guardar</button>
                <!-- <button type="button" class="btn bg-gradient-info estadoBoton" id="actualizarP">Actualizar</button> -->
            </div>
            <!-- /.card-footer -->
        </div>
    </div>
</div>

<script src="js/precios.js"></script>