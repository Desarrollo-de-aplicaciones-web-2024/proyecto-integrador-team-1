<?php
require_once '../../../../config/global.php';
require_once '../../../../config/db.php';
// Definir la ruta de inclusión, ajustar según sea necesario
define('RUTA_INCLUDE', '../../../../');





?>
<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-TMqX1SPpjQn3n3EqFSKwkjCZOI8wjUkaWwrk/WvC+5Aee3uvD63ftIQKIt8FcU2jOZNtH2X96R2eKNQqgj2xtQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Asegúrate de que PAGE_TITLE esté definida -->
    <title><?php echo htmlspecialchars(PAGE_TITLE, ENT_QUOTES, 'UTF-8'); ?></title>

    <!-- Incluir archivos superiores -->
    <?php getTopIncludes(RUTA_INCLUDE); ?>

    <!-- Estilos para la barra de progreso -->
    <style>
        .progress-container {
            width: 100%;
            background-color: #f3f3f3;
            border-radius: 4px;
            overflow: hidden;
            height: 20px;
            margin-bottom: 15px;
        }

        .progress-stage {
            width: 25%;
            height: 100%;
            float: left;
            background-color: #ddd;
            position: relative;
            transition: background-color 0.25s;
        }

        .progress-stage.active {
            background-color: #3d65ee;
        }

        .progress-title {
            text-align: center;
            margin-bottom: 10px;
        }

        .progress-stage-title {
            position: absolute;
            top: -25px;
            left: 50%;
            transform: translateX(-50%);
            color: #555;
            font-size: 14px;
        }

        .progress-stage-number {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
        }
    </style>
</head>

<body id="page-top">

<!-- Incluir barra de navegación -->
<?php getNavbar(); ?>

<div id="wrapper">

    <!-- Incluir barra lateral -->
    <?php getSidebar($rutas)?>

    <div id="content-wrapper">
        <div class="container-fluid">
            <!-- Contenido de la página -->
            <h1>¡Bienvenido, Alumno(a)!</h1>
            <hr>
            <p>Bienvenido a tu portal de prácticas profesionales.</p>

            <!-- Título de la barra de progreso -->
            <h2 class="progress-title">Progreso de documentación de prácticas profesionales</h2>
            <p class="progress-note"><b>NOTA:</b> Recuerda que por cualquier aclaración, ponte en contacto directo con Aseguramiento de calidad y Dirección de Carrera</p>

            <!-- Barra de progreso -->
            <div class="progress-container">
                <!-- Etapa 1 -->
                <div class="progress-stage active">
                    <div class="progress-stage-title"><i class="fas fa-file"></i> Etapa 1</div>
                    <div class="progress-bar" style="width: 25%;">25%</div>
                    <div class="progress-stage-number">Etapa 1</div>
                </div>
                <!-- Etapas restantes -->
                <div class="progress-stage">
                    <div class="progress-stage-title">Etapa 2</div>
                    <div class="progress-bar" style="width: 0;">0%</div>
                    <div class="progress-stage-number">Etapa 2</div>
                </div>
                <div class="progress-stage">
                    <div class="progress-stage-title">Etapa 3</div>
                    <div class="progress-bar" style="width: 0;">0%</div>
                    <div class="progress-stage-number">Etapa 3</div>
                </div>
                <div class="progress-stage">
                    <div class="progress-stage-title">Etapa 4</div>
                    <div class="progress-bar" style="width: 0;">0%</div>
                    <div class="progress-stage-number">Etapa 4</div>
                </div>
            </div>
            <!-- Texto adicional -->
            <p><i class="fas fa-file"></i> <b>Etapa 1:</b> Solicitar carta de presentación y formato de documentos requeridos
                </br><i class="fas fa-file"></i> <b>Etapa 2:</b> Subir documentos de Solicitud y Carta de Aceptación
                </br><i class="fas fa-file"></i> <b>Etapa 3:</b> Subir Reportes mensuales de prácticas
                </br><i class="fas fa-file"></i> <b>Etapa 4:</b> Documentos de conclusión de prácticas aceptados</p>


                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

        <!-- Incluir pie de página -->
        <?php getFooter(); ?>
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->

<!-- Botón de desplazamiento hacia arriba -->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Incluir modal de logout -->
<?php getModalLogout(); ?>

<!-- Incluir archivos inferiores -->
<?php getBottomIncludes(RUTA_INCLUDE); ?>

<!-- Script para la lógica de la barra de progreso -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let stages = document.querySelectorAll(".progress-stage");

        // Comprobar si la etapa anterior está completa
        function isPreviousStageComplete(stageIndex) {
            for (let i = 0; i < stageIndex; i++) {
                if (!stages[i].classList.contains("active")) {
                    return false;
                }
            }
            return true;
        }

        // Actualizar el progreso de las etapas
        function updateStagesProgress() {
            for (let i = 1; i < stages.length; i++) {
                if (isPreviousStageComplete(i)) {
                    stages[i].querySelector(".progress-bar").style.width = "25%";
                } else {
                    stages[i].querySelector(".progress-bar").style.width = "0%";
                }
            }
        }

        // Actualizar el progreso inicialmente
        updateStagesProgress();
    });
</script>
</body>

</html>
