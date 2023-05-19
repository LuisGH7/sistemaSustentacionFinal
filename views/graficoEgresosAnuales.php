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

</div>

<div class="container-chart" id="containerChartFull">
    <div class="row connectedSortable">
        <!-- Gráficos -->
        <div class="col-md-12 form-group ">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="card-title text-uppercase text-bold" style="color: #3c8dbc  ;">ATENCIONES ANUALES DE LAS
                                ESPECIALIDADES</h3>
                        </div>
                        <div class="col-md-6">
                            <div class="card-tools float-right">
                                <button type="button" data-toggle="collapse" data-target="#container-table1"
                                    class="btn bg-gradient-info">
                                    <i class="fas fa-table"></i> Detalle
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <!-- canvas -->
                        <div class="col-md-12">
                            <canvas id="graficoegresos" class="chart-responsive-lg"></canvas>
                        </div>
                    </div>
                </div>
                <div class="collapse" id="container-table1">
                    <div class="card-footer">
                        <div class="col-md-12">
                            <label class="mt-3">Tipo de Egresos:</label>
                            <select name="" id="tipoegreso" class="form-control float-right mb-2">
                            </select>

                            <p class="mt-3"><strong>Resumen de datos:</strong></p>
                            <table class="table table-striped text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">Mes</th>
                                        <th scope="col">Cantidad (S/)</th>
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
    const ctx = document.getElementById('graficoegresos').getContext('2d');

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

    const graficoegresos = new Chart(ctx, {
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
                    text: 'Egresos Anuales'
                }
            }
        }
    });

    function listarTipoEgresoG1(anionecesario) {
        var datos = {
            'op': 'DetEgresosAnioActual',
            'fechabuscar': anionecesario
        };
        $.ajax({
            url: 'controllers/Reporte.controller.php',
            type: 'GET',
            data: datos,
            success: function(result) {
                let resultado = JSON.parse(result);
                for (var i = 0; i < resultado.length; i++) {
                    fechaarray = resultado[i].fechaatencion;
                    tipoegreso = resultado[i].tipoegreso;
                    egresototal = resultado[i].egresototal;
                    const aleatorio = colores[i];

                    objeto1 = {
                        label: tipoegreso,
                        data: resultado[i].egresototal,
                        backgroundColor: [
                            aleatorio
                        ],
                        borderColor: [
                            aleatorio
                        ],
                        borderWidth: 1
                    };

                    if (objeto1.label == "Compras menores") {
                        var objeto2 = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

                        objeto2[(fechaarray - 1)] = objeto1.data;

                    }
                    fecharegistro.push(fechaarray); // por ver
                    graficoegresos.data.datasets[i] = objeto1;
                    graficoegresos.data.datasets[i].data[(fechaarray - 1)] = egresototal;
                }
                graficoegresos.update();
            }
        });
    }

    function aniocargar() {
        datos = {
            'op': 'cargarAniosEgresos'
        };
        $.ajax({
            url: 'controllers/Reporte.controller.php',
            type: 'GET',
            data: datos,
            success: function(result) {
                $("#fechabuscar").html(result);
                egresosDisponibles("");
            }
        });
    }

    $("#fechabuscar").change(function() {

        graficoegresos.data.datasets = [];
        var fechabuscar = $(this).val();

        if (fechabuscar == "") {
            listarTipoEgresoG1("");
        } else {
            listarTipoEgresoG1(fechabuscar);
            egresosDisponibles(fechabuscar);
        }
        

    });

    function egresosDisponibles(fechabuscar){
        var datos = {
            'op': 'SelectEgresosTablaDetalle',
            'anio': fechabuscar
        };
        $.ajax({
            url: 'controllers/Reporte.controller.php',
            type: 'GET',
            data: datos,
            success: function(e) {
                $("#tipoegreso").html(e);
            }
        });
        $("#datosDetalle").html("");
    }

    $("#tipoegreso").change(function() {
        let anio = $("#fechabuscar").val();
        let tipoegreso = $("#tipoegreso").val();

        var datos = {
            'op': 'EgresosTablaDetalle',
            'anio': anio,
            'tipoegreso': tipoegreso
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

    listarTipoEgresoG1("");
    aniocargar();
</script>