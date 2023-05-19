<?php
    require_once 'datatable.php';
    require_once 'acceso-seguro.php';
?>

    <br>
    <div class="row justify-content-center">
        <!-- DataTable -->
        <div class="col-md-12">
            <div  class=" card card-outline card-info">
                <div class="card-header">
                    <p class="card-title" style="font-size: 22px">Buscar Historias Clínicas</p>
                </div>
                <div class="card-body table-responsive">
                    <table class="table" style="width:100%" id="tablaHistoria">
                        <thead>
                            <tr>
                                <th class="text-center">N°</th>
                                <th class="text-center">Apellidos</th>
                                <th class="text-center">Nombres</th>
                                <th class="text-center">N° Historia Clínica</th>
                                <th class="text-center">Fecha de Registro</th>
                                <th class="text-center">Operaciones</th>
                            </tr>
                        </thead>
                        <tbody class="table text-center" id="datosHistoria">
                            <!-- Se carga de manera dinamica -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.DataTable -->
    </div>

    <style>
        .botones-modal{
            display: flex;
            z-index: 1;
            box-sizing: border-box;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 0;
            margin-bottom: 1em;
        }
    </style>
    
    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                    <div class="swal2-icon swal2-question" style="display: flex; margin-bottom: 0em !important;">
                        <div class="swal2-icon-content" style="font-size: 2.75em; color:#0056B4;"><i class="fas fa-calendar-alt"></i></div>
                    </div>
                    <div class="modal-body">
                    <div style="text-align:-webkit-center;" class="m-1">
                        <label for="">Fecha de atención:</label>
                        <input type="date" class="form-control text-center" style="width: 45%; height: calc(2.55rem + 2px);" id="fechaatencioncrear" value="<?php echo date("Y-m-d"); ?>" required>
                        <input type="text" id="idpacienteregistrar" style="display:none;">
                    </div>
                </div>
                <div class="botones-modal">
                    <button type="button" class="btn bg-gradient-info swal2-styled generaratencion">Aceptar</button>
                    <button type="button" class="btn btn-secondary swal2-styled"  data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

<script src="js/historia.js"></script>