<?php
    require_once 'datatable.php';
    require_once 'acceso-seguro.php';
?>

<div class="row justify-content-center">
    <div class="col-md-12">
        <div  class=" card card-outline card-info">
            <div class="card-header">
                <p class="card-title" style="font-size: 22px">Lista de Egresos</p>
            </div>
            <div class="card-body table-responsive">
                <table class="table" id="tablaEgreso">
                    <thead>
                        <tr>
                            <th class="text-center">N°</th>
                            <th class="text-center">Tipo de egreso</th>
                            <th class="text-center">Motivo</th>
                            <th class="text-center">Usuario que registró</th>
                            <th class="text-center">Usuario que aprobó</th>
                            <th class="text-center">Fecha de egreso</th> 
                            <th class="text-center">Registrar detalle</th> 
                        </tr>
                    </thead>
                    <tbody class="table" id="datosEgreso">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title">Detalle de Egreso</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Formulario registro detegreso -->
                        <div class="col-md-6">
                            <fieldset class="border p-2">
                                <legend  class="w-auto" style="font-size:12px"> Registro de compras </legend>
                                <form action="" id="formularioDetegreso" class="p-4">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="producto">Producto</label>
                                                <input type="text" class="form-control form-control-border" id="producto">
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-6">
                                                <label for="cantidad">Cantidad</label>
                                                <input type="text" class="form-control form-control-border" id="cantidad">
                                            </div> 
                                            <div class="col-md-6">
                                                <label for="precio">Precio</label>
                                                <input type="text" class="form-control form-control-border" id="precio">
                                            </div> 
                                        </div>
                                </form>
                                <div class="card-footer text-right bg-white">
                                    <button type="button" class="btn bg-gradient-secondary" id="cancelarDetEgreso">Cancelar</button>
                                    <button type="button" class="btn bg-gradient-info" id="registrarDetEgreso">Guardar</button>
                                </div>
                            </fieldset>
                        </div>
                        <!-- Fin formulario registro detegreso -->

                        <!-- Tabla de registro detegreso -->
                        <div class="col-md-6">
                            <fieldset class="border p-2">
                                <div id="total" class="text-right">
                                </div>
                                <legend  class="w-auto" style="font-size:12px"> Lista de compras </legend>
                                <div style="width: 100%; overflow: auto; height: 238px;">
                                    <table class="table table-sm table-hover text-center" id="tabladetegreso">
                                        <thead style="position: sticky; top: 0; left: 0;">
                                            <tr style="background-color: #0056B4; color: white;">
                                                <th>Producto</th>
                                                <th>Cantidad</th>
                                                <th>Precio</th>
                                                <?php
                                                    if($_SESSION['nombrerol'] == 'Admisión General' || $_SESSION['nombrerol'] == 'Gerencia'){
                                                        echo "<th>Operación</th>";
                                                    }
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody id="listadetegreso">

                                        </tbody>
                                        <tfoot id="suma">

                                        </tfoot>
                                    </table>
                                </div>
                            </fieldset>
                        </div>
                        <!-- Fin tabla de registro detegreso -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/detegresos.js"></script>
<script src="js/egresos.js"></script>