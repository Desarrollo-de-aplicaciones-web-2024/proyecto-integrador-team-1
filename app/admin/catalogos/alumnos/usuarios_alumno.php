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
                    <li class="breadcrumb-item active" aria-current="page">Nombre del catálogo</li>
                </ol>
            </nav>

           <!-- <div class="alert alert-success" role="alert">
                <i class="fas fa-check"></i> Mensaje de éxito
            </div>

            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle"></i> Mensaje de error
            </div> -->

            <div class="row my-3">
                <div class="col text-right">
                    <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo</button>
                </div>
            </div>

            <div class="table-responsive mb-3">
                <table class="table table-bordered dataTable">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Fecha de inicio</th>
                        <th>Etapa</th>
                        <th>Empresa</th>
                        <th>Supervisor</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Fecha de inicio</th>
                        <th>Etapa</th>
                        <th>Empresa</th>
                        <th>Supervisor</th>
                        <th>Acciones</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <tr>
                        <td>Ximena Ruiz de la Peña</td>
                        <td>202160177@ucc.mx</td>
                        <td>01/04/2024</td>
                        <td>2da</td>
                        <td>Grupo Más</td>
                        <td>Ing. Guillermo Gomez Fernández</td>
                        <td><a href="#" class="btn btn-link btn-sm btn-sm">Editar</a> <a href="#" class="btn btn-link btn-sm">Eliminar</a></td>
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
