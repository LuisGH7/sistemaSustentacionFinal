<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <p class="card-title" style="font-size: 22px">Atenciones</p>
                    </div>
                    <div class="col-md-6">
                        <a href="javascript: history.go(-1)">
                            <button style="background-color: white;" type="button" class="btn botones-card float-right"><i class="fas fa-arrow-circle-left"></i> &nbsp;Volver</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover text-center" id="table-triaje">
                        <thead>
                            <tr style="background-color:#548cbe; color:#ffffff">
                                <th>Datos de la persona</th>
                                <th>Código del servicio</th>
                                <th>Edad</th>
                                <th>Fecha de Atención</th>
                                <th>Operación</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header"  style="background-color: #0056B4;color: #ffff;">
                <div class="text-white">
                    <h5 class="modal-title"  id="codservicio" ></h5>
                </div>
                <button type="button" style="color: #ffff;" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Registrar -->

                    <div class="col-md-5" style="border-right: 2px solid #0056B4;">
                        <div class="container mb-1">
                            <form action='off' id="formulario-registrodetatencion">
                                <div class='row'>
                                    <div class='col-md-12 form-group'>
                                        <label for='atencion'>Atención a:</label>
                                        <input type='text' class='form-control form-control-border' id="atencion"
                                            disabled>
                                        <input type="text" id="codserviciotexto" style="display:none;">
                                    </div>
                                    <div class='col-md-12 form-group'>
                                        <label for='especialidad'>Especialidad</label>
                                        <select name='' class='form-control form-control-border' id="especialidad">
                                        </select>
                                    </div>
                                    <div class='col-md-12 form-group'>
                                        <label for='precio'>Precio</label>
                                        <select name='' class='form-control form-control-border' id="precio">
                                        </select>
                                    </div>
                                    <div class='col-md-12 form-group'>
                                        <label for='medico'>Médico</label>
                                        <select class='form-control form-control-border' id="medico">
                                        </select>
                                    </div>

                                    <div class="col-md-12 form-group text-right mb-1">
                                        <button type="button" class="btn btn-primary" id="registrarDetatencion">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Listado -->
                    <div class="col-md-7">
                        <table class="table table-striped">
                            <thead class="text-center" style="background-color:#548CBE; color: #fff">
                                <tr>
                                    <th>Especialidad</th>
                                    <th>Médico</th>
                                    <th>Precio</th>
                                    <th>Operación</th>
                                </tr>
                            </thead>
                            <tbody class="text-center" id="detatencion-table">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="">Cancelar</button>
                <button type="button" class="btn btn-lg"style="background-color:#0056B4;color: #fff" id="finalizaratencion">Finalizar</button>
            </div>
        </div>
    </div>
</div>

<script src="js/atencion.js"></script>
