<div class="row justify-content-center">
    <div class="col-md-11">
    <div class="card card-outline card-info">
        <div class="card-header">
            <p class="card-title mt-2" style="font-size: 22px">Revisión Médica</p>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="" id="formularioHistoria">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="paciente">Paciente</label>
                            <input type="text" class="form-control form-control-border" id="pacienterev" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="tipodiagnostico">Tipo diagnóstico</label>
                            <select name="" id="tipodiagnostico" class="form-control form-control-border">
                                <option value="">Seleccione</option>
                                <option value="Provicional" >Provicional</option>
                                <option value="Definitivo">Definitivo</option>
                                <option value="Riesgo">Riesgo</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="derivacionlaboratorio">Derivación laboratorio</label>
                            <select name="" id="derivacionlaboratorio" class="form-control form-control-border">
                                <option value="">Seleccione</option>
                                <option value="S">Sí</option>
                                <option value="N">No</option>
                            </select>
                        </div>
                        <div class=" mt-3 col-md-12 form-group">
                            <label for="">Exámen clínico</label>
                            <textarea name="" id="examenclinico" class="form-control form-control-border"></textarea>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="diagnostico">Diagnóstico</label>
                            <textarea name="" id="diagnostico" cols="20" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="">Tratamiento</label>
                            <textarea name="" id="tratamiento" cols="20" rows="3" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
        <div class="card-footer text-right bg-white">
            <button type="button" class="btn bg-gradient-secondary " id="cancelar">Cancelar</button>
            <button type="button" class="btn bg-gradient-info" id="guardar">Guardar</button>
        </div>
        <!-- /.card-footer -->
    </div>
    <br>
    </div>
</div>

<script src="js/revisionmedica.js"></script>