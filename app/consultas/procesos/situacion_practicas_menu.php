<?php
require_once '../../../config/global.php';
require_once '../../../config/db.php';

define('RUTA_INCLUDE', '../../../'); //ajustar a necesidad

$sql = "SELECT * FROM usuarios_alumno";

$sql2 = "SELECT nombre, Tipo_Doc, Fecha 
FROM Reporte_Mensual JOIN usuarios_alumno ON Reporte_Mensual.Alumno = usuarios_alumno.matricula 
WHERE Reporte_Mensual.Estatus = 'Pendiente';
";
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="https://fonts.googleapis.com/css2?family=Liberation+Sans&display=swap" rel="stylesheet">
    <!-- Bootstrap 5.1 CSS -->

    <title><?php echo PAGE_TITLE ?></title>


    <?php getTopIncludes(RUTA_INCLUDE ) ?>
    <style>
        .table-hover tbody tr:hover {
            color: #007faf;
            cursor: pointer; /* Change cursor to pointer on hover */
        }

        .my-custom-font {
            font-family: 'Liberation Sans', sans-serif;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .table td, .table th {
            vertical-align: middle;
        }
        .status-badge {
            display: inline-block;
            padding: .35em .65em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: .25rem;
        }
        .ready-for-review {
            background-color: #ffc107;
            color: #212529;
        }
        .draft {
            background-color: #17a2b8;
            color: #fff;
        }
        .ready-for-editing {
            background-color: #28a745;
            color: #fff;
        }

    </style>

</head>

<body id="page-top">

<?php getNavbar() ?>

<div id="wrapper">

    <?php getSidebar() ?>

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Page Content -->

            <div class="container mt-5 mb-4">
                <div class="mt-5 mb-3 text-center">
                    <h1 class="">Situación de Prácticas Profesionales</h1>

                </div>
                <hr>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Consultar situación</h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive mt-3 mb-3">
                                    <table class="table table-hover dataTable">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Empresa</th>
                                                <th>Etapa</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                                $resultado = mysqli_query($conexion, $sql);
                                                $encontrados = mysqli_num_rows($resultado);

                                                if($encontrados > 0){
                                                while ($fila=mysqli_fetch_assoc($resultado)){
                                            ?>

                                            <tr onclick="window.location.href='situacion_practicas_alumno.php?matricula=<?php echo $fila['matricula']; ?>'">
                                                <td><?php echo $fila['matricula']?></td>
                                                <td><?php echo $fila['nombre']?></td>
                                                <td>Documentos Finales</td>
                                            </tr>

                                            <?php } ?>

                                        </tbody>
                                    </table>

                                    <?php
                                    }else{
                                        echo "<div class='alert alert-warning mt-5'>No hay alumnos</div>";
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Documentos pendientes<span class="badge ml-2" style="color: #ffffff; background-color: #1c81f8;">
                                        <?php
                                            $resultado2 = mysqli_query($conexion, $sql2);
                                            $encontrados2 = mysqli_num_rows($resultado2);
                                            echo $encontrados2
                                        ?>
                                    </span></h5>
                            </div
                            <div class="card-body p-0">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">

                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="content-items" role="tabpanel" aria-labelledby="content-items-tab">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Documento</th>
                                                <th style="width: 100px;">Fecha</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php

                                            if($encontrados2 > 0){
                                            while ($fila2=mysqli_fetch_assoc($resultado2)){
                                            ?>

                                            <tr>
                                                <td><?php echo $fila2['nombre']?></td>
                                                <td><?php echo $fila2['Tipo_Doc']?></td>
                                                <td><?php echo $fila2['Fecha']?></td>
                                            </tr>

                                            <?php } ?>

                                        </table>

                                        <?php
                                        }else{
                                            echo "<div class='alert alert-warning mt-5'>No hay alumnos</div>";
                                        }
                                        ?>

                                    </div>
                                    <div class="tab-pane fade" id="editions" role="tabpanel" aria-labelledby="editions-tab">
                                        <!-- Content for editions tab -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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

<?php getBottomIncudes( RUTA_INCLUDE ) ?>


</body>

</html>
