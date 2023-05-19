<?php
    require_once 'datatable.php';
    require_once 'acceso-seguro.php';
?>

<div class="row">
    <div class="col-md-12">
        <div  class=" card card-outline card-info">
            <div class="card-header">
                <div class="row col-md-12">
                    <div class="col-md-7">
                        <p class="card-title" style="font-size: 22px">Detalle de productividad</p>
                    </div>
                    <div class="col-md-2">
                        <select name="" id="anio" class="form-control float-right">
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="" id="especialidad" class="form-control float-right">
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table" id="tablaProductividadMedicos">
                    <thead>
                        <tr>
                            <th class="text-center" style="width:10%">N°</th>
                            <th class="text-center" style="width:35%">Médico</th>
                            <th class="text-center" style="width:23%">Especialidad</th>
                            <th class="text-center" style="width:17%">Mes</th>
                            <th class="text-center" style="width:25%">Cantidad de atenciones</th>
                        </tr>
                    </thead>
                    <tbody class="table text-center"  id="datosProductividadMedicos">
                        <!-- Se carga de manera dinamica -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){

        function listarProductividad(){
            $.ajax({
                url: 'controllers/Reporte.controller.php',
                type: 'GET',
                data: 'op=listarProductividadMedicos',
                success: function(e){
                    var tabla = $("#tablaProductividadMedicos").DataTable();
                    tabla.destroy();
                    $("#datosProductividadMedicos").html(e);
                    $("#tablaProductividadMedicos").DataTable({
                        language: { url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json' },
                        columnDefs: [
                        {
                            visible: true,
                            searchable: true
                        }
                        ],
                        dom: 'Bfrtip',
                        buttons: ['copy', 'print', 'pdf', 'excel']
                    });
                }
            });
        }

        function cargarAnios(){
            $.ajax({
                url: 'controllers/Reporte.controller.php',
                type: 'GET',
                data: 'op=cargarAnios',
                success: function(e){
                    $("#anio").html(e);
                }
            });
        }

        $("#anio").change(function(){
            let anio = $("#anio").val();
            if(anio==""){
                listarProductividad();
            }else{
                var datos = {
                    'op' : 'filtrarEspecialidad',
                    'anio' : anio
                };
                $.ajax({
                    url: 'controllers/Reporte.controller.php',
                    type: 'GET',
                    data: datos,
                    success: function(e){
                        $("#especialidad").html(e);
                    }
                });
            }
        });

        $("#especialidad").change(function(){
            let anio = $("#anio").val();
            let especialidad = $("#especialidad").val();
            
            var datos = {
                'op' : 'listarProductividad',
                'anio' : anio,
                'especialidad' : especialidad
            };
            $.ajax({
                url: 'controllers/Reporte.controller.php',
                type: 'GET',
                data: datos,
                success: function(e){
                    var tabla = $("#tablaProductividadMedicos").DataTable();
                    tabla.destroy();
                    $("#datosProductividadMedicos").html(e);
                    $("#tablaProductividadMedicos").DataTable({
                        language: { url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json' },
                        columnDefs: [
                        {
                            visible: true,
                            searchable: true
                        }
                        ],
                        dom: 'Bfrtip',
                        buttons: ['copy', 'print', 'pdf', 'excel']
                    });
                }
            });
        });

        cargarAnios();
        listarProductividad();
    })
</script>