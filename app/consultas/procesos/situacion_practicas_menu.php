<?php
require_once '../../../config/global.php';
require_once '../../../config/db.php';

define('RUTA_INCLUDE', '../../../'); //ajustar a necesidad

$sqly = "SELECT * FROM usuarios_alumno";

$sql2 = "SELECT a.*, ua.nombre
FROM Archivos a
JOIN usuarios_alumno ua ON a.matricula = ua.matricula
WHERE a.estado = 'pendiente'";



?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="https://fonts.googleapis.com/css2?family=Liberation+Sans&display=swap" rel="stylesheet">
    <!-- Bootstrap 5.1 CSS -->

    <title><?php echo PAGE_TITLE ?></title>

    <?php getTopIncludes(RUTA_INCLUDE ) ?>
    <style>
        .table-hover tbody tr:hover {
            color: #007faf;
            cursor: pointer; /* Change cursor to pointer on hover */
        }

        .my-custom-font {
            font-family: 'Liberation Sans', sans-serif;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .table td, .table th {
            vertical-align: middle;
        }
        .status-badge {
            display: inline-block;
            padding: .35em .65em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: .25rem;
        }
        .ready-for-review {
            background-color: #ffc107;
            color: #212529;
        }
        .draft {
            background-color: #17a2b8;
            color: #fff;
        }
        .ready-for-editing {
            background-color: #28a745;
            color: #fff;
        }

    </style>

</head>

<body id="page-top">

<?php getNavbar() ?>

<div id="wrapper">

    <?php getSidebar($rutas) ?>

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Page Content -->

            <div class="container mt-5 mb-4">
                <div class="mt-5 mb-3 text-center">
                    <h1 class="">Situación de Prácticas Profesionales</h1>

                </div>
                <hr>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Consultar situación</h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive mt-3 mb-3">
                                    <table class="table table-hover dataTable">
                                        <thead>
                                            <tr>
                                                <th>Matrícula</th>
                                                <th>Nombre</th>
                                                <th>Etapa</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                                $resultadoy = mysqli_query($conexion, $sqly);
                                                $encontradosy = mysqli_num_rows($resultadoy);

                                                if($encontradosy > 0){

                                                    $sqlx = "
                                                    SELECT 
                                                        ua.matricula, ua.nombre,
                                                        e.Razon_social AS empresa,
                                                        sp.Estatus AS SP_Estatus,
                                                        pt.Estatus AS PT_Estatus,
                                                        ca.Estatus AS CA_Estatus,
                                                        rm1.Estatus AS RM1_Estatus,
                                                        rm2.Estatus AS RM2_Estatus,
                                                        rm3.Estatus AS RM3_Estatus,
                                                        rg.estado AS RG_Estatus,
                                                        co.estado AS CO_Estatus,
                                                        rp.estado AS RP_Estatus
                                                    FROM usuarios_alumno ua
                                                    LEFT JOIN Carta_Aceptación ca ON ca.Alumno = ua.matricula
                                                    LEFT JOIN Empresa e ON ca.Empresa = e.idEmpresa
                                                    LEFT JOIN Solicitud_practicas sp ON sp.Alumno = ua.matricula
                                                    LEFT JOIN Plan_Trabajo pt ON pt.Alumno = ua.matricula
                                                    LEFT JOIN Reporte_Mensual rm1 ON rm1.Alumno = ua.matricula AND rm1.Fecha_Fin = (
                                                        SELECT MIN(Fecha_Fin) FROM Reporte_Mensual WHERE Alumno = ua.matricula
                                                    )
                                                    LEFT JOIN Reporte_Mensual rm2 ON rm2.Alumno = ua.matricula AND rm2.Fecha_Fin = (
                                                        SELECT MIN(Fecha_Fin) FROM Reporte_Mensual WHERE Alumno = ua.matricula AND Fecha_Fin > (
                                                            SELECT MIN(Fecha_Fin) FROM Reporte_Mensual WHERE Alumno = ua.matricula
                                                        )
                                                    )
                                                    LEFT JOIN Reporte_Mensual rm3 ON rm3.Alumno = ua.matricula AND rm3.Fecha_Fin = (
                                                        SELECT MIN(Fecha_Fin) FROM Reporte_Mensual WHERE Alumno = ua.matricula AND Fecha_Fin > (
                                                            SELECT MIN(Fecha_Fin) FROM Reporte_Mensual WHERE Alumno = ua.matricula AND Fecha_Fin > (
                                                                SELECT MIN(Fecha_Fin) FROM Reporte_Mensual WHERE Alumno = ua.matricula
                                                            )
                                                        )
                                                    )
                                                    LEFT JOIN Archivos rg ON rg.matricula = ua.matricula AND rg.clasificacion = 'reporte' AND rg.tipo_archivo = 'final'
                                                    LEFT JOIN Archivos co ON co.matricula = ua.matricula AND co.clasificacion = 'constancia' AND co.tipo_archivo = 'final'
                                                    LEFT JOIN Archivos rp ON rp.matricula = ua.matricula AND rp.clasificacion = 'resena' AND rp.tipo_archivo = 'final'
                                                    ";
                                                    $resultadox = mysqli_query($conexion, $sqlx);

                                                    while ($filax = mysqli_fetch_assoc($resultadox)) {
                                                        $id_proposito = $filax['matricula'];
                                                        $nombre = $filax['nombre'];
                                                        $empresa = $filax['empresa'] ?? 'Sin Empresa';

                                                        $statuses = [
                                                            'SP_Estatus' => $filax['SP_Estatus'] ?? 'Sin subir',
                                                            'PT_Estatus' => $filax['PT_Estatus'] ?? 'Sin subir',
                                                            'CA_Estatus' => $filax['CA_Estatus'] ?? 'Sin subir',
                                                            'RM1_Estatus' => $filax['RM1_Estatus'] ?? 'Sin subir',
                                                            'RM2_Estatus' => $filax['RM2_Estatus'] ?? 'Sin subir',
                                                            'RM3_Estatus' => $filax['RM3_Estatus'] ?? 'Sin subir',
                                                            'RG_Estatus' => $filax['RG_Estatus'] ?? 'Sin subir',
                                                            'CO_Estatus' => $filax['CO_Estatus'] ?? 'Sin subir',
                                                            'RP_Estatus' => $filax['RP_Estatus'] ?? 'Sin subir',
                                                        ];

                                                        $etapa = 1;
                                                        if ($statuses['SP_Estatus'] == 'Aceptado' && $statuses['PT_Estatus'] == 'Aceptado' && $statuses['CA_Estatus'] == 'Aceptado') {
                                                            $etapa++;
                                                        }
                                                        if ($statuses['RM1_Estatus'] == "Aceptado") $etapa++;
                                                        if ($statuses['RM2_Estatus'] == "Aceptado") $etapa++;
                                                        if ($statuses['RM3_Estatus'] == "Aceptado") $etapa++;
                                                        if ($statuses['RG_Estatus'] == 'aceptado' && $statuses['CO_Estatus'] == 'aceptado' && $statuses['RP_Estatus'] == 'aceptado') {
                                                            $etapa++;
                                                        }

                                                        // Output or use the data as needed
                                                        // Example: echo "Alumno: $nombre, Empresa: $empresa, Etapa: $etapa\n";

                                                    ?>

                                            <tr onclick="window.location.href='situacion_practicas_alumno.php?matricula=<?php echo $filax['matricula']; ?>'">
                                                <td><?php echo $filax['matricula']?></td>
                                                <td><?php echo $filax['nombre']?></td>
                                                <td style="width: 156px;">
                                                    <?php
                                                    switch($etapa) {
                                                        case 1:
                                                            echo 'Sin iniciar proceso';
                                                            break;
                                                        case 2:
                                                            echo '1er Reporte Mensual';
                                                            break;
                                                        case 3:
                                                            echo '2do Reporte Mensual';
                                                            break;
                                                        case 4:
                                                            echo '3er Reporte Mensual';
                                                            break;
                                                        case 5:
                                                            echo 'Documentos Finales';
                                                            break;
                                                        case 6:
                                                            echo 'Proceso finalizado';
                                                            break;
                                                    }
                                                    ?>
                                                </td>
                                            </tr>

                                            <?php } ?>

                                        </tbody>
                                    </table>

                                    <?php
                                    }else{
                                        echo "<div class='alert alert-warning mt-5'>No hay alumnos</div>";
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Pendientes de revisar<span class="badge ml-2" style="color: #ffffff; background-color: #1c81f8;">
                                        <?php
                                            $resultado2 = mysqli_query($conexion, $sql2);
                                            $encontrados2 = mysqli_num_rows($resultado2);
                                            echo $encontrados2
                                        ?>
                                    </span></h5>
                            </div
                            <div class="card-body p-0">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">

                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="content-items" role="tabpanel" aria-labelledby="content-items-tab">

                                        <?php
                                            if($encontrados2 > 0){
                                        ?>

                                        <table class="table table-hover mb-0">
                                            <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Documento</th>
                                                <th style="width: 100px;">Fecha</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            while ($fila2=mysqli_fetch_assoc($resultado2)){
                                                $first_key = key($fila2);
                                                $first_value = current($fila2);
                                            ?>
                                                <tr onclick="window.location.href='revision_documento2.php?id=<?php echo $fila2['id']; ?>'">
                                                <td><?php echo $fila2['nombre']?></td>
                                                <td>
                                                    <?php
                                                    switch ($fila2['clasificacion']) {
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
                                                </td>
                                                <td>
                                                    <?php
                                                    date_default_timezone_set('America/New_York');
                                                    $todays_date = date('Y-m-d');
                                                    echo $todays_date;?>
                                                </td>
                                            </tr>

                                            <?php } ?>

                                        </table>

                                        <?php
                                        }else{

                                        ?>

                                    </div>

                                    <div class="tab-pane fade" id="editions" role="tabpanel" aria-labelledby="editions-tab">
                                        <!-- Content for editions tab -->
                                    </div>
                                </div>
                            </div>

                            <?php
                            echo "<div class='alert alert-info mt-3'>Ningún documento por revisar</div>";
                            }?>
                        </div>
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
