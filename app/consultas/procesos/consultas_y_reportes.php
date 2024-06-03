<?php
require_once '../../../config/global.php';
require_once '../../../config/db.php';
define('RUTA_INCLUDE', '../../../'); //ajustar a necesidad
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

        .btn-secondary {
            margin: 0 auto;
            display: block;
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

            <div class="row my-3">
                <div class="col">
                    <form id="consulta-form" class="form-inline">
                        <div class="form-group mb-2">
                            <select class="form-control" id="column-select">
                                <option value="id">ID</option>
                                <option value="alumno">Alumno</option>
                                <option value="carrera">Carrera</option>
                                <option value="semestre">Semestre</option>
                                <option value="inicio">Inicio</option>
                                <option value="fin">Fin</option>
                                <option value="horas">Horas</option>
                                <option value="empresa">Empresa</option>
                                <option value="departamento">Departamento</option>
                                <option value="supervisor">Supervisor</option>
                            </select>
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="search" class="sr-only">Buscar</label>
                            <input type="text" class="form-control" id="search" placeholder="Valor a buscar">
                        </div>
                    </form>
                </div>
            </div>

            <!-- Filtros de fecha -->
            <div class="row my-3" id="dateFilters" style="display: none;">
                <div class="col">
                    <div class="form-group">
                        <label for="day">Día:</label>
                        <input type="text" class="form-control" id="day" placeholder="Día" maxlength="2" min="1" max="31">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="month">Mes:</label>
                        <input type="text" class="form-control" id="month" placeholder="Mes" maxlength="2" min="1" max="12">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="year">Año:</label>
                        <input type="text" class="form-control" id="year" placeholder="Año" maxlength="4" min="1900" max="2100">
                    </div>
                </div>
            </div>

            <div class="table-responsive mb-3">
                <table class="table table-bordered dataTable" id="dataTable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Alumno</th>
                        <th>Carrera</th>
                        <th>Semestre</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>Horas</th>
                        <th>Empresa</th>
                        <th>Departamento</th>
                        <th>Supervisor</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>202160286</td>
                        <td>Bruno Rangel Zuñiga</td>
                        <td>Sistemas Computacionales</td>
                        <td>2do</td>
                        <td>16/05/2024</td>
                        <td>16/08/2024</td>
                        <td>240</td>
                        <td>Microna</td>
                        <td>TI</td>
                        <td>Dr. Jaime Martínez Castillo</td>
                    </tr>
                    <tr>
                        <td>202060597</td>
                        <td>Guillermo Mendez</td>
                        <td>Mecatrónica</td>
                        <td>6to</td>
                        <td>16/05/2021</td>
                        <td>09/02/2022</td>
                        <td>2</td>
                        <td>PEMEX</td>
                        <td>Jefatura</td>
                        <td>Dr. Sergio Roman</td>
                    </tr>
                    <tr>
                        <td>201960579</td>
                        <td>Abimael Ochoa</td>
                        <td>Psicología</td>
                        <td>8vo</td>
                        <td>06/05/2020</td>
                        <td>05/12/2020</td>
                        <td>5</td>
                        <td>TAMSA</td>
                        <td>Desarrollo</td>
                        <td>Dr. Pedro Mabil</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <!-- Canvas para la gráfica -->
            <div class="row">
                <div class="col">
                    <canvas id="myChart"></canvas>
                </div>
            </div>

        </div>

        <!-- /.container-fluid -->

        <?php getFooter() ?>

    </div>
    <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<?php getModalLogout() ?>

<?php getBottomIncudes(RUTA_INCLUDE) ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Datos estáticos para la gráfica
        const labels = ['ID', 'Alumno', 'Carrera', 'Semestre', 'Inicio', 'Fin', 'Horas', 'Empresa', 'Departamento', 'Supervisor'];
        const data = [3, 3, 3, 3, 3, 3, 3, 3, 3, 3]; // Cantidad de datos en cada columna

        // Crear la gráfica con Chart.js
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Cantidad de Datos por Columna',
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

        // Resto de la lógica para filtrar la tabla...

    });
</script>

</body>
</html>