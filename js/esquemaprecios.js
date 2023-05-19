$(document).ready(function(){

    $("#motivo").change(function(){
        let motivo = $("#motivo").val();

        if(motivo == "eps"){
            $("#idepscargar").html(
                "<label for='ideps'>Eps</label> <select id='ideps' class='form-control form-control-border'></select>"
            );
            cargarEps();
        }else{
            var datos = {
                'op': 'norequiereEps'
            };
            $.ajax({
                url: 'controllers/Esquema.controller.php',
                type:'GET',
                data: datos,
                success: function (e) {
                    var datosServer = JSON.parse(e);
                    $("#idepscargar").html(
                        "<label for='ideps'>Eps</label><select disabled=true id='ideps' class='form-control form-control-border'><option id='norequiere'value=''>No requiere eps</option></select>"
                    );
                    $("#norequiere").val(datosServer[0].ideps);
                }
            });
        }
    });

    function esquemaYaExiste(){
        let motivo = $("#motivo").val();
        let ideps = $("#ideps").val();

        var datos = {
            'op'       : 'historiaYaExiste',
            'motivo'   : motivo,
            'ideps'    : ideps
        };
        $.ajax({
            url: 'controllers/Esquema.controller.php',
            type:'GET',
            data: datos,
            success:function(e){
                if(e == 2){
                    mostrarAlerta("error", "¡Ya existe este registro!");     
                }
                else if(e == 1){
                    registrarEsquema();
                }else{
                    mostrarAlerta("error", "¡A ocurrido un error!");
                }
            }
        });
    }

    function registrarEsquema(){
        let motivo = $("#motivo").val();
        let ideps = $("#ideps").val();

        if(motivo == "" || ideps == ""){
            mostrarAlerta("warning", "¡Completar los campos necesarios!");
        }else{
            Swal.fire({
                icon: 'question',
                title: '¿Está seguro de registrar?',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Confirmar',
            }).then((result)=>{
                if(result.isConfirmed){
                    var datos = {
                        'op'              : 'registrarEsquema',
                        'motivo'       : motivo,
                        'ideps'       : ideps
                        };
                    $.ajax({
                        url: 'controllers/Esquema.controller.php',
                        type:'GET',
                        data: datos,
                        success:function(e){
                            mostrarAlerta("success", "¡Registrado con éxito!");
                            $("#formularioEsquema")[0].reset();
                            listarEsquema();
                        }
                    });
                }
            });
        }

    }

    function listarEsquema(){
        $.ajax({
            url: 'controllers/Esquema.controller.php',
            type: 'GET',
            data: 'op=listarEsquema',
            success: function(e){
                var tabla = $("#tablaEsquema").DataTable();
                tabla.destroy();
                $("#datosEsquema").html(e);
                $("#tablaEsquema").DataTable({
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

    function cargarEps(){
        $.ajax({
            url: 'controllers/Eps.controller.php',
            type: 'GET',
            data: 'op=cargarEpsActiva',
            success: function(e){
                $("#ideps").html(e);
            }
        });
    }

    listarEsquema();
    $("#cancelarEsquema").click(function(){
        $("#formularioEsquema")[0].reset();
    });
    $("#registrarEsquema").click(esquemaYaExiste);

});