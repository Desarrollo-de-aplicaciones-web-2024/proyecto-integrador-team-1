<?php
require_once '../../../config/global.php';
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
</head>

<body id="page-top">

<?php getNavbar() ?>

<div id="wrapper">

    <?php getSidebar() ?>

    <div id="content-wrapper">

        <div class="container-fluid">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Academia</li>
                    <li class="breadcrumb-item active" aria-current="page">Consultas y reportes</li>
                </ol>
            </nav>

            <div class="row my-3">
                <div class="col">
                    <form id="consulta-form" class="form-inline">
                        <div class="form-group mb-2">
                            <label for="alumno-id" class="sr-only">ID del Alumno</label>
                            <input type="text" class="form-control" id="alumno-id" placeholder="ID del Alumno">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="empresa-id" class="sr-only">ID de la Empresa</label>
                            <input type="text" class="form-control" id="empresa-id" placeholder="ID de la Empresa">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Consultar</button>
                    </form>
                </div>
            </div>

            <div class="table-responsive mb-3">
                <style>
                    th, td {
                        text-align: center;
                    }

                    th {
                        background-color: #016CA1;
                        color: white;
                    }
                </style>
                <table class="table table-bordered dataTable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Alumno</th>
                        <th>Carrera</th>
                        <th>Semestre</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>Horas</th>
                        <th>ID Empresa</th>
                        <th>Empresa</th>
                        <th>Departamento</th>
                        <th>Supervisor</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>6</td>
                        <td>Bruno Rangel Zuñiga</td>
                        <td>Ing. en Sistemas Computacionales</td>
                        <td>6to</td>
                        <td>16/05/2024</td>
                        <td>16/08/2024</td>
                        <td>240</td>
                        <td>54</td>
                        <td>Microna</td>
                        <td>TI</td>
                        <td>Dr. Jaime Martínez Castillo</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>Guillermo Mendez</td>
                        <td>Ing. en Sistemas Computacionales</td>
                        <td>6to</td>
                        <td>16/05/2024</td>
                        <td>16/08/2024</td>
                        <td>2</td>
                        <td>8</td>
                        <td>PEMEX</td>
                        <td>Jefatura</td>
                        <td>Dr. Jaime Martínez Castillo</td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>Abimael Ochoa</td>
                        <td>Ing. en Sistemas Computacionales</td>
                        <td>6to</td>
                        <td>16/05/2024</td>
                        <td>16/08/2024</td>
                        <td>5</td>
                        <td>4</td>
                        <td>TAMSA</td>
                        <td>Desarrollo</td>
                        <td>Dr. Jaime Martínez Castillo</td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
        <div class="row my-3">
            <div class="col text-center">
                <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Generar reporte</button>
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
</body>

</html>