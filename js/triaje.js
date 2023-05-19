$(document).ready(function(){
    var iddetlocalget = localStorage.getItem('iddetatencion');

    function getPaciente(){
        $.ajax({
            url: 'controllers/Detatencion.controller.php',
            type: 'GET',
            data: {
                'op': 'getDetatencionPaciente',
                'iddetatencion' : iddetlocalget
            },
            success: function(result){
                var resultado = JSON.parse(result);

                if(resultado != ""){
                    $("#historiainfo").val(resultado[0].nrohistoria);
                    $("#historiainfo").attr("data-iddetatencion", resultado[0].iddetlocalget);
                    $("#paciente").val(resultado[0].datospersonales);
                    $("#edad").val(resultado[0].edad);
                }
                
            }
        });
    }

    function registroTriaje(){
        let presionarterial = $("#presionarterial").val();
        let pulso = $("#pulso").val();
        let temperatura = $("#temperatura").val();
        let frecuenciarespiratoria = $("#frecuenciarespiratoria").val();
        let talla = $("#talla").val();
        let peso = $("#peso").val();

        if (iddetlocalget == "" || presionarterial == "" || pulso == "" || temperatura == "" || frecuenciarespiratoria == "" || talla == "" || peso == ""){
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
                        'op'                      : 'registroTriaje',
                        'iddetatencion'           : iddetlocalget,
                        'presionarterial'         : presionarterial,
                        'pulso'                   : pulso, 
                        'temperatura'             : temperatura,
                        'frecuenciarespiratoria'  : frecuenciarespiratoria,
                        'talla'                   : talla,
                        'peso'                    : peso
                    };
                    $.ajax({
                        url: 'controllers/Triaje.controller.php',
                        type: 'GET',
                        data: datos,
                        success: function(e){
                            triajelisto();
                            window.location.href = "main.php?view=atencionxrealizar";
                            quitarDetatencion();
                        }
                    });
                }
            });
        }
    }

    function triajelisto(){
        $.ajax({
            url: 'controllers/Triaje.controller.php',
            type: 'GET',
            data: 'op=triajelisto&iddetatencion=' + iddetlocalget,
            success: function(result){
                mostrarAlerta("success", "¡Triaje completo!");
            }
        });
    }

    function quitarDetatencion(){
        localStorage.removeItem("iddetatencion");
    }

    function listDetatencion(){
        $.ajax({
            url : 'controllers/Detatencion.controller.php',
            type: 'GET',
            data: 'op=listDetatencion',
            success: function(result){
                $("#lista-triaje").html(result);
            }
        });
    }

    function buscarDetatencionFecha(){
        var fechaatencion = $("#fechatriaje").val();
        $.ajax({
            url : 'controllers/Detatencion.controller.php',
            type: 'GET',
            data: {'op' : 'buscarDetatencionFecha', 'fechaatencion' : fechaatencion},
            success: function(result){
                $("#lista-triaje").html(result);
            }
        });
    }

    listDetatencion();
    getPaciente();
    $("#filtrarfechaDetatencion").click(buscarDetatencionFecha);
    $("#finalizarTriaje").click(registroTriaje);
});