<?php
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
    function procesarArchivo($nombreInput, $nombreArchivoDestino) {
        global $directorioSubida, $mensaje;
        if (isset($_FILES[$nombreInput]) && $_FILES[$nombreInput]['error'] == UPLOAD_ERR_OK) {
            $tipoArchivo = mime_content_type($_FILES[$nombreInput]['tmp_name']);
            $archivoSubido = $directorioSubida . $nombreArchivoDestino;

            // Validación del archivo
            if ($tipoArchivo == 'application/pdf') {
                if (move_uploaded_file($_FILES[$nombreInput]['tmp_name'], $archivoSubido)) {
                    $mensaje .= "El archivo " . basename($_FILES[$nombreInput]['name']) . " ha sido subido con éxito como " . $nombreArchivoDestino . ".<br>";
                } else {
                    $mensaje .= "Hubo un error al subir el archivo " . basename($_FILES[$nombreInput]['name']) . ". Por favor, intenta de nuevo.<br>";
                }
            } else {
                $mensaje .= "Error: El archivo " . basename($_FILES[$nombreInput]['name']) . " no es un PDF válido.<br>";
            }
        }
    }

    // Procesa cada archivo individualmente
    procesarArchivo('archivo-reporte', 'Reporte_Global.pdf');
    procesarArchivo('archivo-resena', 'Reseña_Practicas.pdf');
    procesarArchivo('archivo-constancia', 'Constancia.pdf');

    // Muestra el mensaje final basado en los resultados de la subida
    echo $mensaje;
    header("Location: documentos-finales.php?upload=success");
    exit();
} else {
    header("Location: documentos-finales.php?upload=failure");
    exit();
}
?>
