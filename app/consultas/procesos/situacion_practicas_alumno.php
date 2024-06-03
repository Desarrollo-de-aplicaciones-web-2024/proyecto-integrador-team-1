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

        .step {
            list-style: none;
            margin: .2rem 0;
            width: 100%;
        }

        .step .step-item {
            -ms-flex: 1 1 0;
            flex: 1 1 0;
            margin-top: 0;
            min-height: 1rem;
            position: relative;
            text-align: center;
        }

        .step .step-item:not(:first-child)::before {
            background: #0069d9;
            content: "";
            height: 2px;
            left: -50%;
            position: absolute;
            top: 9px;
            width: 100%;
        }

        .step .step-item a {
            color: #000000;
            display: inline-block;
            padding: 20px 10px 0;
            text-decoration: none;
        }

        .step .step-item a::before {
            background: #0069d9;
            border: .1rem solid #fff;
            border-radius: 50%;
            content: "";
            display: block;
            height: .9rem;
            left: 50%;
            position: absolute;
            top: .2rem;
            transform: translateX(-50%);
            width: .9rem;
            z-index: 1;
        }

        .step .step-item.active a::before {
            background: #fff;
            border: .1rem solid #0069d9;
        }

        .step .step-item.active ~ .step-item::before {
            background: #e7e9ed;
        }

        .step .step-item.active ~ .step-item a::before {
            background: #e7e9ed;
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

            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="mt-5 mb-5 text-center">
                            <h1 class="">Situación de Prácticas Profesionales</h1>
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="mt-5 bi bi-person" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                            </svg>

                            <h4 class="mt-2">Bruno Rangel Zuñiga</h4>
                            <h5 class="">Grupo Mimpo</h5>
                        </div>
                    </div>

                </div>
                <div class="container" id="myGroup">
                    <ul id="myList" class="step d-flex flex-nowrap">
                        <li class="step-item button-li" data-toggle="collapse" data-target="#collapse1">
                            <a href="#!" class="">Documentos</a>
                            <p href="#!" class="">Iniciales</p>
                        </li>
                        <li class="step-item button-li" data-toggle="collapse" data-target="#collapse2">
                            <a href="#!" class="">1er Reporte</a>
                            <p href="#!" class="">Mensual</p>
                        </li>
                        <li class="step-item active" data-toggle="collapse" data-target="#collapse3">
                            <a href="#!" class="">2do Reporte</a>
                            <p href="#!" class="">Mensual</p>
                        </li>
                        <li class="step-item" data-toggle="collapse" data-target="#collapse4">
                            <a href="#!" class="">3er Reporte</a>
                            <p href="#!" class="">Mensual</p>
                        </li>
                        <li class="step-item" data-toggle="collapse" data-target="#collapse5">
                            <a href="#!" class="">Documentos</a>
                            <p href="#!" class="">Finales</p>
                        </li>
                    </ul>

                    <div class="mt-4 panel-group">
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fas fa-table"></i>
                                Tabla de documentos
                            </div>
                            <div class="card-body">
                                <div id="collapse1" class="panel-collapse collapse" data-parent="#myGroup">
                                    <div class="table-responsive table-hover">
                                        <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                                            <thead>
                                            <tr>
                                                <th>Documento</th>
                                                <th>Fecha de subida</th>
                                                <th>Encargado de revisión</th>
                                                <th>Fecha de revisión</th>
                                                <th>Estatus</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>Solicitud de prácticas</td>
                                                <td>12/05/2024</td>
                                                <td>María del Carmen Aguirre</td>
                                                <td>15/05/2024</td>
                                                <td class="text-success">Aceptado</td>
                                            </tr>
                                            <tr>
                                                <td>Plan de trabajo</td>
                                                <td>12/05/2024</td>
                                                <td>María del Carmen Aguirre</td>
                                                <td>15/05/2024</td>
                                                <td class="text-danger">Rechazado</td>
                                            </tr>
                                            <tr>
                                                <td>Carta de Aceptación</td>
                                                <td>15/05/2024</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td class="text-warning">Pendiente</td>
                                            </tr>
                                            <tr>
                                                <td>Carta de Recomendación</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td class="text-secondary">Sin subir</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div id="collapse2" class="panel-collapse collapse" data-parent="#myGroup">
                                    <div class="table-responsive table-hover">
                                        <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                                            <thead>
                                            <tr>
                                                <th>Documento</th>
                                                <th>Fecha de subida</th>
                                                <th>Encargado de revisión</th>
                                                <th>Fecha de revisión</th>
                                                <th>Estatus</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>1er Reporte Mensual</td>
                                                <td>12/05/2024</td>
                                                <td>María del Carmen Aguirre</td>
                                                <td>15/05/2024</td>
                                                <td class="text-success">Aceptado</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div id="collapse3" class="panel-collapse collapse-in" data-parent="#myGroup">
                                    <div class="table-responsive table-hover">
                                        <table class="table table-bordered" id="dataTable3" width="100%" cellspacing="0">
                                            <thead>
                                            <tr>
                                                <th>Documento</th>
                                                <th>Fecha de subida</th>
                                                <th>Encargado de revisión</th>
                                                <th>Fecha de revisión</th>
                                                <th>Estatus</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr onclick="window.location='revision_documento.php'">
                                                <td>2do Reporte Mensual</td>
                                                <td>17/05/2024<td>
                                                <td>-</td>
                                                <td class="text-warning">Pendiente</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div id="collapse4" class="panel-collapse collapse" data-parent="#myGroup">
                                    <div class="table-responsive">
                                        <div class="alert alert-danger" role="alert">
                                            El alumno no ha completado un proceso anterior
                                        </div>

                                    </div>
                                </div>

                                <div id="collapse5" class="panel-collapse collapse" data-parent="#myGroup">
                                    <div class="table-responsive">
                                        <div class="alert alert-danger" role="alert">
                                            El alumno no ha completado un proceso anterior
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="card-footer small text-muted"></div>
                        </div>
                    </div>
                </div>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    $(document).ready(function(){
                        // Show collapse3 on page load
                        $('#collapse3').collapse('show');

                        // When a collapse is shown
                        $('.button-li').on('shown.bs.collapse', function () {
                            var target = $(this).data('target');
                            if (target !== '#collapse3') {
                                $('#collapse3').collapse('hide');
                            }
                        });
                    });
                </script>


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

<!--

            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="testfile.pdf" allowfullscreen></iframe>
            </div>

Aspect ratios can be customized with modifier classes.

<div class="embed-responsive embed-responsive-21by9">
    <iframe class="embed-responsive-item" src="testfile.pdf"></iframe>
</div>

<div class="embed-responsive embed-responsive-16by9">
    <iframe class="embed-responsive-item" src="testfile.pdf"></iframe>
</div>

<div class="embed-responsive embed-responsive-4by3">
    <iframe class="embed-responsive-item" src="testfile.pdf"></iframe>
</div>

<div class="embed-responsive embed-responsive-1by1">
    <iframe class="embed-responsive-item" src="testfile.pdf"></iframe>
</div>

!>