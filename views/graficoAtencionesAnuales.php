<div class="row" style="margin-top: 1em;">
    <div class="col-md-3">
        <div style="position:relative; margin: auto;">
            <label style="margin-left:1em">Años</label>
            <select style="margin-left:1em" name="fechabuscar" id="fechabuscar" class="form-control">
            </select>
        </div>
    </div>
</div>
<div class="row" style="margin-top: 1em;">

    <div class="col-md-3">


    </div>
</div>

<div class="container-chart" id="containerChartFull">
    <div class="row connectedSortable">
        <!-- Gráficos -->
        <div class="col-md-12 form-group ">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="card-title text-uppercase text-bold" style="color: #3c8dbc;">ATENCIONES ANUALES DE LAS ESPECIALIDADES</h3>
                        </div>
                        <div class="col-md-6">
                            <div class="card-tools float-right">
                                <button type="button" data-toggle="collapse" data-target="#container-table1"
                                    class="btn bg-gradient-info" >
                                    <i class="fas fa-table"></i> Detalle
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <div class="col-md-12">
                            <canvas id="graficoatenciones" class="chart-responsive-lg"></canvas>
                        </div>
                    </div>
                </div>
                <div class="collapse" id="container-table1">
                    <div class="card-footer">
                        <label class="mt-3">Especialidades:</label>

                        <select name="" id="especialidad" class="form-control float-right mb-2">
                        </select>

                        <p class="mt-3"><strong>Resumen de datos:</strong></p>
                        <div class="card card-body border border-secondary">
                            <table class="table table-striped text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">Mes</th>
                                        <th scope="col">Cantidad de atenciones</th>
                                    </tr>
                                </thead>
                                <tbody id="datosDetalle">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    
    const ctx = document.getElementById('graficoatenciones').getContext('2d');

    var labels = [];
    var data = [];
    var datasets = [];
    var tipoegreso = [];
    var egresototal = ""; // []
    var fecharegistro = [];
    var fechaarray = {};
    var config = {};

    var unicos = [];

    var objeto1 = {};

    const months = [
        'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre',
        'Diciembre'
    ];
    const colores = [
        'rgba(255, 99, 132, 0.5)',
        'rgba(25, 99, 32, 0.5)',
        'rgba(105, 90, 322, 0.5)',
        'rgba(152, 90, 132, 0.5)',
        'rgba(2, 9, 311, 0.5)',
        'rgba(10, 511, 112, 0.5)',
        'rgba(10, 21, 112, 0.5)',
        'rgba(10, 51, 12, 0.5)',
        'rgba(100, 51, 12, 0.5)',
        'rgba(40, 101, 102, 0.5)',
        'rgba(20, 20, 502, 0.5)',
        'rgba(200, 10, 1, 0.5)',
        'rgba(100, 100, 100, 0.5)',
        'rgba(150, 110, 440, 0.5)',
        'rgba(200, 10, 1, 0.5)',
        'rgba(500, 100, 200, 0.5)',
        'rgba(250, 250, 1, 0.5)',
        'rgba(250, 250, 350, 0.5)',
        'rgba(350, 10, 100, 0.5)'
    ];

    const graficoatenciones = new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: []
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Atenciones Anuales'
                }
            }
        }
    });

    function listarAtencionesCantidad(anionecesario) {
        var datos = {
            'op': 'atencionMedicosAnioBuscar',
            'fechabuscar': anionecesario
        };
        $.ajax({
            url: 'controllers/Reporte.controller.php',
            type: 'GET',
            data: datos,
            success: function(result) {
                let resultado = JSON.parse(result);

                for (var i = 0; i < resultado.length; i++) {
                    especialidad = resultado[i].especialidad;
                    const aleatorio = colores[i];

                    objeto1 = {
                        label: especialidad,
                        data: resultado[i].mes,
                        backgroundColor: [
                            aleatorio
                        ],
                        borderColor: [
                            aleatorio
                        ],
                        borderWidth: 1
                    };

                    graficoatenciones.data.datasets[i] = objeto1;
                }
                graficoatenciones.update();
            }
        });
    }

    function aniocargar() {
        datos = {
            'op': 'cargarAnios'
        };
        $.ajax({
            url: 'controllers/Reporte.controller.php',
            type: 'GET',
            data: datos,
            success: function(result) {
                $("#fechabuscar").html(result);
                especialidadesDiponibles("");
            }
        });
    }

    $("#fechabuscar").change(function() {

        graficoatenciones.data.datasets = [];
        var fechabuscar = $(this).val();

        if (fechabuscar == "") {
            listarAtencionesCantidad("");
        } else {
            listarAtencionesCantidad(fechabuscar);
            especialidadesDiponibles(fechabuscar);
        }
    });

    function especialidadesDiponibles(fechabuscar) {
        var datos = {
            'op': 'filtrarEspecialidad',
            'anio': fechabuscar
        };
        console.log(datos);
        $.ajax({
            url: 'controllers/Reporte.controller.php',
            type: 'GET',
            data: datos,
            success: function(e) {
                $("#especialidad").html(e);
                console.log(e);
            }
        });
        $("#datosDetalle").html("");
    }

    $("#especialidad").change(function() {
        let anio = $("#fechabuscar").val();
        let especialidad = $("#especialidad").val();

        var datos = {
            'op': 'atencionesTablaDetalle',
            'anio': anio,
            'especialidad': especialidad
        };
        $.ajax({
            url: 'controllers/Reporte.controller.php',
            type: 'GET',
            data: datos,
            success: function(e) {
                $("#datosDetalle").html(e);
            }
        });
    });

    listarAtencionesCantidad("");
    aniocargar();
</script>