<?php
require_once '../../../config/global.php';


define('RUTA_INCLUDE', '../../../'); //ajustar a necesidad
// Conexión a la base de datos
$conn = new mysqli("database-team1-daw.c30w0agw4764.us-east-2.rds.amazonaws.com", "admin", "S1stemas_23", "PP_TEAM1");
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

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
                    <li class="breadcrumb-item">Registro</li>
                    <li class="breadcrumb-item active" aria-current="page">Plan de trabajo de prácticas profesionales</li>
                </ol>
            </nav>


        </div>

        <!-- /.container-fluid -->

        <div class="container">
            <form id="formulario-subida" action="registro_pt.php" method="post" enctype="multipart/form-data">
                <div class="form-group" >
                    <label for="fecha-inicio">Fecha de inicio de las prácticas:</label>
                    <input name="fecha_inicio" type="date" class="form-control custom-width" id="fecha-inicio" placeholder="dd/mm/aaaa">
                </div>
                <div class="form-group">
                    <label for="dias-asistencia">Días en los que se asistirá:</label>
                    <input name="asistencia" type="text" class="form-control" placeholder="Lunes-Viernes" id="dias-asistencia">
                </div>
                <div class="form-group">
                    <label for="horario-asistencia">Horario de asistencia:</label>
                    <input name="horario" type="text" class="form-control" placeholder="08:00-14:00" id="horario-asistencia">
                </div>

                <div class="mb-3">
                    <label for="descripcion_act" class="form-label">Descripción de las actividades a realizar:</label>
                    <textarea name="descripcion" class="form-control" id="descripcion_act" rows="10"></textarea>
                </div>
                <div class="row mb-5">
                    <div class="col">
                        <input type="submit" value="Guardar" class="btn btn-primary" id="input-subida">
                    </div>
                    <div class="col text-right">
                        <button type="button" class="btn btn-danger">Cancelar</button>
                    </div>
                </div>



            </form>
        </div>
        <!-- /.container -->

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
