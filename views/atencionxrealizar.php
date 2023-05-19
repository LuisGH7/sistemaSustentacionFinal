<div class="row justify-content-center">
    <div class="col-md-12">
        <!-- buscador  -->
        <div class="row justify-content-end">
            <div class="col-md-3">
                <div class="input-group mb-3">
                    <input type="date" class="form-control text-center" id="fechatriaje"
                        value="<?php echo date("Y-m-d"); ?>" required>
                    <div class="input-group-append">
                        <button class="btn btn-info" type="button" id="filtrarfechaDetatencion"><i
                            class="fas fa-filter"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <p class="card-title" style="font-size: 22px">ATENCIONES POR REALIZAR</p>
                    </div>
                    <div class="col-md-6">
                        <a href="javascript: history.go(-1)">
                            <button style="background-color: white;" type="button" class="btn botones-card float-right"><i
                                class="fas fa-arrow-circle-left"></i> &nbsp;Volver</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover text-center" id="tableatencionrealizar">
                        <thead>
                            <tr style="background-color:#548cbe; color:#ffffff">
                                <th>Datos de la persona</th>
                                <th>Código del servicio</th>
                                <th>Edad</th>
                                <th>Fecha</th>
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
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#548cbe; color:#ffffff">
                <h5 class="modal-title">ATENDIENDO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="container">
                        <table class="table table-striped text-center" id="atencionxrealizar">
                            <thead style="background-color:#0056B4;color: #fff">
                                <td>N°</td>
                                <td>Especialidad</td>
                                <td>Operación</td>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/atencion.js"></script>