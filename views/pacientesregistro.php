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
    <div class="col-md-12">
        <div class=" card card-outline card-info" style="margin:0px">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <p class="card-title" style="font-size: 22px" id="titulo">Registrar Paciente</p>
                    </div>
                    <div class="col-md-6">
                        <a href="main.php?view=pacientesbuscar" >
                            <button type="button" class="btn botones-card float-right"><i class="fas fa-search"></i> &nbsp;Buscar</button>
                        </a>
                    </div>
                </div>
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
                            <div class="col-md-4 mt-3">
                                <label for="primerapellido">Primer Apellido</label>
                                <input id="primerapellido" class="form-control form-control-border">
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="segundoapellido">Segundo Apellido</label>
                                <input id="segundoapellido" placeholder="Opcional" class="form-control form-control-border">
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="nombres">Nombres</label>
                                <input id="nombres" class="form-control form-control-border" data-idpersona="" maxlength="30">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <label for="telefonoper">Teléfono</label>
                                <input id="telefonoper" class="form-control form-control-border" placeholder="Opcional" maxlength="9">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="emailper">Email</label>
                                <input id="emailper" class="form-control form-control-border" maxlength="80" placeholder="Opcional">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mt-3">
                                <label for="fechanacimientoper">Fecha de Nacimiento</label>
                                <input id="fechanacimientoper" class="form-control form-control-border" type="date"  max="<?php echo date('Y-m-d')?>">
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="sexoper">Sexo</label>
                                <select id="sexoper" class="form-control form-control-border">
                                    <option value="">Seleccione</option>
                                    <option value="F">Femenino</option>
                                    <option value="M">Masculino</option>
                                </select>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="estadocivilper">Estado Civil</label>
                                <select id="estadocivilper" class="form-control form-control-border">
                                    <option value="">Seleccione</option>
                                    <option value="S" selected>Soltero</option>
                                    <option value="C">Casado</option>
                                    <option value="V">Viudo</option>
                                    <option value="D">Divorciado</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mt-3">
                                <label for="ubigeo"><b>Escriba el ubigeo:</b>  <span id="total-items"></span> </label>
                                <input type="search" class="form-control form-control-border mb-2" id="ubigeo" autofocus="true">
                            </div>
                            <div class="col-md-4 mt-3">
                                <label>Ubigeo encontrado: </label>
                                <input disabled id="codigo-ubigeo" class="form-control-border form-control">
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="direccionper">Dirección</label>
                                <input id="direccionper" class="form-control form-control-border">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <label for="esalergico">¿Es alérgico a algo?</label>
                                <select id="esalergico" class="form-control form-control-border">
                                    <option value="Sí">Sí</option>
                                    <option value="No" selected>No</option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-3" id="alergias">

                            </div>
                        </div>
                        
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-right bg-white">
                <button type="reset" class="btn bg-gradient-secondary " id="cancelarPersona">Cancelar</button>
                <button type="button" class="btn bg-gradient-info" id="registrarPerPac">Guardar</button>
            </div>
            <!-- /.card-footer -->
        </div>
    </div>
</div>

<script src="js/personas.js"></script>
<script src="js/pacientes.js"></script>