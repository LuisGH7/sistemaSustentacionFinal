<div class="container">
    <p class="h2 m-2" style="text-align:center">Buscar atenciones de paciente</p>
    <br>
    <form action="" id="busquedaHistoria" autocomplete="off">
        <div class="row mb-5">
            
            <div class="col-md-5">
                <label for="tipodocListar">Seleccione un tipo de documento</label>
                <select id="tipodocListar" class="form-control form-control-border" style="padding:9px;">
                    <option value="">Seleccione</option>
                    <option value="C">Carnet de extrangería</option>
                    <option value="D" selected>DNI</option>
                </select>
            </div>
            <div class="col-md-5">
                <label for="nrodocumentoListar">N° de documento</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="nrodocumentoListar" maxlength="9">
                    <div class="input-group-prepend">
                        <div class="btn bg-gradient-info" id="buscarRM"><i class="fas fa-search"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <label for="reiniciarListar">&nbsp; </label>
                <div class="btn bg-gradient-info btn-block" id="reiniciarListar">Reiniciar</div>
            </div>
        </div>
    </form>

    <div class="card" style="background-color: #e9ecef;">
        <div class="card-body">
            <form action="" id="datospacientesRM">
                <div class="row" id="card-datospaciente">
                <div class='col-md-4 form-group'>
                    <div class='row m-1'>
                        <label for=''>Código H.C:</label>
                        <div class='input-group mb-3'>
                            <input type='text' value='' id='codigohistoriaRM' class='form-control form-control-border' disabled>
                        </div>
                    </div>
                </div>
                <div class='col-md-4 form-group'>
                    <div class='row  m-1'>
                        <label for=''>Datos del paciente:</label>
                        <div class='input-group mb-3'>
                            <input type='text' value='' id="pacienteRM" class='form-control form-control-border' disabled>
                        </div>
                    </div>
                </div>
                <div class='col-md-4 form-group'>
                    <div class='row m-1'>
                        <label for=''>Edad:</label>
                        <div class='input-group mb-3'>
                            <input type='text' value='' id="edadRM" class='form-control form-control-border' disabled>
                        </div>
                    </div>
                </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <!-- DataTable -->
        <div class="col-md-12">
            <div  class=" card card-outline card-info">
                <div class="card-body table-responsive">
                    <table class="table" id="tablaRevisionMedica">
                        <thead>
                            <tr>
                                <th class="text-center">Especialidad</th>
                                <th class="text-center">Fecha</th>
                                <th class="text-center">Código servicio</th>
                                <th class="text-center">Operación</th>
                            </tr>
                        </thead>
                        <tbody class="table" id="datosRevisionMedica">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.DataTable -->
    </div>

</div>

<script src="js/revisionmedica.js"></script>