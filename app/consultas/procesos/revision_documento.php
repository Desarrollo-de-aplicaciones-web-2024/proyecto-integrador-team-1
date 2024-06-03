<?php
require_once '../../../config/global.php';
require_once '../../../config/db.php';

define('RUTA_INCLUDE', '../../../'); //ajustar a necesidad

if(!empty($_GET['id']) && !empty($_GET['tipo'])) {

    $id = $_GET['id'];
    $Tipo = $_GET['tipo'];
    $nombre = $_GET['nombre'];
}
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <title><?php echo PAGE_TITLE ?></title>

    <?php getTopIncludes(RUTA_INCLUDE ) ?>

</head>

<body id="page-top">

<?php getNavbar() ?>

<div id="wrapper">

    <?php getSidebar() ?>

    <div id="content-wrapper">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 mb-2 d-flex align-items-center justify-content-start">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="javascript:history.back()" class="font-monospace"><?php echo $nombre ?></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Revisión <?php echo $Tipo ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-4 d-flex justify-content-end align-items-center">
                    <!-- Previous and Next buttons -->
                    <button type="button" class="btn btn-primary mr-2">Anterior</button>
                    <button type="button" class="btn btn-primary">Siguiente</button>
                </div>
            </div>
        </div>

        <div class="container-fluid bg-light">
            <div class="row">
                <div class="col-md-8">
                    <div class="embed-responsive embed-responsive-4by3">
                        <iframe class="embed-responsive-item" src="testfile.pdf" style="width: 100%; height: 100%;"></iframe>
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- Content for the right column can be added here -->
                    <div class="overflow-auto" style="max-height: 650px;">
                        <h5 class="mt-3">Datos de envío</h5>
                        <p class="mb-2 text-success">Enviado para revisión</p>
                        <div class="d-flex align-items-center">
                            <i class="far fa-file-pdf mr-2"></i>
                            <p class="mb-0"> <?php echo $Tipo ?>.pdf</p>
                        </div>
                        <div class="text-right">
                            <p class="mt-3 mb-0">15 de Febrero 2024, 1:20 PM</p>
                        </div>

                        <div class="card mt-3 align-content-center">
                            <div class="card-body">
                                <h5 class="card-title">Información</h5>

                                <p>Alumno:  <?php echo $nombre ?></p>
                                <p>Empresa: Grupo Mimpo</p>
                                <p>Periodo: 29/01/2024-06/02/2024</p>
                                <p>Horas reportadas: 30 horas</p>

                                <p>Actividades realizadas:</p>
                                <div data-mdb-input-init class="form-outline">
                                    <textarea class="form-control" id="textAreaExample1" rows="4" readonly>Se realizó la localización de monitores con cierto número de servicio en las diversas oficinas de la empresa para ser reemplazados por unos nuevos con motivo de problemas de resolución por el tipo de entrada (DisplayPort). Acomodo de inventario y equipo en el almacén de tecnología
                                    </textarea>
                                </div>
                                <!-- Empty container to maintain layout
                                <p class="mt-3">Observaciones:</p>
                                <div data-mdb-input-init class="form-outline">
                                    <textarea class="form-control" id="textAreaExample1" rows="4" readonly>Se realiza explicación de los procesos a seguir para la correcta preparación del equipo de cómputo con las características mínimas necesarias para la organización. Realizó el correcto proceso en los equipos asignados y cumplió en tiempo y forma la recolección y cambio de monitores.
                                    </textarea>
                                </div>
                                 -->
                            </div>
                        </div>
                        <div class="card mt-3 align-content-center">
                            <div class="card-body">
                                <h5 class="card-title">Comentarios</h5>

                                <div data-mdb-input-init class="form-outline">
                                    <textarea class="form-control" id="textAreaExample1" rows="4"></textarea>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <!-- Empty container to maintain layout -->
                </div>
                <div class="col-md-4">
                    <!-- Empty container to maintain layout -->
                </div>
            </div>
        </div>

        <!-- White space row -->
        <div class="container-fluid bg-white fixed-bottom border-top">
            <div class="row">
                <div class="col-md-12">
                    <!-- Bottom Section -->
                    <div class="container mt-4 mb-4">
                        <div class="text-center">
                            <button type="button" class="btn btn-primary"
                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                Aceptar
                            </button>
                            <button type="button" class="btn btn-secondary"
                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                Rechazar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


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
