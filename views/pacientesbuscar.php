<?php
    require_once 'datatable.php';
    require_once 'acceso-seguro.php';
?>

<div class="container">
<p class="h2 m-2" style="text-align:center">Buscar paciente por número de documento</p>
<br>
    <form action="" id="busquedaPaciente" autocomplete="off">
        <div class="row mb-5">
            <div class="col-md-5">
                <label for="tipodocBuscar">Seleccione un tipo de documento</label>
                <select id="tipodocBuscar" class="form-control form-control-border" style="padding: 9px;">
                    <option value="">Seleccione</option>
                    <option value="C">Carnet de extrangería</option>
                    <option value="D" selected>DNI</option>
                </select>
            </div>
            <div class="col-md-5">
                <label for="nrodocumentoBuscar">N° de documento</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="nrodocumentoBuscar" maxlength="9">
                    <div class="input-group-append">
                        <div class="btn bg-gradient-info" id="buscarPaciente"><i class="fas fa-search"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <label for="reiniciarBuscar">&nbsp; </label>
                <div class="btn bg-gradient-info btn-block" id="reiniciarBuscar">Reiniciar</div>
            </div>
            
        </div>
    </form>
    <div class="row">
        <div class="col-md-12">
            <div  class=" card card-outline card-info">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="card-title mt-2" style="font-size: 22px">Paciente</p>
                        </div>
                        <div class="col-md-6">
                            <a href="javascript: history.go(-1)">
                                <button style="background-color: white;" type="button" class="btn botones-card float-right"><i class="fas fa-arrow-circle-left"></i> &nbsp;Volver</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table" id="filtropacienteBuscar">
                        <thead>
                            <tr>
                                <th class="text-center">N°</th>
                                <th class="text-center">Apellidos</th>
                                <th class="text-center">Nombres</th>
                                <th class="text-center">Fecha de registro</th>
                                <th class="text-center">Operaciones</th>
                            </tr>
                        </thead>
                        <tbody class="table" id="datosfiltropacienteBuscar">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #0056B4;color: #ffff;">
                <h5 class="modal-title">Actualizar datos del paciente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #ffff;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="formulariomodificarpaciente">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="estadocivilmodpac">Estado Civil:</label>
                            <select name="" id="estadocivilmodpac" class="form-control">
                                <option value="S">Soltero</option>
                                <option value="C">Casado</option>
                                <option value="V">Viudo</option>
                                <option value="D">Divorciado</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 for-group">
                            
                            <label for="esalergico">¿Es alérgico?</label>
                            <select name="" id="esalergico" class="form-control">
                                <option value="Sí">Sí</option>
                                <option value="No" selected>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div id="alergias" class="col-md-12 form-group"></div>

                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="ubigeomodpac">Ubigeo Actual:</label>
                            <input type="text" id="ubigeomodpac" class="form-control" disabled>
                        </div>
                        <div class="col-md-8 form-group">
                            <label for="direccionmodpac">Dirección Actual:</label>
                            <input type="text" id="direccionmodpac" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 mt-3">
                            <label for="ubigeo"><b>Escriba el nuevo ubigeo(Opcional):</b>  <span id="total-items"></span> </label>
                            <input type="search" class="form-control form-control-border mb-2" id="ubigeo" autofocus="true">
                        </div>
                        <div class="col-md-4 mt-3"> 
                            <label>Ubigeo encontrado: </label>
                            <input disabled id="codigo-ubigeo" class="form-control-border form-control">
                        </div>
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="modificarPaciente" style="background-color: #0056B4;color: #ffff;">Actualizar</button>
            </div>
        </div>
    </div>
</div>

<script src="js/pacientes.js"></script>