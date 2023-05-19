function cargarTipoEgreso(){
    $.ajax({
        url: 'controllers/TipoEgreso.controller.php',
        type: 'GET',
        data: 'op=cargarTipoEgreso',
        success: function(e){
            $("#idtipoegreso").html(e)
        }
    });
}

function cargarUsuarios(){
    $.ajax({
        url: 'controllers/Usuario.controller.php',
        type: 'GET',
        data: 'op=cargarUsuario',
        success: function(e){
            $("#idusuarioautoriza").html(e)
        }
    });
}

function registrarTipoEgreso(){
    let tipoegreso = $("#tipoegreso").val();

    if (tipoegreso == ""){
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
                    'op'              : 'registrarTipoEgreso',
                    'tipoegreso'          : tipoegreso
                };
                $.ajax({
                    url: 'controllers/TipoEgreso.controller.php',
                    type: 'GET',
                    data: datos,
                    success: function(e){
                        mostrarAlerta("success", "¡Registrado con éxito!");
                        $("#formularioTipoEgreso")[0].reset();
                        cargarTipoEgreso();
                    }
                });
            }
        });
    }
}

function tipoegresoYaExiste(){
    let tipoegresoYaExiste = $("#tipoegreso").val();
    
    if(tipoegresoYaExiste == ""){
        mostrarAlerta("warning", "¡Completar los campos necesarios!");
    }else{
        var datos = {
            'op' : 'tipoegresoYaRegistrado',
            'tipoegreso' : tipoegresoYaExiste
        };
        $.ajax({
            type: "GET",
            url:  "controllers/TipoEgreso.controller.php",
            data: datos,
            success: function(e){
                if(e == 1){
                    mostrarAlerta("error", "¡Ya existe este registro!");
                }
                else if(e == 2){
                    registrarTipoEgreso();
                }else{
                    mostrarAlerta("error", "¡A ocurrido un error!");
                }
            }
        });
    }
}

function listarTipoEgresoInactivo(){
    $.ajax({
        url: 'controllers/TipoEgreso.controller.php',
        type: 'GET',
        data: 'op=listarTipoEgresoTablaInactivo',
        success: function(e){
            var tabla = $("#tablaTipoEgresoInactivo").DataTable();
            tabla.destroy();
            $("#datosTipoEgresoInactivo").html(e);
            $("#tablaTipoEgresoInactivo").DataTable({
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

function GestionTipoEgreso(tipo, valor, icono, mensaje, numero,estado){
    var datos = {
        'op' : tipo,
        'idtipoegreso' : valor
    };
    $.ajax({
        url: 'controllers/TipoEgreso.controller.php',
        type: 'GET',
        data: datos,
        success: function(e){
            $(`#info${numero}`).html(estado);
            mostrarAlerta(icono,mensaje);
        }
    });
}

$('#datosTipoEgresoActivo').on('change',"#on",function(){
    var idtipoegreso2 = $(this).attr('data-idtipoegreso2');
    let numero = $(this).attr('data-numero');
    if(this.checked){
        GestionTipoEgreso("reactivarTipoEgreso", idtipoegreso2, "success", "¡Restaurado con éxito!",numero, "Activo");
    }
    else{
        GestionTipoEgreso("eliminarTipoEgreso", idtipoegreso2, "success", "¡Eliminado con éxito!",numero, "Inactivo");
    }
});

$("#datosTipoEgresoInactivo").on("click",".reactivar" , function(){
    let idtipoegreso = $(this).attr('data-idtipoegreso');

    Swal.fire({
        icon: 'question',
        title: '¿Está seguro de reactivar?',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Confirmar',
    }).then((result)=>{
        if(result.isConfirmed){
            var datos = {
                'op' : 'reactivarTipoEgreso',
                'idtipoegreso' : idtipoegreso
            };
            $.ajax({
                url: 'controllers/TipoEgreso.controller.php',
                type: 'GET',
                data: datos,
                success: function(e){
                    mostrarAlerta("success","¡Reactivado con éxito!");
                    listarTipoEgresoInactivo();
                }
            });
        }
    });
});

function listarTipoEgresoActivo(){
    $.ajax({
        url: 'controllers/TipoEgreso.controller.php',
        type: 'GET',
        data: 'op=listarTipoEgresoTabla',
        success: function(e){
            var tabla = $("#tablaTipoEgresoActivo").DataTable();
            tabla.destroy();
            $("#datosTipoEgresoActivo").html(e);
            $("#tablaTipoEgresoActivo").DataTable({
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

$("#datosTipoEgresoActivo").on("click",".eliminar" , function(){
    let idtipoegreso = $(this).attr('data-idtipoegreso');

    Swal.fire({
        icon: 'question',
        title: '¿Está seguro de eliminar?',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Confirmar',
    }).then((result)=>{
        if(result.isConfirmed){
            var datos = {
                'op' : 'eliminarTipoEgreso',
                'idtipoegreso' : idtipoegreso
            };
            $.ajax({
                url: 'controllers/TipoEgreso.controller.php',
                type: 'GET',
                data: datos,
                success: function(e){
                    mostrarAlerta("success","¡Eliminado con éxito!");
                    listarTipoEgresoActivo();
                }
            });
        }
    });
});

function listarEgreso(){
    $.ajax({
        url: 'controllers/Egreso.controller.php',
        type: 'GET',
        data: 'op=listarEgreso',
        success: function(e){
            var tabla = $("#tablaEgreso").DataTable();
            tabla.destroy();
            $("#datosEgreso").html(e);
            $("#tablaEgreso").DataTable({
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

function registrarEgreso(){
    var idtipoegreso = $("#idtipoegreso").val();
    var ruc = $("#nroruc").val();
    var nombreempresa = $("#nombreempresa").val();
    var motivo = $("#motivo").val();
    var idtipoegreso = $("#idtipoegreso").val();
    var tipocomprobante = $("#tipocomprobante").val();
    var seriecomprobante = $("#seriecomprobante").val();
    var numcomprobante = $("#numcomprobante").val();
    var idusuarioautoriza = $("#idusuarioautoriza").val();
    var fechaegreso = $("#fechaegreso").val();

    if(idtipoegreso == "" || ruc == "" || nombreempresa == "" || motivo == "" || tipocomprobante == "" || seriecomprobante == "" || numcomprobante == "" || idusuarioautoriza == "" || fechaegreso == "" ){
        mostrarAlerta("warning", "¡Completar los campos necesarios!");
    }else{
        Swal.fire({
            icon:'question',
            title:'¿Está seguro de registrar?',
            showCancelButton: true,
            cancelButtonText:'Cancelar',
            confirmButtonText:'Aceptar'
        }).then((result) => {
            
            if(result.isConfirmed){
                var datos = {
                    'op'                : 'registrarEgreso',
                    'idtipoegreso'      : idtipoegreso,
                    'ruc'               : ruc,
                    'nombreempresa'     : nombreempresa,
                    'motivo'            : motivo,
                    'tipocomprobante'   : tipocomprobante,
                    'seriecomprobante'  : seriecomprobante,
                    'numcomprobante'    : numcomprobante,
                    'idusuarioautoriza' : idusuarioautoriza,
                    'fechaegreso'       : fechaegreso
                };
                $.ajax({
                    url : 'controllers/Egreso.controller.php',
                    type: 'GET',
                    data: datos,                        
                    success: function(result){
                        mostrarAlerta("success", "¡Registrado con éxito!");
                        $("#formularioEgreso")[0].reset();
                    }
                });
            }
        });
    }

};

function consultaRUC(){
    let ruc = $("#nroruc").val();
    if(ruc == ""){
        mostrarAlerta("warning", "¡Completar los campos necesarios!");
    }else{
        $.ajax({
            url :'controllers/Egreso.controller.php',
            type: 'GET',
            data: {'op' : 'consultaRUC', 'nroruc': ruc},
            dataType: 'JSON',
            success: function(result){
                    $("#nombreempresa").val(result.nombre);
            }
        });
    }
}

$("#cancelarEgreso").click(function(){
    $("#formularioEgreso")[0].reset();
});

$("#cancelarDetEgreso").click(function(){
    $("#formularioDetegreso")[0].reset();
});

listarEgreso();
listarTipoEgresoActivo();
listarTipoEgresoInactivo();
cargarTipoEgreso();
cargarUsuarios();
$("#registrarTipoEgreso").click(tipoegresoYaExiste);
$("#buscarRUC").click(consultaRUC);
$("#registrarEgreso").click(registrarEgreso);