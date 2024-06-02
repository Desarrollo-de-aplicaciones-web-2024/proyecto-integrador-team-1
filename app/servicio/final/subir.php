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

    // Itera sobre los archivos subidos
    foreach ($_FILES['archivos']['name'] as $indice => $nombreArchivo) {
        $tipoArchivo = mime_content_type($_FILES['archivos']['tmp_name'][$indice]);

        // Genera un nombre de archivo único
        $nombreUnico = uniqid() . "_" . basename($nombreArchivo);
        $archivoSubido = $directorioSubida . $nombreUnico;

        // Validación del archivo
        if ($tipoArchivo == 'application/pdf') {
            if (move_uploaded_file($_FILES['archivos']['tmp_name'][$indice], $archivoSubido)) {
                $mensaje .= "El archivo " . basename($nombreArchivo) . " ha sido subido con éxito como " . $nombreUnico . ".<br>";
            } else {
                $mensaje .= "Hubo un error al subir el archivo " . basename($nombreArchivo) . ". Por favor, intenta de nuevo.<br>";
            }
        } else {
            $mensaje .= "Error: El archivo " . basename($nombreArchivo) . " no es un PDF válido o no tiene el nombre permitido.<br>";
        }
    }

    // Muestra el mensaje final basado en los resultados de la subida
    echo $mensaje;
} else {
    echo "Error: No se ha enviado ningún archivo.";
}
?>
