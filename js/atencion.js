$(document).ready(function(){

    function listarAtencion(){
        $.ajax({
            url: 'controllers/Atencion.controller.php',
            type: 'GET',
            data: {'op' : 'listarAtencion'},
            success: function(result) {
                $("#table-triaje tbody").html(result);
            }
        });
    }

    $("#table-triaje tbody").on('click', '.prueba', function(){
        
        let idatenciontable = $(this).data('atencion');
        listarDetatencion(idatenciontable);

        $.ajax({
            url: 'controllers/Atencion.controller.php',
            type: 'GET',
            data: {'op':'getAtencion', 'idatencion': idatenciontable},
            success: function(result){
                var result = JSON.parse(result);
                
                $("#atencion").val(result[0].datospersonales);
                $("#atencion").attr("data-idatencion", result[0].idatencion);
                $("#atencion").attr("data-idpaciente", result[0].idpaciente);
                $("#codservicio").html(`DETALLE DE ATENCIÓN - Cod. servicio ( ${result[0].codservicio} )`);
                $("#codserviciotexto").val(result[0].codservicio);
                cargarEspecialidad();
            }
        });

    });

    function cargarEspecialidad(){
        $.ajax({
            url : 'controllers/Atencion.controller.php',
            type : 'GET',
            data: {'op' : 'cargarEspecialidad'},
            success: function(result){
                $("#especialidad").html(result);
            }
        });
    }

    function cargarMedico(){
        let idespecialidad = $("#especialidad").val();
        $.ajax({
            url: 'controllers/Atencion.controller.php',
            type: 'GET',
            data: {'op': 'cargarMedicos', 'idespecialidad': idespecialidad},
            success: function(result){
                $("#medico").html(result);
            }
        });
    }

    function cargarPrecio(){
        let idespecialidad = $("#especialidad").val();
        var datos={'op': 'cargarPrecios', 'idespecialidad': idespecialidad}
        ;
        $.ajax({
            url: 'controllers/Atencion.controller.php',
            type: 'GET',
            data: datos,
            success: function(result){
                $("#precio").html(result);
            }
        });
    }

    $("#especialidad").change(function(){
        cargarMedico();
        cargarPrecio();
    });

    function validarAtencionRepetida(){
        let idespecialidad = $("#especialidad").val();
        let idatencion = $("#atencion").attr("data-idatencion");
        let datos={
            'op'                :'validarAtencionRepetida',
            'idespecialidad'    : idespecialidad,
            'idatencion'        : idatencion
        }
        $.ajax({
            url : 'controllers/Detatencion.controller.php',
            type: 'GET',
            data : datos,
            success:function(result){
                if(result == 1){
                    registrarDetatencion();
                }else if(result == 2){
                    mostrarAlerta("error", "¡Esta especialidad ya fue registrada!");
                }
            }
        });
    }

    function validarAtencion(){
        let codserviciotexto = $("#codserviciotexto").val();
        let idpaciente = $("#atencion").attr("data-idpaciente");
        let datos = {
            'op'                : 'validarDetatencion',
            'codservicio'  : codserviciotexto,
            'idpaciente'        : idpaciente
        }
        $.ajax({
            url: 'controllers/Detatencion.controller.php',
            type:'GET',
            data: datos,
            success : function(result){
                if(result == 1){
                    mostrarAlerta("error", "¡No se ha registrado una atención!");
                }else if(result == 2){
                    atencionRealizada();
                }
                
            }
        });
    }

    function atencionRealizada(){
        let idatencion = $("#atencion").attr('data-idatencion');;
        $.ajax({
            url: 'controllers/Atencion.controller.php',
            type: 'GET',
            data: {'op' : 'atencionRealizada', 'idatencion' : idatencion},
            success: function(result){
                listarAtencion();
                mostrarAlerta("info", "¡Atención procesada!");
                $("#modelId").modal('hide');
            }
        });
    }
//ACA
    function registrarDetatencion(){
        let idatenciondet = $("#atencion").attr('data-idatencion');
        let idprecio = $("#precio").val();
        let idmedico = $("#medico").val();
        
        if(idatenciondet == "" || idprecio == undefined || idmedico == undefined){
            mostrarAlerta("warning", "¡Completar los campos necesarios!");
        }else{
            var datos = {
                'op'            : 'registrarDetatencion', 
                'idatencion'    : idatenciondet,
                'idprecioesp'   : idprecio,
                'idmedico'      : idmedico
            };
            $.ajax({
                url:'controllers/Detatencion.controller.php',
                type: 'GET',
                data: datos,
                success: function(result){
                    mostrarAlerta("success", "¡Registrado con éxito!");
                    listarDetatencion(idatenciondet);
                }
            });
        } 
        
    }

    $("#cerrarModalDetatencion").click(function(){
        $("#formulario-registrodetatencion")[0].reset();
        $("#precio").attr('');
        $("#precio").val('');
        $("#medico").val('');
    });

    function listarDetatencion(idvalor){
        $.ajax({
            url : 'controllers/Detatencion.controller.php',
            type: 'GET',
            data: {'op' : 'listarDetatencionPorAtencion', 'idatencion' : idvalor},
            success: function(result){
                $("#detatencion-table").html(result);
                listarAtencion();
            }
        });
    }

    $("#detatencion-table").on('click', '.eliminardetalle', function(){
        var iddetalle = $(this).data('iddetalle');
        let idatenciondetalle = $("#atencion").attr('data-idatencion');

        $.ajax({
            url: 'controllers/Detatencion.controller.php',
            type: 'GET',
            data: {'op' : 'eliminarDetatencion', 'iddetatencion' : iddetalle},
            success: function(result){
                mostrarAlerta("error", "¡Eliminado!");
                listarDetatencion(idatenciondetalle);
            }
        });
    });

    function quitarDetatencion(){
        localStorage.removeItem("iddetatencion");
    }

    function listarAtencionesPorRealizar(){
        var fechabuscar = $("#fechatriaje").val();

        $.ajax({
            url: 'controllers/Atencion.controller.php',
            type: 'GET',
            data: {'op' : 'listarAtencionesPorRealizar', 'fechabuscar' : fechabuscar},
            success: function(result) {
                $("#tableatencionrealizar tbody").html(result);
                quitarDetatencion();
            }
        });
    }

    $("#tableatencionrealizar").on('click', '.getID', function(){
        var idatencionobtener = $(this).attr('data-idatencion');

        $.ajax({
            url: 'controllers/Atencion.controller.php',
            type: 'GET',
            data: {'op' : 'atencionPorRevisar', 'idatencion' : idatencionobtener},
            success: function(result) {
                $("#atencionxrealizar tbody").html(result);
            }
        });
    });

    $("#atencionxrealizar tbody").on("click", ".getDetIdLocalRV", function(e){
        e.preventDefault();
        let idlocalgetDet = $(this).attr("data-iddetatencion");
        
        localStorage.setItem("iddetatencion", idlocalgetDet);
        window.location.href = "main.php?view=revisionmedica-registro";
    });

    $("#atencionxrealizar tbody").on("click", ".getDetIdLocalTR", function(e){
        e.preventDefault();
        let idlocalgetDet = $(this).attr("data-iddetatencion");
        
        localStorage.setItem("iddetatencion", idlocalgetDet);
        window.location.href = "main.php?view=triaje-registro";
    });


    $("#filtrarfechaDetatencion").click(listarAtencionesPorRealizar);
    $("#registrarDetatencion").click(validarAtencionRepetida);//proceso
    // $("#registrarDetatencion").click(registrarDetatencion);//este
    $("#finalizaratencion").click(validarAtencion);
    listarAtencionesPorRealizar();
    listarAtencion();
    
});