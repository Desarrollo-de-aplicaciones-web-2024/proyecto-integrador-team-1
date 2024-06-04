<?php
require_once '../../../config/global.php';
require_once '../../../config/db.php';

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



        .contenedor-icono svg{
            width: 35px;
            height: 35px;
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
            <div class="container">
                <h4><b>Archivos por subir</b></h4>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="align-middle">Archivos</th>
                        <th class="align-middle text-center">Estatus</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="align-middle" >Solicitud para realización de prácticas profesionales <a href="Solicitud.php" download="Solicitud Practicas Profesionales" class="contenedor-icono" type="button" id="boton-descarga"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 16 16">
                                    <path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
                                    </svg></a>
                            <a a href="Formulario_Registro_Dato.php" download="Solicitud para realización de prácticas profesionales" class="contenedor-icono" type="button" id="boton-subida"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-up" viewBox="0 0 16 16">
                                    <path d="M8.5 11.5a.5.5 0 0 1-1 0V7.707L6.354 8.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 7.707z"/>
                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
                                    </svg>
                        </td>

                        <td class="align-middle text-center" ><p class="text-danger">Rechazado</p></td>
                    </tr>
                    <tr>
                        <td class="align-middle">Plan de trabajo de prácticas profesionales
                                    <a href="" download="Plan de trabajo de prácticas profesionales" class="contenedor-icono" id> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 16 16">
                                    <path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
                                    </svg></a>
                                    <a href="" class="contenedor-icono"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-up" viewBox="0 0 16 16">
                                            <path d="M8.5 11.5a.5.5 0 0 1-1 0V7.707L6.354 8.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 7.707z"/>
                                            <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
                                        </svg></a>
                                </td>
                        <td class="align-middle text-center" ><p class="text-success">Aceptado</p></td>
                    </tr>
                    <tr>
                        <td class="align-middle">Carta de Aceptación  <a href="Formulario_Registro_Dato.php" download="Carta de Aceptación" class="contenedor-icono"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 16 16">
                                    <path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
                                </svg></a>
                            <a href="" class="contenedor-icono"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-up" viewBox="0 0 16 16">
                                    <path d="M8.5 11.5a.5.5 0 0 1-1 0V7.707L6.354 8.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 7.707z"/>
                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
                                </svg></a>
                        </td>
                        <td class="align-middle text-center" ><p class="text-warning">Pendiente</p></td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="d-flex flex-column" style="height: 15vh;">
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

<script>


</script>
</body>

</html>
