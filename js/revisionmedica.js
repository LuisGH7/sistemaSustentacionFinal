$(document).ready(function(){
    var iddetlocalget = localStorage.getItem('iddetatencion');

    tinymce.init({
        selector: 'textarea',
        menubar:false,
        height: 200,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | ' +
        'fontfamily fontsize bold italic underline backcolor  forecolor | ',
    });

    function cancelar(){
        $("#formularioHistoria")[0].reset();
    }

    function getDetatencionPaciente(){
        $.ajax({
            url: 'controllers/Detatencion.controller.php',
            type: 'GET',
            data: {
                'op': 'getDetatencionPaciente',
                'iddetatencion' : iddetlocalget
            },
            success: function(result){
                var resultado = JSON.parse(result);
                if(resultado){
                    $("#pacienterev").val(resultado[0].datospersonales);
                    $("#pacienterev").attr("data-iddetatencion", resultado[0].iddetlocalget);
                }
            }
        });
    }
    
    getDetatencionPaciente();

    function registrarRevisionMedica(){
        let tipodiagnostico = $("#tipodiagnostico").val();
        let derivacionlaboratorio = $("#derivacionlaboratorio").val();
        let examenclinico = tinymce.get("examenclinico").getContent();
        let diagnostico = tinymce.get("diagnostico").getContent();
        let tratamiento = tinymce.get("tratamiento").getContent();

        if(tipodiagnostico == "" || derivacionlaboratorio=="" || examenclinico == "" || diagnostico == "" || tratamiento == ""){
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
                        'op' : 'registrarRevisionMedica',
                        'iddetatencion' : iddetlocalget,
                        'tipodiagnostico' : tipodiagnostico,
                        'derivacionlaboratorio' : derivacionlaboratorio,
                        'examenclinico' : examenclinico,
                        'diagnostico' : diagnostico,
                        'tratamiento' : tratamiento
                    };

                    $.ajax({
                        url : 'controllers/Revisionmedica.controller.php',
                        type: 'GET',
                        data: datos,
                        success: function(result){
                            revmedicalisto();
                            window.location.href = "main.php?view=atencionxrealizar";
                            quitarDetatencion();
                        }
                    });
                }
            });
        }
    }

    function revmedicalisto(){
        $.ajax({
            url: 'controllers/Revisionmedica.controller.php',
            type: 'GET',
            data: 'op=revmedicalisto&iddetatencion=' + iddetlocalget,
            success: function(result){
                mostrarAlerta("success", "¡Revisión completa!");
            }
        });
    }

    function quitarDetatencion(){
        localStorage.removeItem("iddetatencion");
    }

    $("#reiniciarListar").click(function(){
        $("#busquedaHistoria")[0].reset();
        $("#datosRevisionMedica").html("");
        $("#codigohistoriaRM").val("");
        $("#pacienteRM").val("");
        $("#edadRM").val("");
    });

    function buscarRevisiones(){
        let tipodocListar = $("#tipodocListar").val();
        let nrodocumentoListar = $("#nrodocumentoListar").val();

        if(tipodocListar == "" || nrodocumentoListar == ""){
            mostrarAlerta("warning", "¡Completar los campos necesarios!");
        }else{
            $.ajax({
                url: 'controllers/Revisionmedica.controller.php',
                type: 'GET',
                data: {
                    'op': 'buscarRevisionesMedicas',
                    'tipodoc' : tipodocListar,
                    'nrodocumento' : nrodocumentoListar
                    },
                success: function(result){
                    var resultado = JSON.parse(result);

                    if(resultado == ""){
                        $("#codigohistoriaRM").val('');
                        $("#codigohistoriaRM").attr('');
                        $("#pacienteRM").val('');
                        $("#edadRM").val('');

                        mostrarAlerta("info", "No tiene revisiones");
                    }else{
                        $("#codigohistoriaRM").val(resultado[0].nrohistoria);
                        $("#codigohistoriaRM").attr("data-iddetatencion", resultado[0].iddetatencion);
                        $("#pacienteRM").val(resultado[0].datospersonales);
                        $("#edadRM").val(resultado[0].edad);
                    }

                    listRevisionmedica();
                }
            });
        }
    }

    function listRevisionmedica(){
        let tipodocListar = $("#tipodocListar").val();
        let nrodocumentoListar = $("#nrodocumentoListar").val();

        if(tipodocListar == "" || nrodocumentoListar == ""){
            mostrarAlerta("warning", "¡Completar los campos necesarios!");
        }else{
            $.ajax({
                url: 'controllers/Revisionmedica.controller.php',
                type: 'GET',
                data: {
                    'op': 'listRevisionmedica',
                    'tipodoc' : tipodocListar,
                    'nrodocumento' : nrodocumentoListar
                    },
                success: function(result){
                    $("#datosRevisionMedica").html(result);
                }
            });
        }
    } 

    $("#datosRevisionMedica").on("click", ".reporte", function(e){
        let idrevision = $(this).attr("data-revision");
        window.open("reports/historiaclinica.php"+ "?idrevision=" + idrevision);
    }); 

    $("#buscarRM").click(buscarRevisiones);
    $("#guardar").click(registrarRevisionMedica);
    $("#cancelar").click(cancelar);

});