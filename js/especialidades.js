$(document).ready(function(){

    $("#cancelar").click(function(){
        $("#formularioEspecialidades")[0].reset();
    });

    function cargarAreas(){
        $.ajax({
            url: 'controllers/Area.controller.php',
            type: 'GET',
            data: 'op=listarArea',
            success: function(e){
                $("#idarea").html(e)
            }
        });
    }

    function GestionEspecialidad(tipo,valor,icono,mensaje,numero,estado){
        var datos = {
            'op' : tipo,
            'idespecialidad' : valor
        };
        $.ajax({
            url: 'controllers/Especialidad.controller.php',
            type: 'GET',
            data: datos,
            success: function(e){
                $(`#info${numero}`).html(estado);
                mostrarAlerta(icono,mensaje);
            }
        });
    }

    $('#datosEspecialidades').on('change',"#on",function(){
        let idespecialidad2 = $(this).attr('data-idespecialidad2');
        let numero = $(this).attr('data-numero');
        if(this.checked){
            GestionEspecialidad("reactivarEspecialidad", idespecialidad2, "success", "¡Restaurado con éxito!",numero, "Activo");
        }
        else{
            GestionEspecialidad("eliminarEspecialidad", idespecialidad2, "success", "¡Eliminado con éxito!",numero, "Inactivo");
        }
    });

    $("#idarea").change(function(){
        let nombre2 = $("#idarea").val();

        var datos = {
            'op' : 'validadArea',
            'idarea' : nombre2
        };
        $.ajax({
            url: 'controllers/Area.controller.php',
            type: 'GET',
            data: datos,
            success: function(e){
                $("#cajaEspecialidad").html(e);
            }
        });
    });

    function listarEspecialidades(){
        $.ajax({
            url: 'controllers/Especialidad.controller.php',
            type: 'GET',
            data: 'op=listarEspecialidadTabla',
            success: function(e){
                var tabla = $("#tablaEspecialidades").DataTable();
                tabla.destroy();
                $("#datosEspecialidades").html(e);
                $("#tablaEspecialidades").DataTable({
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

    function registrarEspecialidad(){
        let idarea = $("#idarea").val();
        let especialidad = $("#especialidad").val();

        if (idarea == "" || especialidad == ""){
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
                        'op'              : 'registrarEspecialidad',
                        'idarea'          : idarea,
                        'especialidad'    : especialidad
                    };
                    $.ajax({
                        url: 'controllers/Especialidad.controller.php',
                        type: 'GET',
                        data: datos,
                        success: function(e){
                            mostrarAlerta("success", "¡Registrado con éxito!");
                            $("#formularioEspecialidades")[0].reset();
                            listarEspecialidades();
                        }
                    });
                }
            });
        }
    }

    $("#datosEspecialidades").on("click",".eliminar" , function(){
        let idespecialidad = $(this).attr('data-idespecialidad');

        Swal.fire({
            icon: 'question',
            title: '¿Está seguro de eliminar?',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Confirmar',
        }).then((result)=>{
            if(result.isConfirmed){
                var datos = {
                    'op' : 'eliminarEspecialidad',
                    'idespecialidad' : idespecialidad
                };
                $.ajax({
                    url: 'controllers/Especialidad.controller.php',
                    type: 'GET',
                    data: datos,
                    success: function(e){
                        mostrarAlerta("success", "¡Eliminado con éxito!");
                        listarEspecialidades();
                    }
                });
            }
        });
    });

    function especialidadYaExiste(){
        let areaexiste = $("#idarea").val();
        let especialidadexiste = $("#especialidad").val();

        var datos = {
            'op' : 'especialidadYaRegistrado',
            'idarea' : areaexiste,
            'especialidad' : especialidadexiste,
        };
        $.ajax({
            type: "GET",
            url:  "controllers/Especialidad.controller.php",
            data: datos,
            success: function(e){
                if(e == 3){
                    mostrarAlerta("error", "¡Ya existe este registro!");
                }
                else if(e == 4){
                    registrarEspecialidad();
                }else{
                    mostrarAlerta("error", "¡A ocurrido un error!");
                }
            }
        });
    }

    $("#registrar").click(function(){

        let areaexiste = $("#idarea").val();
        let especialidadexiste = $("#especialidad").val();

        if (areaexiste == ""){
            mostrarAlerta("warning", "¡Completar los campos necesarios!");
        }else{
            var datos = {
                'op' : 'especialidadExiste',
                'idarea' : areaexiste,
            };
            $.ajax({
                type: "GET",
                url:  "controllers/Especialidad.controller.php",
                data: datos,
                success: function(e){
                    if(e == 1){
                        mostrarAlerta("error", "¡Ya existe este registro!");
                    }
                    else if(e == 2){
                        especialidadYaExiste();
                    }else{
                        mostrarAlerta("error", "¡A ocurrido un error!");
                    }
                }
            });
        }
    });

    function especialidadesInactivas(){
        $.ajax({
            url: 'controllers/Especialidad.controller.php',
            type: 'GET',
            data: 'op=listarEspecialidadTablaInactivo',
            success: function(e){
                var tabla = $("#tablaespecialidadesi").DataTable();
                tabla.destroy();
                $("#datosespecialidadesi").html(e);
                $("#tablaespecialidadesi").DataTable({
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

    $("#datosespecialidadesi").on("click",".reactivar" , function(){
        let idespecialidad = $(this).attr('data-idespecialidad');

        Swal.fire({
            icon: 'question',
            title: '¿Está seguro de restaurar?',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Confirmar',
        }).then((result)=>{
            if(result.isConfirmed){
                var datos = {
                    'op' : 'reactivarEspecialidad',
                    'idespecialidad' : idespecialidad
                };
                $.ajax({
                    url: 'controllers/Especialidad.controller.php',
                    type: 'GET',
                    data: datos,
                    success: function(e){
                        mostrarAlerta("success", "¡Reactivado con éxito!");
                        especialidadesInactivas();
                    }
                });
            }
        });
    });

    especialidadesInactivas();
    cargarAreas();
    listarEspecialidades();
});
