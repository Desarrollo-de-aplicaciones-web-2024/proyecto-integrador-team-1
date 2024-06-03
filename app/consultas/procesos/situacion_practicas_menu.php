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
                                    <table class="table dataTable">
                                        <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Empresa</th>
                                            <th>Etapa</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Elvis Gamboa Quiroz</td>
                                            <td>TENARIS TAMSA</td>
                                            <td>Documentos finales</td>
                                        </tr>
                                        <tr>
                                            <td>Irving López García</td>
                                            <td>Grupo Mimpo</td>
                                            <td>Documentos finales</td>
                                        </tr>
                                        <tr>
                                            <td>Bruno Rangel Zuñiga</td>
                                            <td>Grupo MAS</td>
                                            <td>2do Reporte Mensual</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Documentos recientes</h5>

                            </div>
                            <div class="card-body p-0">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">

                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="content-items" role="tabpanel" aria-labelledby="content-items-tab">
                                        <table class="table mb-0">
                                            <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Documento</th>
                                                <th style="width: 100px;">Fecha</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>Irving de Jesús López García</td>
                                                <td>Reporte Final</td>
                                                <td>5/31/2024</td>
                                            </tr>
                                            <tr>
                                                <td>Elvis Gamboa Quiroz</td>
                                                <td>Reporte Final</td>
                                                <td>5/31/2024</td>
                                            </tr>
                                            <tr>
                                                <td>Bruno Rangel Zuñiga</td>
                                                <td>2do Reporte Mensual</td>
                                                <td>5/31/2024</td>
                                            </tr>
                                        </table>
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
