 $(document).ready(function(){
    idusuario = "";
    var dni = document.querySelector("#nrodocumento");

    $("#cancelarPersona").click(function(){
        $("#formularioPersona")[0].reset();
        $("#tipodoc").prop('disabled', false);
        $("#nrodocumento").prop('disabled', false);
        $("#primerapellido").prop('disabled', false);
        $("#segundoapellido").prop('disabled', false);
        $("#nombres").prop('disabled', false);
    });

    function registrarPersona(){
        let primerapellido = $("#primerapellido").val();
        let segundoapellido = $("#segundoapellido").val();
        let nombres = $("#nombres").val();
        let tipodoc = $("#tipodoc").val();
        let nrodocumento = $("#nrodocumento").val();
        let telefono = $("#telefono").val();
        let email = $("#email").val();

        if (primerapellido == "" || nombres == "" || tipodoc == "" || nrodocumento == ""){
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
                        'op'              : 'registrarPersona',
                        'primerapellido'  : primerapellido,
                        'segundoapellido' : segundoapellido,
                        'nombres'         : nombres,
                        'tipodoc'         : tipodoc, 
                        'nrodocumento'    : nrodocumento,
                        'telefono'        : telefono,
                        'email'           : email
                    };
                    $.ajax({
                        url: 'controllers/Persona.controller.php',
                        type: 'GET',
                        data: datos,
                        success: function(e){
                            mostrarAlerta("success", "¡Registrado con éxito!");
                            $("#formularioPersona")[0].reset();
                        }
                    });
                }
            });
        }
    }

    function registrarPersonaPaciente(){
        let primerapellidoper = $("#primerapellido").val();
        let segundoapellidoper = $("#segundoapellido").val();
        let nombresper = $("#nombres").val();
        let tipodocper = $("#tipodoc").val();
        let nrodocumentoper = $("#nrodocumento").val();
        let telefonoper = $("#telefonoper").val();
        let emailper = $("#emailper").val();

        let ubigeoper = $("#codigo-ubigeo").val();
        let direccionper = $("#direccionper").val();
        let fechanacimientoper = $("#fechanacimientoper").val();
        let sexoper = $("#sexoper").val();
        let estadocivilper = $("#estadocivilper").val();
        let esalergicoper = $("#esalergico").val();
        let alergiasper = $("#alergiastexto").val();

        if (primerapellidoper == "" || nombresper == "" || tipodocper == "" || 
            nrodocumentoper == "" || ubigeoper == "" || direccionper == "" || fechanacimientoper == "" || sexoper == "" || estadocivilper == "" ||
            esalergicoper == "" || alergiasper == ""){
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
                        'op'              : 'registrarPersonaPaciente',
                        'primerapellido'  : primerapellidoper,
                        'segundoapellido' : segundoapellidoper,
                        'nombres'         : nombresper,
                        'tipodoc'         : tipodocper, 
                        'nrodocumento'    : nrodocumentoper,
                        'telefono'        : telefonoper,
                        'email'           : emailper,
                        'ubigeo'          : ubigeoper,
                        'direccion'       : direccionper,
                        'fechanacimiento' : fechanacimientoper,
                        'sexo'            : sexoper,
                        'estadocivil'     : estadocivilper,
                        'esalergico'      : esalergicoper,
                        'alergias'        : alergiasper
                    };

                    $.ajax({
                        url: 'controllers/Persona.controller.php',
                        type: 'GET',
                        data: datos,
                        success: function(result){
                            mostrarAlerta("success", "¡Registrado con éxito!");
                            $("#formularioPersona")[0].reset();
            
                            window.location.href = "main.php?view=procesoprincipal#step-2";
                            location.reload(true);
                        }
                    });
                }
            });
        }
    }

    function personaYaExiste(){
        let personaYaExiste = $("#tipodoc").val();
        let personaYaExiste2 = $("#nrodocumento").val();
        
        if(personaYaExiste == undefined || personaYaExiste2 == undefined){
            mostrarAlerta("warning", "¡Completar los campos necesarios!");
        }else{
            var datos = {
            'op'            : 'personaYaRegistrado',
            'tipodoc'       : personaYaExiste,
            'nrodocumento'  : personaYaExiste2
            };
            $.ajax({
                type: "GET",
                url:  "controllers/Persona.controller.php",
                data: datos,
                success: function(e){
                    if(e == 1){
                        mostrarAlerta("error", "¡Ya existe este registro!");

                    }
                    else if(e == 2){
                        registrarPersona();
                    }else{
                        mostrarAlerta("error", "¡A ocurrido un error!");

                    }
                }
            });
        }
    }

    function personaYaExisteProcesoPrincipal(){
        let personaYaExiste = $("#tipodoc").val();
        let personaYaExiste2 = $("#nrodocumento").val();
        
        if(personaYaExiste == undefined || personaYaExiste2 == undefined){
            mostrarAlerta("warning", "¡Completar los campos necesarios!");
        }else{
            var datos = {
            'op'            : 'personaYaRegistrado',
            'tipodoc'       : personaYaExiste,
            'nrodocumento'  : personaYaExiste2
            };
            $.ajax({
                type: "GET",
                url:  "controllers/Persona.controller.php",
                data: datos,
                success: function(e){
                    if(e == 1){
                        mostrarAlerta("error", "¡Ya existe este registro!");
                    }
                    else if(e == 2){
                        registrarPersonaPaciente();
                    }else{
                        mostrarAlerta("error", "¡A ocurrido un error!");

                    }
                }
            });
        }
    }

    $("#registrarPerPac").click(personaYaExisteProcesoPrincipal);

    $("#tipodoc").change(function(){
        let tipodoc = $("#tipodoc").val();

        if(tipodoc == "D"){
            $("#nrodocumento").val("");
            $("#primerapellido").val("");
            $("#segundoapellido").val("");
            $("#nombres").val("");
            $("#buscarDNI").html("<div class='btn bg-gradient-info' id='consultareniec'><i class='fas fa-search'></i></div>");
            dni.setAttribute('maxlength', '8');

            $('#nrodocumento').focus();
        }else if(tipodoc == "C"){
            $("#nrodocumento").val("");
            $("#primerapellido").val("");
            $("#segundoapellido").val("");
            $("#nombres").val("");
            $("#buscarDNI").html("");
            dni.setAttribute('maxlength', '9');
            $('#nrodocumento').focus();
        }
    });

    function consultaDNI(){
        let dni = $("#nrodocumento").val();
        let tipodoc = $("#tipodoc").val();
        if(dni == "" || tipodoc == ""){
            mostrarAlerta("warning", "¡Completar los campos necesarios!");
        }else{
            $.ajax({
                url :'controllers/Persona.controller.php',
                type: 'GET',
                data: {'op' : 'consultaDNI', 'nrodocumento': dni},
                dataType: 'JSON',
                success: function(result){                    
                    $("#primerapellido").val(result.apellidoPaterno);
                    $("#segundoapellido").val(result.apellidoMaterno);
                    $("#nombres").val(result.nombres);
                    $("#telefono").focus();
                }
            });
        }
    }
    
    function ListarPersonas(){
        var tabla = $("#tablaPersonaListar").DataTable();
        tabla.destroy();

        tabla = $("#tablaPersonaListar").DataTable({
            "processing" : true,
            "serverSide" : true,
            "sAjaxSource": 'controllers/Persona.controller.php?op=ListarPersona',
            "pageLength" : 10,
            "language": { url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json' },
            "columnDefs" : [
                {
                    "data": null,
                    render: function(data,type,row){
                        if (data[6] != null) {
                            return `
                                <a  href='#' data-idpersona='${data[0]}' style='color:#ffffff' class='btn btn-sm btn-warning modificar' data-toggle='modal' data-target='#modelId'>
                                    <i class='fas fa-edit'></i>
                                </a>
                                <a  href='#' id="yaespaciente" style='color:#ffffff; background-color:#3c8dbc; border-color:#3c8dbc' class='btn btn-sm btn-secondary'>
                                    <i class="fas fa-check"></i>
                                </a>
                            `;
                        }else{
                            return `
                            <a  href='#' data-idpersona='${data[0]}' style='color:#ffffff' class='btn btn-sm btn-warning modificar' data-toggle='modal' data-target='#modelId'>
                                <i class='fas fa-edit'></i>
                            </a>

                            <a  href='#' data-idpersonapaciente='${data[0]}' style='color:#ffffff; background-color:#0056B4;' data-apellido='${data[1]}' data-nombre='${data[2]}' class='btn btn-sm crearpaciente'  data-toggle='modal' data-target='#modalcrearpaciente'>
                            <i class="fas fa-user-injured"></i>
                            </a>
                        `;
                        }
                    },
                    "targets":6
                }
            ]
        });
    }  
    
    $("#datosPersonaListar").on("click", "#yaespaciente", function(){
        mostrarAlerta("info", "¡Esta persona ya es un paciente!");
    });


    function actualizarPersona(){
        let telefonomodal = $("#telefonomodal").val();
        let emailmodal = $("#emailmodal").val();
        let idpersona = $("#nombresmodal").attr('data-idpersona');
        Swal.fire({
            icon: 'question',
            title: '¿Está seguro de modificar?',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Aceptar',
            focusConfirm: true
        }).then((result)=>{
            if(result.isConfirmed){
                var datos ={
                    'op'    :   'modificarPersona',
                    'idpersona': idpersona,
                    'telefono' :    telefonomodal,
                    'email'     :   emailmodal
                };
                $.ajax({
                    url: 'controllers/Persona.controller.php',
                    type :'GET',
                    data: datos,
                    success: function(e){
                        $("#modelId").modal("hide");
                        mostrarAlerta("success", "¡Actualizado con éxito!");
                        ListarPersonas();
                    }
                });
            }
        });
    }

    $("#datosPersonaListar").on("click", ".modificar", function(){
        let idpersona = $(this).attr("data-idpersona");
        var datos = {
            'op'         : 'getPersona',
            'idpersona'  : idpersona
        };
        $.ajax({
            url: 'controllers/Persona.controller.php',
            type: 'GET',
            data: datos,
            success: function (e){
                var datosServer = JSON.parse(e);
                $('#telefonomodal').focus();
                $("#nombresmodal").attr("data-idpersona", datosServer[0].idpersona);
                $("#nombresmodal").val(datosServer[0].primerapellido + " " + datosServer[0].segundoapellido + " " + datosServer[0].nombres);
                $("#telefonomodal").val(datosServer[0].telefono); 
                $("#emailmodal").val(datosServer[0].email); 
            }
        });
    });

    $("#modelId").on("click","#modificardatos", function(){
        actualizarPersona();
    });
    
    $("#emailmodal").keypress(function (e){
        if (e.keyCode == 13){
            actualizarPersona();
        }
    });	

    $('#telefono').keypress(function(e){
        if (e.keyCode == 13){
            personaYaExiste();
        }
    });

    $('#email').keypress(function(e){
        if (e.keyCode == 13){
            personaYaExiste();
        }
    });

    $("#nrodocumento").keyup(function () {
        let tipodoc = $("#tipodoc").val();
        var a = $("#nrodocumento").val().length;
        if (tipodoc == "D" && a == 8) {
            consultaDNI();
        }
    });
    

    ListarPersonas();
    $("#actualizar").click(actualizarPersona);
    $("#buscarDNI").click(consultaDNI);
    $("#registrar").click(personaYaExiste);
    $("#cerrarModal").click(function(){$("#formularioPaciente")[0].reset();});

});