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
                    <label>Horario de Asistencia:</label>
                    <div class="container mt-4">
                        <div class="hora-asistencia form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="lunes">
                            <label class="form-check-label" for="lunes">Lunes</label>
                            <div class="horarios">
                                <input type="time" class="form-control" name="hora_inicio_lunes">
                                <input type="time" class="form-control" name="hora_fin_lunes">
                            </div>
                        </div>
                        <div class="hora-asistencia form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="martes">
                            <label class="form-check-label" for="martes">Martes</label>
                            <div class="horarios">
                                <input type="time" class="form-control" name="hora_inicio_martes">
                                <input type="time" class="form-control" name="hora_fin_martes">
                            </div>
                        </div>
                        <div class="hora-asistencia form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="miercoles">
                            <label class="form-check-label" for="miercoles">Miércoles</label>
                            <div class="horarios">
                                <input type="time" class="form-control" name="hora_inicio_miercoles">
                                <input type="time" class="form-control" name="hora_fin_miercoles">
                            </div>
                        </div>
                        <div class="hora-asistencia form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="jueves">
                            <label class="form-check-label" for="jueves">Jueves</label>
                            <div class="horarios">
                                <input type="time" class="form-control" name="hora_inicio_jueves">
                                <input type="time" class="form-control" name="hora_fin_jueves">
                            </div>
                        </div>
                        <div class="hora-asistencia form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="viernes">
                            <label class="form-check-label" for="viernes">Viernes</label>
                            <div class="horarios">
                                <input type="time" class="form-control" name="hora_inicio_viernes">
                                <input type="time" class="form-control" name="hora_fin_viernes">
                            </div>
                        </div>
                        <div class="hora-asistencia form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="sabado">
                            <label class="form-check-label" for="sabado">Sábado</label>
                            <div class="horarios">
                                <input type="time" class="form-control" name="hora_inicio_sabado">
                                <input type="time" class="form-control" name="hora_fin_sabado">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="descripcion_act_real" class="form-label">Descripción de las actividades a realizar:</label>
                    <textarea class="form-control" id="descripcion_act_real" rows="10"></textarea>
                </div>
                <div class="row mb-5">
                    <div class="col">
                        <button onclick="window.location.href='plan_trabajo.php'" class="btn btn-primary">Guardar</button>
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
