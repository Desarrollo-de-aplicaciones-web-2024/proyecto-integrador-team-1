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

    <?php getTopIncludes(RUTA_INCLUDE ) ?>
</head>

<body id="page-top">

<?php getNavbar() ?>

<div id="wrapper">

    <?php getSidebar() ?>

    <div id="content-wrapper">

        <div class="container-fluid">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Catálogos</li>
                    <li class="breadcrumb-item active" aria-current="page">Empresas</li>
                </ol>
            </nav>

            <!-- <div class="alert alert-success" role="alert">
                <i class="fas fa-check"></i> Mensaje de éxito
            </div>

            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle"></i> Mensaje de error
            </div>
            -->
            <div class="row my-3">
                <div class="col text-right">
                    <button type="button" class="btn btn-success"><i class="fas fa-plus"></i> Agregar Empresa</button>
                </div>
            </div>

            <div class="table-responsive mb-3">
                <table class="table table-bordered dataTable">
                    <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Nombre de la Empresa</th>
                        <th>Sector</th>
                        <th>Número de Teléfono</th>
                        <th>Dirección</th>
                        <th>Disponibilidad</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tbody>
                    <tr>
                        <td><img src="/img/274460.svg" alt="Logo de Tamsa" class="logo" style="max-width: 100px;"></td>
                        <td>TENARIS TAMSA</td>
                        <td>Industrial</td>
                        <td>229 989 1100</td>
                        <td>Carretera México-Veracruz KM433.7 Industrial,Bruno Pagliai, 91697 Pagliai, Ver.</td>
                        <td>No Disponible</td>
                        <td><a href="#" class="btn btn-link btn-sm">Editar</a> <a href="#" class="btn btn-link btn-sm">Eliminar</a></td>
                    </tr>
                    <tr>
                        <td><img src="/img/coca_cola_femsa.jpg" alt="Logo de Tamsa" class="logo" style="max-width: 100px;"></td>
                        <td>Coca-cola FEMSA</td>
                        <td>Bebidas</td>
                        <td>229 123 5400</td>
                        <td>P.º Ejército Mexicano Pte., Boca del Río, 94297 Boca del Río,Ver.</td>
                        <td>Disponible</td>
                        <td><a href="#" class="btn btn-link btn-sm">Editar</a> <a href="#" class="btn btn-link btn-sm">Eliminar</a></td>
                    </tr>
                    <tr>
                        <td><img src="/img/grupo_mas.png" alt="Logo de Tamsa" class="logo" style="max-width: 100px;"></td>
                        <td>GRUPO MAS</td>
                        <td>Agua y Saneamiento</td>
                        <td>229 454 6550</td>
                        <td>Santos Pérez Abascal 1170, Moderno, 91918 Veracruz, Ver.</td>
                        <td>Disponible</td>
                        <td><a href="#" class="btn btn-link btn-sm">Editar</a> <a href="#" class="btn btn-link btn-sm">Eliminar</a></td>
                    </tr>
                    <tr>
                        <td><img src="/img/Logo_de_la_Universidad_Veracruzana.svg" alt="Logo de Tamsa" class="logo" style="max-width: 50px;"></td>
                        <td>UV Microna</td>
                        <td>Tecnología y la ciencia aplicada</td>
                        <td>229 775 2000</td>
                        <td>Bv. Adolfo Ruíz Cortines 455, Costa Verde, 94294 Boca del Río, Ver.</td>
                        <td>Disponible</td>
                        <td><a href="#" class="btn btn-link btn-sm">Editar</a> <a href="#" class="btn btn-link btn-sm">Eliminar</a></td>
                    </tr>
                    </tbody>
                </table>
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

