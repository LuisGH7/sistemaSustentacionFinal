$(document).ready(function(){

    function registrarEps() {
        let nombreeps = $("#nombreeps").val();

        if(nombreeps == ""){
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
                        'op'         : 'registrarEps',
                        'nombreeps'  : nombreeps
                    };
                    $.ajax({
                        url: 'controllers/Eps.controller.php',
                        type:'GET',
                        data: datos,
                        success:function(e){
                            mostrarAlerta("success", "¡Registrado con éxito!");
                            $("#formularioEps")[0].reset();
                            listarEps();
                            cargarEps();
                        }
                    });
                }
            });
        }
    }

    function epsYaExiste(){
        let epsYaExiste = $("#nombreeps").val();
        
        if(epsYaExiste == ""){
            mostrarAlerta("warning", "¡Completar los campos necesarios!");
        }else{
            var datos = {
            'op' : 'epsYaRegistrado',
            'nombreeps' : epsYaExiste
            };
            $.ajax({
                type: "GET",
                url:  "controllers/Eps.controller.php",
                data: datos,
                success: function(e){
                    if(e == 1){
                        mostrarAlerta("error", "¡Ya existe este registro!");           
                    }
                    else if(e == 2){
                        registrarEps();
                    }else{
                        mostrarAlerta("error", "¡A ocurrido un error!");
                    }
                }
            });
        }
    }
    
    function listarEps(){
        $.ajax({
            url: 'controllers/Eps.controller.php',
            type: 'GET',
            data: 'op=listarEpsActiva',
            success: function(e){
                var tabla = $("#tablaEps").DataTable();
                tabla.destroy();
                $("#datosEps").html(e);
                $("#tablaEps").DataTable({
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

    $("#datosEps").on("click",".eliminar" , function(){
        let ideps = $(this).attr('data-ideps');

        Swal.fire({
            icon: 'question',
            title: '¿Está seguro de eliminar?',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Confirmar',
        }).then((result)=>{
            if(result.isConfirmed){
                var datos = {
                    'op' : 'eliminarEps',
                    'ideps' : ideps
                };

                $.ajax({
                    url: 'controllers/Eps.controller.php',
                    type: 'GET',
                    data: datos,
                    success: function(e){
                        mostrarAlerta("success", "¡Eliminado con éxito!");
                        listarEps();
                        cargarEps();
                    }
                });
            }
        });
    });

    $("#cancelarEPS").click(function(){
        $("#formularioEps")[0].reset();
    });

    function listarEpsInactiva(){
        $.ajax({
            url: 'controllers/Eps.controller.php',
            type: 'GET',
            data: 'op=listarEpsInactiva',
            success: function(e){
                var tabla = $("#tablaEpsInactiva").DataTable();
                tabla.destroy();
                $("#datosEpsInactiva").html(e);
                $("#tablaEpsInactiva").DataTable({
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

    $("#datosEpsInactiva").on("click",".restaurar" , function(){
        let ideps = $(this).attr('data-ideps');

        Swal.fire({
            icon: 'question',
            title: '¿Está seguro de restaurar?',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Confirmar',
        }).then((result)=>{
            if(result.isConfirmed){
                var datos = {
                    'op' : 'reactivarEps',
                    'ideps' : ideps
                };
                $.ajax({
                    url: 'controllers/Eps.controller.php',
                    type: 'GET',
                    data: datos,
                    success: function(e){
                        mostrarAlerta("success", "¡Restaurado con éxito!");
                        listarEpsInactiva();
                    }
                });
            }
        });
    });

    function GestionEPS(tipo,valor,icono,mensaje,numero,estado){
        var datos = {
            'op' : tipo,
            'ideps' : valor
        };
        $.ajax({
            url: 'controllers/Eps.controller.php',
            type: 'GET',
            data: datos,
            success: function(e){
                $(`#info${numero}`).html(estado);
                mostrarAlerta(icono,mensaje);
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

    $('#datosEps').on('change',"#on",function(){
        let ideps2 = $(this).attr('data-ideps2');
        let numero = $(this).attr('data-numero');
        if(this.checked){
            GestionEPS("reactivarEps", ideps2, "success", "¡Restaurado con éxito!",numero, "Activo");
        }
        else{
            GestionEPS("eliminarEps", ideps2, "success", "¡Eliminado con éxito!",numero, "Inactivo");
        }
    });

    listarEpsInactiva();

    $("#registrarEPS").click(epsYaExiste);
    listarEps();

});