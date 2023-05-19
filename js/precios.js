$(document).ready(function(){
    var botonGuardar = document.querySelector("#registrar");

    $('#datosPrecio').on('click',".eliminar",function(){
        let idprecio2 = $(this).attr('data-idprecio2');
        
        Swal.fire({
            icon: 'question',
            title: '¿Está seguro de eliminar?',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if(result.isConfirmed){
                var datos = {
                    'op' : 'eliminarPrecio',
                    'idprecio' : idprecio2
                };
                $.ajax({
                    url: 'controllers/Precio.controller.php',
                    type: 'GET',
                    data: datos,
                    success: function(e){
                        mostrarAlerta("success", "¡Eliminado con éxito!");
                        listarPrecios();
                    }
                });
            }
        });
        
    });

    function cancelar(){
        $("#formularioPrecios")[0].reset();
        listarEspecialidadesCargar();
        cargarMotivos();

        botonGuardar.classList.remove('estadoBoton');
        $("#Titulo").html("Registro de Precio");
        $("#idespecialidad").prop('disabled', false);
        $("#idesquema").prop('disabled', false);
        $("#cajasfechas").html("");
        validarFechas();
    }

    function listarEspecialidadesCargar(){
        $.ajax({
            url: 'controllers/Especialidad.controller.php',
            type: 'GET',
            data: 'op=listarEspecialidadesCargar',
            success: function(e){
                $("#idespecialidad").html(e);
            }
        });
    }

    function cargarMotivos(){
        $.ajax({
            url: 'controllers/Esquema.controller.php',
            type: 'GET',
            data: 'op=cargarEsquema',
            success: function(e){
                $("#idesquema").html(e);
            }
        });
    }

    function listarPrecios(){
        $.ajax({
            url: 'controllers/Precio.controller.php',
            type: 'GET',
            data: 'op=listarPrecios',
            success: function(e){
                var tabla = $("#tablaPrecio").DataTable();
                tabla.destroy();
                $("#datosPrecio").html(e);
                $("#tablaPrecio").DataTable({
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

    function listarPreciosInactivos(){
        $.ajax({
            url: 'controllers/Precio.controller.php',
            type: 'GET',
            data: 'op=listarPreciosInactivos',
            success: function(e){
                var tabla = $("#tablaPrecioInactivo").DataTable();
                tabla.destroy();
                $("#datosPrecioInactivos").html(e);
                $("#tablaPrecioInactivo").DataTable({
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

    function registrarPrecio(){
        let idespecialidad = $("#idespecialidad").val();
        let idesquema = $("#idesquema").val();
        let descripcion = $("#descripcion").val();
        let precio = $("#precio").val();
        let fechainicio = $("#fechainicio").val();
        let fechafin = $("#fechafin").val();

        if (idespecialidad == "" || idesquema == "" || descripcion == "" || precio == ""){
            mostrarAlerta("warning", "¡Completar los campos necesarios!");
        }else{
            Swal.fire({
                icon: 'question',
                title: '¿Está seguro de registrar?',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if(result.isConfirmed){
                var datos = {
                    'op'                : 'registrarPrecio',
                    'idespecialidad'    : idespecialidad,
                    'idesquema'         : idesquema,
                    'descripcion'       : descripcion,
                    'precio'            : precio,
                    'fechainicio'       : fechainicio,
                    'fechafin'          : fechafin
                    };
                $.ajax({
                    url: 'controllers/Precio.controller.php',
                    type:'GET',
                    data: datos,
                    success:function(e){
                        mostrarAlerta("success", "¡Registrado con éxito!");
                        $("#formularioPrecios")[0].reset();
                        listarPrecios();
                    }
                });
                }
            });
        }
    }

    function validarFechas(){
        $("#idesquema").change(function(){
            let motivo = $("#idesquema option:selected").text();
            if(motivo != "campaña"){
                $("#cajasfechas").html(
                    "<div class='col-md-6 mt-3 mb-3'><label for='fechainicio'>Fecha Inicio</label><fieldset disabled='disabled'><input type='date'id='fechainicio' class='form-control form-control-border'></fieldset></div><div class='col-md-6 mt-3 mb-3'><label for='fechafin'>Fecha Fin</label><fieldset disabled='disabled'><input type='date' id='fechafin' class='form-control form-control-border'></fieldset></div>"

                );
            }else{
                $("#cajasfechas").html(
                    "<div class='col-md-6 mt-3 mb-3'><label for='fechainicio'>Fecha Inicio</label><input type='date'id='fechainicio' class='form-control form-control-border'></div><div class='col-md-6 mt-3 mb-3'><label for='fechafin'>Fecha Fin</label><input type='date'id='fechafin' class='form-control form-control-border'></div>"
                );
            }
        });
    }

    function PrecioExiste(){
        let idespecialidad = $("#idespecialidad").val();
        let idesquema = $("#idesquema").val();

        var datos = {
            'op'                : 'yaExistePrecio',
            'idespecialidad'    : idespecialidad,
            'idesquema'         : idesquema
            };
        $.ajax({
            url: 'controllers/Precio.controller.php',
            type:'GET',
            data: datos,
            success:function(e){
                if(e == 1){
                    mostrarAlerta("error", "¡Ya existe este registro!");
                }
                else if(e == 2){
                    registrarPrecio();
                }else{
                    mostrarAlerta("error", "¡A ocurrido un error!");
                }
            }
        });
    }

    $("#registrar").click(PrecioExiste);
    $("#cancelar").click(cancelar);
    listarEspecialidadesCargar();
    cargarMotivos();
    listarPrecios();
    validarFechas();
    listarPreciosInactivos();

});