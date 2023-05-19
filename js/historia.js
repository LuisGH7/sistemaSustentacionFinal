$(document).ready(function(){

    $("#reiniciar").click(function(){
        $("#busquedaHistoria")[0].reset();
        var tabla = $("#tablaHistoria").DataTable();
        tabla.destroy();
        $("#datosHistoria").html("");
    });

    function buscarPersonaHC(){
        var tabla = $("#tablaHistoria").DataTable();
        tabla.destroy();

        tabla = $("#tablaHistoria").DataTable({
            "processing" : true,
            "order"      : [[0, "desc"]],
            "serverSide" : true,
            "sAjaxSource": 'controllers/Historia.controller.php?op=buscarHistoria',
            "pageLength" : 10,
            "language"   : { url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json' },
            "columnDefs" : [
                {
                    "data": null,
                    render: function(data,type,row){
                        return `
                            <a href='#' data-idhistoria='${data[5]}' id='paciente' class='btn btn-sm btn-warning ml-3 abrir-modal' style="color:#ffffff; text-align:center" data-toggle="modal" data-target="#modelId">
                                <i class='fas fa-plus'></i>
                            </a>
                        `;
                    },
                    "targets":5
                }
            ]
        });
    } 

    $("#tablaHistoria").on('click', '.abrir-modal', function(){
        var idpaciente = $(this).attr('data-idhistoria');
        $("#idpacienteregistrar").val(idpaciente);
    });

    $("#modelId").on('click', '.generaratencion', function(){
        var idhistoriaclinica = $("#idpacienteregistrar").val();
        var fechaatencion = $("#fechaatencioncrear").val();
        $.ajax({
            url : 'controllers/Atencion.controller.php',
            type: 'GET',
            data : {
                'op' : 'registrarAtencion',
                'fechaatencion' : fechaatencion,
                'idpaciente' : idhistoriaclinica
            },
            success: function(result){
                window.location.href = "main.php?view=atencion";
            }
        });
    });

    function listarPacientesSinHistoria(){
        $.ajax({
            url: 'controllers/Paciente.controller.php',
            type: 'GET',
            data: 'op=pacienteSinHistoria',
            success: function(e){
                var tabla = $("#tablahistoriacrear").DataTable();
                tabla.destroy();
                $("#datoshistoriacrear").html(e);
                $("#tablahistoriacrear").DataTable({
                    language: { url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json' },
                    dom: 'Bfrtip',
                    buttons: []
                });
            }
        });
    }

    $("#tablahistoriacrear").on("click", ".registrar", function (){
        let idpaciente = $(this).attr("data-idpaciente");

        Swal.fire({
            icon: 'question',
            title: '¿Está seguro de crear una historia clínica?',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Confirmar',
        }).then((result)=>{
            if(result.isConfirmed){
                var datos = {
                    'op'              : 'registrarHistoriaClinica',
                    'idpaciente'       : idpaciente
                    };
                $.ajax({
                    url: 'controllers/Historia.controller.php',
                    type:'GET',
                    data: datos,
                    success:function(e){
                        mostrarAlerta("success", "¡Registrado con éxito!");
                        listarPacientesSinHistoria();
                        $("#formularioPaciente")[0].reset();
                    }
                });
            }
        });
    });

    $("#recargar").click(listarPacientesSinHistoria);
    listarPacientesSinHistoria();
    buscarPersonaHC();

});