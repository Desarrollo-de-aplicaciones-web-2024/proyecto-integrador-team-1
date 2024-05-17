<?php
require_once '../../../config/global.php';

define('RUTA_INCLUDE', '../../../'); // ajustar a necesidad
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="estilos.css" >

    <title><?php echo "Documentos Iniciales" ?></title>

    <?php getTopIncludes(RUTA_INCLUDE) ?>

    <style>
        .circle-pendiente{
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: 	#FF8000;
            display: inline-block;
            margin-right: 10px;
        }

        .circle-aprobado{
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: #008000;
            display: inline-block;
            margin-right: 10px;
        }

        .circle-rechazado{
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: #FF0000;
            display: inline-block;
            margin-right: 10px;
        }
    </style>
</head>

<body id="page-top">

<?php getNavbar() ?>

<div id="wrapper">

    <?php getSidebar();?>

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Page Content -->
            <h1>Documentos Iniciales</h1>
            <hr>
            <p><b>En este espacio descargarás los documentos necesarios para el inicio de tus prácticas
                    profesionales, así como también realizar la solicitud de la carta de presentación.</p></b>
            <div class="alert alert-info" role="alert">
                <strong>Nota:</strong>
                <ul class="mb-0">
                    <li>Las firmas, datos del alumno y demás involucrados se observen claramente.</li>
                    <li>No subir archivos manchados o maltratados.</li>
                    <li>Recuerda tu periodo de prácticas comienza al momento de que los documentos sean validados por el aseguramiento de calidad.</li>
                </ul>
            </div>
            <b><h4>Archivos por subir</b><br></h4>
            <div class="list-group">
                <div class="list-group-item d-flex align-items-center">
                    <div class="circle-pendiente"></div>
                    <p class="mb-0">Solicitud para realización de prácticas profesionales</p>
                </div>
                <div class="list-group-item d-flex align-items-center">
                    <div class="circle-aprobado"></div>
                    <p class="mb-0">Plan de trabajo de prácticas profesionales</p>
                </div>
                <div class="list-group-item d-flex align-items-center">
                    <div class="circle-rechazado"></div>
                    <p class="mb-0">Carta de Aceptación</p>
                </div>
            </div>
            <div class="row my-3 justify-content-center">
                <div class="col-auto">
                    <button type="button" class="btn btn-primary">Descargar archivos</button>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-primary">Subir Archivos</button>
                </div>
            </div>

            <div class="d-flex flex-column" style="height: 10vh;">
                <div class="flex-grow-1"></div>
                <div class="row my-3">
                    <div class="col text-right">
                        <button type="button" class="btn btn-danger">Salir</button>
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

<?php getBottomIncudes(RUTA_INCLUDE) ?>
</body>

</html>
