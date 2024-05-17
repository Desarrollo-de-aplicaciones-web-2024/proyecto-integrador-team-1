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
    <link rel="stylesheet" href="estilos.css">

    <title><?php echo "Documentos Iniciales" ?></title>


    <?php getTopIncludes(RUTA_INCLUDE ) ?>
</head>

<body id="page-top">

<?php getNavbar() ?>

<div id="wrapper">

    <?php getSidebar() ?>

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Page Content -->
            <h1>Documentos Iniciales</h1>
            <hr>
            <p><b>En este espacio descargarás los documentos necesarios para el inicio de tus prácticas
                    profesionales, asi como tambián realizar la solicitud de la carta de presentación.</p></b>
            <p>Nota:<br>
                <ul>
                <li type="disc">Las firmas, datos del alumno y demas involucrados se observen claramente.<br></li>
                <li type="disc">No subir archivos manchados o maltratados.<br></li>
                <li type="disc">Recuerda tu periodo de prácticas comienza al momento de que los documentos sean validados por el aseguramiento de calidad.</p></li>
            </ul>
            <b><p class="col text-center">Archivos por subir</p></b>

            <b><p class="col text-center">Solicitud para realización de practicas profesionales</p></b>
            <b><p class="col text-center">Plan de trabajo de practicas profesionales</p></b>
            <b><p class="col text-center">Carta de Aceptación</p></b>
            <div class="row my-3">
                <div class="col text-left">
                    <button type="button" class="btn btn-primary"> Descargar archivos</button>
                </div>

                <div class="col text-right">
                    <button type="button" class="btn btn-primary" > Subir Archivos</button>
                </div>
            </div>

            <div class="d-flex flex-column" style="height: 15vh;">
                <div class="flex-grow-1"></div>
                <div class="row my-3">
                    <div class="col text-right">
                        <button type="button" class="btn btn-primary">Salir</button>
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
