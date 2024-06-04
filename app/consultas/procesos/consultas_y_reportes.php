<?php
require_once '../../../config/global.php';
require_once '../../../config/db.php';
define('RUTA_INCLUDE', '../../../'); // Ajustar a necesidad

$columns = [];
$sql_columns = "SHOW COLUMNS FROM alumnos_B";
$result_columns = mysqli_query($conexion, $sql_columns);
while ($row = mysqli_fetch_assoc($result_columns)) {
    $column_name = $row['Field'];
    if (!in_array($column_name, ['id_alumno', 'fecha_inicio', 'fecha_fin', 'estado_practicas', 'id_empresa'])) {
        $columns[] = $column_name;
    }
}

$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';
$estado = isset($_GET['estado']) ? $_GET['estado'] : '';
$empresa = isset($_GET['empresa']) ? $_GET['empresa'] : '';
$carrera = isset($_GET['carrera']) ? $_GET['carrera'] : '';

$empresas = [];
$sql_empresas = "SELECT id_empresa, nombre FROM empresas_B";
$result_empresas = mysqli_query($conexion, $sql_empresas);
while ($row = mysqli_fetch_assoc($result_empresas)) {
    $empresas[] = $row;
}

$carreras = [];
$sql_carreras = "SELECT DISTINCT carrera FROM alumnos_B";
$result_carreras = mysqli_query($conexion, $sql_carreras);
while ($row = mysqli_fetch_assoc($result_carreras)) {
    $carreras[] = $row;
}

$filters_applied = !empty($start_date) || !empty($end_date) || !empty($estado) || !empty($empresa) || !empty($carrera);

$empresa_counts = [];
if ($filters_applied) {
    $sql_count = "SELECT e.nombre, COUNT(*) as num_alumnos
                  FROM alumnos_B da
                  INNER JOIN empresas_B e ON da.id_empresa = e.id_empresa
                  WHERE 1=1";

    if (!empty($start_date) && !empty($end_date)) {
        $sql_count .= " AND da.fecha_inicio >= '$start_date' AND da.fecha_fin <= '$end_date'";
    }
    if (!empty($estado)) {
        $sql_count .= " AND da.estado_practicas = '$estado'";
    }
    if (!empty($empresa)) {
        $sql_count .= " AND e.nombre = '$empresa'";
    }
    if (!empty($carrera)) {
        $sql_count .= " AND da.carrera = '$carrera'";
    }
    $sql_count .= " GROUP BY e.nombre ORDER BY num_alumnos DESC LIMIT 3";

    $result_count = mysqli_query($conexion, $sql_count);
    while ($row = mysqli_fetch_assoc($result_count)) {
        $empresa_counts[] = $row;
    }
}

// Obtener los datos para el gráfico circular general
$empresa_general_counts = [];
$sql_general = "SELECT e.nombre, COUNT(*) as num_alumnos
                FROM alumnos_B da
                INNER JOIN empresas_B e ON da.id_empresa = e.id_empresa
                GROUP BY e.nombre
                ORDER BY num_alumnos DESC";

$result_general = mysqli_query($conexion, $sql_general);
while ($row = mysqli_fetch_assoc($result_general)) {
    $empresa_general_counts[] = $row;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo PAGE_TITLE ?></title>

    <?php getTopIncludes(RUTA_INCLUDE) ?>
    <style>
        th, td {
            text-align: center;
        }
        th {
            background-color: #016CA1;
            color: white;
        }
         margin: 0 auto;
            display: block;
        }
        {
            width: 70%;
            margin: auto;
        }
        {
            display: none;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body id="page-top">

<?php getNavbar() ?>

<div id="wrapper">

    <?php getSidebar($rutas)?>

    <div id="content-wrapper">
        <div class="container-fluid">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Academia</li>
                    <li class="breadcrumb-item active" aria-current="page">Consultas y reportes de Practicantes</li>
                </ol>
            </nav>

            <div class="row">
                <?php if (!empty($empresa_counts)): ?>
                    <div class="col-lg-4">
                        <canvas id="chart1"></canvas>
                    </div>
                    <div class="col-lg-4">
                        <canvas id="chart2"></canvas>
                    </div>
                    <div class="col-lg-4">
                        <canvas id="chart3"></canvas>
                    </div>
                <?php endif; ?>
            </div>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"></li>
                </ol>
            </nav>

            <form method="GET" action="">
                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="filtro_columna">Lista de Carreras</label>
                        <select class="form-control" id="carrera" name="carrera">
                            <option value="" <?php echo $carrera == '' ? 'selected' : ''; ?>>Todas</option>
                            <?php foreach ($carreras as $carr): ?>
                                <option value="<?php echo htmlspecialchars($carr['carrera']); ?>" <?php echo $empresa == $carr['carrera'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($carr['carrera']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="estado">Estados de Practicas</label>
                        <select class="form-control" id="estado" name="estado">
                            <option value="" <?php echo $estado == '' ? 'selected' : ''; ?>>Todos</option>
                            <option value="Completado" <?php echo $estado == 'Completado' ? 'selected' : ''; ?>>
                                Completado
                            </option>
                            <option value="Cancelado" <?php echo $estado == 'Cancelado' ? 'selected' : ''; ?>>
                                Cancelado
                            </option>
                            <option value="En curso" <?php echo $estado == 'En curso' ? 'selected' : ''; ?>>En curso
                            </option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="start_date">Fecha de inicio</label>
                        <input type="date" class="form-control" id="start_date" name="start_date"
                               value="<?php echo htmlspecialchars($start_date); ?>">
                    </div>

                    <div class="form-group col-md-2">
                        <label for="end_date">Fecha de fin</label>
                        <input type="date" class="form-control" id="end_date" name="end_date"
                               value="<?php echo htmlspecialchars($end_date); ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="empresa">Empresa</label>
                        <select class="form-control" id="empresa" name="empresa">
                            <option value="" <?php echo $empresa == '' ? 'selected' : ''; ?>>Todas</option>
                            <?php foreach ($empresas as $emp): ?>
                                <option value="<?php echo htmlspecialchars($emp['nombre']); ?>" <?php echo $empresa == $emp['nombre'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($emp['nombre']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2 align-self-end">
                        <button type="submit" class="btn btn-primary">Aplicar Filtros</button>
                    </div>
                </div>
            </form>

            <div id="table-container" class="<?php echo $filters_applied ? '' : 'hidden'; ?>">
                <?php if ($filters_applied): ?>
                    <?php if ((empty($start_date) && !empty($end_date)) || (!empty($start_date) && empty($end_date))): ?>
                        <div class="alert alert-warning" role="alert">
                            Debe seleccionar tanto la fecha de inicio como la fecha de fin.
                        </div>
                    <?php endif; ?>
                        <div class="table-responsive mb-3">
                            <table class="table table-bordered dataTable">
                                <thead>
                                <tr>
                                    <th>Matricula</th>
                                    <th>Nombre</th>
                                    <th>Carrera</th>
                                    <th>Semestre</th>
                                    <th>Correo</th>
                                    <th>Inicio</th>
                                    <th>Fin</th>
                                    <th>Horas</th>
                                    <th>Empresa</th>
                                    <th>Departamento</th>
                                    <th>Supervisor</th>
                                    <th>Estado</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql = "SELECT u.matricula AS matricula, da.id_alumno, u.nombre, da.carrera, da.semestre, u.correo, da.fecha_inicio, da.fecha_fin, da.horas_acumuladas, e.nombre AS empresa, da.departamento, da.supervisor, da.estado_practicas 
FROM alumnos_B da
INNER JOIN usuarios_B u ON da.id_usuario = u.id_usuario
INNER JOIN empresas_B e ON da.id_empresa = e.id_empresa
WHERE 1=1";

                                if (!empty($start_date) && !empty($end_date)) {
                                    $sql .= " AND da.fecha_inicio >= '$start_date' AND da.fecha_fin <= '$end_date'";
                                }

                                if (!empty($estado)) {
                                    $sql .= " AND da.estado_practicas = '$estado'";
                                }
                                if (!empty($empresa)) {
                                    $sql .= " AND e.nombre = '$empresa'";
                                }
                                if (!empty($carrera)) {
                                    $sql .= " AND carrera = '$carrera'";
                                }

                                $result = mysqli_query($conexion, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($row['matricula']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['carrera']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['semestre']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['correo']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['fecha_inicio']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['fecha_fin']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['horas_acumuladas']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['empresa']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['departamento']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['supervisor']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['estado_practicas']) . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='11'>No se encontraron resultados</td>";
                                }

                                mysqli_close($conexion);
                                ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                    <div class="alert alert-info" role="alert">
                        Por favor seleccione algún filtro para mostrar los resultados.
                    </div>
                <?php endif; ?>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"></li>
                    </ol>
                </nav>
                    <div class="col-lg-12 text-center">
                        <label><b>Cantidad de practicantes en Empresas</b></label>
                        <canvas id="chartExtremos"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="footer">
    <?php getFooter() ?>
</footer>
<?php getModalLogout(RUTA_INCLUDE) ?>
<?php getBottomIncudes(RUTA_INCLUDE) ?>
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<script>
    <?php if (!empty($empresa_counts)): ?>
    const empresaCounts = <?php echo json_encode($empresa_counts); ?>;
    const labels = empresaCounts.map(item => item.nombre);
    const data = empresaCounts.map(item => item.num_alumnos);

    new Chart(document.getElementById('chart1'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Alumnos por empresa',
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

    new Chart(document.getElementById('chart2'), {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                label: 'Alumnos por empresa',
                data: data,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true
        }
    });

    new Chart(document.getElementById('chart3'), {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                label: 'Alumnos por empresa',
                data: data,
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true
        }
    });

    <?php endif; ?>

    // Gráfico circular con todos los datos
    const empresaGeneralCounts = <?php echo json_encode($empresa_general_counts); ?>;
    const labelsGeneral = empresaGeneralCounts.map(item => item.nombre);
    const dataGeneral = empresaGeneralCounts.map(item => item.num_alumnos);

    new Chart(document.getElementById('chartExtremos'), {
        type: 'pie',
        data: {
            labels: labelsGeneral,
            datasets: [{
                label: 'Alumnos por empresa',
                data: dataGeneral,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true
        }
    });
</script>
</body>
</html>


