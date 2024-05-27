<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Directorio donde se guardarán los archivos subidos
    $directorioSubida = 'uploads/';

    // Verifica si el directorio de subida existe, si no, lo crea
    if (!is_dir($directorioSubida)) {
        mkdir($directorioSubida, 0755, true);
    }

    // Obtiene información sobre el archivo subido
    $nombreArchivo = $_FILES['archivo']['name'];
    $tipoArchivo = mime_content_type($_FILES['archivo']['tmp_name']);
    $archivoSubido = $directorioSubida . basename($nombreArchivo);

    // Validación del archivo
    if ($tipoArchivo == 'application/pdf' && ($nombreArchivo === 'Reporte_Global.pdf' || $nombreArchivo === 'Reseña_Practicas.pdf' || $nombreArchivo === 'Constancia.pdf')) {
        if (move_uploaded_file($_FILES['archivo']['tmp_name'], $archivoSubido)) {
            echo "El archivo " . basename($nombreArchivo) . " ha sido subido con éxito.";
        } else {
            echo "Hubo un error al subir el archivo. Por favor, intenta de nuevo.";
        }
    } else {
        echo "Error: Solo se permiten archivos PDF con el nombre indicado.";
    }
} else {
    echo "Error: No se ha enviado ningún archivo.";
}
?>
