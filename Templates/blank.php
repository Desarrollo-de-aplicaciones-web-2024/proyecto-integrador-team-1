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
</head>

<body id="page-top">

<?php getNavbar() ?>

<div id="wrapper">

    <?php getSidebar() ?>

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Page Content -->
            <h1>Documentacion final</h1>
            <hr>
            <p>En este espacio descargarás los documentos necesarios para el inicio de tus prácticas
                profesionales, asi como tambián realizar la solicitud de la carta de presentación.</p>

            <p>Nota:</p>
            <ul>
                <li>Las firmas, datos del alumno y demás involucrados se observen claramente.</li>
                <li>No subir archivos manchados o maltratados.</li>
                <li>Recuerda tu periodo de prácticas comienza al momento de que los documentos sean validados por el aseguramiento de calidad.</li>
            </ul>

            <h2>Archivos por subir</h2>

            <div>
                <p>Solicitud para realizacion de practicas profesionales</p>
                <div></div>
            </div>

            <div>
                <p>Plan de trabajo de practicas profesionales</p>
                <div></div>
            </div>
        </div>

        <div>
            <p>Carta de Aceptación</p>
            <div></div>
        </div>

        <div>
            <button></button>
            <button></button>
            <button></button>

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
