<?php
    require_once 'datatable.php';
    require_once 'acceso-seguro.php';
?>

<style>
    .asignar{
        display: none;
    }
</style>
<br>
<div class="row justify-content-center">
    <div class="col-md-11">
        <div class=" card card-outline card-info">
            <div class="card-header">
                <p class="card-title" style="font-size: 22px" id="titulo">Registrar Persona</p>
                <a href="main.php?view=personaslistar">
                    <button style="background-color: white; font-size: 18px" type="button" class="btn btn-lg float-right"><i class="fas fa-folder-open"></i> &nbsp;Lista de Personas</button>
                </a>
            </div>
            <!-- /.card-header -->
            
            <div class="card-body">
                <form action="" id="formularioPersona">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="tipodoc">Tipo de documento</label>
                                <select id="tipodoc" class="form-control form-control-border">
                                    <option value="C">Carnet de Extrangería</option>
                                    <option value="D" selected>DNI</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="nrodocumento">N° de documento</label>
                                <div class="input-group consulta">
                                    <input type="text" class="form-control" id="nrodocumento" maxlength="8">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <label for="primerapellido">Primer Apellido</label>
                                <input id="primerapellido" class="form-control form-control-border">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="segundoapellido">Segundo Apellido</label>
                                <input id="segundoapellido" class="form-control form-control-border">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <label for="nombres">Nombres</label>
                                <input id="nombres" class="form-control form-control-border" data-idpersona="" maxlength="30">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <label for="telefono">Teléfono</label>
                                <input id="telefono" class="form-control form-control-border" placeholder="Opcional" maxlength="9">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="email">Email</label>
                                <input id="email" class="form-control form-control-border" maxlength="80" placeholder="Opcional">
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-right bg-white">
                <button type="reset" class="btn bg-gradient-secondary " id="cancelarPersona">Cancelar</button>
                <button type="button" class="btn bg-gradient-info" id="registrar">Guardar</button>
            </div>
            <!-- /.card-footer -->
        </div>
    </div>
</div>

<script src="js/personas.js"></script>