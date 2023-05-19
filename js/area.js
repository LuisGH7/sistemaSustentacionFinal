$(document).ready(function(){

    function GestionArea(tipo,valor,icono,mensaje,numero,estado){
        var datos = {
            'op' : tipo,
            'idarea' : valor
        };
        $.ajax({
            url: 'controllers/Area.controller.php',
            type: 'GET',
            data: datos,
            success: function(e){
                $(`#info${numero}`).html(estado);
                mostrarAlerta(icono,mensaje);
            }
        });
    }

    $('#datosAreaActiva').on('change',"#on",function(){
        let idarea2 = $(this).attr('data-idarea2');
        let numero = $(this).attr('data-numero');
        if(this.checked){
            GestionArea("restaurarArea", idarea2, "success", "¡Restaurado con éxito!",numero, "Activo");
        }
        else{
            GestionArea("eliminarArea", idarea2, "success", "¡Eliminado con éxito!",numero, "Inactivo");
        }
    });

    function listarAreaActivos(){
        $.ajax({
            url: 'controllers/Area.controller.php',
            type: 'GET',
            data: 'op=listarAreaActiva',
            success: function(e){
                var tabla = $("#tablaAreaActiva").DataTable();
                tabla.destroy();
                $("#datosAreaActiva").html(e);
                $("#tablaAreaActiva").DataTable({
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
    
    function registrarArea() {
        let nombrerolAreaActiva = $("#nombrerolAreaActiva").val();

        if(nombrerolAreaActiva == ""){
            mostrarAlerta("warning", "¡Completar los campos necesarios!");
        }else{
            Swal.fire({
                icon:'question',
                title:'¿Está seguro de registrar?',
                showCancelButton: true,
                cancelButtonText:'Cancelar',
                confirmButtonText:'Aceptar'
            }).then((result) =>{
                if(result.isConfirmed){
                    var datos = {
                        'op'         : 'registrarArea',
                        'nombrerol'  : nombrerolAreaActiva
                    };
                    $.ajax({
                        url: 'controllers/Area.controller.php',
                        type:'GET',
                        data: datos,
                        success:function(e){
                            mostrarAlerta("success","¡Registrado con éxito!");            
                            $("#formularioAreaActiva")[0].reset();
                            listarAreaActivos();
                        }
                    });
                }
            });
        }
    }

    function areaYaExiste(){
        let areaYaExiste = $("#nombrerolAreaActiva").val();
        
        if(areaYaExiste == ""){
            mostrarAlerta("warning", "¡Completar los campos necesarios!");
        }else{
            var datos = {
                'op' : 'areaYaRegistrado',
                'nombrerol' : areaYaExiste
            };
            $.ajax({
                type: "GET",
                url:  "controllers/Area.controller.php",
                data: datos,
                success: function(e){
                    if(e == 1){
                        mostrarAlerta("error", "¡Ya existe este registro!");
                    }
                    else if(e == 2){
                        registrarArea();
                    }else{
                        mostrarAlerta("error", "¡A ocurrido un error!");
                    }
                }
            });
        }
    }
    
    listarAreaActivos();
    $("#cancelarAreaActiva").click(function(){
        $("#formularioAreaActiva")[0].reset();
    });

    $("#registrarAreaActiva").click(areaYaExiste);

});
