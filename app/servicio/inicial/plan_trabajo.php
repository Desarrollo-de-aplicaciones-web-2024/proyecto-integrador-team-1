<?php
require_once '../../../config/global.php';


define('RUTA_INCLUDE', '../../../'); //ajustar a necesidad
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
            <form>
                <div class="form-group">
                    <label for="fecha_inicio">Fecha de inicio de las prácticas:</label>
                    <input type="date" id="fecha_inicio" name="fecha_inicio" required>                </div>

                <div class="form-group">
                    <label>Hora de Asistencia:</label>
                    <div class="day-group">
                        <div class="day">
                            <input type="checkbox" id="lunes" name="dias[]" value="lunes">
                            <label for="lunes">Lunes</label>
                            <input type="time" name="hora_inicio_lunes">
                            <input type="time" name="hora_fin_lunes">
                        </div>
                        <div class="day">
                            <input type="checkbox" id="martes" name="dias[]" value="martes">
                            <label for="martes">Martes</label>
                            <input type="time" name="hora_inicio_martes">
                            <input type="time" name="hora_fin_martes">
                        </div>
                        <div class="day">
                            <input type="checkbox" id="miercoles" name="dias[]" value="miercoles">
                            <label for="miercoles">Miércoles</label>
                            <input type="time" name="hora_inicio_miercoles">
                            <input type="time" name="hora_fin_miercoles">
                        </div>
                        <div class="day">
                            <input type="checkbox" id="jueves" name="dias[]" value="jueves">
                            <label for="jueves">Jueves</label>
                            <input type="time" name="hora_inicio_jueves">
                            <input type="time" name="hora_fin_jueves">
                        </div>
                        <div class="day">
                            <input type="checkbox" id="viernes" name="dias[]" value="viernes">
                            <label for="viernes">Viernes</label>
                            <input type="time" name="hora_inicio_viernes">
                            <input type="time" name="hora_fin_viernes">
                        </div>
                        <div class="day">
                            <input type="checkbox" id="sabado" name="dias[]" value="sabado">
                            <label for="sabado">Sábado</label>
                            <input type="time" name="hora_inicio_sabado">
                            <input type="time" name="hora_fin_sabado">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="descripcion_act_real" class="form-label">Descripción de las actividades a realizar:</label>
                    <textarea class="form-control" id="descripcion_act_real" rows="10"></textarea>
                </div>
                <div class="row mb-5">
                    <div class="col">
                        <button onclick="window.location.href='plan_trabajo.php'" class="btn btn-success">Guardar</button>
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
