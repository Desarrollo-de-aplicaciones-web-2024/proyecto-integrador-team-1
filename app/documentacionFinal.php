<?php
require_once '../config/global.php';


define('RUTA_INCLUDE', '../'); //ajustar a necesidad
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


    <?php getTopIncludes(RUTA_INCLUDE ) ?>
    <style>
        .circle {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: #007bff;
            display: inline-block;
            margin-right: 10px;
        }
    </style>
</head>

<body id="page-top">

<?php getNavbar() ?>

<div id="wrapper">

    <?php getSidebar() ?>

    <div id="content-wrapper">

        <div class="container-fluid">

            <div class="container mt-5">
                <!-- Page Content -->
                <h1 class="mb-4">Documentación Final</h1>
                <hr>
                <p>En este espacio descargarás los documentos necesarios para el final de tus prácticas
                    profesionales, así como llenar todos los documentos necesarios</p>

                <div class="alert alert-info" role="alert">
                    <strong>Nota:</strong>
                    <ul class="mb-0">
                        <li>Las firmas, datos del alumno y demás involucrados se observen claramente.</li>
                        <li>No subir archivos manchados o maltratados.</li>
                        <li>Recuerda tu periodo de prácticas comienza al momento de que los documentos sean validados por el aseguramiento de calidad.</li>
                    </ul>
                </div>

                <h2 class="mt-4">Archivos por Subir</h2>

                <div class="list-group">
                    <div class="list-group-item d-flex align-items-center">
                        <div class="circle"></div>
                        <p class="mb-0">Solicitud para realización de prácticas profesionales</p>
                    </div>
                    <div class="list-group-item d-flex align-items-center">
                        <div class="circle"></div>
                        <p class="mb-0">Plan de trabajo de prácticas profesionales</p>
                    </div>
                    <div class="list-group-item d-flex align-items-center">
                        <div class="circle"></div>
                        <p class="mb-0">Carta de Aceptación</p>
                    </div>
                </div>

                <div class="mt-4 p-3 text-center">
                    <button class="btn btn-primary mr-2" value="Descargar">Descargar</button>
                    <button class="btn btn-success mr-2" value="Subir">Subir</button>
                    <button class="btn btn-danger" value="Salir">Salir</button>
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
