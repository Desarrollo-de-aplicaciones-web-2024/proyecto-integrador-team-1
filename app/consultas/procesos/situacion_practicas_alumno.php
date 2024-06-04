<?php
require_once '../../../config/global.php';
require_once '../../../config/db.php';

define('RUTA_INCLUDE', '../../../'); //ajustar a necesidad

if(!empty($_GET['matricula'])){

    $id_proposito = $_GET['matricula'];

    $sql_empresa = "SELECT Empresa.Razon_social
    FROM Carta_Aceptación
    JOIN Empresa ON Carta_Aceptación.Empresa = Empresa.idEmpresa
    WHERE Carta_Aceptación.Alumno = $id_proposito;
    ";
    $sql = "select * from usuarios_alumno where matricula = $id_proposito";

    $resultado = mysqli_query($conexion, $sql);
    $resultado2 = mysqli_query($conexion, $sql_empresa);

    if($resultado){
        $fila = mysqli_fetch_assoc($resultado);
        $matricula = $fila['matricula'];
        $nombre = $fila['nombre'];
    }
    if($resultado2){
        $encontrados = mysqli_num_rows($resultado2);
        if($encontrados > 0) {
            $fila2 = mysqli_fetch_assoc($resultado2);
            $empresa = $fila2['Razon_social'];
        }else{
            $empresa = 'Sin Empresa';
        }
    }

    $etapa = 1;

    // 1
    $sql_SP = $sql = "select * from Solicitud_practicas where Alumno = $id_proposito";   $resultado_SP = mysqli_query($conexion, $sql_SP);
    $sql_PT = $sql = "select * from Plan_Trabajo where Alumno = $id_proposito";          $resultado_PT = mysqli_query($conexion, $sql_PT);
    $sql_CA = $sql = "select * from Carta_Aceptación where Alumno = $id_proposito";      $resultado_CA = mysqli_query($conexion, $sql_CA);

    if($resultado_SP){
        $encontrados_SP = mysqli_num_rows($resultado_SP);
        if($encontrados_SP > 0) {
            $fila_SP = mysqli_fetch_assoc($resultado_SP);
            $SP_ID = $fila_SP['idSolicitud_Practicas'];
            $SP_Tipo_Doc = $fila_SP['Tipo_Doc'];
            $SP_Fecha_Subida = $fila_SP['Fecha'];
            $SP_Encargado_Rev = $fila_SP['Encargado_Rev'];
            $SP_Fecha_Rev = $fila_SP['Fecha_Rev'];
            $SP_Estatus = $fila_SP['Estatus'];
        }else{
            $SP_Tipo_Doc = '-';
            $SP_Fecha_Subida = '-';
            $SP_Encargado_Rev = '-';
            $SP_Fecha_Rev = '-';
            $SP_Estatus = 'Sin subir';
        }
    }

    if($resultado_PT){
        $encontrados_PT = mysqli_num_rows($resultado_PT);
        if($encontrados_PT > 0) {
            $fila_PT = mysqli_fetch_assoc($resultado_PT);
            $PT_ID = $fila_PT['idPlan_Trabajo'];
            $PT_Tipo_Doc = $fila_PT['Tipo_Doc'];
            $PT_Fecha_Subida = $fila_PT['Fecha'];
            $PT_Encargado_Rev = $fila_PT['Encargado_Rev'];
            $PT_Fecha_Rev = $fila_PT['Fecha_Rev'];
            $PT_Estatus = $fila_PT['Estatus'];
        }else{
            $PT_Tipo_Doc = '-';
            $PT_Fecha_Subida = '-';
            $PT_Encargado_Rev = '-';
            $PT_Fecha_Rev = '-';
            $PT_Estatus = 'Sin subir';
        }
    }

    if($resultado_CA){
        $encontrados_CA = mysqli_num_rows($resultado_CA);
        if($encontrados_CA > 0) {
            $fila_CA = mysqli_fetch_assoc($resultado_CA);
            $CA_ID = $fila_CA['idCarta_Aceptación'];
            $CA_Tipo_Doc = $fila_CA['Tipo_Doc'];
            $CA_Fecha_Subida = $fila_CA['Fecha'];
            $CA_Encargado_Rev = $fila_CA['Encargado_Rev'];
            $CA_Fecha_Rev = $fila_CA['Fecha_Rev'];
            $CA_Estatus = $fila_CA['Estatus'];
        }else{
            $CA_Tipo_Doc = '-';
            $CA_Fecha_Subida = '-';
            $CA_Encargado_Rev = '-';
            $CA_Fecha_Rev = '-';
            $CA_Estatus = 'Sin subir';
        }
    }

    if($SP_Estatus == 'Aceptado' && $PT_Estatus == 'Aceptado' && $CA_Estatus == 'Aceptado')$etapa++;

    // 2
    $sql_RM = $sql = "select * from Reporte_Mensual where Alumno = $id_proposito order by Fecha_Fin";
    $resultado_RM = mysqli_query($conexion, $sql_RM);

    $all_rows_data = [];

    if($resultado_RM){
        $encontrados_RM = mysqli_num_rows($resultado_RM);

        while ($row = mysqli_fetch_assoc($resultado_RM)){
            $all_rows_data[] = $row;
        }

        if($encontrados_RM > 0){

            $first_row = $all_rows_data[0];

            $RM1_ID = $first_row['idReporte_Mensual'];
            $RM1_Tipo_Doc = $first_row['Tipo_Doc'];
            $RM1_Fecha_Subida = $first_row['Fecha'];
            $RM1_Encargado_Rev = $first_row['Encargado_Rev'];
            $RM1_Fecha_Rev = $first_row['Fecha_Rev'];
            $RM1_Estatus = $first_row['Estatus'];

            if($encontrados_RM > 1){

                $second_row = $all_rows_data[1];

                $RM2_ID = $second_row['idReporte_Mensual'];
                $RM2_Tipo_Doc = $second_row['Tipo_Doc'];
                $RM2_Fecha_Subida = $second_row['Fecha'];
                $RM2_Encargado_Rev = $second_row['Encargado_Rev'];
                $RM2_Fecha_Rev = $second_row['Fecha_Rev'];
                $RM2_Estatus = $second_row['Estatus'];

                if($encontrados_RM > 2){

                    $third_row = $all_rows_data[2];

                    $RM3_ID = $third_row['idReporte_Mensual'];
                    $RM3_Tipo_Doc = $third_row['Tipo_Doc'];
                    $RM3_Fecha_Subida = $third_row['Fecha'];
                    $RM3_Encargado_Rev = $third_row['Encargado_Rev'];
                    $RM3_Fecha_Rev = $third_row['Fecha_Rev'];
                    $RM3_Estatus = $third_row['Estatus'];

                }else{
                    $RM3_Tipo_Doc = '-';
                    $RM3_Fecha_Subida = '-';
                    $RM3_Encargado_Rev = '-';
                    $RM3_Fecha_Rev = '-';
                    $RM3_Estatus = 'Sin subir';
                }

            }else{
                $RM2_Tipo_Doc = '-';
                $RM2_Fecha_Subida = '-';
                $RM2_Encargado_Rev = '-';
                $RM2_Fecha_Rev = '-';
                $RM2_Estatus = 'Sin subir';
                $RM3_Tipo_Doc = '-';
                $RM3_Fecha_Subida = '-';
                $RM3_Encargado_Rev = '-';
                $RM3_Fecha_Rev = '-';
                $RM3_Estatus = 'Sin subir';
            }

        }else{
            $RM1_Tipo_Doc = '-';
            $RM1_Fecha_Subida = '-';
            $RM1_Encargado_Rev = '-';
            $RM1_Fecha_Rev = '-';
            $RM1_Estatus = 'Sin subir';
            $RM2_Tipo_Doc = '-';
            $RM2_Fecha_Subida = '-';
            $RM2_Encargado_Rev = '-';
            $RM2_Fecha_Rev = '-';
            $RM2_Estatus = 'Sin subir';
            $RM3_Tipo_Doc = '-';
            $RM3_Fecha_Subida = '-';
            $RM3_Encargado_Rev = '-';
            $RM3_Fecha_Rev = '-';
            $RM3_Estatus = 'Sin subir';
        }

        if($RM1_Estatus == "Aceptado")$etapa++;
        if($RM2_Estatus == "Aceptado")$etapa++;
        if($RM3_Estatus == "Aceptado")$etapa++;

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

        .step {
            list-style: none;
            margin: .2rem 0;
            width: 100%;
        }

        .step .step-item {
            -ms-flex: 1 1 0;
            flex: 1 1 0;
            margin-top: 0;
            min-height: 1rem;
            position: relative;
            text-align: center;
        }

        .step .step-item:not(:first-child)::before {
            background: #0069d9;
            content: "";
            height: 2px;
            left: -50%;
            position: absolute;
            top: 9px;
            width: 100%;
        }

        .step .step-item a {
            color: #000000;
            display: inline-block;
            padding: 20px 10px 0;
            text-decoration: none;
        }

        .step .step-item a::before {
            background: #0069d9;
            border: .1rem solid #fff;
            border-radius: 50%;
            content: "";
            display: block;
            height: .9rem;
            left: 50%;
            position: absolute;
            top: .2rem;
            transform: translateX(-50%);
            width: .9rem;
            z-index: 1;
        }

        .step .step-item.active a::before {
            background: #fff;
            border: .1rem solid #0069d9;
        }

        .step .step-item.active ~ .step-item::before {
            background: #e7e9ed;
        }

        .step .step-item.active ~ .step-item a::before {
            background: #e7e9ed;
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

            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="mt-5 mb-5 text-center">
                            <h1 class="">Situación de Prácticas Profesionales</h1>
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="mt-5 bi bi-person" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                            </svg>

                            <h4 class="mt-2"><?php echo $nombre?></h4>
                            <h5 class=""><?php echo $empresa?></h5>
                        </div>
                    </div>

                </div>

                <div class="container" id="myGroup">
                    <ul id="myList" class="step d-flex flex-nowrap">
                        <?php
                        $steps = [
                            ['Documentos', 'Iniciales'],
                            ['1er Reporte', 'Mensual'],
                            ['2do Reporte', 'Mensual'],
                            ['3er Reporte', 'Mensual'],
                            ['Documentos', 'Finales']
                        ];

                        foreach ($steps as $index => $step) {
                            $activeClass = ($index + 1 == $etapa) ? ' active' : '';
                            echo '<li class="step-item' . $activeClass . '" data-toggle="collapse" data-target="#collapse' . ($index + 1) . '">
                <a class="">' . $step[0] . '</a>
                <p class="">' . $step[1] . '</p>
            </li>';
                        }
                        ?>
                    </ul>
                </div>

                <div class="mt-4 panel-group">
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fas fa-table"></i>
                                Tabla de documentos
                            </div>
                            <div class="card-body">
                                <div id="collapse1" class="panel-collapse collapse" data-parent="#myGroup">

                                    <?php
                                    if ($encontrados_SP == 0) {
                                        echo '<div class="alert alert-warning" role="alert">El alumno no ha iniciado el trámite</div>';
                                    } else { ?>
                                        <div class="table-responsive table-hover">
                                            <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                                                <thead>
                                                <tr>
                                                    <th>Documento</th>
                                                    <th>Fecha de subida</th>
                                                    <th>Encargado de revisión</th>
                                                    <th>Fecha de revisión</th>
                                                    <th>Estatus</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr onclick="window.location.href='revision_documento.php?id=<?php echo $SP_ID; ?>&tipo=<?php echo $SP_Tipo_Doc; ?>&nombre=<?php echo $nombre; ?>'">
                                                    <td>Solicitud de Prácticas</td>
                                                    <td><?php echo $SP_Fecha_Subida ?></td>
                                                    <td><?php echo $SP_Encargado_Rev ?></td>
                                                    <td><?php echo $SP_Fecha_Rev ?></td>
                                                    <?php
                                                    switch($SP_Estatus) {
                                                        case "Aceptado":
                                                            echo '<td class="text-success">' . $SP_Estatus . '</td>';
                                                            break;
                                                        case "Rechazado":
                                                            echo '<td class="text-danger">' . $SP_Estatus . '</td>';
                                                            break;
                                                        case "Pendiente":
                                                            echo '<td class="text-warning">' . $SP_Estatus . '</td>';
                                                            break;
                                                        case "Sin subir":
                                                            echo '<td class="text-secondary">' . $SP_Estatus . '</td>';
                                                            break;
                                                    }
                                                    ?>
                                                </tr>
                                                <tr onclick="window.location.href='revision_documento.php?id=<?php echo $PT_ID; ?>&tipo=<?php echo $PT_Tipo_Doc; ?>&nombre=<?php echo $nombre; ?>'">
                                                    <td>Plan de Trabajo</td>
                                                    <td><?php echo $PT_Fecha_Subida ?></td>
                                                    <td><?php echo $PT_Encargado_Rev ?></td>
                                                    <td><?php echo $PT_Fecha_Rev ?></td>
                                                    <?php
                                                    switch($PT_Estatus) {
                                                        case "Aceptado":
                                                            echo '<td class="text-success">' . $PT_Estatus . '</td>';
                                                            break;
                                                        case "Rechazado":
                                                            echo '<td class="text-danger">' . $PT_Estatus . '</td>';
                                                            break;
                                                        case "Pendiente":
                                                            echo '<td class="text-warning">' . $PT_Estatus . '</td>';
                                                            break;
                                                        case "Sin subir":
                                                            echo '<td class="text-secondary">' . $PT_Estatus . '</td>';
                                                            break;
                                                    }
                                                    ?>
                                                </tr>
                                                <tr onclick="window.location.href='revision_documento.php?id=<?php echo $CA_ID; ?>&tipo=<?php echo $CA_Tipo_Doc; ?>&nombre=<?php echo $nombre; ?>'">
                                                    <td>Carta de Aceptación</td>
                                                    <td><?php echo $CA_Fecha_Subida ?></td>
                                                    <td><?php echo $CA_Encargado_Rev ?></td>
                                                    <td><?php echo $CA_Fecha_Rev ?></td>
                                                    <?php
                                                        switch($CA_Estatus) {
                                                            case "Aceptado":
                                                                echo '<td class="text-success">' . $CA_Estatus . '</td>';
                                                                break;
                                                            case "Rechazado":
                                                                echo '<td class="text-danger">' . $CA_Estatus . '</td>';
                                                                break;
                                                            case "Pendiente":
                                                                echo '<td class="text-warning">' . $CA_Estatus . '</td>';
                                                                break;
                                                            case "Sin subir":
                                                                echo '<td class="text-secondary">' . $CA_Estatus . '</td>';
                                                                break;
                                                        }
                                                    ?>
                                                </tr>
                                                <tr>
                                                    <td>Carta de Recomendación</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td class="text-secondary">Sin subir</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php } ?>
                                </div>

                                <div id="collapse2" class="panel-collapse collapse" data-parent="#myGroup">
                                    <?php
                                    if ($etapa < 2) {
                                        echo '<div class="alert alert-danger" role="alert">El alumno no ha completado un proceso anterior</div>';
                                    } else {
                                        ?>
                                        <div class="table-responsive table-hover">
                                            <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                                                <thead>
                                                <tr>
                                                    <th>Documento</th>
                                                    <th>Fecha de subida</th>
                                                    <th>Encargado de revisión</th>
                                                    <th>Fecha de revisión</th>
                                                    <th>Estatus</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr onclick="window.location.href='revision_documento.php?id=<?php echo $RM1_ID; ?>&tipo=<?php echo $RM1_Tipo_Doc; ?>&nombre=<?php echo $nombre; ?>'">
                                                    <td>1er Reporte Mensual</td>
                                                    <td><?php echo $RM1_Fecha_Subida; ?></td>
                                                    <td><?php echo $RM1_Encargado_Rev; ?></td>
                                                    <td><?php echo $RM1_Fecha_Rev; ?></td>
                                                    <td>
                                                        <?php
                                                        switch ($RM1_Estatus) {
                                                            case "Aceptado":
                                                                echo '<span class="text-success">' . $RM1_Estatus . '</span>';
                                                                break;
                                                            case "Rechazado":
                                                                echo '<span class="text-danger">' . $RM1_Estatus . '</span>';
                                                                break;
                                                            case "Pendiente":
                                                                echo '<span class="text-warning">' . $RM1_Estatus . '</span>';
                                                                break;
                                                            case "Sin subir":
                                                                echo '<span class="text-secondary">' . $RM1_Estatus . '</span>';
                                                                break;
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>


                                <div id="collapse3" class="panel-collapse collapse" data-parent="#myGroup">
                                    <?php
                                    if ($etapa < 3) {
                                        echo '<div class="alert alert-danger" role="alert">El alumno no ha completado un proceso anterior</div>';
                                    } else {
                                        ?>
                                        <div class="table-responsive table-hover">
                                            <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                                                <thead>
                                                <tr>
                                                    <th>Documento</th>
                                                    <th>Fecha de subida</th>
                                                    <th>Encargado de revisión</th>
                                                    <th>Fecha de revisión</th>
                                                    <th>Estatus</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr onclick="window.location.href='revision_documento.php?id=<?php echo $RM2_ID; ?>&tipo=<?php echo $RM2_Tipo_Doc; ?>&nombre=<?php echo $nombre; ?>'">
                                                    <td>2do Reporte Mensual</td>
                                                    <td><?php echo $RM2_Fecha_Subida; ?></td>
                                                    <td><?php echo $RM2_Encargado_Rev; ?></td>
                                                    <td><?php echo $RM2_Fecha_Rev; ?></td>
                                                    <td>
                                                        <?php
                                                        switch ($RM2_Estatus) {
                                                            case "Aceptado":
                                                                echo '<span class="text-success">' . $RM2_Estatus . '</span>';
                                                                break;
                                                            case "Rechazado":
                                                                echo '<span class="text-danger">' . $RM2_Estatus . '</span>';
                                                                break;
                                                            case "Pendiente":
                                                                echo '<span class="text-warning">' . $RM2_Estatus . '</span>';
                                                                break;
                                                            case "Sin subir":
                                                                echo '<span class="text-secondary">' . $RM2_Estatus . '</span>';
                                                                break;
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>

                                <div id="collapse4" class="panel-collapse collapse" data-parent="#myGroup">
                                    <?php
                                    if ($etapa < 4) {
                                        echo '<div class="alert alert-danger" role="alert">El alumno no ha completado un proceso anterior</div>';
                                    } else {
                                        ?>
                                        <div class="table-responsive table-hover">
                                            <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                                                <thead>
                                                <tr>
                                                    <th>Documento</th>
                                                    <th>Fecha de subida</th>
                                                    <th>Encargado de revisión</th>
                                                    <th>Fecha de revisión</th>
                                                    <th>Estatus</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr onclick="window.location.href='revision_documento.php?id=<?php echo $RM3_ID; ?>&tipo=<?php echo $RM3_Tipo_Doc; ?>&nombre=<?php echo $nombre; ?>'">
                                                    <td>3er Reporte Mensual</td>
                                                    <td><?php echo $RM3_Fecha_Subida; ?></td>
                                                    <td><?php echo $RM3_Encargado_Rev; ?></td>
                                                    <td><?php echo $RM3_Fecha_Rev; ?></td>
                                                    <td>
                                                        <?php
                                                        switch ($RM3_Estatus) {
                                                            case "Aceptado":
                                                                echo '<span class="text-success">' . $RM3_Estatus . '</span>';
                                                                break;
                                                            case "Rechazado":
                                                                echo '<span class="text-danger">' . $RM3_Estatus . '</span>';
                                                                break;
                                                            case "Pendiente":
                                                                echo '<span class="text-warning">' . $RM3_Estatus . '</span>';
                                                                break;
                                                            case "Sin subir":
                                                                echo '<span class="text-secondary">' . $RM3_Estatus . '</span>';
                                                                break;
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>


                                <div id="collapse5" class="panel-collapse collapse" data-parent="#myGroup">
                                    <div class="table-responsive">
                                        <div class="alert alert-danger" role="alert">
                                            El alumno no ha completado un proceso anterior
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="card-footer small text-muted"></div>
                        </div>
                    </div>
                </div>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    $(document).ready(function() {
                        // Get the value of the $etapa variable from PHP
                        var etapa = <?php echo $etapa; ?>;
                        console.log(etapa);

                        // Show the appropriate collapse element based on the etapa value
                        $('#collapse' + etapa).collapse('show');

                        // Attach click event handlers to the step items
                        $('.step-item').on('click', function() {
                            // Hide all collapses except the one being clicked
                            var target = $(this).data('target');
                            $('.panel-collapse').not(target).collapse('hide');
                            $(target).collapse('show');
                        });
                    });
                </script>


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
