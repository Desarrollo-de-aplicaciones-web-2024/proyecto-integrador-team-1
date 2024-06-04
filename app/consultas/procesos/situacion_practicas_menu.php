<?php
require_once '../../../config/global.php';
require_once '../../../config/db.php';

define('RUTA_INCLUDE', '../../../'); //ajustar a necesidad

$sqlx = "SELECT * FROM usuarios_alumno";

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
                                                $resultadox = mysqli_query($conexion, $sqlx);
                                                $encontradosx = mysqli_num_rows($resultadox);

                                                if($encontradosx > 0){
                                                while ($filax=mysqli_fetch_assoc($resultadox)){

                                                    $id_proposito = $filax['matricula'];

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
                                                    $sql_SP = "select * from Solicitud_practicas where Alumno = $id_proposito";   $resultado_SP = mysqli_query($conexion, $sql_SP);
                                                    $sql_PT = "select * from Plan_Trabajo where Alumno = $id_proposito";          $resultado_PT = mysqli_query($conexion, $sql_PT);
                                                    $sql_CA = "select * from Carta_Aceptación where Alumno = $id_proposito";      $resultado_CA = mysqli_query($conexion, $sql_CA);

                                                    if($resultado_SP){
                                                        $encontrados_SP = mysqli_num_rows($resultado_SP);
                                                        if($encontrados_SP > 0) {
                                                            $fila_SP = mysqli_fetch_assoc($resultado_SP);

                                                            $SP_Estatus = $fila_SP['Estatus'];
                                                        }else{
                                                            $SP_Estatus = 'Sin subir';
                                                        }
                                                    }

                                                    if($resultado_PT){
                                                        $encontrados_PT = mysqli_num_rows($resultado_PT);
                                                        if($encontrados_PT > 0) {
                                                            $fila_PT = mysqli_fetch_assoc($resultado_PT);
                                                            $PT_Estatus = $fila_PT['Estatus'];
                                                        }else{
                                                            $PT_Estatus = 'Sin subir';
                                                        }
                                                    }

                                                    if($resultado_CA){
                                                        $encontrados_CA = mysqli_num_rows($resultado_CA);
                                                        if($encontrados_CA > 0) {
                                                            $fila_CA = mysqli_fetch_assoc($resultado_CA);

                                                            $CA_Estatus = $fila_CA['Estatus'];
                                                        }else{
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

                                                            $RM1_Estatus = $first_row['Estatus'];

                                                            if($encontrados_RM > 1){

                                                                $second_row = $all_rows_data[1];

                                                                $RM2_Estatus = $second_row['Estatus'];

                                                                if($encontrados_RM > 2){

                                                                    $third_row = $all_rows_data[2];


                                                                    $RM3_Estatus = $third_row['Estatus'];

                                                                }else{

                                                                    $RM3_Estatus = 'Sin subir';
                                                                }

                                                            }else{
                                                                $RM2_Estatus = 'Sin subir';
                                                                $RM3_Estatus = 'Sin subir';
                                                            }

                                                        }else{

                                                            $RM1_Estatus = 'Sin subir';

                                                            $RM2_Estatus = 'Sin subir';

                                                            $RM3_Estatus = 'Sin subir';
                                                        }

                                                        if($RM1_Estatus == "Aceptado")$etapa++;
                                                        if($RM2_Estatus == "Aceptado")$etapa++;
                                                        if($RM3_Estatus == "Aceptado")$etapa++;
                                                    }

                                                    $sql_RG = "select * from Archivos where matricula = $id_proposito and clasificacion = 'reporte' and tipo_archivo = 'final'";        $resultado_RG = mysqli_query($conexion, $sql_RG);
                                                    $sql_CO = "select * from Archivos where matricula = $id_proposito and clasificacion = 'constancia' and tipo_archivo = 'final'";     $resultado_CO = mysqli_query($conexion, $sql_CO);
                                                    $sql_RP = "select * from Archivos where matricula = $id_proposito and clasificacion = 'resena' and tipo_archivo = 'final'";         $resultado_RP = mysqli_query($conexion, $sql_RP);

                                                    if($resultado_RG){
                                                        $encontrados_RG = mysqli_num_rows($resultado_RG);
                                                        if($encontrados_RG > 0) {
                                                            $fila_RG = mysqli_fetch_assoc($resultado_RG);

                                                            $estado_RG = $fila_RG['estado'];;

                                                        }else{
                                                            $estado_RG = 'Sin subir';

                                                        }
                                                    }

                                                    if($resultado_CO){
                                                        $encontrados_CO = mysqli_num_rows($resultado_CO);
                                                        if($encontrados_CO > 0) {
                                                            $fila_CO = mysqli_fetch_assoc($resultado_CO);
                                                            $estado_CO = $fila_CO['estado'];

                                                        }else{

                                                            $estado_CO = 'Sin subir';

                                                        }
                                                    }

                                                    if($resultado_RP){
                                                        $encontrados_RP = mysqli_num_rows($resultado_RP);
                                                        if($encontrados_RP > 0) {
                                                            $fila_RP = mysqli_fetch_assoc($resultado_RP);

                                                            $estado_RP = $fila_RP['estado'];

                                                        }else{

                                                            $estado_RP = 'Sin subir';
                                                        }
                                                    }

                                                    if($estado_RP === 'aceptado' && $estado_CO === 'aceptado' && $estado_RG === 'aceptado')$etapa++;
                                            ?>

                                            <tr onclick="window.location.href='situacion_practicas_alumno.php?matricula=<?php echo $filax['matricula']; ?>'">
                                                <td><?php echo $filax['matricula']?></td>
                                                <td><?php echo $filax['nombre']?></td>
                                                <td>
                                                    <?php
                                                    switch($etapa) {
                                                        case 1:
                                                            echo 'Sin iniciar';
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
                                                            echo 'Documento Finales';
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
                                                <td><?php echo $fila2['clasificacion']?></td>
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
