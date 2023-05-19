<?php
    require_once 'datatable.php';
    require_once 'acceso-seguro.php';
?>
<br>
<style>
.asignar {
    display: none;
}
</style>
<div class="row">
    <div class="col-md-12">
        <div class=" card card-outline card-info">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <p class="card-title mt-2" style="font-size: 22px">Lista de personas</p>
                    </div>
                    <div class="col-md-6">
                        <a href="javascript: history.go(-1)">
                            <button style="background-color: white; font-size: 18px" type="button"
                                class="btn btn-lg float-right botones-card"><i class="fas fa-arrow-circle-left"></i> &nbsp;Volver</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table" id="tablaPersonaListar">
                    <thead>
                        <tr>
                            <th class="text-center">N°</th>
                            <th class="text-center">Apellidos</th>
                            <th class="text-center">Nombres</th>
                            <th class="text-center">Tipo de doc.</th>
                            <th class="text-center">N° de documento</th>
                            <th class="text-center">Teléfono</th>
                            <th class="text-center">Operaciones</th>
                        </tr>
                    </thead>
                    <tbody class="table text-center" id="datosPersonaListar">
                        <!-- Se carga de manera dinamica -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal modificar datos de personas -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #0056B4;color: #ffff;">
                <h5 class="modal-title">Modificar Datos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #ffff;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <form action="" id="modificar-persona">
                        <label for="nombresmodal">Datos de la personas</label>
                        <input type="text" disabled="disabled" id="nombresmodal" class="form-control">
                        <label for="telefonomodal" class="mt-3">Teléfono</label>
                        <input id="telefonomodal" maxlength="9" class="form-control">
                        <label for="emailmodal" class="mt-3">Correo electrónico</label>
                        <input type="text" class="form-control" id="emailmodal">
                    </form>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn bg-gradient-info" id="modificardatos">Modificar</button>
            </div>
        </div>
    </div>
</div>
<br>

<!-- Crear como paciente -->

<!-- Button trigger modal -->
<div class="modal fade" id="modalcrearpaciente" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #0056B4;color: #ffff;">
                <h5 class="modal-title">CREAR PACIENTE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="formularioPaciente">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <input id="modalidpaciente" disabled="true" style="display:none;" class="form-control form-control-border">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="nombrecompletopersona">Persona</label>
                                <input id="nombrecompletopersona" data-modalidpaciente="" disabled="true" class="form-control form-control-border">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="fechanacimiento">Fecha de Nacimiento</label>
                                <input id="fechanacimiento" class="form-control form-control-border" type="date"
                                    max="<?php echo date('Y-m-d')?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <label for="sexo">Sexo</label>
                                <select id="sexo" class="form-control form-control-border">
                                    <option value="">Seleccione</option>
                                    <option value="F">Femenino</option>
                                    <option value="M">Masculino</option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="estadocivil">Estado Civil</label>
                                <select id="estadocivil" class="form-control form-control-border">
                                    <option value="">Seleccione</option>
                                    <option value="S" selected>Soltero</option>
                                    <option value="C">Casado</option>
                                    <option value="V">Viudo</option>
                                    <option value="D">Divorciado</option>
                                </select>
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
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <label for="ubigeo"><b>Escriba el ubigeo:</b> <span id="total-items"></span> </label>
                                <input type="search" class="form-control form-control-border mb-2" id="ubigeo"
                                    autofocus="true">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <label>Ubigeo encontrado: </label>
                                <input disabled id="codigo-ubigeo" class="form-control-border form-control">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="direccion">Dirección</label>
                                <input id="direccion" class="form-control form-control-border">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrarModal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnGuardarPacienteModal">Guardar</button>
            </div>
        </div>
    </div>
</div>


<script src="js/personas.js"></script>
<script src="js/pacientes.js"></script>