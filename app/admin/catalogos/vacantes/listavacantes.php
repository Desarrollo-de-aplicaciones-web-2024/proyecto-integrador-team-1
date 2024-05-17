<?php
require_once '../../../../config/global.php';

define('RUTA_INCLUDE', '../../../../'); //ajustar a necesidad
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

    <!-- Cargar jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <?php getTopIncludes(RUTA_INCLUDE) ?>
    <style>
        .additional-info {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 10px;
            margin-top: 10px;
        }
    </style>
    <script>

        $(document).ready(function() {
            $('.dropdown-item').click(function() {
                console.log("Clic detectado en una opción de menú desplegable.");

                var selectedOption = $(this).text();
                console.log("Opción seleccionada: " + selectedOption);

                var contentToAdd = "";

                if (selectedOption === 'Empresas públicas') {
                    contentToAdd = '<div class="additional-info">' +
                        '  <p>Contenido para empresas públicas...</p>' +
                        '<p><b>Empresa</b>:Procuradoría General del Estado <br><b>vacantes</b>: 1 <br><b>Tipo</b>: Técnico en mantenimiento'
                        '</div>';
                } else if (selectedOption === 'Empresas privadas') {
                    contentToAdd = '<div class="additional-info">' +
                        '  <p>Contenido para empresas privadas...</p>' +
                        '  <p><b>Empresa</b>:Bimbo <br><b>vacantes</b>: 2 <br><b>Tipo</b>: Administrador de redes</p>' +
                        '</div>';
                }

                $('#content').html(contentToAdd);
            });
        });
    </script>
</head>

<body id="page-top">

<?php getNavbar() ?>

<div id="wrapper">

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Page Content -->
            <h1>Vacantes de empresas</h1>
            <hr>
            <p>Descubre aquí la lista de las vacantes de las distintas empresas en donde podrás hacer tus prácticas profesionales.<br>Recuerda que puedes escoger entre empresas públicas o privadas<br><b>NOTA</b>:Ten en cuenta que algunas vacantes pueden cambiar sin previo aviso.</b></p>

            <!-- Dropdown Menu -->
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Seleccionar Rubro
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Empresas públicas</a>
                    <a class="dropdown-item" href="#">Empresas privadas</a>
                </div>
            </div>

            <!-- Contenido -->
            <div id="content"></div>

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
