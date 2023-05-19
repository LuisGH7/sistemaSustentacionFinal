<div class="row justify-content-center mt-3">
    <div class="col-md-10">
        <div class="accordion" id="accordionExample">

            <!-- Valores normales -->
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Valores normales
                        </button>
                    </h2>
                </div>
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr class="table-active">
                                    <th>Tipo de persona</th>
                                    <th>Presión Arterial</th>
                                    <th>Pulso</th>
                                    <th>Temperatura</th>
                                    <th>Frecuencia Respiratoria</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Niño</td>
                                    <td>90/60 a 120/180</td>
                                    <td>80 a 130</td>
                                    <td>36.1 C° A 37.7 C°</td>
                                    <td>12 a 18 rpm</td>
                                </tr>
                                <tr>
                                    <td>Adulto</td>
                                    <td>90/60 a 120/180</td>
                                    <td>60 a 100</td>
                                    <td>36.1 C° A 37.2 C°</td>
                                    <td>12 a 18 rpm</td>
                                </tr>
                                <tr>
                                    <td>Adulto Mayor</td>
                                    <td>90/60 a 120/180</td>
                                    <td>60 a 100</td>
                                    <td>36.1 C° A 37.2 C°</td>
                                    <td>10 a 30 rpm</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card" style="background-color: #e9ecef;">
            <div class="card-body">
                <form action="">
                    <div class="row" id="card-datospaciente">
                    <div class='col-md-4 form-group'>
                        <div class='row m-1'>
                            <label for=''>Código H.C:</label>
                            <div class='input-group mb-3'>
                                <input type='text' value='' id='historiainfo' class='form-control form-control-border' disabled>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-4 form-group'>
                        <div class='row  m-1'>
                            <label for=''>Datos del paciente:</label>
                            <div class='input-group mb-3'>
                                <input type='text' value='' id="paciente" class='form-control form-control-border' disabled>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-4 form-group'>
                        <div class='row m-1'>
                            <label for=''>Edad:</label>
                            <div class='input-group mb-3'>
                                <input type='text' value='' id="edad" class='form-control form-control-border' disabled>
                            </div>
                        </div>
                    </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Formulario de funciones vitales -->
        <!-- bg-light -->
        <div class="card">
            <div class="card-body">
                <form action="" id="formulario-funcionesvitales" autocomplete="">
                    <div class="row m-3">
                        <div class="col-md-4 form-group">
                            <div class="row">
                                <div class="col-md-5 text-right mt-2">
                                    <label for="presionarterial">Presión Arterial:</label>
                                </div>
                                <div class="col-md-7 ">
                                    <input id="presionarterial" class="form-control form-control-border">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 form-group">
                            <div class="row">
                                <div class="col-md-5 text-right mt-2">
                                    <label for="pulso">Pulso:</label>
                                </div>
                                <div class="col-md-7">
                                    <input id="pulso" class="form-control form-control-border">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 form-group">
                            <div class="row">
                                <div class="col-md-5 text-right mt-2">
                                    <label for="temperatura">Temperatura:</label>
                                </div>
                                <div class="col-md-7">
                                    <input id="temperatura" class="form-control form-control-border">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row m-3">
                        <div class="col-md-4 form-group">
                            <div class="row">
                                <div class="col-md-5 text-right mt-2">
                                    <label for="frecuenciarespiratoria">Frecuencia respiratoria:</label>
                                </div>
                                <div class="col-md-7 ">
                                    <input id="frecuenciarespiratoria" class="form-control form-control-border">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 form-group">
                            <div class="row">
                                <div class="col-md-5 text-right mt-2">
                                    <label for="peso">Peso:</label>
                                </div>
                                <div class="col-md-7">
                                    <input id="peso" class="form-control form-control-border">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 form-group">
                            <div class="row">
                                <div class="col-md-5 text-right mt-2">
                                    <label for="talla">Talla:</label>
                                </div>
                                <div class="col-md-7">
                                    <input id="talla" class="form-control form-control-border">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 text-right">
                        <a type="button" id="finalizarTriaje" class="btn bg-gradient-info" style="color:white">Finalizar consulta</a>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</div>

<script src="js/triaje.js"></script>