<?php
require_once '../../../../config/global.php';

define('RUTA_INCLUDE', '../../../../'); // ajustar a necesidad
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo htmlspecialchars(PAGE_TITLE); ?></title>

    <!-- Cargar jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <?php getTopIncludes(RUTA_INCLUDE); ?>
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
            // Tu código JavaScript aquí
        });
    </script>
</head>

<body id="page-top">

<?php getNavbar(); ?>

<div id="wrapper">

    <?php getSidebar(); ?>

    <div id="content-wrapper">

        <div class="container-fluid">
            <section class="jumbotron text-center">
                <div class="container">
                    <h1 class="jumbotron-heading">Vacantes de empresas</h1>
                    <p class="lead text-muted">Aquí encontrarás una lista de las distintas vacantes disponibles en diferentes empresas</br><b>NOTA:</b> la información desplegada puede cambiar sin previo aviso.</p>
                </div>
            </section>

            <div class="album py-5 bg-light">
                <div class="container">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <img src="https://via.placeholder.com/300" class="card-img-top" alt="Placeholder image">
                                <div class="card-body">
                                    <p class="card-text"><b>Empresa:</b> Grupo Bimbo<br><b>Giro:</b> Panificadora a nivel nacional<br><b>Vacante:</b> Administración de redes</p>

                                </div>
                            </div>
                        </div>

                        <!-- tarjeta 2 -->
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <img src="ruta/a/la/imagen2.jpg" class="card-img-top" alt="Descripción de la imagen">
                                <div class="card-body">
                                    <p class="card-text"><b>Empresa:</b> Grupo Tony<br><b>Giro:</b> Papelería y oficina<br><b>Vacante:</b> Administrador de BD</p>

                                </div>
                            </div>
                        </div>


                        <!-- Nueva tarjeta 3 -->
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <img src="ruta/a/la/imagen3.jpg" class="card-img-top" alt="Descripción de la imagen">
                                <div class="card-body">
                                    <p class="card-text"><b>Empresa:</b> Grupo Chedraui<br><b>Giro:</b> Supermercado<br><b>Vacante:</b> Gestor de comunicaciones</p>

                                </div>
                            </div>
                        </div>


                        <!-- empresa 4 -->
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <img src="ruta/a/la/imagen4.jpg" class="card-img-top" alt="Descripción de la imagen">
                                <div class="card-body">
                                    <p class="card-text"><b>Empresa:</b> Telmex<br><b>Giro:</b> Telefonía e Internet<br><b>Vacante:</b> Desarrollador Web</p>

                                </div>
                            </div>
                        </div>
                        <!-- Fin de la nueva tarjeta 4 -->

                        <!-- empresa 5 -->
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <img src="ruta/a/la/imagen5.jpg" class="card-img-top" alt="Descripción de la imagen">
                                <div class="card-body">
                                    <p class="card-text"><b>Empresa:</b> Grupo Lala<br><b>Giro:</b> Lácteos<br><b>Vacante:</b> Analista de Datos</p>

                                </div>
                            </div>
                        </div>
                        <!-- Fin de la nueva tarjeta 5 -->

                        <!-- empresa 6 -->
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <img src="ruta/a/la/imagen6.jpg" class="card-img-top" alt="Descripción de la imagen">
                                <div class="card-body">
                                    <p class="card-text"><b>Empresa:</b> Centro MICRONA<br><b>Giro:</b> Centro de investigación<br><b>Vacante:</b> Coordinador de Logística</p>

                                </div>
                            </div>
                        </div>
                        <!-- Fin de la nueva tarjeta 6-->

                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

        <?php getFooter(); ?>

    </div>
    <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<?php getModalLogout(); ?>

<?php getBottomIncudes(RUTA_INCLUDE); ?>
</body>

</html>
