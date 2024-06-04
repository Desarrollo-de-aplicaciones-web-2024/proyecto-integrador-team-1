<?php

// Conexión a la base de datos
$conn = new mysqli("database-team1-daw.c30w0agw4764.us-east-2.rds.amazonaws.com", "admin", "S1stemas_23", "PP_TEAM1");
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Directorio donde se guardarán los archivos subidos
    $directorioSubida = 'uploads/';

    // Verifica si el directorio de subida existe, si no, lo crea
    if (!is_dir($directorioSubida)) {
        mkdir($directorioSubida, 0755, true);
    }

    // Inicializa el mensaje de resultado
    $mensaje = "";

    // Función para procesar cada archivo
    function procesarArchivo($nombreInput, $nombreArchivoDestino, $tipo) {
        global $directorioSubida, $mensaje, $conn;
        if (isset($_FILES[$nombreInput]) && $_FILES[$nombreInput]['error'] == UPLOAD_ERR_OK) {
            $tipoArchivoSubido = mime_content_type($_FILES[$nombreInput]['tmp_name']);
            $archivoSubido = $directorioSubida . $_FILES[$nombreInput]['name'];

            // Validación del archivo
            if ($tipoArchivoSubido == 'application/pdf') {
                if (move_uploaded_file($_FILES[$nombreInput]['tmp_name'], $archivoSubido)) {
                    // Inserta el registro en la base de datos
                    $matricula = 202160177; // Cambiar esto por la matricula real del estudiante
                    $estado = 'pendiente'; // Estado inicial del documento
                    $tipoArchivo = "final";
                    $stmt = $conn->prepare("INSERT INTO Archivos (matricula, tipo_archivo, nombre_archivo, ruta_archivo, estado, clasificacion) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("isssss", $matricula,$tipoArchivo, $_FILES[$nombreInput]['name'], $archivoSubido, $estado, $tipo);
                    if ($stmt->execute()) {
                        $mensaje .= "El archivo " . basename($_FILES[$nombreInput]['name']) . " ha sido subido con éxito como " . $nombreArchivoDestino . ".<br>";
                    } else {
                        $mensaje .= "Hubo un error al guardar la información del archivo " . basename($_FILES[$nombreInput]['name']) . " en la base de datos.<br>";
                    }
                    $stmt->close();
                } else {
                    $mensaje .= "Hubo un error al subir el archivo " . basename($_FILES[$nombreInput]['name']) . ". Por favor, intenta de nuevo.<br>";
                }
            } else {
                $mensaje .= "Error: El archivo " . basename($_FILES[$nombreInput]['name']) . " no es un PDF válido.<br>";
            }
        }
    }

    // Procesa cada archivo individualmente
    procesarArchivo('archivo-reporte', 'Reporte_Global.pdf', 'reporte');
    procesarArchivo('archivo-resena', 'Reseña_Practicas.pdf', 'resena');
    procesarArchivo('archivo-constancia', 'Constancia.pdf', 'constancia');

    // Muestra el mensaje final basado en los resultados de la subida
    echo $mensaje;
    header("Location: documentos-finales.php?upload=success");
    exit();
} else {
    header("Location: documentos-finales.php?upload=failure");
    exit();
}
?>
