<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("location: /index.php");
}
include_once("../CapaNegocio/estadisticareporte/capaNegocioEstadisticaReporte.php");
try{
    
}catch(PDOException $ex){
    echo  $ex->getMessage();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dr.LET</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
</head>

<?php
include_once("../plantilla.html");
?>
<body>
    <br>
<h1 class="h2 text-center pt-5 mt-4">ESTADISTICAS</h1>
<div class="container mt-3">
<div class="container mt-5">
    <h2 class="text-center">Trabajos Más Requeridos en Tratamientos por Mes y Año</h2>
    <form method="GET" class="form-inline mb-4">
        <div class="form-group">
            <label for="year" class="mr-2">Año:</label>
            <input type="number" class="form-control" id="year" name="year" value="<?php echo date('Y'); ?>" required>
        </div>
        <div class="form-group mx-sm-3">
            <label for="month" class="mr-2">Mes:</label>
            <input type="number" class="form-control" id="month" name="month" value="<?php echo date('m'); ?>" min="1" max="12" required>
        </div>
        <button type="submit" class="btn btn-primary">Trabajos Más Requeridos</button>
    </form>

    <?php
    // Procesar el formulario y mostrar el gráfico
    if (isset($_GET['year']) && isset($_GET['month'])) {
        $year = intval($_GET['year']);
        $month = intval($_GET['month']);

        $capaNegocioEstadisticaReporte = new capaNegocioEstadisticaReporte();
        $trabajos = $capaNegocioEstadisticaReporte->getTrabajosMasRequeridosPorMes($year, $month);

        $labels = [];
        $data = [];

        foreach ($trabajos as $trabajo) {
            $labels[] = $trabajo['nombre'];
            $data[] = $trabajo['cantidad'];
        }
    ?>
    <canvas id="myBarChart"></canvas>

    <script>
        var labels = <?php echo json_encode($labels); ?>;
        var data = <?php echo json_encode($data); ?>;

        var ctx = document.getElementById('myBarChart').getContext('2d');
        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Cantidad',
                    data: data,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <?php } ?>
</div>
</div>
<!-- Gráfica de Línea de Ingresos Mensuales -->
<div class="container mt-5">
    <h2 class="text-center">Ingresos Mensuales Basados en Tratamientos</h2>
    <form method="GET" class="form-inline mb-4">
        <div class="form-group mx-sm-3">
            <label for="year_ingresos" class="mr-2">Año:</label>
            <input type="number" class="form-control" id="year_ingresos" name="year_ingresos" value="<?php echo date('Y'); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Ingresos Mensuales</button>
    </form>

    <?php
    // Procesar el formulario y mostrar el gráfico de ingresos
    if (isset($_GET['year_ingresos'])) {
        $year_ingresos = intval($_GET['year_ingresos']);
        $capaNegocioEstadisticaReportea = new capaNegocioEstadisticaReporte();
        $ingresos = $capaNegocioEstadisticaReportea->getIngresosMensualesPorAno($year_ingresos);

        $ingresos_labels = [];
        $ingresos_data = [];

        foreach ($ingresos as $mes => $monto_total) {
            $ingresos_labels[] = $mes;
            $ingresos_data[] = $monto_total;
        }
    ?>
    <canvas id="myLineChart"></canvas>

    <script>
        var ingresos_labels = <?php echo json_encode($ingresos_labels); ?>;
        var ingresos_data = <?php echo json_encode($ingresos_data); ?>;

        var ctx = document.getElementById('myLineChart').getContext('2d');
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ingresos_labels,
                datasets: [{
                    label: 'Ingresos',
                    data: ingresos_data,
                    fill: false,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <?php } ?>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>