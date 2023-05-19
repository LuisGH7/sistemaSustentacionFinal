$(document).ready(function(){

    idusuario = "";
    var txtPersona = document.querySelector("#idusuariomod");
    var selectPersona = document.querySelector("#idpersona");
    var botonActualizar = document.querySelector("#actualizar");
    var botonGuardar = document.querySelector("#registrar");
    

    function cargarPersonas(){
        $.ajax({
            url: 'controllers/Persona.controller.php',
            type: 'GET',
            data: 'op=cargarPersona',
            success: function(e){
                $("#idpersona").html(e);
            }
        });
    }

    function cargarAreas(){
        $.ajax({
            url: 'controllers/Area.controller.php',
            type: 'GET',
            data: 'op=listarArea',
            success: function(e){
                $("#idarea").html(e);
            }
        });
    }

    function registrarUsuarios() {
        let idpersona = $("#idpersona").val();
        let nombreusuario = $("#nombreusuario").val();
        let idespecialidad = $("#idespecialidad").val();
        let codigoespecialista = $("#codigoespecialista").val();
        if(idpersona == "" || nombreusuario == "" || idespecialidad == "" || codigoespecialista == ""){
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
                        'op'              : 'registrarUsuario',
                        'idpersona'       : idpersona,
                        'nombreusuario'   : nombreusuario, 
                        'idespecialidad'     : idespecialidad,
                        'codigoespecialista': codigoespecialista
                    };

                    $.ajax({
                        url: 'controllers/Usuario.controller.php',
                        type:'GET',
                        data: datos,
                        success:function(e){
                            mostrarAlerta("success", "¡Registrado con éxito!");
                            $("#formularioUsuario")[0].reset();
                            listarUsuariosActivos();
                            cargarPersonas();
                        }
                    });
                }
            });
        }
    }

    function listarUsuariosActivos(){
        $.ajax({
            url: 'controllers/Usuario.controller.php',
            type: 'GET',
            data: 'op=listarUsuariosActivos',
            success: function(e){
                var tabla = $("#tablaUsuario").DataTable();
                tabla.destroy();
                $("#datosUsuario").html(e);
                $("#tablaUsuario").DataTable({
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
    function GestionUsuario(tipo, valor, icono, mensaje){
        var datos = {
            'op' : tipo,
            'idusuario' : valor
        };
        $.ajax({
            url: 'controllers/Usuario.controller.php',
            type: 'GET',
            data: datos,
            success: function(e){
                mostrarAlerta(icono, mensaje);
            }
        });
    }

    $('#datosUsuario').on('change',"#on",function(){
        var idusuario2 = $(this).attr('data-idusuario2');
        if(this.checked){
            GestionUsuario("reactivarUsuario", idusuario2, "success", "¡Restaurado con éxito!");
        }
        else{
            GestionUsuario("eliminarUsuario", idusuario2, "success", "¡Eliminado con éxito!");
        }
    });

    $("#tablaUsuario").on('click', ".modificar", function(){
        var idusuario = $(this).attr('data-idusuariomod');

        $.ajax({
            url: 'controllers/Usuario.controller.php',
            type: 'GET',
            data: {
                'op': 'getUsuario',
                'idusuario' : idusuario
            },
            success: function(result){                        
                var idespecialidad = $("#idespecialidad").val();

                if ($.trim(result) != ""){
                    //Asiganamos y quitamos la clase que muestra la caja de texto
                    $("#Aviso").html("Actualizar Usuario");
                    selectPersona.classList.add('asignar');
                    txtPersona.classList.remove('asignar');
                    botonActualizar.classList.remove('asignar');
                    botonGuardar.classList.add('asignar');
                    $("#codigoespecialista").prop('disabled', true);

                    var resultado = JSON.parse(result);

                    $("#idusuariomod").val(resultado[0].nombrecompleto);
                    $("#nombreusuario").val(resultado[0].nombreusuario);
                    $("#codigoespecialista").val(resultado[0].codigoespecialista);
                    txtPersona.setAttribute("data-idusuario", resultado[0].idusuario);
                }else{
                    $("#idusuario").val("");
                    mostrarAlerta("warning", "¡No encontramos registros!");
                }
            }
        });
    });

    function modificarUsuarios(){
        let idusuario = $("#idusuariomod").attr('data-idusuario');
        let nombreusuario = $("#nombreusuario").val();
        let idespecialidad = $("#idespecialidad").val();
        let idarea = $("#idarea").val();
        if(nombreusuario == "" || idespecialidad == "" || idarea == ""){
            mostrarAlerta("warning", "¡Completar los campos necesarios!");
        }else{
            Swal.fire({
                icon:'question',
                title:'¿Está seguro de modificar?',
                showCancelButton: true,
                cancelButtonText:'Cancelar',
                confirmButtonText:'Aceptar'
            }).then((result) =>{
                if(result.isConfirmed){
                    var datos = {
                        'op'              : 'modificarUsuario',
                        'idusuario'       : idusuario,
                        'nombreusuario'   : nombreusuario, 
                        'idespecialidad'     : idespecialidad
                    };
                    $.ajax({
                        url: 'controllers/Usuario.controller.php',
                        type:'GET',
                        data: datos,
                        success:function(e){
                            mostrarAlerta("success", "¡Modificado con éxito!");

                            $("#formularioUsuario")[0].reset();
                            $("#Aviso").html("Registrar Usuario");
                            selectPersona.classList.remove('asignar');
                            txtPersona.classList.add('asignar');
                            botonActualizar.classList.add('asignar');
                            botonGuardar.classList.remove('asignar');
                            $("#codigoespecialista").prop('disabled', false);
                            $("#idespecialidad").val("");

                            listarUsuariosActivos();
                        }
                    });
                }
            });
        }
    }

    $("#idarea").change(function (){
        let idarea = $("#idarea").val();
        
        $.ajax({
            url: 'controllers/Especialidad.controller.php',
            type: 'GET',
            data: 'op=listarEspecialidad&idarea=' + idarea,
            success: function(e){
                $("#idespecialidad").html(e)
            }
        });
    });

    $("#cancelar").click(function(){
        $("#formularioUsuario")[0].reset();
        $("#formularioUsuario")[0].reset();                   
        $("#Aviso").html("Registrar Usuario");
        selectPersona.classList.remove('asignar');
        txtPersona.classList.add('asignar');
        botonActualizar.classList.add('asignar');
        botonGuardar.classList.remove('asignar');
        $("#codigoespecialista").prop('disabled', false);
        $("#idespecialidad").val("");
    });

    function resetearFormulario(){
        $("#formularioActualizarContraseña")[0].reset();
    }

    function actualizarClave(){
        const claveActual = $("#claveactual").val();
        const claveNueva = $("#clavenueva").val();
        const claveNuevaConfirmada = $("#clavenuevaconfirmada").val();

        if(claveActual == "" || claveNueva == "" || claveNuevaConfirmada == ""){
            mostrarAlerta("warning", "¡Completar los campos necesarios!");
        }else{
            if(claveNueva != claveNuevaConfirmada){ // faltaria validacion para cuando la clave actual no es correcta
                mostrarAlerta("warning", "¡Las nuevas contraseñas no coinciden!");
            }else{
                Swal.fire({
                    icon: 'question',
                    title: '¿Está seguro de cambiar la contraseña?',
                    showCancelButton: true,
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed){
                        $.ajax({
                            url: 'controllers/Usuario.controller.php',
                            type: 'GET',
                            data: {
                                'op' : 'actualizarClave',
                                'claveActual' : claveActual,
                                'claveNueva' : claveNueva 
                            },
                            success: function(result){
                                if($.trim(result) == "OK"){
                                    mostrarAlerta("success", "¡Actualizado correctamente!");
                                    resetearFormulario();
                                }else{
                                    mostrarAlerta("warning", "¡La contraseña actual es incorrecta");
                                    $("#claveactual").focus();
                                }
                            }
                        });
                    }
                });
            }
        }
    }

    function nombreusuarioYaExiste(){
        let nombreusuarioYaExiste = $("#nombreusuario").val();
        
        if(nombreusuarioYaExiste == ""){
            mostrarAlerta("warning", "¡Completar los campos necesarios!");
        }else{
            var datos = {
                'op' : 'nombreusuarioYaRegistrado',
                'nombreusuario' : nombreusuarioYaExiste
            };
            $.ajax({
                type: "GET",
                url:  "controllers/Usuario.controller.php",
                data: datos,
                success: function(e){
                    if(e == 1){
                        mostrarAlerta("error", "¡Ya existe este nombre de usuario!");
                    }
                    else if(e == 2){
                        codigoespecialistaYaExiste();
                    }else{
                        mostrarAlerta("error", "¡A ocurrido un error!");
                    }
                }
            });
        }
    }
    
    function codigoespecialistaYaExiste(){
        var codigoespecialista = $("#codigoespecialista").val();
        if(codigoespecialista ==""){
            mostrarAlerta("warning", "¡Completar los campos necesarios!");
        }else{
            var datos={
                'op' : 'codigoespecialistaYaRegistrado',
                'codigoespecialista':codigoespecialista
            }
            $.ajax({
                type:"GET",
                url:"controllers/Usuario.controller.php",
                data:datos,
                success: function(e){
                    if(e==1){
                        mostrarAlerta("error","¡Ya existe este registro!")
                    }else
                    if(e==2){
                        registrarUsuarios();
                    }else
                    {
                        mostrarAlerta("error","¡A ocurrido un error!")
                    }
                }
            });
        }
    }

    
    $("#cambiarclave").click(actualizarClave);
    $("#cancelar").click(resetearFormulario);
    $("#registrar").click(nombreusuarioYaExiste);
    $("#actualizar").click(modificarUsuarios);
    listarUsuariosActivos();
    cargarPersonas();
    cargarAreas();
});