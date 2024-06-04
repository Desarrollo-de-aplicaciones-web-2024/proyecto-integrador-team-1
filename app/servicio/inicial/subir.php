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
    function procesarArchivo($nombreInput, $tipo) {
        global $directorioSubida, $mensaje, $conn;
        if (isset($_FILES[$nombreInput]) && $_FILES[$nombreInput]['error'] == UPLOAD_ERR_OK) {
            $tipoArchivoSubido = mime_content_type($_FILES[$nombreInput]['tmp_name']);
            $nombreArchivoOriginal = basename($_FILES[$nombreInput]['name']);
            $archivoIDUnico = uniqid() . '-' . time();
            $nombreArchivoDestino = $archivoIDUnico . '-' . $nombreArchivoOriginal;
            $archivoSubido = $directorioSubida . $nombreArchivoDestino;

            // Validación del archivo
            if ($tipoArchivoSubido == 'application/pdf') {
                if (move_uploaded_file($_FILES[$nombreInput]['tmp_name'], $archivoSubido)) {
                    // Inserta el registro en la base de datos
                    $matricula = 202160177; // Cambiar esto por la matricula real del estudiante
                    $estado = 'pendiente'; // Estado inicial del documento
                    $stmt = $conn->prepare("INSERT INTO Archivos (matricula, tipo_archivo, nombre_archivo, ruta_archivo, estado, clasificacion) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("isssss", $matricula, $tipo, $nombreArchivoDestino, $archivoSubido, $estado, $tipo);
                    if ($stmt->execute()) {
                        $mensaje .= "El archivo " . $nombreArchivoOriginal . " ha sido subido con éxito como " . $nombreArchivoDestino . ".<br>";
                    } else {
                        $mensaje .= "Hubo un error al guardar la información del archivo " . $nombreArchivoOriginal . " en la base de datos.<br>";
                    }
                    $stmt->close();
                } else {
                    $mensaje .= "Hubo un error al subir el archivo " . $nombreArchivoOriginal . ". Por favor, intenta de nuevo.<br>";
                }
            } else {
                $mensaje .= "Error: El archivo " . $nombreArchivoOriginal . " no es un PDF válido.<br>";
            }
        }
    }

    // Procesa cada archivo individualmente
    procesarArchivo('archivo-solicitud', 'solicitud');
    procesarArchivo('archivo-plan_trabajo', 'plan_trabajo');
    procesarArchivo('archivo-carta_presentacion', 'carta_presentacion');

    // Muestra el mensaje final basado en los resultados de la subida
    echo $mensaje;
    header("Location: documentos-iniciales.php?upload=success");
    exit();
} else {
    header("Location: documentos-iniciales.php?upload=failure");
    exit();
}
?>
