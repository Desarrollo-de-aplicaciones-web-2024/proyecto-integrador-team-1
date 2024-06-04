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

// Consulta SQL para obtener los archivos subidos por la matrícula especificada
$sql = "SELECT nombre_archivo, estado, clasificacion FROM Archivos WHERE matricula = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $matricula);
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
                    echo '<td class="align-middle text-center"><p class="text-warning">pendiente</p></td>';
                } elseif ($documento['estado'] == 'rechazado') {
                    // Acción para documentos rechazados
                    echo '<td class="align-middle text-center"><p class="text-danger">rechazado</p></td>';
                } elseif ($documento['estado'] == 'aceptado') {
                    // Acción para documentos aceptados
                    echo '<td class="align-middle text-center"><p class="text-success">aceptado</p></td>';
                }
            }
        }
    }

    // Si no se encontraron documentos para la clasificación 'reporte', muestra un mensaje
    if (!$encontrado) {
        echo '<td class="align-middle text-center"><p class="text-secondary">No hay documentos subidos</p></td>';
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

    <title><?php echo "Documentos Finales" ?></title>

    <?php getTopIncludes(RUTA_INCLUDE) ?>

    <style>

        #subir-reporte,#subir-constancia,#subir-resena {
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

<body id="page-top">

<?php getNavbar() ?>

<div id="wrapper">

    <?php getSidebar();?>

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Page Content -->
            <h1>Documentos Finales</h1>
            <hr>
            <p><b>En este espacio descargarás los documentos necesarios para el final de tus prácticas profesionales, así como llenar todos los documentos necesarios
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
                        <td class="align-middle" >Reporte global
                            <a href="Solicitud.php" download="Solicitud Practicas Profesionales" class="contenedor-icono" type="button" id="boton-descarga"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 16 16">
                                    <path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
                                </svg></a>
                            <button class="contenedor-icono" id="boton-subida-reporte"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-up" viewBox="0 0 16 16">
                                    <path d="M8.5 11.5a.5.5 0 0 1-1 0V7.707L6.354 8.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 7.707z"/>
                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
                                </svg> </button>
                            <p class="archivo-reporte"> constancia.pdf</p>
                        </td>

                        <?php
                            procesarEstado($documentosPorClasificacion,'reporte');
                        ?>



                    </tr>
                    <tr>
                        <!--RESEÑA DE PRACTICAS-->
                        <td class="align-middle">Reseña de practicas
                            <a href="" download="Plan de trabajo de prácticas profesionales" class="contenedor-icono" id> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 16 16">
                                    <path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
                                </svg></a>
                            <button class="contenedor-icono" id="boton-subida-resena"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-up" viewBox="0 0 16 16">
                                    <path d="M8.5 11.5a.5.5 0 0 1-1 0V7.707L6.354 8.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 7.707z"/>
                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
                                </svg></button>
                            <p class="archivo-resena"> constancia.pdf</p>

                        </td>
                        <?php

                        procesarEstado($documentosPorClasificacion, 'resena');

                        ?>
                    </tr>
                    <tr>
                        <!--CONSTANCIA-->
                        <td class="align-middle">Constancia <a href="Formulario_Registro_Dato.php" download="Carta de Aceptación" class="contenedor-icono"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 16 16">
                                    <path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
                                </svg></a>
                            <button href="" class="contenedor-icono" id="boton-subida-constancia"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-up" viewBox="0 0 16 16">
                                    <path d="M8.5 11.5a.5.5 0 0 1-1 0V7.707L6.354 8.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 7.707z"/>
                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
                                </svg></button>
                            <p class="archivo-constancia"> constancia.pdf</p>
                        </td>
                        <?php
                        procesarEstado($documentosPorClasificacion, 'constancia');
                        ?>
                    </tr>
                    </tbody>
                </table>
            </div>

            <form id="formulario-subida" action="subir.php" method="post" enctype="multipart/form-data">
                    <input class="archivo" type="file" name="archivo-reporte" id="subir-reporte" accept="application/pdf">
                    <input class="archivo" type="file" name="archivo-resena" id="subir-resena" accept="application/pdf">
                    <input class="archivo" type="file" name="archivo-constancia" id="subir-constancia" accept="application/pdf">

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

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>


    document.addEventListener('DOMContentLoaded', function() {
        const reporteInput = document.getElementById('subir-reporte');
        const resenaInput = document.getElementById('subir-resena');
        const constanciaInput = document.getElementById('subir-constancia');

        const botonSubidaReporte = document.getElementById('boton-subida-reporte');
        const botonSubidaResena = document.getElementById('boton-subida-resena');
        const botonSubidaConstancia = document.getElementById('boton-subida-constancia');

        const archivoSubidoReporte = document.querySelector('.archivo-reporte');
        const archivoSubidoResena = document.querySelector('.archivo-resena');
        const archivoSubidoConstancia = document.querySelector('.archivo-constancia');

        //BOTONES SUBIDA
        botonSubidaReporte.addEventListener('click', () => {
            reporteInput.click();
        });

        botonSubidaResena.addEventListener('click', () => {
            resenaInput.click();
        });

        botonSubidaConstancia.addEventListener('click', () => {
            constanciaInput.click();
        });

        //MOSTRAR ARCHIVOS
        reporteInput.addEventListener('change', function() {
            const fileName = this.files[0].name;
            archivoSubidoReporte.textContent = fileName;
            archivoSubidoReporte.style.display = 'block';
        });

        resenaInput.addEventListener('change', function() {
            const fileName = this.files[0].name;
            archivoSubidoResena.textContent = fileName;
            archivoSubidoResena.style.display = 'block';
        });

        constanciaInput.addEventListener('change', function() {
            const fileName = this.files[0].name;
            archivoSubidoConstancia.textContent = fileName;
            archivoSubidoConstancia.style.display = 'block';
        });
    });

    document.getElementById('input-subida').addEventListener('click', function(event) {

        const reporte = document.getElementById('subir-reporte').files.length;
        const resena = document.getElementById('subir-resena').files.length;
        const constancia = document.getElementById('subir-constancia').files.length;
        if (reporte === 0 || resena === 0 || constancia === 0) {
            event.preventDefault();
            const mensajeError = document.getElementById('mensaje-error');
            mensajeError.textContent = 'Por favor, sube todos los archivos requeridos antes de enviar el formulario.';
            mensajeError.style.display = 'block';
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
