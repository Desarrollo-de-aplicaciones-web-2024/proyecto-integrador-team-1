<?php
require_once '../../../config/global.php';
require_once '../../../config/db.php';

define('RUTA_INCLUDE', '../../../'); // ajustar a necesidad

if (!empty($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT a.*, ua.nombre
            FROM Archivos a
            JOIN usuarios_alumno ua ON a.matricula = ua.matricula
            WHERE a.id = $id";

    $resultado = mysqli_query($conexion, $sql);

    if ($resultado) {
        $encontrados = mysqli_num_rows($resultado);
        if ($encontrados > 0) {
            $fila = mysqli_fetch_assoc($resultado);
            $matricula = $fila['matricula'];
            $nombre = $fila['nombre'];
            $tipo_archivo = $fila['tipo_archivo'];
            $nombre_archivo = $fila['nombre_archivo'];
            $estado = $fila['estado'];
            $ruta = $fila['ruta_archivo'];
            $comentario = $fila['Comentarios'];
            $clasificacion = $fila['clasificacion'];
        }
    }

    $sql2 = "SELECT Empresa.Razon_social
            FROM Carta_Aceptación
            JOIN Empresa ON Carta_Aceptación.Empresa = Empresa.idEmpresa
            WHERE Carta_Aceptación.Alumno = $matricula";

    $resultado2 = mysqli_query($conexion, $sql2);

    if ($resultado2) {
        $encontrados2 = mysqli_num_rows($resultado2);
        if ($encontrados2 > 0) {
            $fila2 = mysqli_fetch_assoc($resultado2);
            $empresa = $fila2['Razon_social'];
        }
    }
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

    <?php getTopIncludes(RUTA_INCLUDE) ?>

</head>

<body id="page-top">

<?php getNavbar() ?>

<div id="wrapper">

    <?php getSidebar($rutas) ?>

    <div id="content-wrapper">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 mb-2 d-flex align-items-center justify-content-start">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="javascript:history.back()" class="font-monospace">Situación de prácticas</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Revisión <?php echo $tipo_archivo ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-4 d-flex justify-content-end align-items-center">
                    <!-- Previous and Next buttons
                    <button type="button" class="btn btn-primary mr-2">Anterior</button>
                    <button type="button" class="btn btn-primary">Siguiente</button>
                    -->
                </div>
            </div>
        </div>

        <div class="container-fluid bg-light">
            <div class="row">
                <div class="col-md-8">
                    <div class="embed-responsive embed-responsive-4by3">
                        <?php
                        if ($tipo_archivo === 'inicial') {
                            echo '<iframe class="embed-responsive-item" src="../../servicio/inicial/uploads/' . $nombre_archivo . '" style="width: 100%; height: 100%;"></iframe>';
                        } elseif ($tipo_archivo === 'final') {
                            echo '<iframe class="embed-responsive-item" src="../../servicio/final/uploads/' . $nombre_archivo . '" style="width: 100%; height: 100%;"></iframe>';
                        }
                        ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="overflow-auto" style="max-height: 650px;">
                        <h5 class="mt-3">Datos de envío</h5>
                            <?php
                            switch($estado) {
                                case "aceptado":
                                    echo '<p class="mb-2 text-success"><td>Se ha aceptado</td></p>';
                                    break;
                                case "rechazado":
                                    echo '<p class="mb-2 text-danger"><td>Se ha rechazado</td></p>';
                                    break;
                                case "pendiente":
                                    echo '<p class="mb-2 text-warning"><td>Enviado para revisión</td></p>';
                                    break;
                            }
                            ?>
                        <div class="d-flex align-items-center">
                            <i class="far fa-file-pdf mr-2"></i>
                            <p class="mb-0"> <?php echo $nombre_archivo ?>.pdf</p>
                        </div>
                        <div class="text">
                            <p class="mt-3 mb-0">Fecha:
                                <?php
                                date_default_timezone_set('America/New_York');
                                $todays_date = date('Y-m-d');
                                echo $todays_date;
                                ?>
                            </p>
                        </div>

                        <div class="card mt-3 align-content-center">
                            <div class="card-body">
                                <h5 class="card-title">Información</h5>
                                <p>Documento:
                                    <?php
                                    switch ($clasificacion) {
                                        case "resena":
                                            echo 'Reseña Practicantes';
                                            break;
                                        case "reporte":
                                            echo 'Reporte Global';
                                            break;
                                        case "constancia":
                                            echo 'Constancia de finalización';
                                            break;
                                        case "solicitud":
                                            echo 'Solicitud de Prácticas';
                                            break;
                                        case "carta_presentacion":
                                            echo 'Carta de presentación';
                                            break;
                                    }
                                    ?>
                                </p>
                                <p>Alumno: <?php echo $nombre ?></p>
                                <p>Empresa: <?php echo $empresa ?></p>
                            </div>
                        </div>

                        <div class="card mt-3 align-content-center">
                            <div class="card-body">

                                <h5 class="card-title">Comentarios</h5>

                                <?php
                                if ($estado === 'pendiente') {
                                    echo '<div data-mdb-input-init class="form-outline">
                                            <textarea class="form-control" id="textAreaExample1" rows="4"></textarea>
                                          </div>';
                                } else {
                                    echo '<div data-mdb-input-init class="form-outline">
                                        <textarea disabled class="form-control" id="textAreaExample1" rows="4">' . $comentario . '</textarea>
                                        </div>';
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid bg-white fixed-bottom border-top">
            <div class="row">
                <div class="col-md-12">
                    <div class="container mt-4 mb-4">
                        <div class="text-center">
                            <?php
                            if ($estado === 'pendiente') {
                                echo '
                                        <button id="acceptButton" type="button" class="btn btn-primary"
                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                            Aceptar
                                        </button>
                                        <button id="rejectButton" type="button" class="btn btn-secondary"
                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                            Rechazar
                                        </button>
                                    ';
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Accept Modal -->
        <div class="modal fade" id="acceptModal" tabindex="-1" role="dialog" aria-labelledby="acceptModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="acceptModalLabel">Aceptar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Add your accept confirmation message here -->
                        ¿Está seguro de que desea aceptar?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button id="confirmAcceptButton" type="button" class="btn btn-primary">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reject Modal -->
        <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="rejectModalLabel">Rechazar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Add your reject confirmation message here -->
                        ¿Está seguro de que desea rechazar?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button id="confirmRejectButton" type="button" class="btn btn-danger">Rechazar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS (jQuery is required) -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script>
            function sendComment(action) {
                var comment = document.getElementById('textAreaExample1').value;

                $.ajax({
                    url: 'update.php',
                    type: 'POST',
                    data: {
                        action: action,
                        id: <?php echo $id; ?>,
                        comment: comment
                    },
                    success: function (response) {
                        if (action === 'accept') {
                            $('#acceptModal').modal('hide');
                        } else if (action === 'reject') {
                            $('#rejectModal').modal('hide');
                        }
                        window.location.href = 'situacion_practicas_menu.php';
                    }
                });
            }

            $('#acceptButton').on('click', function () {
                $('#acceptModal').modal('show');
            });

            $('#rejectButton').on('click', function () {
                $('#rejectModal').modal('show');
            });

            $('#confirmAcceptButton').on('click', function () {
                sendComment('accept');
            });

            $('#confirmRejectButton').on('click', function () {
                sendComment('reject');
            });
        </script>

        <?php getFooter() ?>

    </div>
</div>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<?php getModalLogout() ?>

<?php getBottomIncudes(RUTA_INCLUDE) ?>
</body>

</html>
