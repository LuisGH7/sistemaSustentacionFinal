$(document).ready(function(){
    var productod = document.querySelector("#producto");

    function Tabla(valor){
        var datos = {
                'op'              : 'listarDetEgreso',
                'idegreso'       : valor
                };
        $.ajax({
            url : 'controllers/Detegreso.controller.php',
            type: 'GET',
            data: datos,
            success: function(result){
                $("#listadetegreso").html(result);
            }
        });
    }

    function Total(valortotal){
        var datos = {
                'op'              : 'detegresosuma',
                'idegreso'       : valortotal
                };
        $.ajax({
            url : 'controllers/Detegreso.controller.php',
            type: 'GET',
            data: datos,
            success: function(result){
                $("#total").html(result);
            }
        });
    }

    $("#datosEgreso").on('click', '#idegreso', function(){
        var idegreso = $(this).attr("data-idegreso");
        productod.setAttribute("data-egreso", idegreso); 
        Tabla(idegreso);
        Total(idegreso);
    });

    $("#listadetegreso").on("click",".eliminar" , function(){
        let iddetegreso = $(this).attr('data-iddetegreso');
        let idegreso= $(this).attr('data-idegreso');

        Swal.fire({
            icon: 'question',
            title: '¿Está seguro de eliminar?',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Confirmar',
        }).then((result)=>{
            if(result.isConfirmed){
                var datos = {
                    'op' : 'eliminarDetegreso',
                    'iddetegreso' : iddetegreso
                };
                $.ajax({
                    url: 'controllers/Detegreso.controller.php',
                    type: 'GET',
                    data: datos,
                    success: function(e){
                        mostrarAlerta("success","¡Eliminado con éxito!");
                        Tabla(idegreso);
                        Total(idegreso);
                    }
                });
            }
        });
    });

    function registrarDetegreso(){
        let idegreso = productod.getAttribute('data-egreso');
        let producto = $("#producto").val();
        let cantidad = $("#cantidad").val();
        let precio = $("#precio").val();

        if(producto == "" || cantidad == "" || precio == ""){
            mostrarAlerta("warning", "¡Completar los campos necesarios!");
        }else{
            $.ajax({
                url : 'controllers/Detegreso.controller.php',
                type : 'GET',
                data: {
                    'op' : 'registrarDetegreso',
                    'idegreso' : idegreso,
                    'producto' : producto,
                    'cantidad' : cantidad,
                    'precio'   : precio
                },
                success: function (result){
                    mostrarAlerta("success", "¡Registrado con éxito!");
                    $("#formularioDetegreso")[0].reset();
                    Tabla(idegreso);
                    Total(idegreso);
                }
            });
        }
    }
    


    $("#registrarDetEgreso").click(registrarDetegreso);
});