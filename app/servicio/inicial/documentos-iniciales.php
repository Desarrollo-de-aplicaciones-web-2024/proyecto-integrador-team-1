<?php
require_once '../../../config/global.php';

define('RUTA_INCLUDE', '../../../'); // ajustar a necesidad

// Conexión a la base de datos
$conn = new mysqli("database-team1-daw.c30w0agw4764.us-east-2.rds.amazonaws.com", "admin", "S1stemas_23", "PP_TEAM1");
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener la matrícula del usuario (cambia esto por la matrícula real del estudiante)
$matricula = 202160177;
$tipo_archivo = "inicial";

// Consulta SQL para obtener los archivos subidos por la matrícula especificada
$sql = "SELECT nombre_archivo, estado, clasificacion FROM Archivos WHERE matricula = ? && tipo_archivo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $matricula, $tipo_archivo);
$stmt->execute();
$result = $stmt->get_result();

// Crear una matriz bidimensional para almacenar los datos de los archivos subidos
$archivos = array();

// Iterar sobre los resultados y almacenarlos en la matriz bidimensional
while ($row = $result->fetch_assoc()) {
    $archivos[] = array(
        'nombre_archivo' => $row['nombre_archivo'],
        'estado' => $row['estado'],
        'clasificacion' => isset($row['clasificacion']) ? $row['clasificacion'] : 'sin_clasificacion' // Manejar el caso en que 'clasificacion' sea NULL o no exista
    );
}

// Cerrar la consulta y la conexión
$stmt->close();
$conn->close();

// Crear matrices para clasificar los documentos por su clasificación
$documentosPorClasificacion = array();

// Clasificar los documentos según su clasificación
foreach ($archivos as $archivo) {
    $documentosPorClasificacion[$archivo['clasificacion']][] = array(
        'nombre_archivo' => $archivo['nombre_archivo'],
        'estado' => $archivo['estado']
    );
}

//// Imprimir los documentos según su clasificación y estado
//foreach ($documentosPorClasificacion as $clasificacion => $documentos) {
//    echo "Clasificación: $clasificacion<br>";
//    foreach ($documentos as $documento) {
//        echo "Nombre del archivo: " . $documento['nombre_archivo'] . " - Estado: " . $documento['estado'] . "<br>";
//    }
//    echo "<br>";
//}

function procesarEstado ($documentosPorClasificacion,$nombre)
{
    $encontrado = false;
    // Realizar acciones basadas en el estado de los documentos
    foreach ($documentosPorClasificacion as $clasificacion => $documentos) {
        foreach ($documentos as $documento) {
            if ($clasificacion == $nombre) {
                $encontrado = true; // Documento encontrado
                if ($documento['estado'] == 'pendiente') {
                    // Acción para documentos pendientes
                    echo '<td class="align-middle text-center"><p class="text-warning"  id="estado-documento">Pendiente</p></td>';
                } elseif ($documento['estado'] == 'rechazado') {
                    // Acción para documentos rechazados
                    echo '<td class="align-middle text-center" ><p class="text-danger" id="estado-documento">Rechazado</p></td>';
                } elseif ($documento['estado'] == 'aceptado') {
                    // Acción para documentos aceptados
                    echo '<td class="align-middle text-center" ><p class="text-success" id="estado-documento">Aceptado</p></td>';
                }
            }
        }
    }

    // Si no se encontraron documentos para la clasificación 'reporte', muestra un mensaje
    if (!$encontrado) {
        echo '<td class="align-middle text-center" <p class="text-secondary" id="estado-documento">No hay documentos subidos</p></td>';
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
    <link rel="stylesheet" href="estilos.css" >

    <title><?php echo "Documentos Iniciales" ?></title>

    <?php getTopIncludes(RUTA_INCLUDE) ?>

    <style>

        #subir-solicitud,#subir-plan_trabajo,#subir-carta_presentacion {
            display: none; /* Oculta el input de tipo file */
        }

        #mensaje-error {
            display: none;
        }

        .contenedor-icono svg{
            width: 20px;
            height: 20px;
        }

        .contenedor-icono{
            background-color: transparent;
            border: none;
            color: blue;
        }

        .archivo-reporte {
            display: none;
            margin-top: 10px;
            font-size: 14px;
            color: green;
        }


        .archivo-resena {
            display: none;
            margin-top: 10px;
            font-size: 14px;
            color: green;
        }


        .archivo-constancia {
            display: none;
            margin-top: 10px;
            font-size: 14px;
            color: green;
        }
    </style>
</head>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<body id="page-top">

<?php getNavbar() ?>

<div id="wrapper">

    <?php getSidebar($rutas);?>

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Page Content -->
            <h1>Documentos Iniciales</h1>
            <hr>
            <p><b>En este espacio descargarás los documentos necesarios para el inicio de tus prácticas profesionales, así como llenar todos los documentos necesarios.
            </p></b>
            <div class="alert alert-info" role="alert">
                <strong>Nota:</strong>
                <ul class="mb-0">
                    <li>No subir archivos manchados o maltratados.</li>
                    <li>Recuerda cumplir con todos los documento necesarios para poder completar tu periodo de practicas</li>
                    <li>Las firmas, datos del alumno y demás involucrados se observen claramente.</li>

                </ul>
            </div>
            <div class="container">
                <h4><b>Archivos por subir</b></h4>

                <p id="mensaje-error" class="alert alert-danger"></p>

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="align-middle">Archivos</th>
                        <th class="align-middle text-center">Estatus</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <!--REPORTE GLOBAL-->
                        <td class="align-middle" >Solicitud Practicas Profesionales
                            <a href="solicitud_practicas.php" download="solicitud_practicas.pdf" class="contenedor-icono" type="button" id="boton-descarga"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 16 16">
                                    <path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
                                </svg></a>
                            <button class="contenedor-icono" id="boton-subida-solicitud"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-up" viewBox="0 0 16 16">
                                    <path d="M8.5 11.5a.5.5 0 0 1-1 0V7.707L6.354 8.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 7.707z"/>
                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
                                </svg> </button>
                            <p class="archivo-solicitud"> </p>
                        </td>

                        <?php
                        procesarEstado($documentosPorClasificacion,'solicitud');
                        ?>



                    </tr>
                    <tr>
                        <!--RESEÑA DE PRACTICAS-->
                        <td class="align-middle">Plan de Trabajo
                            <a href="PlanDeTrabajo.php" download="PlanDeTrabajo.pdf" class="contenedor-icono" id> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 16 16">
                                    <path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
                                </svg></a>
                            <button class="contenedor-icono" id="boton-subida-plan_trabajo"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-up" viewBox="0 0 16 16">
                                    <path d="M8.5 11.5a.5.5 0 0 1-1 0V7.707L6.354 8.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 7.707z"/>
                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
                                </svg></button>
                            <p class="archivo-plan_trabajo">  </p>

                        </td>
                        <?php

                        procesarEstado($documentosPorClasificacion, 'plan_trabajo');

                        ?>
                    </tr>
                    <tr>
                        <!--CONSTANCIA-->
                        <td class="align-middle">Carta de Presentacion <a href="CartaP.php" download="CartaP.pdf" class="contenedor-icono"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 16 16">
                                    <path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
                                </svg></a>
                            <button href="" class="contenedor-icono" id="boton-subida-carta_presentacion"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-up" viewBox="0 0 16 16">
                                    <path d="M8.5 11.5a.5.5 0 0 1-1 0V7.707L6.354 8.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 7.707z"/>
                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
                                </svg></button>
                            <p class="archivo-carta_presentacion"> </p>
                        </td>
                        <?php
                        procesarEstado($documentosPorClasificacion, 'carta_presentacion');
                        ?>
                    </tr>
                    </tbody>
                </table>
            </div>

            <form id="formulario-subida" action="subir.php" method="post" enctype="multipart/form-data">
                <input class="archivo" type="file" name="archivo-solicitud" id="subir-solicitud" accept="application/pdf">
                <input class="archivo" type="file" name="archivo-plan_trabajo" id="subir-plan_trabajo" accept="application/pdf">
                <input class="archivo" type="file" name="archivo-carta_presentacion" id="subir-carta_presentacion" accept="application/pdf">

                <div class="archivos_subidos">

                </div>

                <div class="d-flex flex-column" style="height: 15vh;">
                    <div class="flex-grow-1"></div>
                    <div class="row my-3">
                        <div class="col text-center">
                            <input type="submit" value="Subir Archivos" class="btn btn-success" id="input-subida" </input>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Ventana emergente de éxito -->
            <div class="modal fade" id="modalExito" tabindex="-1" role="dialog" aria-labelledby="modalExitoLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalExitoLabel">Subida Exitosa</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ¡Todos los archivos se han subido con éxito!
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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

<?php getBottomIncudes(RUTA_INCLUDE) ?>

<script>


    document.addEventListener('DOMContentLoaded', function() {
        const SolicitudInput = document.getElementById('subir-solicitud');
        const PlanTrabajoInput = document.getElementById('subir-plan_trabajo');
        const CartaPInput = document.getElementById('subir-carta_presentacion');

        const botonSubidaSolicitud = document.getElementById('boton-subida-solicitud');
        const botonSubidaPlanTrabajo = document.getElementById('boton-subida-plan_trabajo');
        const botonSubidaCartaP = document.getElementById('boton-subida-carta_presentacion');

        const archivoSubidoSolicitud = document.querySelector('.archivo-solicitud');
        const archivoSubidoPlanTrabajo = document.querySelector('.archivo-plan_trabajo');
        const archivoSubidoCartaP = document.querySelector('.archivo-carta_presentacion');

        //BOTONES SUBIDA
        botonSubidaSolicitud.addEventListener('click', () => {
            SolicitudInput.click();
        });

        botonSubidaPlanTrabajo.addEventListener('click', () => {
            PlanTrabajoInput.click();
        });

        botonSubidaCartaP.addEventListener('click', () => {
            CartaPInput.click();
        });

        //MOSTRAR ARCHIVOS
        SolicitudInput.addEventListener('change', function() {
            const fileName = this.files[0].name;
            archivoSubidoSolicitud.textContent = fileName;
            archivoSubidoSolicitud.style.display = 'block';
        });

        PlanTrabajoInput.addEventListener('change', function() {
            const fileName = this.files[0].name;
            archivoSubidoPlanTrabajo.textContent = fileName;
            archivoSubidoPlanTrabajo.style.display = 'block';
        });

        CartaPInput.addEventListener('change', function() {
            const fileName = this.files[0].name;
            archivoSubidoCartaP.textContent = fileName;
            archivoSubidoCartaP.style.display = 'block';
        });
    });

    document.getElementById('input-subida').addEventListener('click', function(event) {
        const solicitud = document.getElementById('subir-solicitud').files.length;
        const PlanTrabajo = document.getElementById('subir-plan_trabajo').files.length;
        const CartaP = document.getElementById('subir-constancia').files.length;
        const estados = document.querySelectorAll("#estado-documento");
        const estadoSolicitud = estados[0].textContent.trim();
        const estadoPlanTrabajo = estados[1].textContent.trim();
        const estadoCartaP = estados[2].textContent.trim();

        console.log(estadoConstancia);
        console.log(constancia);

        if (
            (estadoSolicitud === "Pendiente" || estadoSolicitud === "Aceptado") &&
            (estadoPlanTrabajo === "Pendiente" || estadoPlanTrabajo === "Aceptado") &&
            (estadoCartaP === "Pendiente" || estadoCartaP === "Aceptado")
        ) {
            event.preventDefault();
            const mensajeError = document.getElementById('mensaje-error');
            mensajeError.textContent = 'Todos tus archivos han sido subidos correctamente';
            mensajeError.style.display = 'block';
            mensajeError.classList.remove('alert-danger');
            mensajeError.classList.add('alert-success');
        }

        if (solicitud === 0 && (estadoSolicitud === "Rechazado" || estadoSolicitud === "No hay documentos subidos")) {
            event.preventDefault();
            const mensajeError = document.getElementById('mensaje-error');
            mensajeError.textContent = 'No puedes enviar el formulario si el estado del reporte es Rechazado o No hay documentos subidos sin subir un archivo.';
            mensajeError.style.display = 'block';
            mensajeError.classList.remove('alert-success');
            mensajeError.classList.add('alert-danger');
            console.log(1);
        }

        if (PlanTrabajo === 0 && (estadoPlanTrabajo === "Rechazado" || estadoPlanTrabajo === "No hay documentos subidos")) {
            event.preventDefault();
            const mensajeError = document.getElementById('mensaje-error');
            mensajeError.textContent = 'No puedes enviar el formulario si el estado del reporte es Rechazado o No hay documentos subidos sin subir un archivo.';
            mensajeError.style.display = 'block';
            mensajeError.classList.remove('alert-success');
            mensajeError.classList.add('alert-danger');
            console.log(2);
        }

        if (CartaP === 0 && (estadoCartaP === "Rechazado" || estadoCartaP === "No hay documentos subidos")) {
            event.preventDefault();
            const mensajeError = document.getElementById('mensaje-error');
            mensajeError.textContent = 'No puedes enviar el formulario si el estado del reporte es Rechazado o No hay documentos subidos sin subir un archivo.';
            mensajeError.style.display = 'block';
            mensajeError.classList.remove('alert-success');
            mensajeError.classList.add('alert-danger');
            console.log(3);
        }
    });

    // Mostrar mensaje de éxito si se redirige con ?upload=success
    window.addEventListener('load', function() {
        const params = new URLSearchParams(window.location.search);
        if (params.get('upload') === 'success') {
            $('#modalExito').modal('show');
        }
    });


</script>
</body>

</html>
