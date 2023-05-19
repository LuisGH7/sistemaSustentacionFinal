$(document).ready(function(){
    var cajatextNombre = document.querySelector("#idpersona");

    $("#cancelarPaciente").click(function(){
        $("#formularioPaciente")[0].reset();
        $("#titulo").html("Registrar Paciente");
        $("#tipodocPaciente").prop('disabled', false);
        $("#nrodocumentoPaciente").prop('disabled', false);
        $("#idpersona").prop('disabled', false);
        $("#fechanacimiento").prop('disabled', false);
        $("#sexo").prop('disabled', false);
    });
    
    function cajaalergia(){  
        $("#esalergico").change(function(){                 
            let esalergico = $("#esalergico").val();
            if(esalergico == "Sí"){
                $("#alergias").html(
                    "<label for='alergias'>Alergias</label> <input class='form-control form-control-border' id='alergiastexto'>"
                    );
                $('#alergiastexto').focus();
            }else{
                $("#alergias").html(
                    "<fieldset disabled='disabled'> <label for='alergias'>Alergias</label><input class='form-control form-control-border' id='alergiastexto' value='No tiene alergias'></fieldset>"
                );
                $('#ubigeo').focus();
            }
        });
    }
    cajaalergia();
    
    function alergicosino(){
        $("#alergias").html(
            "<fieldset disabled='disabled'> <label for='alergias'>Alergias</label><input class='form-control form-control-border' id='alergiastexto' value='No tiene alergias'></fieldset>"
        );
    }
    alergicosino();


    $("#formularioPaciente").submit(function(event){
        event.preventDefault();
    });

    $("#ubigeo").autoComplete({
        resolver: 'custom',
        minLength: 3,
        noResultsText: 'No encontrado',
        events: {
            search: function(query, callback){
                $.ajax({
                    url: 'controllers/Ubigeo.controller.php',
                    type: 'GET',
                    dataType: 'JSON',
                    data: {'operacion' : 'getUbigeo', 'valorBuscado': query}
                }).done(function (res){
                    callback(res);
                    $("#total-items").html(res.length);
                });
            }
        }
    }); 

    $("#ubigeo").on('autocomplete.select', function(event, item){
        $("#codigo-ubigeo").val(item['ubigeo']);
        $("#total-items").html('');
        $("#direccion").focus();
    });

    $("#ubigeo").keyup(function(e){
        if($(this).val() == "" || e.keyCode == 27){
            $("#codigo-ubigeo").val("");
            $("#total-items").html("");
        }
    });

    function buscarPersona(){
        let tipodoc = $("#tipodocPaciente").val();
        let nrodocumento = $("#nrodocumentoPaciente").val();

        if(tipodoc == "" || nrodocumento == ""){
            mostrarAlerta("warning", "¡Completar los campos necesarios!");
        }else{
            var datos = {
                "op"            : "buscarPersona",
                "tipodoc"       : tipodoc,
                "nrodocumento"  : nrodocumento
            };
            $.ajax({
                url: 'controllers/Persona.controller.php',
                type: 'GET',
                data: datos,
                success: function (e){
                    if ($.trim(e) != ""){
                        var resultado = JSON.parse(e);
                        $("#idpersona").val(resultado[0].persona);
                        cajatextNombre.setAttribute("data-idpersona", resultado[0].idpersona);
                    }else{
                        $("#idpersona").val("");
                        mostrarAlerta("warning", "¡No encontramos registros!");
                    }
                }
            });
        }
    }

    function registrarPaciente(){
        let idpersona = $("#modalidpaciente").val();
        let ubigeo = $("#codigo-ubigeo").val();
        let direccion = $("#direccion").val();
        let fechanacimiento = $("#fechanacimiento").val();
        let sexo = $("#sexo").val();
        let estadocivil = $("#estadocivil").val();
        let esalergico = $("#esalergico").val();
        let alergias = $("#alergiastexto").val();
        
        if (idpersona == "" || ubigeo == "" || direccion == "" || fechanacimiento == "" || sexo == "" || estadocivil == "" || esalergico == "" || alergias == ""){
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
                        'op'              : 'registrarPaciente',
                        'idpersona'       : idpersona,
                        'ubigeo'          : ubigeo,
                        'direccion'       : direccion,
                        'fechanacimiento' : fechanacimiento,
                        'sexo'            : sexo,
                        'estadocivil'     : estadocivil,
                        'esalergico'      : esalergico,
                        'alergias'        : alergias
                    };
                    $.ajax({
                        url: 'controllers/Paciente.controller.php',
                        type: 'GET',
                        data: datos,
                        success: function(e){
                            mostrarAlerta("success", "¡Registrado con éxito!");
                            $("#formularioPaciente")[0].reset();
                            location.reload();
                        }
                    });
                }
            });
        }
    }

    $("#tablaPersonaListar").on('click', '.crearpaciente', function(){
        var modalidpaciente = $(this).attr('data-idpersonapaciente');
        var modalapellidospaciente = $(this).attr('data-apellido');
        var modalnombrespaciente = $(this).attr('data-nombre');
        var nombrecompelto = `${modalapellidospaciente}  ${modalnombrespaciente}`;

        $("#nombrecompletopersona").val(nombrecompelto);
        $("#modalidpaciente").val(modalidpaciente);
    });

    function pacienteYaExiste(){
        let pacienteYaExiste = $("#idpersona").attr('data-idpersona');
        
        if(pacienteYaExiste == undefined){
            mostrarAlerta("warning", "¡Completar los campos necesarios!");
        }else{
            var datos = {
            'op' : 'pacienteYaRegistrado',
            'idpersona' : pacienteYaExiste
            };
            $.ajax({
                type: "GET",
                url:  "controllers/Paciente.controller.php",
                data: datos,
                success: function(e){
                    if(e == 1){
                        mostrarAlerta("error", "¡Ya existe este registro!");
                    }
                    else if(e == 2){
                        registrarPaciente();
                    }else{
                        mostrarAlerta("error", "¡A ocurrido un error!");
                    }
                }
            });
        }
    }

    $("#reiniciarBuscar").click(function(){
        $("#busquedaPaciente")[0].reset();
        var tabla = $("#filtropacienteBuscar").DataTable();
        tabla.destroy();
        $("#datosfiltropacienteBuscar").html("");
    });

    $("#buscarPaciente").click(function (){
        let tipodocBuscar = $("#tipodocBuscar").val();
        let nrodocumentoBuscar = $("#nrodocumentoBuscar").val();

        if(tipodocBuscar == "" || nrodocumentoBuscar == ""){
            mostrarAlerta("warning", "¡Completar los campos necesarios!");
        }else{
            var datos = {
                'op'                : 'FiltrarPaciente',
                'tipodoc'           : tipodocBuscar,
                'nrodocumento'      : nrodocumentoBuscar,
            };

            $.ajax({
                url: 'controllers/Paciente.controller.php',
                type: 'GET',
                data: datos,
                success: function (e){
                    var tabla = $("#filtropacienteBuscar").DataTable();
                    tabla.destroy();
                    $("#datosfiltropacienteBuscar").html(e);
                    $("#filtropacienteBuscar").DataTable({
                        language: { url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json' },
                        columnDefs: [
                        {
                            visible: true,
                            searchable: true
                        }
                        ],
                        dom: 'Bfrtip',
                        buttons: []
                    });
                }
            });
        }


    });

    // Obtener datos para el modal
    $("#datosfiltropacienteBuscar").on("click", ".modificar", function(){
        var idpacientemodpac = $(this).data('idpaciente');

        $.ajax({
            url : 'controllers/Paciente.controller.php',
            type: 'GET',
            data: {'op' : 'getPaciente', 'idpaciente' : idpacientemodpac},
            success: function(result){
                var resultado = JSON.parse(result);
                $("#estadocivilmodpac").val(resultado[0]['estadocivil']);
                $("#estadocivilmodpac").attr('data-idpacientemodal', idpacientemodpac);
                $("#ubigeomodpac").val(resultado[0]['ubigeo']);
                $("#direccionmodpac").val(resultado[0]['direccion']);
                $("#esalergico").val(resultado[0]['esalergico']);
                let esalergico = $("#esalergico").val();
                if(esalergico == "Sí"){
                    $("#alergias").html(
                        "<label for='alergias'>Alergias</label> <input class='form-control form-control-border' id='alergiastexto'>"
                    );
                    $("#alergiastexto").val(resultado[0]['alergias']);
                }else{
                    $("#alergias").html(
                        "<fieldset disabled='disabled'> <label for='alergias'>Alergias</label><input class='form-control form-control-border' id='alergiastexto' value='No tiene alergias'></fieldset>"
                    );
                }
            }
        });
    });

    // Modificar los datos
    function modificarPaciente(){
        let idpacientemod = $("#estadocivilmodpac").data('idpacientemodal');
        let estadocivilmod = $("#estadocivilmodpac").val();
        let esalergicomod = $("#esalergico").val();
        let alergiasmod = $("#alergiastexto").val();
        let direccionmod = $("#direccionmodpac").val();
        let ubigeomod = $("#codigo-ubigeo").val();
        let ubigeonormalmod = "";

        if(alergiasmod == "" || direccionmod == "" ){
            mostrarAlerta("warning", "¡Completar los campos necesarios!");
        }else{
            if(ubigeomod==""){      
                ubigeonormalmod = $("#ubigeomodpac").val();
            }else{
                ubigeonormalmod = ubigeomod;
            }

            Swal.fire({
                icon: 'question',
                title: '¿Está seguro de modificar?',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Aceptar',
                focusConfirm: true
            }).then((result)=>{
                if(result.isConfirmed){
                    $.ajax({
                        url: 'controllers/Paciente.controller.php',
                        type: 'GET',
                        data: {
                            'op': 'modificarPaciente',
                            'idpaciente' : idpacientemod,
                            'estadocivil': estadocivilmod,
                            'esalergico' : esalergicomod,
                            'alergias'   : alergiasmod,
                            'direccion'  : direccionmod,
                            'ubigeo'     : ubigeonormalmod
                        },
                        success: function(result){
                            mostrarAlerta("success", "¡Actualizado con éxito!");
                            $("#modelId").modal('hide');
                            $("#ubigeo").val("");
                            $("#codigo-ubigeo").val("");
                        }
                    });
                }
            });
        }
    }



    $("#btnGuardarPacienteModal").click(registrarPaciente);
    $("#buscarP").click(buscarPersona);
    $("#modificarPaciente").click(modificarPaciente);
    $("#registrarPaciente").click(pacienteYaExiste);

});