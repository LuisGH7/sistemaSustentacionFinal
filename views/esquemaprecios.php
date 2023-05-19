<?php
    require_once 'datatable.php';
    require_once 'acceso-seguro.php';
?>

<div class="row justify-content-center">
    <div class="col-md-10">
        <div class=" card card-outline card-info">
            <div class="card-header">
                <div class="row float-right">
                    <a href="main.php?view=esquemaprecioslista">
                        <button style="background-color: white; font-size: 18px" type="button" class="btn botones-card float-right"><i class="fas fa-folder-open"></i> &nbsp;Lista de Esquemas</button>
                    </a>
                    <a href="main.php?view=epslista">
                        <button style="background-color: white; font-size: 18px" type="button" class="btn botones-card float-right"><i class="fas fa-folder-open"></i> &nbsp;Lista de EPS</button>
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="" id="formularioEps">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="nombreeps">Si no se encuentra EPS, registrelo aquí:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="nombreeps">
                                    <div class="input-group-append">
                                        <div class="btn bg-gradient-info" id="registrarEPS">Registrar</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <fieldset class="border p-2">
                    <legend  class="w-auto" style="font-size:16px"><b>Registro de Esquema de Precio</b></legend>
                    <form action="" id="formularioEsquema" class="p-4">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="motivo">Motivo</label>
                                    <select id="motivo" class="form-control form-control-border">
                                        <option value="">Seleccione</option>
                                        <option value="estándar">Estándar</option>
                                        <option value="campaña">Campaña</option>
                                        <option value="eps">Eps</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-3 mb-3" id="idepscargar">
                                </div>
                            </div>
                        </div>
                    </form>
                </fieldset>
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-right bg-white">
                <button type="reset" class="btn bg-gradient-secondary " id="cancelarEsquema">Cancelar</button>
                <button type="button" class="btn bg-gradient-info" id="registrarEsquema">Guardar</button>
            </div>
            <!-- /.card-footer -->
        </div>
    </div>
</div>
<script src="js/eps.js"></script>
<script src="js/esquemaprecios.js"></script>