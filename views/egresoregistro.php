<?php
    require_once 'datatable.php';
    require_once 'acceso-seguro.php';
?>

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class=" card card-outline card-info">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <p class="card-title" style="font-size: 22px"></p>
                    </div>
                    <div class="col-md-6">
                        <a href="main.php?view=tipoegresolista">
                            <button style="background-color: white; font-size: 18px" type="button" class="btn botones-card float-right"><i class="fas fa-folder-open"></i> &nbsp;Tipo de egreso</button>
                        </a>
                    </div>
                </div>
            </div>            
            <div class="card-body">
                <form action="" id="formularioTipoEgreso">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="tipoegreso">Si no encuentra un tipo de egreso, registrelo aquí:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="tipoegreso" maxlength='50'>
                                    <div class="input-group-append">
                                        <div class="btn bg-gradient-info" id="registrarTipoEgreso">Registrar</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <fieldset class="border p-2">
                    <legend  class="w-auto" style="font-size:16px"><b>Registro de Egreso</b></legend>
                    <form action="" id="formularioEgreso" class="p-4">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="nroruc">Escribe tu RUC:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-border" id="nroruc" maxlength="11">
                                        <div class="input-group-append">
                                            <button class="btn bg-gradient-info" type="button" id="buscarRUC"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="nombreempresa">Empresa</label>
                                    <input type="text" disabled="true" class="form-control form-control-border" id="nombreempresa">
                                </div> 
                                <div class="col-md-6 mt-3">
                                    <label for="idtipoegreso">Tipo de egreso</label>
                                    <select name="" id="idtipoegreso" class="form-control form-control-border">
                                    <option value="">Seleccione</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="motivo">Motivo</label>
                                    <input type="text" class="form-control form-control-border" id="motivo">
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label for="tipocomprobante">Tipo de comprobante</label>
                                    <select name="" id="tipocomprobante" class="form-control form-control-border">
                                        <option value="Boleta">Boleta</option>
                                        <option value="Factura">Factura</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label for="seriecomprobante">Serie de comprobante</label>
                                    <input type="text" class="form-control form-control-border" id="seriecomprobante">
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label for="numcomprobante">Nº de comprobante</label>
                                    <input type="text" class="form-control form-control-border" id="numcomprobante">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="idusuarioautoriza">Usuario que aprueba</label>
                                    <select name="" id="idusuarioautoriza" class="form-control form-control-border">
                                        <option value="">Seleccione</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="fechaegreso">Fecha de egreso</label>
                                    <input type="date"  class="form-control form-control-border" id="fechaegreso" max="<?php echo date('Y-m-d')?>" value="<?php echo date('Y-m-d')?>">
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="card-footer text-right bg-white">
                        <button type="reset" class="btn bg-gradient-secondary " id="cancelarEgreso">Cancelar</button>
                        <button type="button" class="btn bg-gradient-info" id="registrarEgreso">Guardar</button>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</div>

<script src="js/egresos.js"></script>